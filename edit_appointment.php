<?php
$pageTitle = "Edit Appointment";
include 'header.php';
include 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];

// Fetch user appointments
$sql = "SELECT * FROM appointments WHERE user_id = {$user['id']}";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        // Delete the appointment
        $appointmentId = $_POST['appointment_id'];
        $deleteSql = "DELETE FROM appointments WHERE id = $appointmentId";
        if ($conn->query($deleteSql)) {
            echo "<p>Appointment canceled successfully!</p>";
        } else {
            echo "<p>Error canceling appointment: " . $conn->error . "</p>";
        }
    } elseif (isset($_POST['update'])) {
        // Update the appointment
        $appointmentId = $_POST['appointment_id'];
        $newDate = $_POST['appointment_date'];
        $newTime = $_POST['appointment_time'];
        $updateSql = "UPDATE appointments SET appointment_date = '$newDate', appointment_time = '$newTime' WHERE id = $appointmentId";
        if ($conn->query($updateSql)) {
            echo "<p>Appointment updated successfully!</p>";
        } else {
            echo "<p>Error updating appointment: " . $conn->error . "</p>";
        }
    }
    // Refresh the page to show updated data
    header("Location: edit_appointment.php");
    exit;
}
?>

<h1>Edit Your Appointments</h1>

<?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <form method="post">
                        <td>
                            <input type="date" name="appointment_date" value="<?= htmlspecialchars($row['appointment_date']) ?>" required>
                        </td>
                        <td>
                            <input type="time" name="appointment_time" value="<?= htmlspecialchars($row['appointment_time']) ?>" required>
                        </td>
                        <td>
                             <div class="button-container">
                                 <input type="hidden" name="appointment_id" value="<?= $row['id'] ?>">
                                 <button type="submit" name="update">Update</button>
                                 <button type="submit" name="delete" style="background-color: red;">Cancel</button>
                            </div>    
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No appointments found.</p>
<?php endif; ?>

<!-- Go Back Button -->
<a href="dashboard.php" class="button">Go Back</a>

<?php include 'footer.php'; ?>
