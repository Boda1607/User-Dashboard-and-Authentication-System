<?php 
$pageTitle = "Your Appointments";
include 'header.php';
include 'config.php';

session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];  // Retrieve user information from session

// Retrieve the user's appointments
$sql = "SELECT * FROM appointments WHERE user_id = {$user['id']} ORDER BY appointment_date, appointment_time";
$result = $conn->query($sql);

?>

<h1>Your Appointments</h1>

<?php if ($result->num_rows > 0) { ?>
    <table>
        <tr>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <?php while ($appointment = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                <td style="padding-left: 20px;"><?= htmlspecialchars($appointment['appointment_time']) ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>You have no appointments scheduled.</p>
<?php } ?>

<!-- Button to go back to Dashboard -->
<a href="dashboard.php" class="button">Back to Dashboard</a>

<?php include 'footer.php'; ?>
