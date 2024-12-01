<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link defer rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="../fonts/css/all.min.css">
  <script defer src="../fonts/js/all.min.js"></script>

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

    .signup-form {
      background-color: #ffffff;
      padding: 17rem 5rem 1rem;
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

    .form-control {
      border-radius: 8px;
      padding: 2rem 1rem;
      margin-bottom: 3rem;
      border: 1px solid #ced4da;
    }

    .btn-primary {
      background-color: #64BAF3;
      color: white;
      border: none;
      border-radius: 20px;
      margin-top: 1rem;
      cursor: pointer;
    }

    .btn-primary:hover {
      background-color: #4a9fd9;
      color: white;
    }

    .icon-container {
      display: inline-block;
      position: relative;
      bottom: 9rem;
      right: 4px;
    }

    .icon-rectangle {
      width: 55px;
      height: 15px;
      background-color: #64BAF3;
      margin: 5px;
      display: inline-block;
      border-radius: 5px;
    }

    .password-toggle {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #666;
    }
  </style>
</head>

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
          <form id="signupForm" style="padding: 22.5rem 5rem 1rem;" class="signup-form" method="post" action="backend/signupprocess.php">
            <h4 style="position: relative; bottom: 16rem; font-weight: bold;" class="mb-5">Create Account</h4>
            <div style="position: relative; bottom: 13rem;" class="icon-container text-center">
              <div class="icon-rectangle"></div>
              <div style="background-color: #b0d3ea" class="icon-rectangle"></div>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
              <div class="alert alert-danger"><?php echo $_SESSION['error'];
                                              unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <div style="position: relative; bottom: 10rem;" class="form-group">
              <input type="text" class="form-control" name="full-name" placeholder="Full name" required>
            </div>
            <div style="position: relative; bottom: 10rem;" class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email address" required>
            </div>
            <div style="position: relative; bottom: 10rem;" class="form-group">
              <div class="position-relative">
                <input type="password" class="form-control" name="password" id="signupPassword" placeholder="Password" required>
                <span class="password-toggle" onclick="togglePassword('signupPassword', 'signupEyeIcon')">
                  <i id="signupEyeIcon" class="fas fa-eye"></i>
                </span>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="padding: 1.5rem 1.5rem;">Sign Up</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
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

    document.getElementById('signupForm').addEventListener('submit', function(e) {
      const email = document.querySelector('input[name="email"]').value;
      const password = document.querySelector('input[name="password"]').value;
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailRegex.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address');
        return;
      }

      if (password.length < 5) {
        e.preventDefault();
        alert('Password must be at least 5 characters long');
        return;
      }
    });
  </script>

  <!-- Bootstrap and jQuery libraries -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>