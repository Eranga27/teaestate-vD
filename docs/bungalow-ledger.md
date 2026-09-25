# The Bungalow Ledger

**The Tea Bungalow — Galaha, Sri Lanka**
A phased plan for taking the estate's website from a static showcase to a fully connected booking & guest-management platform.

Drafted 15 Sept 2026 · Owner: Eranga · Repo: teaestate-vD

---

## Decisions on record

- **Approach:** Buy, don't build. PMS, booking engine, channel manager and payments come from one bundled hospitality platform rather than custom point-integrations against each OTA/payment API.
- **Starting point:** No PMS or CRM today — bookings run on email/WhatsApp/phone plus a spreadsheet, alongside the existing `/api/enquiry.js` and `/api/waitlist.js` forms.
- **Payments:** Must clear both international cards and Sri Lanka-local rails (LankaQR / local wallets) — not one or the other.
- **CMS:** Editor is the non-technical estate team, updating content often — the CMS needs a real visual editor, not a code workflow.
- **Location:** A restored 1890s colonial planter's bungalow in Galaha, Sri Lanka — old enough to qualify for SLTDA's Heritage Bungalow registration class, which gates OTA/channel-manager listing (see §04).
- **Build tool:** Implemented in Antigravity, on a dedicated feature branch — merged to `main` only through a reviewed pull request (see §01).

---

## Contents

00. Guiding principles
01. Branch & environment workflow
02. Architecture shift required
03. The preloader
04. PMS & booking engine
05. Payment gateway
06. Channel manager
07. CRM & guest journeys
08. CMS for the estate team
09. Analytics & conversion
10. Cross-cutting requirements
11. Phased roadmap
12. Testing, rollback & go-live
13. Indicative cost envelope
14. Open decisions before Phase 2
15. Handoff brief for Antigravity

---

## 00. Guiding principles

- **Buy the plumbing, build the experience.** A 7-room heritage bungalow gains nothing from bespoke channel-manager engineering. The platform's job is to be indistinguishable from a hand-built luxury site while the wiring underneath is entirely off-the-shelf.
- **Nothing touches `main` untested.** Every integration ships first to a feature branch with its own Vercel Preview URL and sandbox credentials, and is promoted to production only through a reviewed pull request.
- **The site never depends on a slow third party to render.** Booking widgets, CMS content and payment scripts load progressively; if the PMS or payment gateway is having a bad day, the estate's photography, copy and enquiry form still work.
- **Guest card data never touches Vercel.** Every payment flow uses hosted fields or a redirect from a PCI-compliant processor — this repo should never see a PAN or CVV.
- **Sequence for revenue first, autonomy second, insight third.** Booking engine, payments and channel sync unblock direct revenue and commission savings. CMS and CRM unblock the estate team. Analytics closes the loop once there's traffic worth measuring.

---

## 01. Branch & environment workflow

Everything happens on a dedicated integration branch, kept alive until every feature below has been verified on its own Vercel Preview Deployment.

```
cd "f:\testsite\testsite\deploy"
git checkout -b feature/platform-integrations
git push -u origin feature/platform-integrations
```

Because the Vercel project is already linked to `github.com/Eranga27/teaestate-vD`, this push alone creates a unique, shareable Preview URL for the branch — separate from `https://teaestate.vercel.app/` — without any extra configuration.

**Keep sandbox credentials out of production.** In Vercel Project Settings › Environment Variables, scope every new secret to Preview only until go-live: sandbox PMS API keys, PayHere's test merchant ID, a separate GA4 property/stream. Promote each variable to Production individually, feature by feature, rather than flipping a single switch for everything at once.

**Template source vs. deployed output.** Everything lives in one repo. Edit the PHP templates, `layout/` partials and CMS JSON under `src/`, then run `npm run build` (which runs `scripts/build_static.js`) to regenerate `public/` locally. Commit only `src/` changes — `public/` is gitignored, and Vercel runs the same build on every push, so the source and the deployed site can't drift apart and CMS edits committed to `src/data/` go live automatically.

**Promotion.** Once a feature is verified on its Preview URL, open a pull request into `main`. The merge triggers the normal production deploy — no manual step beyond reviewing the diff.

> **Working in Antigravity.** This workflow is IDE-agnostic — it makes no difference whether commits come from Antigravity's agent, Claude, or a manual terminal. Two things worth doing specifically because an agentic tool is driving the commits: point Antigravity's working context at `feature/platform-integrations` from the very first prompt, not `main`; and add a branch protection rule on `main` in GitHub (require a pull request before merging, no direct pushes) so no tool — agentic or otherwise — can land a change on production without a reviewed diff in between.

---

## 02. Architecture shift required

The site stays what it is — eleven pre-rendered static pages on Vercel's edge network — but a handful of pages become *hybrid*: static shell, live data layered in client-side.

- **Stays static:** Home, The Bungalow, About, Pekoe Trail, Experiences — pre-rendered exactly as today. Only their content source moves to the CMS (§08).
- **Goes hybrid:** Our Chambers, Packages, The Entire Estate — static page shell, with the PMS's booking widget mounted client-side for live rates and availability.

Three new serverless functions join `/api/enquiry.js` and `/api/waitlist.js`:

| Function | Purpose |
|---|---|
| `/api/booking-webhook.js` | Receives reservation-confirmed events from the PMS so they can be mirrored into the CRM and trigger pre-arrival email sequences. |
| `/api/cms-deploy-hook.js` | Fires a rebuild when the CMS publishes new content, if content is baked in at build time rather than fetched client-side. |
| `/api/create-payment.js` | Only needed if a standalone deposit flow is run outside the PMS's own checkout — see §05. |

Any secret key lives in a Vercel Environment Variable, never in client-side JS. A PMS widget's public property ID is the one exception — it's designed to be visible in the page source.

---

## 03. The preloader

Minimal, once-per-session, 2–4 seconds, and invisible to anyone who has already seen it.

**The constraint most preloader plans miss.** This is an eleven-page static site, not a single-page app — every internal click is a fresh document load. Without a "seen it already" flag, the preloader would replay on *every single navigation*, which is the opposite of seamless. The fix is a `sessionStorage` flag, set the first time it plays, checked before the overlay is even painted on every subsequent page.

**Behaviour**
- First page view in a session: full-bleed Estate Cream (or Forest Green, on brand review) overlay with the estate's monogram and a single restrained motion — a thin gold rule drawing itself, or the wordmark fading up. No spinner, no progress bar.
- Timing: a floor of ~1.2s so it never flashes, a hard ceiling of 4s regardless of what's still loading — implemented as a race between the `load` event and a `setTimeout`, gated by the minimum-display timer.
- Every subsequent page in the same session: no preloader at all — the flag short-circuits it before the overlay markup even renders.
- `prefers-reduced-motion`: skip the animation and show (or skip entirely) a static, near-instant version.

**Implementation notes**
- Pure CSS keyframes plus roughly 25–30 lines of vanilla JS — no animation library. Weight budget: well under 10KB combined.
- Inline the critical preloader CSS in `<head>` so there's no flash-of-unstyled-overlay; the markup sits as the first element in `<body>`.
- Built once into the shared header partial that `build_static.js` injects, so one source edit updates all eleven pages.
- The overlay sits above the real page content, which is already in the DOM underneath — nothing about this delays LCP or harms SEO.
- After the fade-out transition, remove the overlay from the DOM (not just `opacity:0`) so it never lingers in the accessibility tree, and mark it `aria-hidden="true"` while visible.

---

## 04. PMS & live booking engine

One bundled platform for property management, direct booking engine and channel manager — sized for a 7-room independent property, not a 30-room mid-market hotel.

> **Local compliance comes first — SLTDA Heritage Bungalow registration.** Before any OTA can be connected, the property needs to be registered with the Sri Lanka Tourism Development Authority. Given the 1890s restoration story already on the site, this bungalow almost certainly qualifies for SLTDA's **Heritage Bungalow** class (buildings constructed before 1920, or declared under the Antiquities Ordinance No. 09 of 1940, with original exterior features preserved) rather than the standard Bungalow class — worth confirming with SLTDA's Bungalow desk early. Registration runs through `eservices.sltda.gov.lk`. Put this on the critical path in Phase 0: it has nothing to do with the PMS vendor decision, so it can start in parallel today.

| Platform | Why it fits | Trade-off |
|---|---|---|
| **Little Hotelier** (by SiteMinder) | Purpose-built for 1–30 room independent properties. PMS, direct booking engine, channel manager and payments in one subscription, with a guided setup and an embeddable "Book Now" widget. | Less low-level control over the booking widget's exact look — theming happens through their customization panel, not raw CSS. |
| **Beds24** | Developer-oriented, strong presence across Asia, open API, generally cheaper — a good fit if the priority is a booking flow that matches the site's bespoke design exactly. | More manual configuration, less guided onboarding. |

> **Verify before committing.** Neither vendor publishes pricing specific to a 7-room heritage property — book a live demo and request a sample CSV export of reservations/guest profiles to confirm data portability before signing. Put this call in Phase 0.

**Where the widget lives**
- **/our-chambers** — a "Check availability" button per room, opening the widget pre-filtered to that room type.
- **/packages** — each package links through with the relevant rate plan pre-selected.
- **/the-entire-estate** — buyout enquiry flows into the widget's multi-room booking, or stays an enquiry if the PMS doesn't support whole-property holds cleanly.
- **Home** — a sticky "Check Availability" call to action in the hero.

**Brand theming.** Booking widgets are opaque iframes by default and will look bolted-on until themed. Budget real time in Phase 2 to push Forest Green, Heritage Gold and Estate Cream, plus Cinzel/Playfair Display, through whichever theming panel the chosen vendor offers.

**Keep the human channel open.** Luxury guests often prefer to book through a concierge conversation rather than a self-service widget. Keep `/api/enquiry.js` live in parallel as "Prefer to book by message?"

---

## 05. Payment gateway

> **Ruled out: Stripe.** Stripe does not support Sri Lanka–registered merchants directly — it requires routing through a foreign entity (a US LLC or UK Ltd) with its own tax ID and bank account, then paying out to Sri Lanka via an intermediary like Wise. Disproportionate overhead for this project unless the estate already has such an entity.

**Recommended: PayHere**, the one Sri Lankan gateway that genuinely spans both sides of the requirement in a single integration — Visa/Mastercard/Amex, LKR settlement, and foreign-currency support (USD/GBP/EUR) for international guests, alongside local wallets (Genie, EzCash, Frimi).

1. **Check the PMS's built-in processor first.** Little Hotelier and Beds24 both ship with preferred payment partners already wired into their checkout — confirm during the vendor demo whether that partner clears Sri Lankan rails well.
2. **If not, run PayHere via a dedicated endpoint.** `/api/create-payment.js` creates a PayHere Checkout session; the guest is redirected to PayHere's hosted payment page, so card data never reaches a Vercel function (PCI scope stays at SAQ-A).
3. **Verify webhook signatures.** PayHere's payment-confirmation callback must be signature-checked before a booking is marked paid, and the write should be idempotent.

Fee schedules weren't pinned down precisely in research — comparable Sri Lankan gateways run roughly 2.5–3% per transaction. Get PayHere's current merchant agreement directly before budgeting against it.

---

## 06. Channel manager

Ships with whichever PMS is chosen — SiteMinder's engine under Little Hotelier, or Beds24's own channel bridge — so there's no separate contract, no separate sync logic.

**Setup sequence**
- Connect Booking.com, Airbnb, Agoda and Expedia accounts.
- Map all seven room/rate plans 1:1 — six bungalow suites plus the Carriage House Cottage.
- Set a small sync buffer and enable two-way sync so a booking anywhere decrements availability everywhere within minutes.
- Confirm rate-parity compliance — most OTA contracts require the direct-site rate to be at or below the OTA rate.

The website's own booking widget (§04) is simply one more channel pulling from this same central inventory.

> **Before go-live.** Run controlled test bookings on each connected channel in the same window and confirm inventory decrements everywhere inside the vendor's stated SLA before trusting it with real guests.

*Worth tracking, not acting on yet:* as of May 2026 the Sri Lanka Hotels Association is actively lobbying government to require SLTDA registration before a property can appear on Agoda, Booking.com or Expedia at all — no enforcement mechanism exists today, but another reason the Heritage Bungalow registration belongs in Phase 0.

---

## 07. CRM & guest journeys

The chosen PMS already keeps guest profiles, stay history and contact details — that's the system of record for guest data, and enough of a CRM on its own for a 7-room property. A dedicated hotel CRM (Revinate, Guestfolio) is priced for portfolios, not a single bungalow.

**What's actually missing: marketing automation.**

| Option | Pick it if… |
|---|---|
| **Brevo** | The priority is automated email sequences (pre-arrival, post-stay) with strong deliverability — generous free tier. |
| **HubSpot Free CRM** | The priority is pipeline visibility — enquiries as deals moving through stages, not just an inbox. |

Wire `/api/enquiry.js` and `/api/waitlist.js` to push every submission into this tool via its API, in addition to whatever email notification already fires.

**A pre-arrival sequence worth shipping on day one**
1. Booking confirmed — warm welcome, what to expect at a working tea estate.
2. Day −14 — "Packing for Pekoe Trail Stages 1 & 2."
3. Day −3 — arrival logistics: transfers, Galaha directions, what's included.
4. Day 0 (post-stay) — thank-you and a review request.

---

## 08. CMS for the estate team

The requirement is specific: non-technical editors, frequent changes — a real visual editor, not a git workflow dressed up as one.

**Recommended: Decap CMS.** Free, open-source, slots directly into the existing GitHub → Vercel pipeline at zero new hosting cost — every save the estate team makes becomes a Git commit, triggering the same ~30-second deploy already in place.

1. **Editor access** at `/admin`, authenticated via Git Gateway or GitHub OAuth — no command line, no visible git operations.
2. **Content schema** (`config.yml`) scoped to what changes often: Journal/blog entries, Experiences, Packages & offers, Gallery captions, the homepage seasonal banner. Page structure and design stay in code.
3. **The PHP-template bridge:** CMS content lands as structured JSON/Markdown files that `build_static.js` reads and injects into the matching template placeholders — one source of truth.

> **Upgrade path, not a launch requirement.** If the team later wants content scheduling, a richer media library, or multi-user approval flows, Sanity.io is the natural next step.

---

## 09. Analytics & conversion optimization

**Measurement backbone.** GA4 plus a Google Tag Manager container, with custom events mapped to the guest journey: `preloader_complete`, `booking_widget_opened`, `booking_started`, `booking_confirmed`, `waitlist_signup`, `enquiry_submitted`.

`booking_confirmed` is worth firing server-side from `/api/booking-webhook.js` via the GA4 Measurement Protocol, rather than relying on the PMS's own confirmation page to carry your tag.

**Attribution.** UTM-tag every outbound link back to the site so direct-vs-OTA-vs-organic-vs-paid is visible in GA4 — the number that ultimately justifies the booking-engine investment.

**Behaviour & performance**
- Microsoft Clarity (free, no sampling limits) on `/our-chambers` and `/packages`.
- Vercel Speed Insights to catch Core Web Vitals regressions — budget: LCP < 2.5s, CLS < 0.1, gated at PR review.

**A CRO backlog to seed at launch**
- Hero CTA copy: "Check Availability" vs. "Reserve Your Stay."
- Placement of a "book direct and save" trust message near displayed rates.
- Whether a tasteful low-availability indicator lifts conversion without clashing with a quiet-luxury tone.

> **Sri Lanka PDPA.** The Personal Data Protection Act expects clear consent for non-essential tracking and a defined retention policy for guest PII. Add a consent banner gating analytics/marketing scripts until accepted, and document retention in a privacy policy page.

---

## 10. Cross-cutting requirements

| Concern | How it's handled |
|---|---|
| PCI scope | Hosted fields / redirect only — card data never reaches a Vercel function or the repo. |
| Secrets | Every API key in Vercel Environment Variables, scoped Preview vs. Production. |
| SEO | Booking widget loads client-side into an existing indexable page — no thin duplicate pages. |
| Performance | Third-party scripts load async/deferred, or lazy on interaction. |
| Accessibility | Preloader and booking flow both pass a screen-reader and keyboard-only pass before go-live. |

---

## 11. Phased roadmap

| Phase | Focus | Depends on | Duration |
|---|---|---|---|
| **0** | Branch & environments live; SLTDA Heritage Bungalow registration and PayHere KYC both started (longest lead times — run in parallel); PMS demos booked; GA4/GTM/Clarity installed. | Nothing — start today | Week 1 |
| **1** | Preloader shipped to production; analytics baseline; PDPA consent banner. | Phase 0 | Weeks 2–3 |
| **2** | PMS account live, rooms/rates mapped, payment gateway connected, OTAs connected via channel manager, booking widget themed & embedded. | PMS vendor decision | Weeks 3–6 |
| **3** | Decap CMS schema, build-pipeline bridge, estate-team onboarding. | Phase 0 (parallel to Phase 2) | Weeks 5–7 |
| **4** | CRM/ESP layer live, enquiry & waitlist webhooks wired, pre-arrival sequence shipped. | Phase 2 | Weeks 6–8 |
| **5** | Cutover, rate-parity QA, CRO experiment backlog, two-week post-launch monitoring. | Phases 2–4 complete | Week 8+ |

---

## 12. Testing, rollback & go-live

**Preview checklist**
- Cross-browser pass including Safari/iOS — the audience skews Apple.
- Screen-reader pass on the preloader and full booking flow.
- End-to-end sandbox transaction through the payment gateway, including a failed-payment path.
- Webhook signature verification tested with a deliberately invalid payload.
- Booking widget tested under throttled/slow-3G conditions.

**Rollback.** Vercel keeps every deployment individually addressable — if something goes wrong after a merge, re-promoting the previous production deployment from the Vercel dashboard is instant and needs no git revert.

---

## 13. Indicative cost envelope

*Directional only — every source consulted notes 7-room-specific pricing isn't published and needs a live quote.*

| Item | Note |
|---|---|
| PMS + booking engine + channel manager bundle | Published tiers for ~30-room properties run roughly $150–400/month; a 7-room property should land well under that. |
| PayHere transaction fees | Comparable Sri Lankan gateways run ~2.5–3% per transaction. |
| Decap CMS | $0 — open-source, runs on the existing GitHub/Vercel pipeline. |
| Brevo or HubSpot Free | $0 at current volume. |
| GA4, GTM, Microsoft Clarity | $0. |
| Domain, SSL, hosting | Already covered by the existing Vercel + custom-domain setup. |

---

## 14. Open decisions before Phase 2

- Final PMS pick after demos — Little Hotelier vs. Beds24.
- ESP/CRM pick — Brevo vs. HubSpot Free.
- Do OTA listings (Booking.com, Airbnb, Agoda) already exist, or do they need creating from scratch?
- Is the SLTDA registration already in place (and under which class), or does it need filing fresh? This and PayHere's KYC are the two longest lead-time items on the roadmap — both worth starting in Phase 0, in parallel.
- CMS access model — shared login vs. individual GitHub-backed accounts.

---

## 15. Handoff brief for Antigravity

Antigravity starts every task cold — it doesn't have this conversation. Paste the context block below before the first task prompt of each session, then paste one task at a time.

### Context preamble — paste this first, every session

```
PROJECT: The Tea Bungalow — a luxury heritage hospitality website for a
restored 1890s colonial planter's estate in Galaha, Sri Lanka (base for
Pekoe Trail Stages 1 & 2).

STACK: 11 static HTML5 pages, no framework. Vanilla CSS3 (mobile-first,
fluid type via clamp()). Vanilla ES6+ JS, no libraries. Backend: Vercel
serverless functions under /api (enquiry.js, waitlist.js today).

BUILD PIPELINE: source PHP templates live in src/ of the repo
github.com/Eranga27/teaestate-vD; scripts/build_static.js (npm run
build) pre-renders them, injects the shared navbar/footer, and writes
clean static output into public/ (gitignored). Vercel runs that build
on every push and serves public/. Any change that should appear on all 11
pages belongs in the shared header/footer partial build_static.js reads
— locate that actual file before editing anything, don't hand-edit all
11 HTML files individually.

DESIGN TOKENS: Forest Green #1E4D2B / #0f2e16. Heritage Gold #C7A85E /
#dfc080. Estate Cream #F5F1E9. Headings: Cinzel & Playfair Display.
Body: EB Garamond & Lato.

BRANCH RULES: work only on feature/platform-integrations. Never commit
to main. When a task below is verified on its Vercel Preview URL, stop
and tell me — I'll review the diff and open the PR into main myself.
```

### Task 1 — ready now: the preloader

```
TASK: Minimal, once-per-session preloader.

Add a preloader overlay to the shared header partial so it renders
identically on all 11 pages.

BEHAVIOUR
- First page load of a browser session: show a full-bleed overlay
  (Estate Cream or Forest Green background — pick whichever reads
  cleaner against the current hero imagery) carrying the estate's
  monogram/wordmark and one restrained CSS animation — e.g. a thin
  gold rule drawing itself, or the wordmark fading up. No spinner, no
  progress bar, no animation library.
- Minimum display time ~1.2s even if the page is already loaded, so it
  never just flashes.
- Hard maximum of 4s regardless of what else is still loading.
- Every subsequent internal navigation in the same session: NO
  preloader. This is a multi-page static site, not an SPA — every
  click is a fresh document load, so without a session flag the
  preloader would replay on every single page view. Use sessionStorage
  (wrapped in try/catch — some browsers block it) to set a flag the
  first time it plays, and check that flag before the overlay markup
  even renders.
- Respect prefers-reduced-motion: skip the animation, or the whole
  preloader, for users who've set that preference.
- Accessibility: aria-hidden="true" while visible; remove the overlay
  from the DOM entirely after its fade-out transition (not just
  opacity:0) so it never lingers in the accessibility tree.
- Performance: inline the critical preloader CSS in <head> to avoid
  a flash of unstyled overlay. Keep total added weight (CSS+JS) under
  ~10KB. Must not delay or affect LCP of the real page content
  underneath, which is already present in the DOM.

BEFORE WRITING CODE
Locate the actual shared header/include file build_static.js injects
into every page, and confirm the exact command to regenerate public/
(npm run build) after a template change. Make the edit there, rebuild, then verify all
11 output pages picked up the change.

ACCEPTANCE CHECKLIST
- Fresh private/incognito window, first page: preloader plays once,
  1.2-4s, then removes itself from the DOM.
- Click to a second page in the same session: no preloader.
- New private window (new session): preloader plays again.
- prefers-reduced-motion enabled in OS settings: animation skipped.
- VoiceOver/NVDA pass: preloader isn't announced and doesn't trap focus.
- Lighthouse/PageSpeed on the homepage: LCP and CLS unchanged from the
  pre-preloader baseline.
```

### Task 2 — also ready now: analytics baseline

```
TASK: Install a GA4 + Google Tag Manager baseline.

Add a GTM container to the shared header partial (standard script +
noscript-iframe install snippet). Configure GA4 as a tag inside GTM
rather than hardcoding the GA4 snippet directly, so future custom
events (booking_widget_opened, enquiry_submitted, etc.) can be added
later from GTM without another code deploy.

Use a separate GA4 property/data stream while testing on this branch's
Preview URL so test traffic never lands in real analytics data; only
point at the production GA4 property in the PR that merges to main.
```

### What's not ready to hand off yet

PMS/booking-engine, payments, channel manager and CRM briefs need real vendor material — the actual embed snippet, API keys, or webhook docs from whichever of Little Hotelier or Beds24 gets chosen after a demo. Feeding Antigravity a fabricated widget snippet would just mean re-doing the work later. Once that demo has happened and the vendor's developer docs are in hand, bring them back to Claude and the next brief can be written for real.

---

## Sources consulted

- [Best PMS for Boutique Hotels 2026: Mews vs Cloudbeds — Hotel Tech Insight](https://hoteltechinsight.com/2025/12/10/boutique-hotel-technology-guide-2025/)
- [Little Hotelier](https://www.littlehotelier.com/) · [SiteMinder Channel Manager](https://www.siteminder.com/channel-manager/)
- [Beds24 — Capterra](https://www.capterra.com/p/123511/Beds24-com/)
- [How to Get Stripe in Sri Lanka — BR.LK](https://br.lk/blog/stripe-sri-lanka/)
- [Top 5 Payment Gateways for Sri Lankan Websites (2026) — Sitechra](https://sitechra.com/blog/payment-gateways-sri-lanka-2026)
- [Decap CMS overview](https://decapcms.org/docs/intro/)
- [SLTDA — Register With Us](https://www.sltda.gov.lk/en/register-with-us)
- [Sri Lanka hotels seek Agoda, Booking.com restrictions on unregistered properties — Newswire](https://www.newswire.lk/2026/05/16/sri-lanka-hotels-seek-agoda-booking-com-restrictions-on-unregistered-properties/)
