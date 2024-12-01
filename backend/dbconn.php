<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'busticket');
define('DB_USER', 'root');     // Change this to your database username
define('DB_PASS', '');         // Change this to your database password

try {
    // Create a PDO instance
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
    
    // Set the connection as a global variable
    $GLOBALS['pdo'] = $pdo;
    
} catch(PDOException $e) {
    // Log the error (in production, log to a file instead of displaying)
    die("Connection failed: " . $e->getMessage());
}