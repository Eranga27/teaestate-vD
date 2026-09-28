# The Tea Bungalow — website

Luxury heritage stay: restored 1890s planter's bungalow in Galaha, Sri Lanka (base for Pekoe Trail Stages 1 & 2). 7 keys (6 chambers + Carriage House Cottage). Full roadmap and phase status: [docs/bungalow-ledger.md](docs/bungalow-ledger.md).

- Production (`main`): https://teaestate.vercel.app
- Preview (`feature/platform-integrations`): https://teabungalow-git-feature-platform-integrations-eranga-bowatte.vercel.app — the older `deploy-git-…` alias is frozen at a September build; don't use it.
- Repo: github.com/Eranga27/teaestate-vD · Vercel project: `eranga-bowatte/teabungalow`

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

Estate staff commit content through the CMS on this same branch, so `git pull` before starting work. Commit `src/`, `api/`, `scripts/` changes only. Vercel runs `npm run build` on every push and serves `public/` (see `vercel.json`).

## CMS (`/admin`)

Decap CMS with one shared estate login — editors don't need GitHub accounts.

- `src/admin/index.html`: branded sign-in form → `api/cms-login.js` checks the password server-side and sets a 12-hour HttpOnly session cookie, then Decap loads with a placeholder user.
- Decap's GitHub backend talks to `/api/github/*` (rewritten to `api/cms-github.js`), which checks the session and calls GitHub with the server-side token. It only allows reads of this repo plus the save sequence (blob → tree → commit → non-forced branch update), and trees may only contain regular files under `src/data/` or `src/images/cms/` — the CMS can never change code. `npm test` covers these rules (`scripts/test_cms_auth.js`).
- Vercel env vars: `CMS_ADMIN_PASSWORD`, `CMS_GITHUB_TOKEN` (fine-grained token, this repo only, Contents read & write), optional `CMS_ADMIN_USERNAME` (default `estate-admin`). Changing the password or token signs everyone out.
- Saves commit to the branch in `config.yml` as the token's owner; Vercel rebuilds (~30 s). Image uploads are capped at 3 MB per field (Vercel's 4.5 MB request limit).
- Config lives only in `config.yml`; `index.html` just sets `api_root` to this origin.
- One JSON file per entry in folder collections. Never put an array of entries in one file — the CMS would treat it as a single entry and overwrite it. Order comes from `sort_order`.
- Packages & Offers render the Pekoe Trail and Heritage grids on `/packages` (one `layout: featured` card allowed); the Estate Buyout rates section stays in `src/packages.php`.

## Guest forms & CRM (Brevo)

- `/contact` → `api/enquiry.js`, Chairman's Bungalow waitlist → `api/waitlist.js`; shared helpers in `api/_brevo.js`. Forms must send URL-encoded bodies (`new URLSearchParams(new FormData(form))`) — Vercel functions don't parse multipart.
- With `BREVO_API_KEY`: each submission emails `ESTATE_NOTIFY_EMAIL` (guest as Reply-To) from `BREVO_SENDER_EMAIL`, then adds the guest to `BREVO_ENQUIRY_LIST_ID` / `BREVO_WAITLIST_LIST_ID` (enquiries carry `ARRIVAL_DATE` / `DEPARTURE_DATE` for Brevo automations). If the email fails the guest gets an error, never a false "thank you". Without the key the forms show guests an error pointing to WhatsApp / stay@theteabungalow.com (submission only logged).
- `scripts/test_forms.js` (in `npm test`) mocks Brevo.
- Current setup (Preview): sent through the developer's Brevo account with a Gmail sender, which Brevo replaces with its own compliant From address; recipients are stay@theteabungalow.com + the developer. To send as stay@, authenticate theteabungalow.com in Brevo (DNS at IONOS) and set `BREVO_SENDER_EMAIL`. Lists are not configured yet.

## Analytics

- `GTM_ID` (Vercel env var, build time) sets the Tag Manager container. Unset → the GTM loader is omitted; Consent Mode v2 defaults and `dataLayer` events stay. Templates keep the `GTM-TEABUNGALOW` placeholder, replaced at build.

## Rules

- Work on `feature/platform-integrations`; never commit to `main` (production at teaestate.vercel.app). Promotion is a reviewed PR.
- Site-wide changes belong in `src/layout/*.php`, not in individual pages.
- Every page must keep: once-per-session tea-leaf preloader, PDPA consent banner wired to Google Consent Mode v2, GTM snippet (when `GTM_ID` is set), reservation modal. `npm test` enforces this.
- Design tokens: Forest Green `#1E4D2B` / `#07130E`, Heritage Gold `#C7A85E` / `#dfc080`, Estate Cream `#F5F1E9`. Fonts: Cinzel, Playfair Display, EB Garamond, Lato. Restrained heritage luxury — no generic Bootstrap/Tailwind look, no intrusive popups.

## Known gaps

- Production (`main`) still has the old enquiry/waitlist code: forms post multipart data the handler can't read, and nothing is emailed — enquiries there are lost until the fix is promoted.
- Awaiting the owner: PMS choice (Little Hotelier vs Beds24), PayHere merchant credentials, Brevo account/API key, real GTM container. Brevo automations for the guest journey (Day −14, −3, +1) are built in Brevo's UI on the enquiry list; booking-confirmed triggers need the PMS.
- The privacy policy should name Brevo as a data processor once it is in use.
