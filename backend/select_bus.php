<?php
session_start();
require_once 'dbconn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT full_name FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
$fullName = $user['full_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Bus - BRTickets</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="select_bus.css">
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4>BRTickets</h4>
        </div>
        <div class="sidebar-menu">
            <a href="user.php" class="menu-item">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="help_support.php" class="menu-item">
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

    <div class="main-content">
        <div class="menu-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>
        <div class="top-bar">
            <div class="welcome-text">
                Hi, <?php echo htmlspecialchars($fullName); ?>
            </div>
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

        <div class="content-area">
            <div class="booking-summary">
                <h3>Your Trip Details</h3>
                <div class="trip-info">
                    <div class="route">
                        <span id="departureDetails"></span>
                        <i class="fas fa-long-arrow-alt-right mx-3 text-primary"></i>
                        <span id="arrivalDetails"></span>
                    </div>
                    <div class="details mt-3">
                        <span id="dateDetails"></span> | 
                        <span id="seatsDetails"></span> seats |
                        <span id="luggageDetails"></span>
                    </div>
                </div>
            </div>

            <div class="bus-options">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="bus-card">
                            <img src="../img/jet_mover.jpg" alt="Toyota Hiance" class="bus-image">
                            <div class="bus-details">
                                <h4>Toyota Hiance</h4>
                                <div class="departure-time">
                                    <i class="far fa-clock"></i> Departure: 6:00 AM
                                </div>
                                <p class="seats-available">9 seats available</p>
                                <div class="price-details">
                                    <h5>₦7,500 per seat</h5>
                                    <p class="total-price" id="hianceTotal"></p>
                                </div>
                                <button  type= "button" class="btn btn-primary w-100 select-bus-btn" data-bus-type="hiance" data-seats="9">Select Seat No(s).</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bus-card">
                            <img src="../img/jet_mover.jpg" alt="Jet Mover" class="bus-image">
                            <div class="bus-details">
                                <h4>Jet Mover</h4>
                                <div class="departure-time">
                                    <i class="far fa-clock"></i> Departure: 7:00 AM
                                </div>
                                <p class="seats-available">13 seats available</p>
                                <div class="price-details">
                                    <h5>₦10,000 per seat</h5>
                                    <p class="total-price" id="jetTotal"></p>
                                </div>
                                <button type="button" class="btn btn-primary w-100 select-bus-btn" data-bus-type="jet" data-seats="13">Select Seat No(s).</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Replace the existing modal div with this one -->
<div class="seat-selection-modal" id="seatModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Select Your Seat No(s)</h3>
            <button type="button" class="close" onclick="closeSeatModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="bus-layout"></div>
            <div class="selected-seats-info">
                <p>
                    Selected: <span id="selectedCount">0</span> / <span id="requiredSeats">0</span>
                </p>
            </div>
            <div id="totalAmount">
                Total: ₦<span class="price-value">0</span>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeSeatModal()">Cancel</button>
            <!-- <button class="btn btn-primary" id="confirmSeats">Confirm</button> -->
            <button class="btn btn-success" id="proceedButton" disabled>Proceed</button>
        </div>
    </div>
</div>



    <script src="select_bus.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
