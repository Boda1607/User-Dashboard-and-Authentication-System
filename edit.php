<?php 
$pageTitle = "Edit Profile";
include 'header.php';
include 'config.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // SQL query to update the user profile
    $sql = "UPDATE users SET username='$username', phone='$phone', email='$email', age='$age', gender='$gender' WHERE id={$user['id']}";
    if ($conn->query($sql)) {
        // Update session data after successful update
        $_SESSION['user'] = array_merge($user, $_POST);
        
        // Redirect to the dashboard after a successful update
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="post">
    <label>Username:</label><input type="text" name="username" value="<?= $user['username'] ?>" required><br>
    <label>Phone:</label><input type="text" name="phone" value="<?= $user['phone'] ?>" required><br>
    <label>Email:</label><input type="email" name="email" value="<?= $user['email'] ?>" required><br>
    <label>Age:</label><input type="number" name="age" value="<?= $user['age'] ?>" required><br>
    <label>Gender:</label>
    <select name="gender">
        <option <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
        <option <?= $user['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
    </select><br>
    <button type="submit">Update</button>
</form>

<?php include 'footer.php'; ?>
