<?php
session_start();
require_once 'dbconn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Define Nigerian states
$states = [
    'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno',
    'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 'Imo', 'Jigawa',
    'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger',
    'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara'
];

// Note: In a production environment, you would:
// 1. Use a routing API (Google Maps, OpenStreetMap)
// 2. Have a database of known routes
// 3. Implement proper distance calculations
// 4. Consider road conditions and traffic data
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

        .route-state {
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
            <a href="booking_history.php" class="menu-item">
                <i class="fas fa-history"></i> Booking History
            </a>
            <a href="settings.php" class="menu-item active">
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
                            <label>Departure State</label>
                            <select class="form-control" id="departureState" required>
                                <option value="">Select departure state</option>
                                <?php foreach ($states as $state): ?>
                                    <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Arrival State</label>
                            <select class="form-control" id="arrivalState" required>
                                <option value="">Select arrival state</option>
                                <?php foreach ($states as $state): ?>
                                    <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
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

    <script>
        // Simplified route finding algorithm
        // In production, this would be replaced with API calls
        const routeMap = {
            // Sample predefined routes between major cities
            'Lagos': {
                'Abuja': ['Lagos', 'Ogun', 'Oyo', 'Kwara', 'Niger', 'FCT'],
                'Kano': ['Lagos', 'Ogun', 'Oyo', 'Kwara', 'Niger', 'Kaduna', 'Kano']
            },
            'Enugu': {
                'Lagos': ['Enugu', 'Anambra', 'Delta', 'Edo', 'Ondo', 'Ogun', 'Lagos'],
                'Port Harcourt': ['Enugu', 'Imo', 'Rivers']
            }
            // Add more predefined routes
        };

        document.getElementById('routeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const departure = document.getElementById('departureState').value;
            const arrival = document.getElementById('arrivalState').value;

            // Show route suggestion
            const suggestionDiv = document.getElementById('routeSuggestion');
            suggestionDiv.style.display = 'block';

            // In a real implementation, this would make an API call
            // For now, we'll generate a simple route
            const route = generateRoute(departure, arrival);
            displayRoute(route);
        });

        function generateRoute(departure, arrival) {
            // This is a simplified route generation
            // In production, use routing API or database
            return {
                states: [departure, ...getIntermediateStates(departure, arrival), arrival],
                distance: calculateApproximateDistance(departure, arrival),
                duration: calculateApproximateDuration(departure, arrival),
                roadCondition: 'Good'
            };
        }

        function getIntermediateStates(departure, arrival) {
            // Simplified intermediate states logic
            // In production, use actual geographical data
            return [];
        }

        function displayRoute(route) {
            const html = `
                <h4>Suggested Route</h4>
                <div class="route-path">
                    ${route.states.map(state => `
                        <span class="route-state">${state}</span>
                        ${state !== route.states[route.states.length - 1] ? 
                            '<i class="fas fa-arrow-right route-arrow"></i>' : ''}
                    `).join('')}
                </div>
                <div class="route-details">
                    <p><i class="fas fa-road"></i> Estimated Distance: ${route.distance} km</p>
                    <p><i class="fas fa-clock"></i> Estimated Duration: ${route.duration} hours</p>
                    <p><i class="fas fa-info-circle"></i> Road Condition: ${route.roadCondition}</p>
                </div>
            `;
            document.getElementById('routeSuggestion').innerHTML = html;
        }

        function calculateApproximateDistance(departure, arrival) {
            // In production, use actual distance calculations
            return Math.floor(Math.random() * 500) + 100;
        }

        function calculateApproximateDuration(departure, arrival) {
            // In production, use actual duration calculations
            return Math.floor(Math.random() * 8) + 2;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="user.js"></script>
</body>
</html>