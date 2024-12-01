<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your existing head content -->
    <title>Ticket Summary - BRTickets</title>
    <style>
        .ticket {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #64BAF3;
            border-radius: 10px;
        }
        .ticket-header {
            border-bottom: 2px dashed #64BAF3;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }
        .qr-code {
            width: 100px;
            height: 100px;
            background: #f8f9fa;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <!-- Include your navbar -->
    
    <div class="container my-5">
        <div class="ticket">
            <div class="ticket-header text-center">
                <h2>BRTickets</h2>
                <p class="text-muted">Your Journey, Our Priority</p>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <h4>Order Number: <span id="orderNumber"></span></h4>
                    <div class="mt-4">
                        <p><strong>From:</strong> <span id="departure"></span></p>
                        <p><strong>To:</strong> <span id="arrival"></span></p>
                        <p><strong>Date:</strong> <span id="date"></span></p>
                        <p><strong>Time:</strong> <span id="time"></span></p>
                        <p><strong>Seat Number:</strong> <span id="seatNumber"></span></p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="qr-code mb-3"></div>
                    <p class="text-muted">Scan for verification</p>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button class="btn btn-primary" onclick="window.print()">Print Ticket</button>
            </div>
        </div>
    </div>

    <script>
    window.onload = function() {
        const ticketDetails = JSON.parse(sessionStorage.getItem('ticketDetails'));
        if (ticketDetails) {
            document.getElementById('orderNumber').textContent = ticketDetails.orderNumber;
            document.getElementById('departure').textContent = ticketDetails.departure;
            document.getElementById('arrival').textContent = ticketDetails.arrival;
            document.getElementById('date').textContent = ticketDetails.date;
            document.getElementById('time').textContent = ticketDetails.time;
            document.getElementById('seatNumber').textContent = ticketDetails.seatNumber;
        }
    }
    </script>
</body>
</html>