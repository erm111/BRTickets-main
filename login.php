<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
  <link defer rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="../fonts/css/all.min.css">
  <script defer src="../fonts/js/all.min.js"></script>
  <link href="../construction_site_takeii_php/Css/login.css" rel="stylesheet">
  <link rel="stylesheet" href="../construction_site_takeii_php/aos/aos.css">
  <script defer src="../Js/create_account.js"></script>
</head>
<style>
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background: url('/img/side-view-woman-waiting-bus.jpg') no-repeat center center fixed;
    background-size: cover;
  }

  .container-fluid::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.2);
  }

  /* The construction image side */
  /* .construction-image {
        background: url('../Images/hero-carousel-1.jpg') no-repeat center center fixed;
        background-size: cover;
      } */

  /* The sign up form side */
  /* .signup-section {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 1rem;
        border-radius: 5%;
        background-color: #f5f5f5; Replace with the correct color code from the image 
      } */

  /* The sign up form styling */


  .signup-form {
    background-color: #ffffff;
    /* Replace with the correct color code from the image */
    padding: 15rem 5rem 1rem;
    border-radius: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    max-width: 800px;
    width: 100%;
    height: auto;
    position: relative;
    left: 2.3rem;
  }

  .sign-up-text {
    position: relative;
    top: 5rem;
    left: 5rem;
  }

  .form-group {
    position: relative;
    bottom: 7rem;
  }

  /* Form inputs styling */
  .form-control {
    border-radius: 8px;
    padding: 2rem 1rem;
    margin-bottom: 3rem;
    border: 1px solid #ced4da;
  }

  /* Submit button styling */
  .btn-primary {
    background-color: #b0d3ea;
    /* Replace with the correct color code from the image */
    color: black;
    border: none;
    border-radius: 20px;
    padding: 1.5rem 1.5rem;
    margin-top: -3rem;
    cursor: pointer;
  }

  .btn-primary:hover {
    background-color: #64BAF3;
    /* Darker shade for hover effect, replace as needed */
    color: white;
  }

  /* Media query for responsive design */
  @media (max-width: 768px) {
    .construction-image {
      display: none;
    }

    .signup-section {
      min-height: 100vh;
    }
  }

  /* styles.css */
  .icon-container {
    display: inline-block;
    /* Aligns the icons inline */
    position: relative;
    /* Allows absolute positioning within */
    bottom: 9rem;
    right: 4px;
  }

  .icon-rectangle {
    width: 55px;
    /* Width of the rectangle */
    height: 15px;
    /* Height of the rectangle */
    background-color: #64BAF3;
    /* Yellow color, replace with the exact color code from your design */
    margin: 5px;
    /* Spacing between the rectangles */
    display: inline-block;
    /* Aligns rectangles inline */
    border-radius: 5px;

  }

  h5 {
    color: #000;
    /* Replace with the exact color code used in your design */
    margin-top: 20px;
    /* Spacing between icons and text */
  }
</style>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 construction-image" data-aos="fade-right">
        <div class="container col-md-12 mt-5 sign-up-text">
          <p style="color: white; font-size: 2rem; font-weight: 300;">Connecting Commuters to Their<br> Destination.</p>
          <p style="color: #fff;">Join thousands of happy commuters who book their tickets with ease using BRTickets.</p>
        </div>
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <div class="signup-section">
          <form class="signup-form" method="post" action="backend/loginprocess.php">
            <h4 style="position: relative; bottom: 12rem; font-weight: bold;" class="mb-5">Welcome Back!</h4>
            <div class="icon-container text-center">
              <div class="icon-rectangle"></div>
              <div style="background-color: #b0d3ea" class="icon-rectangle"></div>
            </div>
            <p style="position: relative; bottom: 8rem; font-size: 1.2rem; font-weight: 100;" class="mb-4">Enter your details to log into your account.</p>

            <?php if (isset($_SESSION['error'])): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email address" required>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Password" required>
                <div class="input-group-append">
                  <span class="input-group-text" style="cursor: pointer;" onclick="togglePassword('loginPassword', 'loginEyeIcon')">
                    <i id="loginEyeIcon" class="fas fa-eye"></i>
                  </span>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="submitBtn" style="background-color: #64BAF3;">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="../construction_site_takeii_php/aos/aos.js"></script>
  <script>
    AOS.init()({
      // Custom settings:
      duration: 800, // values from 0 to 3000, with step 50ms
      easing: 'ease-in-out-quart', // default easing for AOS animations
      once: true, // whether animation should happen only once - while scrolling down
      mirror: false, // whether elements should animate out while scrolling past them
    });

    function togglePassword(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);

      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>

  <!-- Bootstrap and jQuery libraries -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="scripts.js"></script>
  <script src=""></script>

</body>

</html>