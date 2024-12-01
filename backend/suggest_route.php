<?php
session_start();
require_once 'dbconn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Define Lagos BRT/Bus stations
$stations = [
    'Obalende', 'Lekki Phase 1', 'Ajah', 'Ikoyi (Falomo)', 'Maroko', 'Sandfill',
    'Bonny Camp', 'Ozumba Mbadiwe', 'Jakande', 'Ojuelegba',
    'Surulere (National Stadium, Barracks, Shitta)', 'Yaba (Tejuosho, Akoka)',
    'Ikeja (Under Bridge, Allen Avenue, Maryland)', 'Ojota', 'Ketu', 'Mile 12',
    'Oshodi (Oshodi Oke, Oshodi Isale)', 'Mushin (Idi Oro, Palm Avenue)',
    'Cele Bus Stop', 'Isolo', 'Ilasa', 'Iyana-Iba', 'Mile 2', 'Okokomaiko',
    'Festac', 'Trade Fair Complex', 'Alaba Rago', 'Agbara', 'Ikorodu Garage',
    'Agric', 'Ogolonto', 'Itowolo', 'Majidun', 'Agege (Pen Cinema)', 'Dopemu',
    'Iyana-Ipaja', 'Abule Egba', 'Ile-Epo', 'Egbeda', 'Ijegun', 'Ipaja',
    'Alaba International Market', 'Wharf Road', 'Tin Can', 'Coconut',
    'Berger Yard', 'Epe Roundabout', 'Eleko Junction', 'Ojodu Berger',
    'Sango-Ota', 'Ikotun', 'Egbe', 'Bariga', 'Gbagada'
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggest Route - BRTickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="user.css">
    <style>
        .route-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(100, 186, 243, 0.1);
            margin-bottom: 2rem;
        }

        .route-suggestion {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-top: 2rem;
            display: none;
        }

        .route-path {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            margin: 1rem 0;
        }

        .route-station {
            background: #e3f2fd;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            margin: 0.5rem;
        }

        .route-arrow {
            color: #64BAF3;
            margin: 0 0.5rem;
        }

        .route-details {
            margin-top: 1rem;
            padding: 1rem;
            background: white;
            border-radius: 8px;
        }

        .select2-container {
            width: 100% !important;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
            <h2>Suggest Route</h2>

            <div class="route-card">
                <form id="routeForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Departure Station</label>
                            <select class="form-control station-select" id="departureStation" required>
                                <option value="">Select departure station</option>
                                <?php foreach ($stations as $station): ?>
                                    <option value="<?php echo $station; ?>"><?php echo $station; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Arrival Station</label>
                            <select class="form-control station-select" id="arrivalStation" required>
                                <option value="">Select arrival station</option>
                                <?php foreach ($stations as $station): ?>
                                    <option value="<?php echo $station; ?>"><?php echo $station; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Find Routes</button>
                </form>

                <div id="routeSuggestion" class="route-suggestion">
                    <!-- Route suggestions will be displayed here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="suggest_route.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
