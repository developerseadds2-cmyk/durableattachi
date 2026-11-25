
<?php

$envPath = '/home/u802604832/domains/nautical-silver-mink-99.hostingersite.com/public_html/.env';

if (!file_exists($envPath)) {
    die("ENV file not found!");
}

$env = [];

$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    $line = trim($line);

    if ($line === '' || str_starts_with($line, '#')) {
        continue;
    }

    if (!str_contains($line, '=')) {
        continue;
    }

    [$key, $value] = explode('=', $line, 2);

    $key = trim($key);
    $value = trim($value);

    // Remove surrounding quotes
    $value = trim($value, "\"'");

    $env[$key] = $value;
}

$host = $env['DB_HOST'] ?? 'localhost';
$database = $env['DB_DATABASE'] ?? '';
$username = $env['DB_USERNAME'] ?? '';
$password = $env['DB_PASSWORD'] ?? '';
$port = $env['DB_PORT'] ?? '3306';

echo "Database: " . htmlspecialchars($database) . "<br>";
echo "Username: " . htmlspecialchars($username) . "<br>";

try {

    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    echo "<h2 style='color:green'>Database Connected Successfully!</h2>";

} catch (PDOException $e) {

    echo "<h2 style='color:red'>Database Connection Failed!</h2>";
    echo htmlspecialchars($e->getMessage());

}
