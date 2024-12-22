<?php 
$pageTitle = "Login";
include 'header.php'; 
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to find the user by email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Check if the password matches
        if (password_verify($password, $user['password'])) {
            // Start the session and redirect to the dashboard
            session_start();
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
            exit;
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "No user found with this email.";
    }
}
?>

<form method="post" style="max-width: 300px; margin: 0 auto;">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required style="width: 100%; padding: 7px; margin-bottom: 10px; box-sizing: border-box;">
    
    <label for="password">Password:</label>
    <div style="position: relative; width: 100%; box-sizing: border-box;">
        <input type="password" id="password" name="password" required style="width: 100%; padding: 7px; box-sizing: border-box;">
        <span id="togglePassword" style="position: absolute; right: 10px; top: 30%; transform: translateY(-50%); cursor: pointer;">
           👁️‍🗨️
        </span>
    </div>

    <button type="submit" style="width: 100%; padding: 10px; margin-top: 10px; box-sizing: border-box;">Login</button>
</form>

<!-- Register Button -->
<div class="register-container" style="text-align: center; margin-top: 20px;">
    <a href="index.php" class="button" style="text-decoration: none; padding: 10px 20px; background-color: #007BFF; color: white; border-radius: 5px;">Register</a>
</div>

<?php if (isset($error_message)) { ?>
    <div class="error-message" style="text-align: center; color: red; margin-top: 20px;">
        <p><?php echo $error_message; ?></p>
    </div>
<?php } ?>

<script>
    // JavaScript to toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Change the icon (optional: replace with your preferred icons)
        this.textContent = type === 'password' ? '👁️‍🗨️' : '🙈';
    });
</script>

<?php include 'footer.php'; ?>
