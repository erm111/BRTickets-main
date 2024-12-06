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
    <title>Payment - BRTickets</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="user.css">
    <style>
        .payment-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(100, 186, 243, 0.1);
        }

        .payment-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .card-input {
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 16px;
        }

        .payment-summary {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .processing-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .success-checkmark {
            display: none;
            color: #28a745;
            font-size: 48px;
        }

        .loader {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #64BAF3;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="content-area">
            <div class="payment-container">
                <div class="payment-header">
                    <h3>Payment Details</h3>
                </div>

                <div class="payment-summary">
                    <!-- Will be populated via JavaScript -->
                </div>

                <form id="paymentForm">
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" id="cardNumber" class="form-control card-input" maxlength="16" placeholder="1234 5678 9012 3456" required pattern="\d*">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <input type="text" id="expiryDate" class="form-control card-input" placeholder="MM/YY" maxlength="5" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>CVV</label>
                                <input type="text" id="cvv" class="form-control card-input" maxlength="3" placeholder="123" required pattern="\d*">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Card Holder Name</label>
                        <input type="text" class="form-control card-input" placeholder="John Doe" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">Pay Now</button>
                </form>
            </div>
        </div>
    </div>

    <div class="processing-overlay">
        <div class="loader"></div>
        <p class="mt-3">Processing payment...</p>
        <i class="fas fa-check-circle success-checkmark"></i>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
            const selectedSeats = JSON.parse(sessionStorage.getItem('selectedSeats'));

            // Calculate total amount with updated prices
            const basePrice = bookingDetails.busType === 'hiance' ? 7500 : 10000;
            const luggageFee = bookingDetails.luggage ? 5000 : 0;
            const totalAmount = (basePrice * selectedSeats.length) + luggageFee;

            // Display payment summary
            const summaryHTML = `
                <h5>Payment Summary</h5>
                <p><strong>Amount:</strong> ₦${totalAmount.toLocaleString()}</p>
                <p><strong>Route:</strong> ${bookingDetails.departure} to ${bookingDetails.arrival}</p>
                <p><strong>Seat No(s):</strong> ${selectedSeats.join(', ')}</p>
            `;
            document.querySelector('.payment-summary').innerHTML = summaryHTML;
        });

        // Card number validation - only numbers allowed
        document.getElementById('cardNumber').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');
        });

        // CVV validation - only numbers allowed
        document.getElementById('cvv').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');
        });

        // Expiry date validation
        document.getElementById('expiryDate').addEventListener('input', function(e) {
            let input = this.value.replace(/\D/g, '');

            // Format MM/YY
            if (input.length > 2) {
                this.value = input.substring(0, 2) + '/' + input.substring(2);
            } else {
                this.value = input;
            }

            // Validate month (01-12)
            if (input.length >= 2) {
                let month = parseInt(input.substring(0, 2));
                if (month < 1 || month > 12) {
                    this.setCustomValidity('Please enter a valid month (01-12)');
                } else {
                    this.setCustomValidity('');
                }
            }
        });

        // Form submission validation
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get current date
            const today = new Date();
            const currentMonth = today.getMonth() + 1;
            const currentYear = today.getFullYear() % 100;

            // Get expiry date values
            const expiryDate = document.getElementById('expiryDate').value;
            const [expMonth, expYear] = expiryDate.split('/').map(num => parseInt(num));

            // Validate expiry date
            if (expYear < currentYear || (expYear === currentYear && expMonth < currentMonth)) {
                alert('Card has expired. Please use a valid card.');
                return;
            }

            // If validation passes, show processing overlay
            const overlay = document.querySelector('.processing-overlay');
            const loader = document.querySelector('.loader');
            const checkmark = document.querySelector('.success-checkmark');

            overlay.style.display = 'flex';

            setTimeout(() => {
                loader.style.display = 'none';
                checkmark.style.display = 'block';

                setTimeout(() => {
                    window.location.href = 'print_ticket.php';
                }, 1500);
            }, 3000);
        });
        // Inside the form submission handler, after successful payment
        fetch('send_mail.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    bookingDetails: bookingDetails,
                    selectedSeats: selectedSeats
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Email sent successfully');
                }
            })
            .catch(error => console.error('Error:', error));
    </script>
</body>

</html>