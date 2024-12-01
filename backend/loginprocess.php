<?php
session_start();
require_once 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    try {
        $sql = "SELECT id, full_name, password FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                header("Location: user.php");
                exit();
            }
        }
        
        $_SESSION['error'] = "Invalid email or password";
        header("Location: ../login.php");
        
    } catch(PDOException $e) {
        $_SESSION['error'] = "Login failed. Please try again.";
        header("Location: ../login.php");
    }
}
