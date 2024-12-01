<?php
session_start();
require_once 'dbconn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Verify current password
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    if (password_verify($data['password'], $user['password'])) {
        if ($data['form_type'] === 'profile') {
            // Update profile
            $stmt = $pdo->prepare("UPDATE users SET full_name = ?, email = ? WHERE id = ?");
            $stmt->execute([$data['form_data']['full_name'], $data['form_data']['email'], $_SESSION['user_id']]);
        } else if ($data['form_type'] === 'password') {
            // Update password
            $newPassword = password_hash($data['form_data']['new_password'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$newPassword, $_SESSION['user_id']]);
        }
        
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Incorrect password']);
    }
}