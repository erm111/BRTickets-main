document.addEventListener('DOMContentLoaded', function() {
    // Initialize Select2 for better dropdown experience
    $('.station-select').select2({
        placeholder: "Select a station",
        allowClear: true
    });

    // Define major routes and connections
    const routeConnections = {
        'Oshodi': ['Mushin', 'Cele', 'Ikeja', 'Mile 2'],
        'Ikeja': ['Maryland', 'Ojota', 'Oshodi', 'Agege'],
        'Mile 2': ['Festac', 'Okokomaiko', 'Oshodi'],
        'Yaba': ['Ojuelegba', 'Surulere', 'Oyingbo'],
        // Add more route connections as needed
    };

    document.getElementById('routeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const departure = document.getElementById('departureStation').value;
        const arrival = document.getElementById('arrivalStation').value;

        if (departure === arrival) {
            alert('Please select different stations for departure and arrival');
            return;
        }

        const route = generateRoute(departure, arrival);
        displayRoute(route);
    });

    function generateRoute(departure, arrival) {
        // This is a simplified route generation
        // In production, implement proper routing algorithm (e.g., Dijkstra's)
        const intermediateStations = findIntermediateStations(departure, arrival);
        
        return {
            stations: [departure, ...intermediateStations, arrival],
            distance: calculateApproximateDistance(departure, arrival),
            duration: calculateApproximateDuration(departure, arrival),
            fare: calculateFare(departure, arrival),
            trafficStatus: getTrafficStatus()
        };
    }

    function findIntermediateStations(departure, arrival) {
        // Simplified intermediate stations logic
        // In production, implement proper path finding
        return [];
    }

    function displayRoute(route) {
        const suggestionDiv = document.getElementById('routeSuggestion');
        suggestionDiv.style.display = 'block';

        const html = `
            <h4>Suggested Route</h4>
            <div class="route-path">
                ${route.stations.map(station => `
                    <span class="route-station">${station}</span>
                    ${station !== route.stations[route.stations.length - 1] ? 
                        '<i class="fas fa-arrow-right route-arrow"></i>' : ''}
                `).join('')}
            </div>
            <div class="route-details">
                <p><i class="fas fa-road"></i> Estimated Distance: ${route.distance} km</p>
                <p><i class="fas fa-clock"></i> Estimated Duration: ${route.duration} minutes</p>
                <p><i class="fas fa-money-bill"></i> Estimated Fare: ₦${route.fare}</p>
                <p><i class="fas fa-traffic-light"></i> Traffic Status: ${route.trafficStatus}</p>
            </div>
        `;
        suggestionDiv.innerHTML = html;
    }

    function calculateApproximateDistance(departure, arrival) {
        // Simplified distance calculation
        return Math.floor(Math.random() * 20) + 5;
    }

    function calculateApproximateDuration(departure, arrival) {
        // Simplified duration calculation
        return Math.floor(Math.random() * 45) + 15;
    }

    function calculateFare(departure, arrival) {
        // Simplified fare calculation
        const baseRate = 150;
        const distance = calculateApproximateDistance(departure, arrival);
        return baseRate + (distance * 20);
    }

    function getTrafficStatus() {
        // Simplified traffic status
        const statuses = ['Light', 'Moderate', 'Heavy'];
        return statuses[Math.floor(Math.random() * statuses.length)];
    }
});