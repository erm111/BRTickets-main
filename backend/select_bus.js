document.addEventListener('DOMContentLoaded', function() {
    // Get booking details from session storage
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    if (bookingDetails) {
        document.getElementById('departureDetails').textContent = bookingDetails.departure;
        document.getElementById('arrivalDetails').textContent = bookingDetails.arrival;
        document.getElementById('departureDate').textContent = new Date(bookingDetails.date).toLocaleDateString();
    }
});

function showSeatSelection(busType, totalSeats) {
    // Update booking details with bus type
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    bookingDetails.busType = busType;
    sessionStorage.setItem('bookingDetails', JSON.stringify(bookingDetails));

    // Create seat layout
    const seatLayout = document.createElement('div');
    seatLayout.className = 'seat-layout';
    
    // Create seats
    for (let i = 1; i <= totalSeats; i++) {
        const seat = document.createElement('div');
        seat.className = 'seat';
        seat.dataset.seatNumber = i;
        seat.innerHTML = i;
        
        seat.addEventListener('click', function() {
            this.classList.toggle('selected');
            updateSelectedSeats();
        });
        
        seatLayout.appendChild(seat);
    }
    
    // Show seat selection container
    const seatSelectionContainer = document.getElementById('seatSelection');
    seatSelectionContainer.innerHTML = '';
    seatSelectionContainer.appendChild(seatLayout);
    seatSelectionContainer.style.display = 'block';
    
    // Show luggage option
    document.getElementById('luggageOption').style.display = 'block';
    
    // Show proceed button
    document.getElementById('proceedButton').style.display = 'block';
}

function updateSelectedSeats() {
    const selectedSeats = [];
    document.querySelectorAll('.seat.selected').forEach(seat => {
        selectedSeats.push(seat.dataset.seatNumber);
    });
    
    // Store selected seats in session storage
    sessionStorage.setItem('selectedSeats', JSON.stringify(selectedSeats));
    
    // Update total amount
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    const basePrice = bookingDetails.busType === 'hiance' ? 23000 : 25000;
    const luggageChecked = document.getElementById('luggageCheckbox').checked;
    const luggageFee = luggageChecked ? 5000 : 0;
    
    const totalAmount = (basePrice * selectedSeats.length) + luggageFee;
    document.getElementById('totalAmount').textContent = `₦${totalAmount.toLocaleString()}`;
}

function handleLuggageChange() {
    const luggageChecked = document.getElementById('luggageCheckbox').checked;
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    bookingDetails.luggage = luggageChecked;
    sessionStorage.setItem('bookingDetails', JSON.stringify(bookingDetails));
    updateSelectedSeats();
}

function proceedToBooking() {
    const selectedSeats = JSON.parse(sessionStorage.getItem('selectedSeats') || '[]');
    if (selectedSeats.length === 0) {
        alert('Please select at least one seat');
        return;
    }
    
    window.location.href = 'ticket_processing.php';
}

// Add event listeners
document.getElementById('luggageCheckbox')?.addEventListener('change', handleLuggageChange);
document.getElementById('proceedButton')?.addEventListener('click', proceedToBooking);
