// States array for Nigeria
const states = [
  'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno',
  'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 'Imo', 'Jigawa',
  'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger',
  'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara'
];

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

// Handle departure state selection
document.getElementById('departureState')?.addEventListener('change', function() {
  const departureState = this.value;
  const arrivalSelect = document.getElementById('arrivalState');
  
  // Enable arrival select
  arrivalSelect.disabled = false;
  
  // Clear and reset arrival select
  arrivalSelect.innerHTML = '<option value="" selected disabled>Select arrival destination</option>';
  
  // Add all states except the departure state
  states.forEach(state => {
      if (state !== departureState) {
          const option = new Option(state, state);
          arrivalSelect.add(option);
      }
  });
});

// Form submission handler
document.getElementById('reservationForm')?.addEventListener('submit', function(e) {
  e.preventDefault();
  
  const bookingDetails = {
      departure: document.getElementById('departureState').value,
      arrival: document.getElementById('arrivalState').value,
      date: document.getElementById('departureDate')?.value,
      busType: document.querySelector('input[name="busType"]:checked')?.value,
      luggage: document.getElementById('luggageOption')?.checked
  };
  
  // Store booking details in session storage
  sessionStorage.setItem('bookingDetails', JSON.stringify(bookingDetails));
  
  // Redirect to seat selection
  window.location.href = 'select_bus.php';
});

// Initialize any date pickers
const departureDateInput = document.getElementById('departureDate');
if (departureDateInput) {
  // Set minimum date to today
  const today = new Date().toISOString().split('T')[0];
  departureDateInput.min = today;
}

// Handle loader display
window.addEventListener('load', function() {
  const loader = document.querySelector('.loader-container');
  if (loader) {
      loader.style.display = 'none';
  }
});
