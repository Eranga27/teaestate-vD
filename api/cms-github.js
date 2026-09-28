const { REPO, cmsConfig, hasValidSession } = require('./_cms-session');

/**
 * GitHub gateway for the estate CMS. Decap's GitHub backend points its api_root here
 * (/api/github/* is rewritten to this function in vercel.json). We check the session
 * cookie, then call GitHub with the server-side token — which never reaches the browser.
 *
 * Only what Decap needs to read and save content is allowed, and saves may only touch
 * content files, so a leaked CMS password cannot change the site's code.
 */
const GITHUB_API = 'https://api.github.com';
const REPO_PATH = `/repos/${REPO}`;
const WRITABLE_PREFIXES = ['src/data/', 'src/images/cms/'];

// Decap saves by: blob upload → tree on top of the branch → commit → fast-forward the branch
function isContentOnlyTree(body) {
  return Boolean(body && body.base_tree && Array.isArray(body.tree) && body.tree.length) &&
    body.tree.every(entry =>
      typeof entry.path === 'string' &&
      WRITABLE_PREFIXES.some(prefix => entry.path.startsWith(prefix)) &&
      !entry.path.split('/').includes('..') &&
      entry.mode === '100644' && // regular files only: no symlinks, executables or submodules
      entry.type === 'blob');
}

function isAllowed(method, pathname, body) {
  if (method === 'GET') {
    return pathname === '/user' || pathname === REPO_PATH || pathname.startsWith(REPO_PATH + '/');
  }
  if (method === 'POST' && (pathname === `${REPO_PATH}/git/blobs` || pathname === `${REPO_PATH}/git/commits`)) return true;
  if (method === 'POST' && pathname === `${REPO_PATH}/git/trees`) return isContentOnlyTree(body);
  if (method === 'PATCH' && pathname.startsWith(`${REPO_PATH}/git/refs/heads/`)) return !(body && body.force);
  return false;
}

// "/api/github/<path>?<query>" → "/<path>?<query>" (the rewrite also passes the path as ?_gh=)
function upstreamPath(req) {
  const url = new URL(req.url, 'http://localhost');
  const pathname = url.pathname.startsWith('/api/github/')
    ? url.pathname.slice('/api/github'.length)
    : '/' + (url.searchParams.get('_gh') || '');
  url.searchParams.delete('_gh');
  const query = url.searchParams.toString();
  return { pathname, full: pathname + (query ? `?${query}` : '') };
}

module.exports = async (req, res) => {
  res.setHeader('Cache-Control', 'no-store');

  const cfg = cmsConfig();
  if (!cfg) return res.status(503).json({ message: 'The estate CMS is not set up yet.' });
  if (!hasValidSession(req, cfg)) {
    return res.status(401).json({ message: 'Your CMS session has expired. Reload the page and sign in again.' });
  }

  const { pathname, full } = upstreamPath(req);
  const body = req.method === 'GET' ? undefined : req.body;
  let decoded;
  try { decoded = decodeURIComponent(pathname); } catch (e) { decoded = null; }
  if (!decoded || !isAllowed(req.method, decoded, body)) {
    console.warn('[CMS] Blocked', req.method, pathname);
    return res.status(403).json({ message: 'The estate CMS can only edit website content.' });
  }

  try {
    const upstream = await fetch(GITHUB_API + full, {
      method: req.method,
      headers: {
        Authorization: `Bearer ${cfg.token}`,
        Accept: req.headers.accept || 'application/vnd.github+json',
        'Content-Type': 'application/json',
        'User-Agent': 'tea-bungalow-cms'
      },
      body: body === undefined ? undefined : JSON.stringify(body)
    });

    let payload = Buffer.from(await upstream.arrayBuffer());
    if (req.method === 'GET' && pathname === '/user' && upstream.ok) {
      // Show "Estate Team" in the CMS header instead of the token owner's GitHub profile
      const user = JSON.parse(payload.toString('utf8'));
      const origin = `https://${req.headers['x-forwarded-host'] || req.headers.host}`;
      payload = Buffer.from(JSON.stringify({ ...user, name: 'Estate Team', avatar_url: `${origin}/images/favicon.png` }));
    }

    res.status(upstream.status);
    const contentType = upstream.headers.get('content-type');
    if (contentType) res.setHeader('Content-Type', contentType);
    const link = upstream.headers.get('link');
    if (link) res.setHeader('Link', link.split(GITHUB_API).join(`https://${req.headers['x-forwarded-host'] || req.headers.host}/api/github`));
    return res.send(payload);
  } catch (err) {
    console.error('[CMS] GitHub request failed:', err);
    return res.status(502).json({ message: 'Could not reach GitHub. Please try again.' });
  }
};

module.exports.isAllowed = isAllowed; // for tests
