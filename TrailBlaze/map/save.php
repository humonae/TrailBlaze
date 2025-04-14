#!/usr/local/bin/php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $park_code = $_POST['park_code'];

    // Insert the bookmark if it doesn't already exist
    $stmt = $conn->prepare("INSERT IGNORE INTO saved (user_id, park_code) VALUES (?, ?)");
	$stmt->bind_param("is", $user_id, $park_code);
    $stmt->execute();
	

    header("Location: map.php");
} 

$conn->close();

?>