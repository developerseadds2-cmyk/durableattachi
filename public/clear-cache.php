<?php

// Direct file cache cleaner (doesn't connect to database)
$basePath = dirname(__DIR__);

echo "<!DOCTYPE html><html><head><title>Cache Cleaner & Diagnostic</title>";
echo "<style>body{font-family:Arial,sans-serif;background:#0f172a;color:#f8fafc;padding:40px;line-height:1.6;}
.card{background:#1e293b;border-radius:12px;padding:30px;max-width:650px;margin:0 auto;box-shadow:0 10px 30px rgba(0,0,0,0.5);}
h2{color:#38bdf8;margin-top:0;}
.ok{color:#4ade80;font-weight:bold;margin:8px 0;}
.info{background:#334155;padding:12px;border-radius:6px;margin:15px 0;font-family:monospace;}
.btn{display:inline-block;background:#38bdf8;color:#0f172a;font-weight:bold;padding:10px 20px;border-radius:6px;text-decoration:none;margin-top:20px;}
</style></head><body><div class='card'>";
echo "<h2>🧹 Direct File Cache Cleaner</h2>";

// 1. Delete all bootstrap cache files directly
$cachedFiles = [
    $basePath . '/bootstrap/cache/config.php',
    $basePath . '/bootstrap/cache/routes-v7.php',
    $basePath . '/bootstrap/cache/services.php',
    $basePath . '/bootstrap/cache/packages.php',
];

$deletedCount = 0;
foreach ($cachedFiles as $file) {
    if (file_exists($file)) {
        if (@unlink($file)) {
            echo "<div class='ok'>✔ Deleted: " . basename($file) . "</div>";
            $deletedCount++;
        }
    }
}

if ($deletedCount === 0) {
    echo "<div class='ok'>✔ No config cache files were present (fresh state).</div>";
}

// 2. Read what .env actually has right now
$envFile = $basePath . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $envValues = [];
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) continue;
        [$k, $v] = explode('=', $line, 2);
        $envValues[trim($k)] = trim($v);
    }

    echo "<div class='info'>";
    echo "<strong>What .env is providing:</strong><br>";
    echo "DB_CONNECTION: " . ($envValues['DB_CONNECTION'] ?? 'mysql') . "<br>";
    echo "DB_HOST: " . ($envValues['DB_HOST'] ?? 'localhost') . "<br>";
    echo "DB_PORT: " . ($envValues['DB_PORT'] ?? '3306') . "<br>";
    echo "DB_DATABASE: " . ($envValues['DB_DATABASE'] ?? '') . "<br>";
    echo "DB_USERNAME: " . ($envValues['DB_USERNAME'] ?? '') . "<br>";
    $pass = $envValues['DB_PASSWORD'] ?? '';
    echo "DB_PASSWORD Length: " . strlen($pass) . " chars<br>";
    echo "DB_PASSWORD Raw: " . htmlspecialchars($pass) . "<br>";
    echo "</div>";

    // 3. Test direct PDO with these exact values
    $host = $envValues['DB_HOST'] ?? '127.0.0.1';
    $db   = $envValues['DB_DATABASE'] ?? '';
    $user = $envValues['DB_USERNAME'] ?? '';
    $rawPass = trim($pass, "\"'");
    $port = $envValues['DB_PORT'] ?? '3306';

    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $rawPass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        echo "<div class='ok' style='font-size:1.1rem;'>🎉 Direct PDO Connected Successfully to Database!</div>";
    } catch (\PDOException $e) {
        echo "<div style='color:#f87171;'><strong>Direct PDO Test Failed:</strong> " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}

echo "<a href='/' class='btn'>Go to Homepage &rarr;</a>";
echo "</div></body></html>";
