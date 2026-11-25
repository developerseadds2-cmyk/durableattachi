<?php

// Utility script to upload single or multiple files to live Hostinger FTP
$host = '145.79.210.17';
$user = 'u802604832.komalji';
$pass = '|p8ckZvDS3';
$port = 21;

$filesToUpload = [
    'resources/views/frontend/home/index.blade.php',
    'app/Http/Middleware/AdminMiddleware.php',
    'resources/views/frontend/layouts/app.blade.php',
    'resources/views/frontend/product/show.blade.php',
    'resources/views/frontend/contact/index.blade.php',
    '.htaccess',
];

$conn = @ftp_connect($host, $port, 20);
if (!$conn) {
    die("Connection failed to $host\n");
}
if (!@ftp_login($conn, $user, $pass)) {
    ftp_close($conn);
    die("Login failed for $user\n");
}
ftp_pasv($conn, true);

echo "Connected to Hostinger FTP successfully!\nUploading latest updated files:\n\n";

foreach ($filesToUpload as $relPath) {
    $localFile = __DIR__ . '/' . $relPath;
    if (!file_exists($localFile)) {
        echo " [SKIP] Local file not found: $relPath\n";
        continue;
    }

    $remoteFile = '/' . str_replace('\\', '/', $relPath);
    $remoteDir = dirname($remoteFile);

    // Ensure remote directory exists
    $parts = explode('/', trim($remoteDir, '/'));
    $currentPath = '';
    foreach ($parts as $part) {
        if ($part === '' || $part === '.') continue;
        $currentPath .= '/' . $part;
        @ftp_mkdir($conn, $currentPath);
    }

    if (ftp_put($conn, $remoteFile, $localFile, FTP_BINARY)) {
        echo " ✔ Uploaded: $relPath -> $remoteFile\n";
    } else {
        echo " ✖ FAILED to upload: $relPath\n";
    }
}

ftp_close($conn);
echo "\nFinished uploading files!\n";
