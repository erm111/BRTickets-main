<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Book Seat - BRTickets</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        .seat-btn {
            width: 50px;
            height: 50px;
            border: 2px solid #ddd;
            background: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .seat-btn.selected {
            background: #64BAF3;
            color: white;
            border-color: #64BAF3;
        }

        .seat-btn.occupied {
            background: #dc3545;
            color: white;
            border-color: #dc3545;
            cursor: not-allowed;
        }

        .driver-seat {
            text-align: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid nav-bar sticky-top px-0 px-lg-4 py-2 py-lg-0">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="" class="navbar-brand p-0">
                    <h1 class="display-6 text-primary"><i class="fas fa-car-alt me-3"></i>BRTickets</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Service</a>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="login.php" class="btn btn-primary rounded-pill px-4">Login</a>
                    <a href="signup.php" class="btn btn-primary rounded-pill px-4 ms-3">Sign Up</a>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Main Content -->
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="mb-4">Toyota (Hiace X)</h3>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-4">
                                <strong>Departure:</strong> <span id="departureDetails"></span>
                            </div>
                            <div>
                                <strong>Arrival:</strong> <span id="arrivalDetails"></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="me-4">
                                <i class="fas fa-chair"></i> <span id="seatsAvailable">9 seats available</span>
                            </div>
                            <div>
                                <i class="far fa-clock"></i> <span id="departureTime"></span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5>Adult: 1</h5>
                            <h4 class="text-primary">₦27,000</h4>
                            <p class="text-success">CashBack: ₦540</p>
                        </div>
                        <button class="btn btn-primary btn-lg" id="viewSeatsBtn">View Seats</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seat Selection Modal -->
    <div class="modal fade" id="seatModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Your Seat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="bus-layout">
                        <div class="driver-seat mb-4">
                            <i class="fas fa-steering-wheel"></i> Driver
                        </div>
                        <div class="seats-container d-flex flex-wrap justify-content-center gap-3">
                            <!-- Row 1 -->
                            <div class="seat-pair d-flex gap-3">
                                <button class="seat-btn" data-seat="1A">1A</button>
                                <button class="seat-btn" data-seat="1B">1B</button>
                            </div>
                            <!-- Row 2 -->
                            <div class="seat-pair d-flex gap-3">
                                <button class="seat-btn" data-seat="2A">2A</button>
                                <button class="seat-btn" data-seat="2B">2B</button>
                            </div>
                            <!-- Row 3 -->
                            <div class="seat-pair d-flex gap-3">
                                <button class="seat-btn" data-seat="3A">3A</button>
                                <button class="seat-btn" data-seat="3B">3B</button>
                            </div>
                            <!-- Row 4 -->
                            <div class="seat-pair d-flex gap-3">
                                <button class="seat-btn" data-seat="4A">4A</button>
                                <button class="seat-btn" data-seat="4B">4B</button>
                            </div>
                            <!-- Row 5 -->
                            <div class="seat-pair d-flex gap-3">
                                <button class="seat-btn" data-seat="5A">5A</button>
                                <button class="seat-btn" data-seat="5B">5B</button>
                            </div>
                        </div>
                    </div>
                    <div class="seat-info mt-4 text-center">
                        <span class="me-3"><i class="fas fa-square text-success"></i> Available</span>
                        <span class="me-3"><i class="fas fa-square text-danger"></i> Occupied</span>
                        <span><i class="fas fa-square text-primary"></i> Selected</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmSeat" disabled>Done</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Start -->
    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">About Us</h4>
                            <p class="mb-3">BRTickets is your reliable companion for seamless transportation. With a focus on convenience, safety, and affordability, we connect cities and communities through our comprehensive bus network.</p>
                        </div>
                        <div class="position-relative">
                            <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your email">
                            <button type="button" class="btn btn-secondary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">Subscribe</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Quick Links</h4>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> About</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Routes & Schedules</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Fares & Passes</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Team</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Contact us</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Service Hours</h4>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Mon - Friday:</h6>
                            <p class="text-white mb-0">06.00 am to 010.00 pm</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Saturday:</h6>
                            <p class="text-white mb-0">10.00 am to 05.00 pm</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Vacation:</h6>
                            <p class="text-white mb-0">All Sunday is our vacation</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Contact Info</h4>
                        <a href="#"><i class="fa fa-map-marker-alt me-2"></i> "123 BRT Main Road, Lagos, Nigeria</a>
                        <a href="mailto:info@example.com"><i class="fas fa-envelope me-2"></i> support@brtickets.com</a>
                        <a href="tel:+012 345 67890"><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                        <a href="tel:+012 345 67890" class="mb-3"><i class="fas fa-print me-2"></i> +234 812 345 6789</a>
                        <div class="d-flex">
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i class="fab fa-facebook-f text-white"></i></a>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i class="fab fa-twitter text-white"></i></a>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i class="fab fa-instagram text-white"></i></a>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-0" href=""><i class="fab fa-linkedin-in text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-body"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i>BRTickets</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-body">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom text-white" href="https://htmlcodex.com">BRTickets</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script>
        window.onload = function() {
            // Retrieve booking details
            const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
            if (bookingDetails) {
                document.getElementById('departureDetails').textContent = bookingDetails.departure;
                document.getElementById('arrivalDetails').textContent = bookingDetails.arrival;
                document.getElementById('departureTime').textContent = bookingDetails.time;
            }
        }

        document.getElementById('viewSeatsBtn').addEventListener('click', () => {
    new bootstrap.Modal(document.getElementById('seatModal')).show();
});



        let selectedSeat = null;

        document.querySelectorAll('.seat-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                if (btn.classList.contains('occupied')) return;

                if (selectedSeat) {
                    selectedSeat.classList.remove('selected');
                }

                btn.classList.add('selected');
                selectedSeat = btn;
                document.getElementById('confirmSeat').disabled = false;
            });
        });

        document.getElementById('confirmSeat').addEventListener('click', () => {
            if (selectedSeat) {
                const seatNumber = selectedSeat.dataset.seat;
                const orderNumber = generateOrderNumber();
                const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));

                // Store ticket details
                sessionStorage.setItem('ticketDetails', JSON.stringify({
                    orderNumber,
                    seatNumber,
                    ...bookingDetails
                }));

                window.location.href = 'ticket_summary.php';
            }
        });

        function generateOrderNumber() {
            return 'BRT' + Math.random().toString().substr(2, 11);
        }
    </script>
</body>

</html>