/**
 * serve_local.js
 * Zero-dependency static file server for public/ (run npm run build first)
 * Usage: node scripts/serve_local.js
 */
const http = require('http');
const fs   = require('fs');
const path = require('path');

const PORT     = 3000;
const ROOT_DIR = path.resolve(__dirname, '..', 'public');

const MIME = {
  '.html': 'text/html; charset=utf-8',
  '.css':  'text/css',
  '.js':   'application/javascript',
  '.json': 'application/json',
  '.png':  'image/png',
  '.jpg':  'image/jpeg',
  '.jpeg': 'image/jpeg',
  '.gif':  'image/gif',
  '.svg':  'image/svg+xml',
  '.webp': 'image/webp',
  '.ico':  'image/x-icon',
  '.woff': 'font/woff',
  '.woff2':'font/woff2',
  '.ttf':  'font/ttf',
  '.yml':  'text/yaml',
  '.txt':  'text/plain',
};

const server = http.createServer((req, res) => {
  let urlPath = req.url.split('?')[0]; // strip query string for file lookup
  if (urlPath === '/' || urlPath === '') urlPath = '/index.html';

  // Append .html if no extension given (clean URLs)
  if (!path.extname(urlPath) && !urlPath.endsWith('/')) {
    const withHtml = path.join(ROOT_DIR, urlPath + '.html');
    if (fs.existsSync(withHtml)) urlPath += '.html';
  }

  const filePath = path.join(ROOT_DIR, urlPath);

  // Security: block path traversal
  if (!filePath.startsWith(ROOT_DIR)) {
    res.writeHead(403); res.end('Forbidden'); return;
  }

  fs.readFile(filePath, (err, data) => {
    if (err) {
      // Try index.html inside a directory
      const indexPath = path.join(filePath, 'index.html');
      fs.readFile(indexPath, (err2, data2) => {
        if (err2) {
          res.writeHead(404, { 'Content-Type': 'text/plain' });
          res.end(`404 Not Found: ${urlPath}`);
        } else {
          res.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8' });
          res.end(data2);
        }
      });
      return;
    }
    const ext  = path.extname(filePath).toLowerCase();
    const mime = MIME[ext] || 'application/octet-stream';
    res.writeHead(200, { 'Content-Type': mime });
    res.end(data);
  });
});

server.listen(PORT, '127.0.0.1', () => {
  console.log('\n  ┌─────────────────────────────────────────────────────────┐');
  console.log('  │  The Tea Bungalow — Local Preview Server                │');
  console.log('  ├─────────────────────────────────────────────────────────┤');
  console.log(`  │  http://localhost:${PORT}                                    │`);
  console.log(`  │  http://localhost:${PORT}/?preview_preloader=1               │`);
  console.log('  ├─────────────────────────────────────────────────────────┤');
  console.log('  │  Pages:                                                 │');
  console.log('  │    /                         → Homepage                 │');
  console.log('  │    /about                    → About                    │');
  console.log('  │    /our-chambers             → Our Chambers             │');
  console.log('  │    /experiences              → Experiences              │');
  console.log('  │    /gallery                  → Gallery                  │');
  console.log('  │    /contact                  → Contact                  │');
  console.log('  │    /privacy                  → Privacy Policy           │');
  console.log('  │    /packages                 → Packages                 │');
  console.log('  │    /pekoe-trail              → Pekoe Trail              │');
  console.log('  │    /the-bungalow             → The Bungalow             │');
  console.log('  │    /the-entire-estate        → The Entire Estate        │');
  console.log('  │    /chairmans-bungalow-2027  → Chairman\'s Bungalow      │');
  console.log('  ├─────────────────────────────────────────────────────────┤');
  console.log('  │  Tip: Add ?preview_preloader=1 to replay the preloader  │');
  console.log('  │  Press Ctrl+C to stop                                   │');
  console.log('  └─────────────────────────────────────────────────────────┘\n');
});
