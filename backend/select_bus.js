document.addEventListener('DOMContentLoaded', function() {
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    if (bookingDetails) {
        document.getElementById('departureDetails').textContent = bookingDetails.departure;
        document.getElementById('arrivalDetails').textContent = bookingDetails.arrival;
        document.getElementById('dateDetails').textContent = new Date(bookingDetails.date).toLocaleDateString();
        document.getElementById('seatsDetails').textContent = bookingDetails.seats;
        document.getElementById('luggageDetails').textContent = bookingDetails.luggage ? 'With Luggage' : 'No Luggage';
    }

    const busButtons = document.querySelectorAll('.select-bus-btn');
    busButtons.forEach(button => {
        button.addEventListener('click', function() {
            const busType = this.dataset.busType;
            const totalSeats = parseInt(this.dataset.seats);
            showSeatSelection(busType, totalSeats);
        });
    });

    document.getElementById('confirmSeats').addEventListener('click', confirmSeatSelection);
    document.getElementById('proceedButton').addEventListener('click', proceedToPayment);
});

function showSeatSelection(busType, totalSeats) {
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    const requiredSeats = parseInt(bookingDetails.seats);
    
    const modal = document.getElementById('seatModal');
    modal.style.display = 'block';

    bookingDetails.busType = busType;
    sessionStorage.setItem('bookingDetails', JSON.stringify(bookingDetails));

    const seatLayout = document.createElement('div');
    seatLayout.className = 'seat-layout';
    
    for (let i = 1; i <= totalSeats; i++) {
        const seat = document.createElement('div');
        seat.className = 'seat';
        seat.dataset.seatNumber = i;
        seat.innerHTML = i;
        
        seat.addEventListener('click', function() {
            const currentSelected = document.querySelectorAll('.seat.selected').length;
            if (!this.classList.contains('selected') && currentSelected >= requiredSeats) {
                alert(`You can only select ${requiredSeats} seats`);
                return;
            }
            this.classList.toggle('selected');
            updateSelectedSeats();
        });
        
        seatLayout.appendChild(seat);
    }
    
    const busLayout = document.querySelector('.bus-layout');
    busLayout.innerHTML = '';
    busLayout.appendChild(seatLayout);

    document.getElementById('requiredSeats').textContent = requiredSeats;
    document.getElementById('selectedCount').textContent = '0';
    updateSelectedSeats();
}

function updateSelectedSeats() {
    const selectedSeats = [];
    document.querySelectorAll('.seat.selected').forEach(seat => {
        selectedSeats.push(seat.dataset.seatNumber);
    });
    
    document.getElementById('selectedCount').textContent = selectedSeats.length;
    sessionStorage.setItem('selectedSeats', JSON.stringify(selectedSeats));
    
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    const basePrice = bookingDetails.busType === 'hiance' ? 7500 : 10000;
    const luggageFee = bookingDetails.luggage ? 2000 : 0;
    
    const totalAmount = (basePrice * selectedSeats.length) + luggageFee;
    document.querySelector('.price-value').textContent = totalAmount.toLocaleString();
    
    const proceedButton = document.getElementById('proceedButton');
    proceedButton.disabled = selectedSeats.length !== parseInt(bookingDetails.seats);
}


function closeSeatModal() {
    const modal = document.getElementById('seatModal');
    modal.style.display = 'none';
}

function confirmSeatSelection() {
    const selectedSeats = JSON.parse(sessionStorage.getItem('selectedSeats') || '[]');
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    const requiredSeats = parseInt(bookingDetails.seats);

    if (selectedSeats.length !== requiredSeats) {
        alert(`Please select exactly ${requiredSeats} seats`);
        return;
    }
    
    document.getElementById('seatsDetails').textContent = selectedSeats.length;
    document.getElementById('proceedButton').disabled = false;
}

function proceedToPayment() {
    const selectedSeats = JSON.parse(sessionStorage.getItem('selectedSeats'));
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    
    if (selectedSeats && bookingDetails) {
        window.location.href = 'ticket_processing.php';
    }
}
