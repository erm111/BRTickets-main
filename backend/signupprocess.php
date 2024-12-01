<?php
session_start();
require_once 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full-name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format";
        header("Location: ../signup.php");
        exit();
    }

    // Validate password length
    if (strlen($password) < 5) {
        $_SESSION['error'] = "Password must be at least 5 characters long";
        header("Location: ../signup.php");
        exit();
    }

    try {
        // Check if email already exists
        $check_stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check_stmt->execute([$email]);

        if ($check_stmt->rowCount() > 0) {
            $_SESSION['error'] = "Email already registered";
            header("Location: ../signup.php");
            exit();
        }

        // Hash password and insert new user
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$full_name, $email, $hashed_password]);

        $_SESSION['success'] = "Registration successful! Please login.";
        header("Location: ../login.php");
    } catch (PDOException $e) {
        $_SESSION['error'] = "Registration failed. Please try again.";
        header("Location: ../signup.php");
    }
}
