#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const errorDiv = document.getElementById('loginError');

        if (!usernameInput.value.trim() || !passwordInput.value.trim()) {
            event.preventDefault();
            errorDiv.textContent = 'Please enter both username/email and password.';
            errorDiv.style.display = 'block';
        } else {
            errorDiv.style.display = 'none';
        }
    });
</script>
</head>
<body>
<div class="container">
    <h1>Login</h1>
    <?php
    session_start();
    if (isset($_SESSION['login_error']) && !empty($_SESSION['login_error'])) {
        echo '<div class="error-message">';
        echo '<ul>';
        echo '<li>' . htmlspecialchars($_SESSION['login_error']);
        echo '</ul>';
        echo '</div>';
        unset($_SESSION['login_error']);
    }
    ?>
    <form id="loginForm" action="login.php" method="POST">
        <div class="form-group">
            <label for="username">Username or Email:</label><br>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
    <p>Don't have an account? <a href="signup_page.php">Sign up here</a></p>
    <div id="loginError" class="error-message" style="display:none;"></div>
</div>
</body>
</html>