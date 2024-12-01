<?php
session_start();
require_once 'dbconn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support - BRTickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="user.css">
    <style>
        .support-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(100, 186, 243, 0.1);
            margin-bottom: 2rem;
        }

        .contact-card {
            border-left: 4px solid #64BAF3;
            padding: 1rem;
            margin-bottom: 1rem;
            background: #f8f9fa;
            border-radius: 0 8px 8px 0;
        }

        .policy-section {
            margin-top: 2rem;
        }

        .policy-section h3 {
            color: #64BAF3;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4>BRTickets</h4>
        </div>
        <div class="sidebar-menu">
            <a href="user.php" class="menu-item">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="help_support.php" class="menu-item active">
                <i class="fas fa-headset"></i> Help and Support
            </a>
            <a href="suggest_route.php" class="menu-item">
                <i class="fas fa-route"></i> Suggest Route
            </a>
            <a href="booking_history.php" class="menu-item">
                <i class="fas fa-history"></i> Booking History
            </a>
            <a href="settings.php" class="menu-item">
                <i class="fas fa-cog"></i> Settings
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="menu-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>

        <div class="content-area">
            <h2>Help & Support</h2>

            <div class="support-section">
                <h3>Contact Us</h3>
                <div class="contact-card">
                    <h5><i class="fas fa-envelope text-primary"></i> Email Support</h5>
                    <p>support@brtickets.com</p>
                </div>
                <div class="contact-card">
                    <h5><i class="fas fa-phone text-primary"></i> Customer Care</h5>
                    <p>+234 801 234 5678<br>+234 809 876 5432</p>
                    <small>Available 24/7</small>
                </div>
            </div>

            <div class="support-section policy-section">
                <h3>Privacy Policy</h3>
                <p>At BRTickets, we take your privacy seriously. Here's how we handle your information:</p>
                <ul>
                    <li>We collect only necessary information for booking and identification purposes</li>
                    <li>Your payment information is encrypted and processed securely</li>
                    <li>Personal data is stored on secure servers with restricted access</li>
                    <li>We never share your information with unauthorized third parties</li>
                    <li>Your travel history is kept confidential and used only for service improvement</li>
                </ul>
            </div>

            <div class="support-section policy-section">
                <h3>Terms & Conditions</h3>
                <h5>Booking and Cancellation</h5>
                <ul>
                    <li>Tickets must be booked at least 2 hours before departure</li>
                    <li>Cancellations made 24 hours before departure are eligible for full refund</li>
                    <li>Cancellations within 24 hours of departure will incur a 50% charge</li>
                    <li>No refunds for no-shows or cancellations after departure time</li>
                </ul>

                <h5>Luggage Policy</h5>
                <ul>
                    <li>One carry-on bag (max 10kg) included with ticket</li>
                    <li>Additional luggage must be declared and paid for during booking</li>
                    <li>Maximum luggage weight per passenger: 30kg</li>
                    <li>BRTickets is not liable for undeclared valuable items</li>
                </ul>

                <h5>Travel Requirements</h5>
                <ul>
                    <li>Valid ID required for boarding</li>
                    <li>Passengers should arrive 30 minutes before departure</li>
                    <li>Seats are non-transferable</li>
                    <li>BRTickets reserves the right to deny boarding for security reasons</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="user.js"></script>
</body>
</html>