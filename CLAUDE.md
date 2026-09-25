# The Tea Bungalow — website

Luxury heritage stay: restored 1890s planter's bungalow in Galaha, Sri Lanka (base for Pekoe Trail Stages 1 & 2). 7 keys (6 chambers + Carriage House Cottage). Full roadmap and phase status: [docs/bungalow-ledger.md](docs/bungalow-ledger.md).

## Layout

| Path | What it is |
|---|---|
| `src/*.php` | The 12 page templates (edit here). `submit_*.php`, `config/`, `.htaccess` are legacy PHP-hosting files, superseded by `api/` |
| `src/layout/navbar.php`, `footer.php` | Shared partials: nav, preloader, consent banner, reservation modal (`#tb-reserve-modal`) |
| `src/data/**/*.json` | CMS content (experiences, packages, journal, gallery, announcements, chamber rates) |
| `src/admin/` | Decap CMS (`config.yml` + login/bootstrap `index.html`) |
| `src/images/` | Estate photos; CMS uploads go to `src/images/cms/` |
| `api/*.js` | Vercel serverless functions (enquiry, waitlist, create-payment, booking-webhook) |
| `scripts/` | `build_static.js` (src → public), QA scripts, local server |
| `public/` | **Generated, gitignored.** Never edit by hand |

## Workflow

```bash
npm run build            # src/ → public/ (plain Node, no PHP or deps needed)
npm test                 # 11 structural checks per page + image/link check
npm run serve            # http://localhost:3000 serving public/
npm run verify:preview   # live checks against the Vercel preview
```

Commit `src/`, `api/`, `scripts/` changes only. Vercel runs `npm run build` on every push and serves `public/` (see `vercel.json`).

## Rules

- Work on `feature/platform-integrations`; never commit to `main` (production at teaestate.vercel.app). Promotion is a reviewed PR.
- Site-wide changes belong in `src/layout/*.php`, not in individual pages.
- Every page must keep: once-per-session tea-leaf preloader, PDPA consent banner wired to Google Consent Mode v2, GTM snippet, reservation modal. `npm test` enforces this.
- Design tokens: Forest Green `#1E4D2B` / `#07130E`, Heritage Gold `#C7A85E` / `#dfc080`, Estate Cream `#F5F1E9`. Fonts: Cinzel, Playfair Display, EB Garamond, Lato. Restrained heritage luxury — no generic Bootstrap/Tailwind look, no intrusive popups.

## Known gaps

- `/admin` login is a client-side placeholder (not a security boundary) and the CMS runs on Decap's `test-repo` backend, so edits are not saved. Real auth (GitHub OAuth / Git Gateway) is pending.
- GTM container ID `GTM-TEABUNGALOW` is a placeholder; replace with the real `GTM-XXXXXXX` in `src/layout/navbar.php` and `scripts/build_static.js`.
- PMS (Little Hotelier vs Beds24), PayHere merchant credentials and Brevo/HubSpot keys are awaiting the owner.
