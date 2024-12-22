<?php 
$pageTitle = "Dashboard";
include 'header.php';
include 'config.php';

session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];  // Retrieve user information from session
?>

<h1>Welcome, <?= htmlspecialchars($user['username']) ?></h1>

<div class="user-info">
    <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Age:</strong> <?= htmlspecialchars($user['age']) ?></p>
    <p><strong>Gender:</strong> <?= htmlspecialchars($user['gender']) ?></p>
</div>

<!-- Profile, Appointment, and View Appointments Buttons -->
<div class="profile-buttons">
    <a href="edit.php" class="button">Edit Profile</a>
    <a href="logout.php" class="button">Logout</a>
    <a href="appointment.php" class="button">Make an Appointment</a>
    <a href="view_appointments.php" class="button">View Appointments</a>
    <a href="edit_appointment.php" class="button">Edit Appointment</a>
    <!-- Link to Website Info Page -->
    <a href="website_info.php" class="button">Website Info</a>
</div>


<?php include 'footer.php'; ?>
