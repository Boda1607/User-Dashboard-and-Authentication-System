<?php 
$pageTitle = "Make an Appointment";
include 'header.php';
include 'config.php';

session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];  // Retrieve user information from session

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // Insert appointment into the database
    $sql = "INSERT INTO appointments (user_id, appointment_date, appointment_time) VALUES ({$user['id']}, '$appointment_date', '$appointment_time')";
    if ($conn->query($sql)) {
        $message = "Appointment scheduled successfully!<br><a href='dashboard.php'>Back to Dashboard</a>";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<h1>Schedule an Appointment</h1>

<form method="post">
    <label for="appointment_date">Date:</label>
    <input type="date" name="appointment_date" required><br>
    
    <label for="appointment_time">Time:</label>
    <input type="time" name="appointment_time" required><br>
    
    <button type="submit">Schedule Appointment</button>
</form>

<?php 
// Display the success or error message below the form
if (isset($message)) {
    echo "<div class='message' style='text-align: center; margin-top: 20px;'>";
    echo "<p>$message</p>";
    echo "</div>";
}

include 'footer.php';
?>
