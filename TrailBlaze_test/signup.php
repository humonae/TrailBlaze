#!/usr/local/bin/php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// this the test database
$servername = "localhost";
$username = "user_name";
$password = "user_password";
$dbname = "TrailBlaze_test";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = sanitize_input($_POST["new_username"]);
    $new_email = sanitize_input($_POST["new_email"]);
    $new_password = sanitize_input($_POST["new_password"]);
    $confirm_password = sanitize_input($_POST["confirm_password"]);

    $valid = true;
    $errors = [];

    if (empty($new_username)) {
        $errors[] = "Username is required.";
        $valid = false;
    }
    if (empty($new_email)) {
        $errors[] = "Email is required.";
        $valid = false;
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
        $valid = false;
    }
    if (empty($new_password)) {
        $errors[] = "Password is required.";
        $valid = false;
    }
    if ($new_password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
        $valid = false;
    } elseif (strlen($new_password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
        $valid = false;
    }
    if (!preg_match('/[A-Z]/', $new_password)) {
        $errors[] = "Password must contain at least one uppercase letter.";
        $valid = false;
    }
    if (!preg_match('/[^a-zA-Z0-9\s]/', $new_password)) {
        $errors[] = "Password must contain at least one symbol (e.g., !@#$%^&*).";
        $valid = false;
    }

    if ($valid) {
        try {
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $check_stmt = $conn->prepare("SELECT id FROM accounts WHERE username = ? OR email = ?");
            $check_stmt->bind_param("ss", $new_username, $new_email);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                $errors[] = "Username or email already exists.";
                $valid = false;
            }

            $check_stmt->close();

            if ($valid) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                //$national_parks = NULL;

                // $insert_stmt = $conn->prepare("INSERT INTO accounts (username, password, email, national_parks) VALUES (?, ?, ?, ?)");
                // $insert_stmt->bind_param("ssss", $new_username, $hashed_password, $new_email);

                $insert_stmt = $conn->prepare("INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)");
                $insert_stmt->bind_param("sss", $new_username, $hashed_password, $new_email);

                if ($insert_stmt->execute()) {
                    $_SESSION['registration_success'] = "Your account has been created. You can now log in.";
                    header("Location: login_page.php");
                    exit();
                } else {
                    $errors[] = "Error creating account: " . $conn->error;
                }

                $insert_stmt->close();
            }

            $conn->close();

        } catch (Exception $e) {
            $errors[] = "An error occurred: " . $e->getMessage();
            $valid = false;
        }
    }

    if (!$valid) {
        $_SESSION['signup_errors'] = $errors;
        header("Location: signup_page.php");
        exit();
    }
} else {
    header("Location: signup_page.php");
    exit();
}
?>