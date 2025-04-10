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
    $login_username = sanitize_input($_POST["username"]);
    $login_password = sanitize_input($_POST["password"]);

    $valid = true;
    $error = "";

    if (empty($login_username) || empty($login_password)) {
        $error = "Please enter both username/email and password.";
        $valid = false;
    }

    if ($valid) {
        try {
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("SELECT id, username, password FROM accounts WHERE username = ? OR email = ?");
            $stmt->bind_param("ss", $login_username, $login_username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $hashed_password_from_db = $row["password"];

                if (password_verify($login_password, $hashed_password_from_db)) {
                    $_SESSION['user_id'] = $row["id"];
                    $_SESSION['username'] = $row["username"];
                    header("Location: home.html");
                    exit();
                } else {
                    $error = "Incorrect password.";
                }
            } else {
                $error = "Invalid username or email.";
            }

            $stmt->close();
            $conn->close();

        } catch (Exception $e) {
            $error = "An error occurred: " . $e->getMessage();
        }
    }

    if ($error) {
        $_SESSION['login_error'] = $error;
        header("Location: login_page.php");
        exit();
    }
} else {
    header("Location: login_page.php");
    exit();
}
?>