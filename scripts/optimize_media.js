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

const VIDEO = { src: 'v1.mp4', name: 'hero-estate', posterAt: 1.2, portraitCrop: 'crop=720:1080:460:0' };
// Stills pulled from the film: [seconds, name, widths]
const STILLS = [[15, 'estate-house', [900, 1600]]];
// Small portrait crops for the preloader's arch montage (shown in this order), cut from the web versions above
// [name, crop position]: 'attention' finds the subject; centre where it's already framed
const PRELOADER = [['tea-factory', 'centre'], ['lounge-arches', 'attention'], ['afternoon-tea', 'attention'], ['chamber-pekoe', 'attention'],
  ['trail-forest', 'centre'], ['lounge-red', 'attention'], ['chamber-galaha', 'attention'], ['estate-house', 'centre']];

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
  // The drone footage is grainy and costly to compress, so it keeps its native 1080p/29.97fps and gets
  // bitrate rather than denoising (VMAF vs the source: 87 here, against 65 for the old 1600px/CRF 33 cut).
  // Phones in portrait get their own 720x1080 cut around the house instead of an upscaled slice of the landscape film.
  const encodes = [
    [`${VIDEO.name}-1080.mp4`, [], '4500k', '7000k'],
    [`${VIDEO.name}-portrait.mp4`, ['-vf', VIDEO.portraitCrop], '2000k', '3200k'],
  ];
  for (const [file, filters, rate, peak] of encodes) {
    const out = path.join(OUT, file);
    if (exists(out)) continue;
    const common = ['-v', 'error', '-y', '-i', input, '-an', ...filters, '-c:v', 'libx264', '-preset', 'slow', '-profile:v', 'high',
      '-pix_fmt', 'yuv420p', '-b:v', rate, '-maxrate', peak, '-bufsize', peak, '-passlogfile', path.join(OUT, '.x264-2pass')];
    execFileSync('ffmpeg', [...common, '-pass', '1', '-f', 'null', '-']);
    execFileSync('ffmpeg', [...common, '-pass', '2', '-movflags', '+faststart', out]);
    fs.readdirSync(OUT).filter(f => f.startsWith('.x264-2pass')).forEach(f => fs.unlinkSync(path.join(OUT, f)));
    console.log('video', file, kb(out));
  }
  const posters = [[`${VIDEO.name}-poster.webp`, null], [`${VIDEO.name}-poster-portrait.webp`, VIDEO.portraitCrop]];
  for (const [file, crop] of posters) {
    const poster = path.join(OUT, file);
    if (exists(poster)) continue;
    const frame = execFileSync('ffmpeg', ['-v', 'error', '-ss', String(VIDEO.posterAt), '-i', input, '-frames:v', '1', ...(crop ? ['-vf', crop] : []),
      '-f', 'image2', '-c:v', 'png', 'pipe:1'], { maxBuffer: 64 * 1024 * 1024 });
    await sharp(frame).resize({ width: crop ? 720 : 1920 }).webp({ quality: 72 }).toFile(poster);
    console.log('poster', file, kb(poster));
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

async function preloaderCrops() {
  for (const [name, position] of PRELOADER) {
    const out = path.join(OUT, `pl-${name}.webp`);
    if (exists(out)) continue;
    const source = fs.readdirSync(OUT)
      .map(f => [f, Number((f.match(new RegExp('^' + name + '-(\\d+)\\.webp$')) || [])[1])])
      .filter(([, w]) => w).sort((a, b) => b[1] - a[1])[0];
    if (!source) { console.warn('preloader: no web version of', name); continue; }
    await sharp(path.join(OUT, source[0])).resize(520, 740, { fit: 'cover', position: position === 'attention' ? sharp.strategy.attention : position })
      .webp({ quality: 62, effort: 6 }).toFile(out);
    console.log('preloader', path.basename(out), kb(out));
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
  await preloaderCrops();
  writeManifest();
  const total = fs.readdirSync(OUT).reduce((n, f) => n + fs.statSync(path.join(OUT, f)).size, 0);
  console.log(`src/media: ${fs.readdirSync(OUT).length} files, ${(total / 1048576).toFixed(1)} MB`);
})().catch(e => { console.error(e); process.exit(1); });
