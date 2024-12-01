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

// States array for the form
$states = [
    'Obalende',
    'Lekki Phase 1',
    'Ajah',
    'Ikoyi (Falomo)',
    'Maroko',
    'Sandfill',
    'Bonny Camp',
    'Ozumba Mbadiwe',
    'Jakande',
    'Ojuelegba',
    'Surulere (National Stadium, Barracks, Shitta)',
    'Yaba (Tejuosho, Akoka)',
    'Ikeja (Under Bridge, Allen Avenue, Maryland)',
    'Ojota',
    'Ketu',
    'Mile 12',
    'Oshodi (Oshodi Oke, Oshodi Isale)',
    'Mushin (Idi Oro, Palm Avenue)',
    'Cele Bus Stop',
    'Isolo',
    'Ilasa',
    'Iyana-Iba',
    'Mile 2',
    'Okokomaiko',
    'Festac',
    'Trade Fair Complex',
    'Alaba Rago',
    'Agbara',
    'Ikorodu Garage',
    'Agric',
    'Ogolonto',
    'Itowolo',
    'Majidun',
    'Agege (Pen Cinema)',
    'Dopemu',
    'Iyana-Ipaja',
    'Abule Egba',
    'Ile-Epo',
    'Egbeda',
    'Ijegun',
    'Ipaja',
    'Alaba International Market',
    'Wharf Road',
    'Tin Can',
    'Coconut',
    'Berger Yard',
    'Epe Roundabout',
    'Eleko Junction',
    'Ojodu Berger',
    'Sango-Ota',
    'Ikotun',
    'Egbe',
    'Bariga',
    'Gbagada'
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - BRTickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="user.css">
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
        <div class="top-bar">
            <div class="welcome-text">
                Hi, <?php echo htmlspecialchars($fullName); ?>
            </div>
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
        <div class="content-area">
            <h2>Welcome to BRTickets</h2>
            <!-- reservation section -->
            <div class="reservation-box">
                <h3>Reserve Your Seat</h3>
                <form id="reservationForm" class="mt-4">
                    <div class="form-group mb-4">
                        <label for="departureState">Where are you travelling from?</label>
                        <select class="form-select form-select-lg" id="departureState" name="departureState" required>
                            <option value="" selected disabled>Choose a departure terminal</option>
                            <?php foreach ($states as $state): ?>
                                <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="arrivalState">Where are you going to?</label>
                        <select class="form-select form-select-lg" id="arrivalState" name="arrivalState" required disabled>
                            <option value="" selected disabled>Select arrival destination</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="departureDate">Departure Date</label>
                        <input type="date" class="form-control form-control-lg" id="departureDate" name="departureDate" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="seatCount">Number of Seats</label>
                        <select class="form-select form-select-lg" id="seatCount" name="seatCount" required>
                            <option value="" selected disabled>Select number of seats</option>
                            <?php for ($i = 1; $i <= 13; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?> seat<?php echo $i > 1 ? 's' : ''; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="luggageCheck" name="luggage">
                        <label class="form-check-label" for="luggageCheck">Luggage?</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100" id="proceedBtn" disabled>Proceed</button>
                </form>
            </div>

            <!-- Loader -->
            <div class="loader-container" style="display: none;">
                <div class="loader"></div>
                <p class="mt-3">Finding bus...</p>
            </div>


            <script>
                // Make states array available to JavaScript
                const statesArray = <?php echo json_encode($states); ?>;
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="user.js"></script>
</body>

</html>