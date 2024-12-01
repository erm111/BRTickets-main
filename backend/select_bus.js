document.addEventListener('DOMContentLoaded', function() {
    // Retrieve booking details from session storage
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    
    if (bookingDetails) {
        // Display trip details
        document.getElementById('departureDetails').textContent = bookingDetails.departure;
        document.getElementById('arrivalDetails').textContent = bookingDetails.arrival;
        document.getElementById('dateDetails').textContent = new Date(bookingDetails.date).toLocaleDateString();
        document.getElementById('seatsDetails').textContent = bookingDetails.seats;
        
        if (bookingDetails.luggage) {
            document.getElementById('luggageDetails').innerHTML = '<i class="fas fa-suitcase"></i> Luggage included';
        }

        // Calculate prices
        const luggageFee = bookingDetails.luggage ? 5000 : 0;
        const numSeats = parseInt(bookingDetails.seats);
        
        // Hiance total
        const hianceTotal = (23000 * numSeats) + luggageFee;
        document.getElementById('hianceTotal').textContent = `Total: ₦${hianceTotal.toLocaleString()}`;
        
        // Jet Mover total
        const jetTotal = (25000 * numSeats) + luggageFee;
        document.getElementById('jetTotal').textContent = `Total: ₦${jetTotal.toLocaleString()}`;
    }
});

function showSeatSelection(busType, totalSeats) {
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    const requiredSeats = parseInt(bookingDetails.seats);
    const modal = document.getElementById('seatModal');
    const layout = document.querySelector('.bus-layout');
    
    // Clear previous layout
    layout.innerHTML = '';
    
    // Generate seats
    for (let i = 1; i <= totalSeats; i++) {
        const seat = document.createElement('div');
        seat.className = 'seat';
        seat.textContent = i;
        seat.onclick = () => toggleSeat(seat, requiredSeats);
        layout.appendChild(seat);
    }
    
    document.getElementById('requiredSeats').textContent = requiredSeats;
    document.getElementById('selectedCount').textContent = '0';
    modal.style.display = 'block';
}

function toggleSeat(seat, requiredSeats) {
    const selectedSeats = document.querySelectorAll('.seat.selected').length;
    
    if (seat.classList.contains('selected')) {
        seat.classList.remove('selected');
    } else if (selectedSeats < requiredSeats) {
        seat.classList.add('selected');
    }
    
    document.getElementById('selectedCount').textContent = 
        document.querySelectorAll('.seat.selected').length;
}

function closeSeatModal() {
    document.getElementById('seatModal').style.display = 'none';
}

// Sidebar toggle functionality
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
}

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const menuToggle = document.querySelector('.menu-toggle');
    
    if (window.innerWidth <= 768) {
        if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    }
});

document.getElementById('confirmSeats').onclick = function() {
    const selectedSeats = document.querySelectorAll('.seat.selected').length;
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    const requiredSeats = parseInt(bookingDetails.seats);
    
    if (selectedSeats === requiredSeats) {
        const selectedSeatNumbers = Array.from(document.querySelectorAll('.seat.selected'))
            .map(seat => seat.textContent);
        sessionStorage.setItem('selectedSeats', JSON.stringify(selectedSeatNumbers));
        closeSeatModal();
        window.location.href = 'ticket_processing.php';
    } else {
        alert(`Please select exactly ${requiredSeats} seats`);
    }
};
