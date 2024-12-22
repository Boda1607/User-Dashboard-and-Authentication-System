<?php 
$pageTitle = "Register";
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO users (username, phone, email, password, age, gender) 
            VALUES ('$username', '$phone', '$email', '$password', '$age', '$gender')";
    if ($conn->query($sql)) {
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<div class="form-container">
    <form method="post">
        <label>Username:</label><input type="text" name="username" required><br>
        <label>Phone:</label><input type="text" name="phone" required><br>
        <label>Email:</label><input type="email" name="email" required><br>
        <label>Password:</label><input type="password" name="password" required><br>
        <label>Age:</label><input type="number" name="age" required><br>
        <label>Gender:</label>
        <select name="gender">
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
        </select><br>
        <button type="submit">Register</button>
    </form>
    
    <!-- Login Button for existing users -->
    <div class="login-link">
        <p>Already registered? <a href="login.php" class="button">Login Here</a></p>
    </div>
</div>

<?php include 'footer.php'; ?>
