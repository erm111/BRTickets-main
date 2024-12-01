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

// Handle departure state selection
document.getElementById('departureState').addEventListener('change', function() {
  const departureState = this.value;
  const arrivalSelect = document.getElementById('arrivalState');
  
  // Clear and enable arrival select
  arrivalSelect.innerHTML = '<option value="" selected disabled>Select arrival destination</option>';
  arrivalSelect.disabled = false;
  
  // Add all states except the departure state
  statesArray.forEach(state => {
      if (state !== departureState) {
          const option = new Option(state, state);
          arrivalSelect.add(option);
      }
  });
  validateForm();
});

// Set minimum date and time
const departureDateInput = document.getElementById('departureDate');
const now = new Date();
const year = now.getFullYear();
const month = String(now.getMonth() + 1).padStart(2, '0');
const day = String(now.getDate()).padStart(2, '0');
const currentDate = `${year}-${month}-${day}`;

departureDateInput.min = currentDate;

// Prevent selecting past dates
departureDateInput.addEventListener('change', function() {
  const selectedDate = new Date(this.value);
  const today = new Date(currentDate);
  
  if (selectedDate < today) {
      alert('Please select a future date');
      this.value = '';
  }
  validateForm();
});

// Form validation
function validateForm() {
  const departureState = document.getElementById('departureState').value;
  const arrivalState = document.getElementById('arrivalState').value;
  const departureDate = document.getElementById('departureDate').value;
  const seatCount = document.getElementById('seatCount').value;

  const isValid = departureState && arrivalState && departureDate && seatCount;
  document.getElementById('proceedBtn').disabled = !isValid;
}

// Add validation to all form inputs
document.querySelectorAll('#reservationForm select, #reservationForm input[type="date"]').forEach(element => {
  element.addEventListener('change', validateForm);
});

// Form submission
document.getElementById('reservationForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const loaderContainer = document.querySelector('.loader-container');
  loaderContainer.style.display = 'flex';

  // Store form data in session storage
  const formData = {
      departure: document.getElementById('departureState').value,
      arrival: document.getElementById('arrivalState').value,
      date: document.getElementById('departureDate').value,
      seats: document.getElementById('seatCount').value,
      luggage: document.getElementById('luggageCheck').checked
  };

  sessionStorage.setItem('bookingDetails', JSON.stringify(formData));

  // Show loader and redirect
  setTimeout(() => {
      window.location.href = 'select_bus.php';
  }, 3000);
});
