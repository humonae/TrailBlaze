<?php

session_start();

$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Handle deletion request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_park'])) {
    $park_to_delete = $_POST['park_code'];

    $delete_sql = "DELETE FROM saved WHERE user_id = ? AND park_code = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("is", $user_id, $park_to_delete);
    $delete_stmt->execute();
    $delete_stmt->close();
}

// Fetch saved parks
$sql = "SELECT park_code FROM saved WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Output each park
while ($row = $result->fetch_assoc()) {
    $parkCode = htmlspecialchars($row['park_code']);

    echo <<<HTML
    <form method="POST" style="margin-bottom: 1em;">
        <input type="hidden" name="park_code" value="{$parkCode}">
        <input type="hidden" name="delete_park" value="1">
        <div class="div-box d-flex align-items-center">
            <a class="navbar-brand" href="#">
                <i class="fas fa-image fa-10x"></i> 
            </a>
            <span class="ms-3">
                <h1>{$parkCode}</h1>
                <p>Description</p>
                <button type="submit">Delete</button>
            </span>
        </div>
    </form>
HTML;
}

$stmt->close();
$conn->close();
?>