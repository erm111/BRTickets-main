<?php
session_start();
require_once 'dbconn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch all tickets for current user
$stmt = $pdo->prepare("
    SELECT * FROM tickets 
    WHERE user_id = ? 
    ORDER BY travel_date DESC
");
$stmt->execute([$_SESSION['user_id']]);
$tickets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History - BRTickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="user.css">
    <style>
        .booking-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(100, 186, 243, 0.1);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .booking-header {
            background: #f8f9fa;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .booking-body {
            padding: 1.5rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .status-upcoming {
            background: #e3f2fd;
            color: #1976d2;
        }

        .status-completed {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .route-info {
            display: flex;
            align-items: center;
            margin: 1rem 0;
        }

        .route-arrow {
            margin: 0 1rem;
            color: #64BAF3;
        }

        .ticket-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .detail-item {
            background: #f8f9fa;
            padding: 0.8rem;
            border-radius: 8px;
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
            <a href="help_support.php" class="menu-item">
                <i class="fas fa-headset"></i> Help and Support
            </a>
            <a href="suggest_route.php" class="menu-item">
                <i class="fas fa-route"></i> Suggest Route
            </a>
            <a href="booking_history.php" class="menu-item active">
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
            <h2>Booking History</h2>

            <?php if (empty($tickets)): ?>
                <div class="alert alert-info">
                    No booking history found. Ready to plan your first trip?
                </div>
            <?php else: ?>
                <?php foreach ($tickets as $ticket):
                    $travelDate = new DateTime($ticket['travel_date']);
                    $today = new DateTime();
                    $interval = $today->diff($travelDate);
                    $daysLeft = $interval->days;
                    $isUpcoming = $travelDate > $today;
                ?>
                    <div class="booking-card">
                        <div class="booking-header d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Booking ID:</strong> #<?php echo $ticket['id']; ?>
                            </div>
                            <?php if ($isUpcoming): ?>
                                <span class="status-badge status-upcoming">
                                    Ride in <?php echo $daysLeft; ?> days
                                </span>
                            <?php else: ?>
                                <span class="status-badge status-completed">
                                    Successful Ride
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="booking-body">
                            <div class="route-info">
                                <span><?php echo htmlspecialchars($ticket['departure_state']); ?></span>
                                <i class="fas fa-long-arrow-alt-right route-arrow"></i>
                                <span><?php echo htmlspecialchars($ticket['arrival_state']); ?></span>
                            </div>

                            <div class="ticket-details">
                                <div class="detail-item">
                                    <small>Travel Date</small>
                                    <div><?php echo date('F j, Y', strtotime($ticket['travel_date'])); ?></div>
                                </div>
                                <div class="detail-item">
                                    <small>Bus Type</small>
                                    <div><?php echo $ticket['bus_type'] === 'hiance' ? 'Toyota Hiance' : 'Jet Mover'; ?></div>
                                </div>

                                <div class="detail-item">
                                    <small>Seats</small>
                                    <div><?php echo implode(', ', json_decode($ticket['seat_numbers'])); ?></div>
                                </div>
                                <div class="detail-item">
                                    <small>Amount Paid</small>
                                    <div>₦<?php echo number_format($ticket['total_amount']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="user.js"></script>
</body>

</html>