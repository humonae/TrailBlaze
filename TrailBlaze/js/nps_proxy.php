#!/usr/local/bin/php

<?php

// Allow cross-origin requests
header("Access-Control-Allow-Origin: https://www.cise.ufl.edu");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Secure API key
$apiKey = '';

// Get the park code from the request
if (!isset($_GET['parkCode'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing parkCode parameter']);
    exit();
}

$parkCode = htmlspecialchars($_GET['parkCode']);

// Make the API request
$apiUrl = "https://developer.nps.gov/api/v1/parks?parkCode={$parkCode}&api_key={$apiKey}";
$response = file_get_contents($apiUrl);

if ($response === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch data from the National Parks API']);
    exit();
}

// Return the API response to the client
header('Content-Type: application/json');
echo $response;
?>
