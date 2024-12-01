<?php
session_start();
require_once 'dbconn.php';

header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<user>';

try {
    $stmt = $pdo->prepare("SELECT full_name FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    echo '<fullname>' . htmlspecialchars($user['full_name']) . '</fullname>';
} catch(PDOException $e) {
    echo '<error>Failed to fetch user data</error>';
}

echo '</user>';