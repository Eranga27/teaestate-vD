// Security tests for the estate CMS login (api/cms-login.js) and GitHub gateway (api/cms-github.js).
// GitHub is mocked; nothing leaves this machine.
const assert = require('assert');
const path = require('path');
const ROOT = path.resolve(__dirname, '..');
function mockRes() {
  const r = { headers: {}, statusCode: 200, body: undefined };
  r.setHeader = (k, v) => { r.headers[k.toLowerCase()] = v; return r; };
  r.status = c => { r.statusCode = c; return r; };
  r.json = b => { r.body = b; return r; }; r.send = b => { r.body = b; return r; };
  return r;
}
const login = require(ROOT + '/api/cms-login.js');
const gw = require(ROOT + '/api/cms-github.js');
const R = '/repos/Eranga27/teaestate-vD';

(async () => {
  // Not configured
  delete process.env.CMS_ADMIN_PASSWORD; delete process.env.CMS_GITHUB_TOKEN;
  let res = mockRes(); await login({ method: 'GET', headers: {} }, res); assert.equal(res.statusCode, 503);
  res = mockRes(); await gw({ method: 'GET', url: '/api/github/user', headers: {} }, res); assert.equal(res.statusCode, 503);
  console.log('✓ not configured → 503 on both endpoints');

  process.env.CMS_ADMIN_PASSWORD = 'correct horse battery'; process.env.CMS_GITHUB_TOKEN = 'github_pat_fake';
  let ghCalls = [];
  global.fetch = async (url, opts) => { ghCalls.push({ url, opts }); return { ok: true, status: 200, json: async () => ({ permissions: { push: true } }) }; };

  let t = Date.now(); res = mockRes(); await login({ method: 'POST', headers: {}, body: { username: 'estate-admin', password: 'nope' } }, res);
  assert.equal(res.statusCode, 401); assert.ok(Date.now() - t >= 1100); assert.ok(!res.headers['set-cookie']);
  res = mockRes(); await login({ method: 'POST', headers: {}, body: { username: 'someone', password: 'correct horse battery' } }, res);
  assert.equal(res.statusCode, 401);
  console.log('✓ wrong password / username → 401, delayed, no cookie');

  ghCalls = []; res = mockRes(); await login({ method: 'POST', headers: {}, body: { username: ' estate-admin ', password: 'correct horse battery' } }, res);
  assert.equal(res.statusCode, 200); const cookie = res.headers['set-cookie'];
  assert.match(cookie, /^tb_cms_session=\d+\.[a-f0-9]{64}; Path=\/; HttpOnly; Secure; SameSite=Strict; Max-Age=43200$/);
  assert.equal(ghCalls[0].url, 'https://api.github.com/repos/Eranga27/teaestate-vD');
  assert.ok(!JSON.stringify(res.body).includes('github_pat_fake') && !cookie.includes('github_pat_fake'));
  console.log('✓ correct login → HttpOnly/Secure/SameSite=Strict 12h cookie; token verified; token not exposed');

  const okFetch = global.fetch;
  global.fetch = async () => ({ ok: true, status: 200, json: async () => ({ permissions: { push: false } }) });
  res = mockRes(); await login({ method: 'POST', headers: {}, body: { username: 'estate-admin', password: 'correct horse battery' } }, res);
  assert.equal(res.statusCode, 502); assert.ok(!res.headers['set-cookie']); global.fetch = okFetch;
  console.log('✓ GitHub token without write access → 502 with clear message, no session');

  const sess = cookie.split(';')[0];
  const get = async c => { const r = mockRes(); await login({ method: 'GET', headers: { cookie: c } }, r); return r.statusCode; };
  const [exp, sig] = sess.split('=')[1].split('.');
  assert.equal(await get('x=1; ' + sess), 200);
  assert.equal(await get(`tb_cms_session=${exp}.${'0'.repeat(64)}`), 401);
  assert.equal(await get(`tb_cms_session=${Number(exp) + 999}.${sig}`), 401);
  assert.equal(await get(`tb_cms_session=1000.${sig}`), 401);
  process.env.CMS_ADMIN_PASSWORD = 'changed'; assert.equal(await get(sess), 401); process.env.CMS_ADMIN_PASSWORD = 'correct horse battery';
  res = mockRes(); await login({ method: 'DELETE', headers: {} }, res); assert.match(res.headers['set-cookie'], /Max-Age=0/);
  console.log('✓ session: forged signature, extended expiry, expired, and password change all rejected; sign-out clears cookie');

  const A = gw.isAllowed;
  const tree = (entries, base = 'abc') => ({ base_tree: base, tree: entries });
  const f = (path, extra = {}) => ({ path, mode: '100644', type: 'blob', sha: 'x', ...extra });
  const cases = [
    ['GET', '/user', null, true],
    ['GET', R, null, true],
    ['GET', R + '/git/trees/feature/platform-integrations:src/data/experiences', null, true],
    ['GET', '/repos/someone/else', null, false],
    ['GET', '/user/repos', null, false],
    ['POST', R + '/git/blobs', { content: 'x' }, true],
    ['POST', R + '/git/commits', {}, true],
    ['POST', R + '/git/trees', tree([f('src/data/experiences/a.json'), f('src/images/cms/p.jpg'), f('src/data/gallery/old.json', { sha: null })]), true],
    ['POST', R + '/git/trees', tree([f('src/data/a.json'), f('api/evil.js')]), false],
    ['POST', R + '/git/trees', tree([f('src/layout/navbar.php')]), false],
    ['POST', R + '/git/trees', tree([f('src/data/../../api/x.js')]), false],
    ['POST', R + '/git/trees', tree([f('src/data/link.json', { mode: '120000' })]), false],
    ['POST', R + '/git/trees', tree([f('src/data/sub', { type: 'tree', mode: '040000' })]), false],
    ['POST', R + '/git/trees', tree([f('src/data/a.json')], null), false],
    ['POST', R + '/git/trees', tree([]), false],
    ['PATCH', R + '/git/refs/heads/feature/platform-integrations', { sha: 's', force: false }, true],
    ['PATCH', R + '/git/refs/heads/main', { sha: 's', force: true }, false],
    ['PATCH', R + '/git/refs/tags/v1', { sha: 's' }, false],
    ['POST', R + '/git/refs', { ref: 'refs/heads/x' }, false],
    ['PUT', R + '/contents/api/x.js', {}, false],
    ['DELETE', R + '/git/refs/heads/main', null, false],
    ['POST', R + '/issues', {}, false],
    ['PATCH', R, {}, false],
  ];
  for (const [m, p, b, want] of cases) assert.equal(A(m, p, b), want, m + ' ' + p + ' ' + JSON.stringify(b));
  console.log('✓ gateway rules: ' + cases.length + ' allow/deny cases (content-only trees; no symlinks, subtrees, "..", force-push, other repos or endpoints)');

  ghCalls = []; res = mockRes(); await gw({ method: 'GET', url: '/api/github/user', headers: {} }, res);
  assert.equal(res.statusCode, 401); assert.equal(ghCalls.length, 0);
  global.fetch = async (url, opts) => {
    ghCalls.push({ url, opts });
    return { ok: true, status: 200, headers: new Map([['content-type', 'application/json']]),
      arrayBuffer: async () => Buffer.from(url.endsWith('/user') ? '{"login":"Eranga27","name":"Eranga B"}' : '{}') };
  };
  const call = async (method, url, body) => { const r = mockRes(); await gw({ method, url, body, headers: { cookie: sess, host: 'x.vercel.app', accept: 'application/vnd.github.v3.raw' } }, r); return r; };
  res = await call('GET', '/api/github/user');
  assert.equal(JSON.parse(res.body).name, 'Estate Team'); assert.equal(ghCalls[0].opts.headers.Authorization, 'Bearer github_pat_fake');
  await call('GET', '/api/github' + R + '/git/trees/feature/platform-integrations:src%2Fdata%2Fexperiences?ts=1&path=src/data/x.json');
  assert.equal(ghCalls.at(-1).url, 'https://api.github.com' + R + '/git/trees/feature/platform-integrations:src%2Fdata%2Fexperiences?ts=1&path=src%2Fdata%2Fx.json');
  await call('GET', '/api/cms-github?_gh=' + encodeURIComponent(R.slice(1) + '/branches/feature/platform-integrations') + '&ts=2');
  assert.equal(ghCalls.at(-1).url, 'https://api.github.com' + R + '/branches/feature/platform-integrations?ts=2');
  const before = ghCalls.length; res = await call('POST', '/api/github' + R + '/git/trees', tree([f('api/evil.js')]));
  assert.equal(res.statusCode, 403); assert.equal(ghCalls.length, before);
  console.log('✓ gateway: 401 without session (GitHub never called), token added server-side, both URL forms parsed, blocked writes never reach GitHub');
})().catch(e => { console.error('✗', e.message); process.exit(1); });
