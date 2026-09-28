const { REPO, cmsConfig, safeEqual, sessionCookie, clearedCookie, hasValidSession } = require('./_cms-session');

/**
 * Estate CMS sign-in with one shared username + password.
 *   GET    → 200 if the session cookie is valid, else 401
 *   POST   → { username, password } → sets the session cookie
 *   DELETE → signs out
 */
module.exports = async (req, res) => {
  res.setHeader('Cache-Control', 'no-store');

  const cfg = cmsConfig();
  if (!cfg) {
    return res.status(503).json({ ok: false, message: 'The estate CMS is not set up yet. Please contact the site developer.' });
  }

  if (req.method === 'GET') {
    const ok = hasValidSession(req, cfg);
    return res.status(ok ? 200 : 401).json({ ok });
  }

  if (req.method === 'DELETE') {
    res.setHeader('Set-Cookie', clearedCookie);
    return res.status(200).json({ ok: true });
  }

  if (req.method !== 'POST') {
    return res.status(405).json({ ok: false, message: 'Method Not Allowed' });
  }

  const { username = '', password = '' } = req.body || {};
  // Compare both (no early exit) so timing doesn't reveal which one was wrong
  const userOk = safeEqual(String(username).trim(), cfg.username);
  const passOk = safeEqual(String(password), cfg.password);
  if (!(userOk && passOk)) {
    await new Promise(resolve => setTimeout(resolve, 1200)); // slow down guessing
    return res.status(401).json({ ok: false, message: 'Incorrect username or password. Please try again.' });
  }

  // Catch a missing/expired GitHub token here, with a clear message, rather than inside the CMS
  try {
    const gh = await fetch(`https://api.github.com/repos/${REPO}`, {
      headers: { Authorization: `Bearer ${cfg.token}`, Accept: 'application/vnd.github+json', 'User-Agent': 'tea-bungalow-cms' }
    });
    const repo = gh.ok ? await gh.json() : null;
    if (!repo || !(repo.permissions && repo.permissions.push)) {
      console.error('[CMS] GitHub token check failed:', gh.status);
      return res.status(502).json({ ok: false, message: 'Signed in, but the CMS cannot save to GitHub (the server token is missing access or has expired). Please contact the site developer.' });
    }
  } catch (err) {
    console.error('[CMS] GitHub unreachable:', err);
    return res.status(502).json({ ok: false, message: 'Could not reach GitHub. Please try again in a minute.' });
  }

  res.setHeader('Set-Cookie', sessionCookie(cfg));
  return res.status(200).json({ ok: true });
};
