<?php
/**
 * Wakalumi PDF Viewer — Pure PHP, NO WordPress dependency
 * 
 * URL: /wp-content/themes/wakalumi-theme/pdf-view.php?f=/wp-content/uploads/path/to/file.pdf
 * 
 * Mendukung 2 mode via header X-Wkl-Fmt:
 * - "b64" (default dari JS) → kembalikan base64 JSON (IDM tidak intercept JSON!)
 * - "raw" → kembalikan PDF binary langsung (untuk navigasi browser biasa)
 */

$raw = isset($_GET['f']) ? stripslashes(trim($_GET['f'])) : '';

if (empty($raw)) {
    header('Content-Type: text/plain; charset=utf-8');
    echo 'pdf-view.php OK';
    exit;
}

$raw = '/' . ltrim($raw, '/');

// Security checks
if (strpos($raw, '/wp-content/uploads/') !== 0) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    exit('403: Only wp-content/uploads allowed');
}
if (strpos($raw, '..') !== false || strpos($raw, "\0") !== false) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    exit('403: Invalid path');
}

// Resolve document root (3 levels up dari wakalumi-theme/)
$doc_root = realpath(__DIR__ . '/../../..');
if (empty($doc_root) || !is_dir($doc_root)) {
    $doc_root = rtrim(realpath($_SERVER['DOCUMENT_ROOT'] ?? ''), '/\\');
}

$file_path = $doc_root . DIRECTORY_SEPARATOR . ltrim(str_replace('/', DIRECTORY_SEPARATOR, $raw), DIRECTORY_SEPARATOR);
$real = realpath($file_path);

if (!$real) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    exit('404: File not found. Tried: ' . $file_path);
}
if (strtolower(pathinfo($real, PATHINFO_EXTENSION)) !== 'pdf') {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    exit('403: PDF only');
}
$uploads_real = realpath($doc_root . DIRECTORY_SEPARATOR . 'wp-content' . DIRECTORY_SEPARATOR . 'uploads');
if (!$uploads_real || strpos($real, $uploads_real) !== 0) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    exit('403: Outside uploads dir');
}
if (!is_readable($real)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    exit('403: Not readable');
}

$filename = basename($real);
$filesize = filesize($real);

// ── Tentukan mode berdasarkan header X-Wkl-Fmt ──
$fmt = isset($_SERVER['HTTP_X_WKL_FMT']) ? strtolower(trim($_SERVER['HTTP_X_WKL_FMT'])) : 'b64';

if ($fmt === 'raw') {
    // ── Mode RAW: kirim PDF langsung (untuk navigasi browser biasa) ──
    while (ob_get_level()) ob_end_clean();
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Length: ' . $filesize);
    header('Cache-Control: public, max-age=3600');
    header('Access-Control-Allow-Origin: *');
    readfile($real);
    exit;
}

// ── Mode B64 (default): kirim PDF sebagai base64 JSON ──
// IDM TIDAK mengintervensi response application/json!
$content = file_get_contents($real);
if ($content === false) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    exit('500: Cannot read file');
}

while (ob_get_level()) ob_end_clean();

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
header('Access-Control-Allow-Origin: *');

echo json_encode([
    'ok'   => true,
    'name' => $filename,
    'size' => $filesize,
    'data' => base64_encode($content),
]);
exit;
