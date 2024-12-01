<?php
session_start();
require_once 'dbconn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch current user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - BRTickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="user.css">
    <style>
        .settings-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(100, 186, 243, 0.1);
        }

        .settings-section {
            margin-bottom: 2rem;
        }

        .settings-section h4 {
            color: #64BAF3;
            margin-bottom: 1.5rem;
        }

        .verify-password-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            margin: 2rem auto;
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
            <h2>Account Settings</h2>

            <div class="settings-card">
                <div class="settings-section">
                    <h4>Personal Information</h4>
                    <form id="updateProfileForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>

                <div class="settings-section">
                    <h4>Change Password</h4>
                    <form id="changePasswordForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new_password" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm_password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Verification Modal -->
    <div class="verify-password-modal" id="verifyPasswordModal">
        <div class="modal-content">
            <h4>Verify Password</h4>
            <p>Please enter your current password to confirm changes</p>
            <form id="verifyPasswordForm">
                <div class="mb-3">
                    <input type="password" class="form-control" name="current_password" placeholder="Current Password" required>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-2" onclick="closeVerifyModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Verify</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let pendingForm = null;
        let pendingData = null;

        function showVerifyModal(form, formData) {
            pendingForm = form;
            pendingData = formData;
            document.getElementById('verifyPasswordModal').style.display = 'block';
        }

        function closeVerifyModal() {
            document.getElementById('verifyPasswordModal').style.display = 'none';
            pendingForm = null;
            pendingData = null;
        }

        document.getElementById('updateProfileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            showVerifyModal('profile', formData);
        });

        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            showVerifyModal('password', formData);
        });

        document.getElementById('verifyPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const password = new FormData(this).get('current_password');
            
            fetch('backend/verify_password.php', {
                method: 'POST',
                body: JSON.stringify({
                    password: password,
                    form_type: pendingForm,
                    form_data: Object.fromEntries(pendingData)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .finally(() => {
                closeVerifyModal();
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="user.js"></script>
</body>
</html>