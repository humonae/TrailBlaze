#!/usr/local/bin/php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Sign Up</h1>
    <?php
    session_start();
    if (isset($_SESSION['signup_errors']) && !empty($_SESSION['signup_errors'])) {
        echo '<div class="error-message">';
        echo '<ul>';
        foreach ($_SESSION['signup_errors'] as $error) {
            echo '<li>' . htmlspecialchars($error) . '</li>';
        }
        echo '</ul>';
        echo '</div>';
        unset($_SESSION['signup_errors']);
    }
    ?>
    <form id="signupForm" action="signup.php" method="POST" onsubmit="return verifyForm()">
        <div class="form-group">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="new_username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="new_email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="reEnterPass">Re-enter your password:</label><br>
            <input type="password" id="reEnterPass" name="confirm_password" required>
        </div>
        <button type="submit" class="btn">Sign Up</button>
        <p>Already have an account? <a href="login_page.php">Log in here</a></p>
        <div id="signupError" class="error-message" style="display:none;"></div>
    </form>
</div>
</body>
</html>