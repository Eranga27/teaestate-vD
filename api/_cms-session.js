const crypto = require('crypto');

/**
 * Shared helpers for the estate CMS login (not a route: Vercel skips files starting with "_").
 *
 * Env (Vercel):
 *   CMS_ADMIN_PASSWORD   shared password editors type at /admin
 *   CMS_ADMIN_USERNAME   optional, defaults to "estate-admin"
 *   CMS_GITHUB_TOKEN     fine-grained GitHub token for this repo only (Contents: read & write).
 *                        Stays on the server; the browser never sees it.
 */
const REPO = 'Eranga27/teaestate-vD'; // must match backend.repo in src/admin/config.yml
const COOKIE = 'tb_cms_session';
const MAX_AGE = 12 * 60 * 60; // seconds

function cmsConfig() {
  const password = process.env.CMS_ADMIN_PASSWORD;
  const token = process.env.CMS_GITHUB_TOKEN;
  if (!password || !token) return null;
  return { username: process.env.CMS_ADMIN_USERNAME || 'estate-admin', password, token };
}

const sha256 = s => crypto.createHash('sha256').update(String(s)).digest();
const safeEqual = (a, b) => crypto.timingSafeEqual(sha256(a), sha256(b));

// Keyed on the password *and* the GitHub token: changing either signs everyone out, and a
// stolen cookie can't be used to guess the password offline.
function sign(cfg, expires) {
  const key = sha256(cfg.password + '\0' + cfg.token);
  return crypto.createHmac('sha256', key).update(`tb-cms.${expires}`).digest('hex');
}

function sessionCookie(cfg) {
  const expires = Math.floor(Date.now() / 1000) + MAX_AGE;
  return `${COOKIE}=${expires}.${sign(cfg, expires)}; Path=/; HttpOnly; Secure; SameSite=Strict; Max-Age=${MAX_AGE}`;
}

const clearedCookie = `${COOKIE}=; Path=/; HttpOnly; Secure; SameSite=Strict; Max-Age=0`;

function hasValidSession(req, cfg) {
  const match = (req.headers.cookie || '').match(new RegExp(`(?:^|;\\s*)${COOKIE}=(\\d+)\\.([a-f0-9]{64})`));
  if (!match || Number(match[1]) < Date.now() / 1000) return false;
  return safeEqual(match[2], sign(cfg, match[1]));
}

module.exports = { REPO, cmsConfig, safeEqual, sessionCookie, clearedCookie, hasValidSession };
