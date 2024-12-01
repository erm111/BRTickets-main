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
    <title>Process Ticket - BRTickets</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="user.css">
    <style>
        .ticket-form {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(100, 186, 243, 0.1);
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section h4 {
            color: #64BAF3;
            margin-bottom: 1.5rem;
        }

        .booking-summary {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="content-area">
            <h2>Complete Your Booking</h2>

            <div class="ticket-form">
                <div class="booking-summary">
                    <!-- Booking details will be populated via JavaScript -->
                </div>

                <form id="ticketForm" method="POST" action="process_tickets.php">
                    <input type="hidden" name="bookingDetails" id="bookingDetailsInput">
                    <input type="hidden" name="selectedSeats" id="selectedSeatsInput">

                    <div class="form-section">
                        <h4>Next of Kin Details</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="next_of_kin_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Relationship</label>
                                <input type="text" class="form-control" name="next_of_kin_relationship" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="next_of_kin_email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" name="next_of_kin_phone" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label>Address</label>
                                <textarea class="form-control" name="next_of_kin_address" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Populate booking summary from session storage
        document.addEventListener('DOMContentLoaded', function() {
            const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
            const selectedSeats = JSON.parse(sessionStorage.getItem('selectedSeats'));

            if (bookingDetails && selectedSeats) {
                const summaryHTML = `
                    <h5>Booking Summary</h5>
                    <p><strong>Route:</strong> ${bookingDetails.departure} to ${bookingDetails.arrival}</p>
                    <p><strong>Date:</strong> ${new Date(bookingDetails.date).toLocaleDateString()}</p>
                    <p><strong>Seats:</strong> ${selectedSeats.join(', ')}</p>
                    <p><strong>Luggage:</strong> ${bookingDetails.luggage ? 'Yes' : 'No'}</p>
                `;
                document.querySelector('.booking-summary').innerHTML = summaryHTML;
            }

            // Set hidden input values on form submission
            document.getElementById('ticketForm').onsubmit = function() {
                document.getElementById('bookingDetailsInput').value = sessionStorage.getItem('bookingDetails');
                document.getElementById('selectedSeatsInput').value = sessionStorage.getItem('selectedSeats');
            };
        });
    </script>
</body>

</html>