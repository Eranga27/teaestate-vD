/**
 * optimize_media.js — web-ready media for the vE pages.
 *
 *   node scripts/optimize_media.js          (needs the sharp devDependency; ffmpeg for video)
 *
 * The originals in src/images/ are camera files (up to ~20 MB, 8000px wide). This writes
 * resized WebP versions (and the compressed hero film) to src/media/, which is committed
 * and copied to public/media/ by the build. Re-run after adding or replacing a photo, and
 * add new photos to JOBS below. Existing outputs are skipped unless --force is passed.
 */
const fs = require('fs');
const path = require('path');
const { execFileSync } = require('child_process');
const sharp = require('sharp');

const ROOT = path.resolve(__dirname, '..');
const SRC = path.join(ROOT, 'src', 'images');
const OUT = path.join(ROOT, 'src', 'media');
const FORCE = process.argv.includes('--force');

// [source file in src/images, output base name, widths]. Widths above the source are skipped.
const JOBS = [
  // Authentic bungalow interiors
  ['heroimg-1.jpeg', 'lounge-main', [900, 1600, 2400]],
  ['IMG_7639.jpeg', 'lounge-arches', [900, 1600, 2400]],
  ['IMG_7650.jpeg', 'lounge-fireplace', [900, 1600]],
  ['IMG_7643 (1).jpeg', 'lounge-red', [900, 1600]],
  ['IMG_7651.jpeg', 'lounge-windows', [900, 1600]],
  ['IMG_7660.jpeg', 'lounge-evening', [900, 1600]],
  ['IMG_7674.jpeg', 'lounge-lamps', [900, 1600]],
  ['IMG_7675.jpeg', 'hall-mirror', [700, 1200]],
  ['IMG_7619.jpeg', 'room-bench', [900, 1600]],
  ['garden.webp', 'garden', [900, 1360]],
  // Chambers, same photo per room as the Chambers page
  ['838733193.jpg', 'chamber-founders', [900, 1600]],
  ['838733260.jpg', 'chamber-highlands', [1024]],
  ['838733265.jpg', 'chamber-pekoe', [1024]],
  ['838733269.jpg', 'chamber-verandah', [1024]],
  ['838733276.jpg', 'chamber-camellia', [1024]],
  ['IMG_7653.jpeg', 'chamber-galaha', [900, 1600]],
  ['IMG_7654.jpeg', 'chamber-carriage', [900, 1600]],
  // Stock that suits tea country (to be replaced by estate photography when available)
  ['tea-factory.jpg', 'tea-factory', [900, 1600, 2400]],
  ['Pekoe Trail access.jpg', 'trail-forest', [900, 1600, 2400]],
  ['front-view-woman-pouring-iced-tea.jpg', 'afternoon-tea', [900, 1600]],
  ['eating outdoor.jpg', 'dining-outdoor', [900, 1600]],
  ['Snooker evenings.jpg', 'snooker', [900, 1600]],
];

const VIDEO = { src: 'v1.mp4', name: 'hero-estate', posterAt: 1.2 };
// Stills pulled from the film: [seconds, name, widths]
const STILLS = [[15, 'estate-house', [900, 1600]]];

const kb = f => Math.round(fs.statSync(f).size / 1024) + ' KB';
const exists = f => fs.existsSync(f) && !FORCE;

async function images() {
  for (const [file, name, widths] of JOBS) {
    const input = path.join(SRC, file);
    if (!fs.existsSync(input)) { console.warn('missing', file); continue; }
    const meta = await sharp(input).rotate().metadata();
    const sourceWidth = (meta.orientation || 1) >= 5 ? meta.height : meta.width;
    for (const w of widths) {
      if (w > sourceWidth && w !== widths[0]) continue;
      const out = path.join(OUT, `${name}-${w}.webp`);
      if (exists(out)) continue;
      await sharp(input).rotate().resize({ width: w, withoutEnlargement: true }).webp({ quality: 72, effort: 5 }).toFile(out);
      console.log('image', path.basename(out), kb(out));
    }
  }
}

function hasFfmpeg() {
  try { execFileSync('ffmpeg', ['-version'], { stdio: 'ignore' }); return true; } catch (e) { return false; }
}

async function video() {
  const input = path.join(SRC, VIDEO.src);
  if (!fs.existsSync(input)) return;
  if (!hasFfmpeg()) { console.warn('ffmpeg not found — skipping the hero film'); return; }
  // Aerial foliage compresses badly; light denoise + 24fps keeps it ~4 MB (desktop) / ~2 MB (phones)
  for (const [w, crf] of [[1600, 33], [1280, 34]]) {
    const out = path.join(OUT, `${VIDEO.name}-${w}.mp4`);
    if (exists(out)) continue;
    execFileSync('ffmpeg', ['-v', 'error', '-y', '-i', input, '-an', '-vf', `fps=24,hqdn3d=3:2:6:4,scale=${w}:-2`, '-c:v', 'libx264', '-preset', 'slow',
      '-crf', String(crf), '-pix_fmt', 'yuv420p', '-movflags', '+faststart', out]);
    console.log('video', path.basename(out), kb(out));
  }
  const poster = path.join(OUT, `${VIDEO.name}-poster.webp`);
  if (!exists(poster)) {
    const frame = execFileSync('ffmpeg', ['-v', 'error', '-ss', String(VIDEO.posterAt), '-i', input, '-frames:v', '1', '-f', 'image2', '-c:v', 'png', 'pipe:1'], { maxBuffer: 64 * 1024 * 1024 });
    await sharp(frame).resize({ width: 1920 }).webp({ quality: 70 }).toFile(poster);
    console.log('poster', path.basename(poster), kb(poster));
  }
  for (const [at, name, widths] of STILLS) {
    const outs = widths.map(w => [w, path.join(OUT, `${name}-${w}.webp`)]).filter(([, out]) => !exists(out));
    if (!outs.length) continue;
    const frame = execFileSync('ffmpeg', ['-v', 'error', '-ss', String(at), '-i', input, '-frames:v', '1', '-f', 'image2', '-c:v', 'png', 'pipe:1'], { maxBuffer: 64 * 1024 * 1024 });
    for (const [w, out] of outs) {
      await sharp(frame).resize({ width: w }).webp({ quality: 72, effort: 5 }).toFile(out);
      console.log('still', path.basename(out), kb(out));
    }
  }
}

// manifest.json: original file -> optimised variants. build_static.js uses it to swap CMS image
// paths (e.g. "/images/IMG_7674.jpeg") for the web-sized versions.
function writeManifest() {
  const manifest = {};
  for (const [file, name] of JOBS) {
    const widths = fs.readdirSync(OUT)
      .map(f => (f.match(new RegExp('^' + name + '-(\\d+)\\.webp$')) || [])[1])
      .filter(Boolean).map(Number).sort((a, b) => a - b);
    if (widths.length) manifest[file] = { name, widths };
  }
  fs.writeFileSync(path.join(OUT, 'manifest.json'), JSON.stringify(manifest, null, 2) + '\n');
}

(async () => {
  fs.mkdirSync(OUT, { recursive: true });
  await images();
  await video();
  writeManifest();
  const total = fs.readdirSync(OUT).reduce((n, f) => n + fs.statSync(path.join(OUT, f)).size, 0);
  console.log(`src/media: ${fs.readdirSync(OUT).length} files, ${(total / 1048576).toFixed(1)} MB`);
})().catch(e => { console.error(e); process.exit(1); });
