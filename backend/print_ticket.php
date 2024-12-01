<?php
session_start();
require_once 'dbconn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Get user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Get latest ticket details
$ticketStmt = $pdo->prepare("
    SELECT * FROM tickets 
    WHERE user_id = ? 
    ORDER BY booking_date DESC 
    LIMIT 1
");
$ticketStmt->execute([$_SESSION['user_id']]);
$ticket = $ticketStmt->fetch();

// Generate 13-digit order number
$orderNumber = date('Y') . str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Ticket - BRTickets</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .ticket-container {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(100, 186, 243, 0.1);
        }

        .ticket-header {
            border-bottom: 2px solid #64BAF3;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .ticket-logo {
            color: #64BAF3;
            font-size: 24px;
            font-weight: bold;
        }

        .order-number {
            color: #666;
            font-size: 14px;
        }

        .ticket-section {
            margin-bottom: 2rem;
        }

        .ticket-section h4 {
            color: #64BAF3;
            margin-bottom: 1rem;
        }

        .ticket-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .detail-item {
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .detail-label {
            color: #666;
            font-size: 0.9rem;
        }

        .detail-value {
            font-weight: 500;
            color: #333;
        }

        .print-btn {
            background: #64BAF3;
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .print-btn:hover {
            background: #4a9fd9;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="ticket-header d-flex justify-content-between align-items-center">
            <div class="ticket-logo">
                <i class="fas fa-bus"></i> BRTickets
            </div>
            <div class="order-number">
                Order #<?php echo $orderNumber; ?>
            </div>
        </div>

        <div class="ticket-section">
            <h4>Journey Details</h4>
            <div class="ticket-details">
                <div class="detail-item">
                    <div class="detail-label">From</div>
                    <div class="detail-value"><?php echo htmlspecialchars($ticket['departure_state']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">To</div>
                    <div class="detail-value"><?php echo htmlspecialchars($ticket['arrival_state']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Date</div>
                    <div class="detail-value"><?php echo date('F j, Y', strtotime($ticket['travel_date'])); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Seat Numbers</div>
                    <div class="detail-value"><?php echo implode(', ', json_decode($ticket['seat_numbers'])); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Bus Type</div>
                    <div class="detail-value"><?php echo $ticket['bus_type'] === 'hiance' ? 'Toyota Hiance' : 'Jet Mover'; ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Amount Paid</div>
                    <div class="detail-value">₦<?php echo number_format($ticket['total_amount']); ?></div>
                </div>
            </div>
        </div>

        <div class="ticket-section">
            <h4>Passenger Details</h4>
            <div class="ticket-details">
                <div class="detail-item">
                    <div class="detail-label">Full Name</div>
                    <div class="detail-value"><?php echo htmlspecialchars($user['full_name']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value"><?php echo htmlspecialchars($user['email']); ?></div>
                </div>
            </div>
        </div>

        <div class="ticket-section">
            <h4>Next of Kin Details</h4>
            <div class="ticket-details">
                <div class="detail-item">
                    <div class="detail-label">Name</div>
                    <div class="detail-value"><?php echo htmlspecialchars($ticket['next_of_kin_name']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Relationship</div>
                    <div class="detail-value"><?php echo htmlspecialchars($ticket['next_of_kin_relationship']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Phone</div>
                    <div class="detail-value"><?php echo htmlspecialchars($ticket['next_of_kin_phone']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value"><?php echo htmlspecialchars($ticket['next_of_kin_email']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Address</div>
                    <div class="detail-value"><?php echo htmlspecialchars($ticket['next_of_kin_address']); ?></div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4 no-print">
    <button onclick="window.print()" class="print-btn me-2">
        <i class="fas fa-print"></i> Print Ticket
    </button>
    <button onclick="window.location.href='user.php'" class="print-btn">
        <i class="fas fa-home"></i> Back to Dashboard
    </button>
</div>

    </div>
</body>
</html>