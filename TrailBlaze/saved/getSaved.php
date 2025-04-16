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

// Collect park codes
$parkCodes = [];
while ($row = $result->fetch_assoc()) {
    $parkCodes[] = htmlspecialchars($row['park_code']);
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Parks</title>
    <script src="../js/NPS.js"></script> <!-- Include NPS.js -->
</head>
<body>
    <h1>Your Saved Parks</h1>
    <div id="parksContainer">
        <?php foreach ($parkCodes as $parkCode): ?>
            <form method="POST" class="park-form" data-park-code="<?= $parkCode ?>" data-saved="true">
                <input type="hidden" name="park_code" value="<?= $parkCode ?>">
                <input type="hidden" name="delete_park" value="1">
                <div class="div-box d-flex align-items-center">
                    <a class="navbar-brand" href="#">
                        <!-- Add a class to indicate saved status -->
                        <i class="fas fa-bookmark save-icon saved" data-park-code="<?= $parkCode ?>"></i>
                    </a>
                    <span class="ms-3">
                        <h1><?= $parkCode ?></h1>
                        <p>Loading description...</p> <!-- Placeholder for description -->
                        <button type="submit">Delete</button>
                    </span>
                </div>
            </form>
        <?php endforeach; ?>
    </div>

    <script>
        // Fetch park details using NPS.js
        async function fetchAndDisplayParks() {
            const parkForms = document.querySelectorAll('.park-form');
            for (const form of parkForms) {
                const parkCode = form.dataset.parkCode;
                const parkData = await fetchParkInfo(parkCode); // Use fetchParkInfo from NPS.js
                if (parkData) {
                    const imageElement = form.querySelector('.navbar-brand i');
                    const titleElement = form.querySelector('h1');
                    const descriptionElement = form.querySelector('p');

                    // Update the image, title, and description
                    imageElement.outerHTML = `<img src="${parkData.images[0]?.url || 'default-image.jpg'}" alt="${parkData.fullName}" style="width: 150px; height: auto;">`;
                    titleElement.textContent = parkData.fullName;
                    descriptionElement.textContent = parkData.description || 'No description available.';
                } else {
                    console.error(`Failed to fetch data for park code: ${parkCode}`);
                }
            }
        }

        // Call the function to fetch and display parks
        fetchAndDisplayParks();
    </script>
</body>
</html>
