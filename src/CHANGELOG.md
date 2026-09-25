# The Tea Bungalow — vD Final Deliverable Change Log
Date: 8 September 2026

Target: /vD (Separate clean release: `The_Tea_Bungalow_vD_final_2026-09-08/vD`)
Note: /vC and prior versions remain completely unmodified as archives.

## 1. Release Architecture & Routing
- **Independent Versioning**: Created clean `vD` directory with all assets, PHP files, layout templates, and `.htaccess`.
- **Full Internal Link Migration**: Updated 127 internal links and action targets from `/vC/` to `/vD/` across all PHP files, header/footer components, and routing rules.
- **Canonical PHP Filenames**:
  - `packages.php` (replaces `pakages.php`)
  - `experiences.php` (replaces `experinces.php`)
  - `chairmans-bungalow-2027.php` (replaces `chairman's-bungalow-2027.php`)
  - Configured `.htaccess` 301 redirects for legacy filenames and old `.html` paths.

## 2. Navigation & Layout Standardization
- **Full 11-Page Shared Layout**: All pages utilize `layout/navbar.php` and `layout/footer.php` with dynamic `$page` active highlighting.
- **Header & Mobile Drawer Parity**: Added missing links ("The Entire Estate", "Contact & Location", "Gallery", "About Us", "Chairman's Bungalow") to ensure all 11 pages are reachable in both desktop and mobile navigation.
- **Robust Mobile Drawer**: Updated mobile drawer toggle mechanism for reliable, instant open/close state transitions.
- **Footer Destinations**: Fixed dead links, restored missing destinations, linked "Getting Here" and "Transfers" directly to the interactive location/map section (`contact.php#location`).

## 3. Expired Promotional & Content Corrections
- **Packages Page (`packages.php`)**:
  - Replaced expired soft-opening banner ("25–30% off all packages until 30 June 2026") with "Current Rates Available on Request — Tailored proposals & direct booking inclusions".
  - Replaced "30% Off Soft Opening" badge with "Direct / Rates on Request".
- **The Entire Estate Page (`the-entire-estate.php`)**:
  - Removed expired "Soft opening discounts apply until 30 June 2026" claim.
  - Replaced "All 6 chambers + cottage" with "All 6 chambers and cottage".
  - Changed rate meta tag to "Direct rates on request".
- **Experiences Page (`experiences.php`)**:
  - Corrected dining schedule typo: Breakfast is now correctly listed as "6:30 AM – 10:00 AM" (was previously "6:30 PM").
  - Added missing `#estate` anchor to the Guided Tea Estate Walk card.

## 4. Usability & Form Validation Fixes
- **Form Placeholders**: Corrected email input placeholders on `contact.php` and `chairmans-bungalow-2027.php` from `stay@theteabungalow.com` to `your.email@example.com`, preventing guest confusion where the hotel's own address was suggested as their contact email.
- **Pricing Clarity**: Replaced all customer-facing "Rs. TBC" labels with professional "Price on request" tags pending finalized commercial rates.
- **Developer Placeholders Cleaned**: Removed all developer notes ("Replace with...") from public cards.

## 5. Responsive Design & Mobile Viewport Fixes
- **Eliminated Horizontal Overflow**: Constrained `.location-inner`, `.map-placeholder`, and embedded iframe components to strict 100% viewport bounds on screens ≤768px.
- **Mobile Hero Typography**: Refined letter spacing and word break rules on mobile hero titles to prevent line overflowing on small mobile displays.

## 6. Verification & Automated Test Status
- All 11 pages return HTTP 200 on local server.
- All redirect rules return HTTP 301 to `/vD/` canonical destinations.
- 0 broken internal links or broken anchor IDs.
- Zero references to `/vC/` remaining in `/vD/` codebase.

## 7. Placeholder Imagery Replacement & Real Photography Integration
- **Gallery (`gallery.php`)**:
  - Replaced all 30 placeholder gradient boxes and emoji markers with authentic estate photographs from `/images/` with zoom-on-hover scaling.
  - Configured high-resolution photo previews in the interactive lightbox modal with full image-scaling parity.
  - Integrated authentic photography into the 6-tile Instagram grid (`tea-estate.jpg`, `IMG_7651.jpeg`, `front-view-woman-pouring-iced-tea.jpg`, `house.jpeg`, `swimming-pool-resort.jpg`, `Pekoe Trail access.jpg`).
- **Chambers (`our-chambers.php`)**:
  - Replaced CSS gradient stand-ins across all 7 accommodation visual panels with high-resolution photography:
    - Founder's Suite (01): `images/838733193.jpg`
    - Highlands Suite (02): `images/838733260.jpg`
    - The Pekoe Room (03): `images/838733265.jpg`
    - Verandah Chamber (04): `images/838733269.jpg`
    - The Camellia Room (05): `images/838733276.jpg`
    - The Galaha Room (06): `images/IMG_7653.jpeg`
    - Carriage House Cottage (07): `images/IMG_7654.jpeg`
  - Removed placeholder emojis and icons from `.ch-ph`.
- **Experiences (`experiences.php`)**:
  - Replaced signature fireplace placeholder box and emoji with real fireside photograph (`images/IMG_7650.jpeg`) integrated with the existing ember rise animation.
  - Upgraded all 15 experience visual backgrounds from flat gradients to real lifestyle and estate photography (`front-view-woman-pouring-iced-tea.jpg`, `tea-estate.jpg`, `IMG_7639.jpeg`, `IMG_7651.jpeg`, `IMG_7660.jpeg`, `hero-img2.jpg`, `eating outdoor.jpg`, `swimming-pool-resort.jpg`, `IMG_7675.jpeg`, `Pekoe Trail access.jpg`, `Snooker evenings.jpg`, `garden.webp`, `tea-factory.jpg`).
- **Hero & Header Visuals across Pages**:
  - `home.php`: Replaced gradient stand-in with `images/heroimg-1.jpeg`.
  - `the-bungalow.php`: Replaced gradient stand-in with `images/house.jpeg`.
  - `the-entire-estate.php`: Replaced gradient stand-in with `images/tea-estate.jpg`.
  - `pekoe-trail.php`: Replaced gradient stand-in with `images/Pekoe Trail access.jpg`.
  - `packages.php`: Replaced gradient stand-in with `images/tea-estate.jpg`.
  - `about.php`: Replaced gradient stand-in with `images/house.jpeg`.
  - `contact.php`: Replaced gradient stand-in with `images/house.jpeg`.
  - `chairmans-bungalow-2027.php`: Replaced "photography coming soon" placeholder with `images/house.jpeg`.
- **Zero Missing Assets**: 100/100 photo references verified on disk. All 11 pages verified with HTTP 200.

### 2026-09-08 — Design & Typography Micro-Polishing
- **Hero Eyebrow Visibility (`home.php`)**:
  - Replaced low-contrast styling on `.hero-estate` with an elegant frosted-glass emerald pill with subtle border and text shadow for crisp legibility over bright background imagery.
- **Typographic Quote Marks (`home.php`)**:
  - Enclosed the opening mist intro quote in proper typographic curly quotes (`“...”`).
- **Experience Cards (`home.php`)**:
  - Removed `"From Price on Request"` lines (`From Price on request · per person`, `From Price on request · for two`) from Planter's Afternoon Tea, Tea Estate Walk, and Private Fireside Dinner cards.
- **Our Chambers Hero Thumbnail Strip (`our-chambers.php`)**:
  - Replaced the 7 solid-color gradient block placeholders (`th-01` through `th-07`) in the top hero strip with authentic room photographs (`838733193.jpg`, `838733260.jpg`, `838733265.jpg`, `838733269.jpg`, `838733276.jpg`, `IMG_7653.jpeg`, `IMG_7654.jpeg`).
  - Polished room numbering and room title labels with enhanced contrast gradients and drop shadows for optimal visibility over images while preserving smooth zoom hover interactions.
- **Shared Spaces / Life on the Estate (`the-bungalow.php`)**:
  - Unified all 6 space cards with consistent luxury white card styling, eliminating the jarring asymmetric green background on the fireplace card.
  - Upgraded layout from edge-to-edge 2px border grid to a breathing 24px grid with 8px rounded corners, subtle warm elevation shadows, and a refined gold top accent border (`border-top: 3px solid var(--gold)`).
  - Enhanced emoji icons with elegant circular medallion badges (`48x48px`) featuring soft sage backgrounds and gold hover transitions.
  - Converted long italic descriptions and section subtitle to clean normal font style (`font-style: normal`) with enhanced ink contrast for improved readability.
- **The Private Pool Visual (`the-bungalow.php`)**:
  - Replaced the green placeholder box, dummy concentric ripples, and water emoji in `.pool-visual` with the authentic estate resort photograph `images/swimming-pool-resort.jpg` with a subtle vignette gradient overlay.
- **Estate Chambers Count & Intro Harmony (`our-chambers.php`)**:
  - Reconciled the room count between the hero circular badge (`7 Rooms`) and the intro heading directly underneath it by updating the heading from *"Six Rooms, One House, One Carriage House"* to *"Seven Rooms: Six in the House, One Carriage House"*.
  - Updated the intro body copy to explicitly clarify the seven-room distribution (six main bungalow chambers + private Carriage House Cottage) and converted italic styling to clean normal font style (`font-style: normal`) for improved legibility.
- **Removed Redundant "Room Details" / "Cottage Details" Buttons (`our-chambers.php`)**:
  - Removed the secondary `.btn-ghost` buttons across all 7 accommodation cards (`#founders`, `#highlands`, `#pekoe`, `#verandah`, `#camellia`, `#galaha`, `#cottage`) that redirected to their own current cards, leaving a single, high-conversion primary call-to-action button (*"Enquire About This Room"* / *"Enquire About the Cottage"*).






