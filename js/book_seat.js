function handleReservation(event) {
  event.preventDefault();

  // Show loader
  const loaderHtml = `
        <div id="seatLoader" class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center" style="background: rgba(0,0,0,0.8); z-index: 9999;">
            <div class="text-center">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h4 class="text-white">Checking Available Seats...</h4>
            </div>
        </div>
    `;
  document.body.insertAdjacentHTML("beforeend", loaderHtml);

  // Get form data
  const form = event.target.closest("form");
  const formData = {
    route: form.querySelector("select").value,
    departure: form.querySelector('input[placeholder="Enter Bus Stop or City"]')
      .value,
    arrival: form.querySelectorAll(
      'input[placeholder="Enter Bus Stop or City"]'
    )[1].value,
    date: form.querySelector('input[type="date"]').value,
    time: form.querySelector("select.form-select.ms-3").value,
  };

  // Store in sessionStorage
  sessionStorage.setItem("bookingDetails", JSON.stringify(formData));

  // Redirect after 3 seconds
  setTimeout(() => {
    window.location.href = "book_seat.php";
  }, 3000);
}
