const crypto = require('crypto');

/**
 * Decap CMS GitHub login — step 1 of 2.
 * The CMS opens this in a popup (backend.base_url + auth_endpoint) and we send the
 * editor to GitHub's consent screen. GitHub returns them to /api/callback.
 *
 * Env (Vercel): OAUTH_GITHUB_CLIENT_ID, OAUTH_GITHUB_CLIENT_SECRET from a GitHub
 * OAuth App whose callback URL is https://<this host>/api/callback.
 */
const ALLOWED_SCOPES = new Set(['public_repo', 'repo']);

module.exports = (req, res) => {
  const clientId = process.env.OAUTH_GITHUB_CLIENT_ID;
  if (!clientId || !process.env.OAUTH_GITHUB_CLIENT_SECRET) {
    return res.status(500).send('Estate CMS login is not configured yet (missing GitHub OAuth credentials).');
  }

  const host = req.headers['x-forwarded-host'] || req.headers.host;
  const scope = ALLOWED_SCOPES.has(req.query.scope) ? req.query.scope : 'public_repo';
  const state = crypto.randomBytes(16).toString('hex');

  // CSRF guard: /api/callback only accepts a code that comes back with this state
  res.setHeader('Set-Cookie', `tb_cms_oauth_state=${state}; Path=/api/callback; HttpOnly; Secure; SameSite=Lax; Max-Age=600`);
  res.setHeader('Cache-Control', 'no-store');

  const url = new URL('https://github.com/login/oauth/authorize');
  url.searchParams.set('client_id', clientId);
  url.searchParams.set('redirect_uri', `https://${host}/api/callback`);
  url.searchParams.set('scope', scope);
  url.searchParams.set('state', state);
  return res.redirect(302, url.toString());
};
