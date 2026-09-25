/**
 * Decap CMS GitHub login — step 2 of 2.
 * GitHub redirects here with ?code&state. We exchange the code for an access token
 * and hand it to the CMS window that opened the popup, using Decap's postMessage
 * handshake. The token is only ever posted to this site's own origin.
 */
function readCookie(req, name) {
  const match = (req.headers.cookie || '').match(new RegExp('(?:^|;\\s*)' + name + '=([^;]+)'));
  return match ? match[1] : null;
}

function renderResult(res, status, payload) {
  const message = `authorization:github:${status}:${JSON.stringify(payload)}`;
  const note = status === 'success'
    ? 'Signed in. You can close this window if it does not close by itself.'
    : 'Sign-in failed: ' + payload.message;
  const escapeHtml = s => s.replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

  res.setHeader('Content-Type', 'text/html; charset=utf-8');
  res.setHeader('Cache-Control', 'no-store');
  res.setHeader('Referrer-Policy', 'no-referrer');
  // Expire the one-time state cookie
  res.setHeader('Set-Cookie', 'tb_cms_oauth_state=; Path=/api/callback; HttpOnly; Secure; SameSite=Lax; Max-Age=0');
  res.status(200).send(`<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="robots" content="noindex"><title>Estate CMS sign-in</title></head>
<body style="font-family:Georgia,serif;background:#07130E;color:#F5F1E9;display:grid;place-items:center;min-height:100vh;margin:0">
<p>${escapeHtml(note)}</p>
<script>
(function () {
  var message = ${JSON.stringify(message).replace(/</g, '\\u003c')};
  if (!window.opener) return;
  // Decap replies to "authorizing:github" from the CMS window; only answer our own origin.
  window.addEventListener('message', function onMessage(e) {
    if (e.origin !== window.location.origin) return;
    window.removeEventListener('message', onMessage);
    window.opener.postMessage(message, e.origin);
  });
  window.opener.postMessage('authorizing:github', window.location.origin);
})();
</script>
</body></html>`);
}

module.exports = async (req, res) => {
  const { code, state, error, error_description: errorDescription } = req.query;

  if (error) {
    return renderResult(res, 'error', { message: errorDescription || error });
  }
  const expectedState = readCookie(req, 'tb_cms_oauth_state');
  if (!code || !state || !expectedState || state !== expectedState) {
    return renderResult(res, 'error', { message: 'Login link expired or invalid. Please try again.' });
  }

  try {
    const host = req.headers['x-forwarded-host'] || req.headers.host;
    const tokenRes = await fetch('https://github.com/login/oauth/access_token', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
      body: JSON.stringify({
        client_id: process.env.OAUTH_GITHUB_CLIENT_ID,
        client_secret: process.env.OAUTH_GITHUB_CLIENT_SECRET,
        code,
        redirect_uri: `https://${host}/api/callback`
      })
    });
    const data = await tokenRes.json();
    if (!data.access_token) {
      console.error('[CMS OAuth] Token exchange failed:', data.error, data.error_description);
      return renderResult(res, 'error', { message: data.error_description || 'GitHub did not return an access token.' });
    }
    return renderResult(res, 'success', { token: data.access_token, provider: 'github' });
  } catch (err) {
    console.error('[CMS OAuth] Token exchange error:', err);
    return renderResult(res, 'error', { message: 'Could not reach GitHub. Please try again.' });
  }
};
