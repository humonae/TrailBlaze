#!/usr/local/bin/php
<?php

session_start();

if (isset($_GET['action'])) {
    $servername = "";
	$username = "";
	$password = "";
	$dbname = "";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'error' => 'Database connection failed']));
    }

    if ($_GET['action'] === 'getReviews' && isset($_GET['parkCode'])) {
      $parkCode = htmlspecialchars($_GET['parkCode']);
      $sql = "SELECT user_id AS username, review, created_at 
              FROM reviews 
              WHERE park_code = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $parkCode);
      $stmt->execute();
      $result = $stmt->get_result();
  
      $reviews = [];
      while ($row = $result->fetch_assoc()) {
          $reviews[] = $row;
      }
  
      echo json_encode(['success' => true, 'reviews' => $reviews]);
      exit();
    }

    if ($_GET['action'] === 'addReview') {
        if (!isset($_SESSION['username'])) {
          echo json_encode(['success' => false, 'error' => 'Username not found in session']);
          exit();
        } 
        // Get the JSON payload
        $input = json_decode(file_get_contents('php://input'), true);
    
        $parkCode = htmlspecialchars($input['parkCode']);
        $review = htmlspecialchars($input['review']);
        $username = $_SESSION['username']; // Assuming the username is stored in the session
        $createdAt = date('Y-m-d'); // Current timestamp
    
        // Insert the review with the username
        $sql = "INSERT INTO reviews (user_id, park_code, review, created_at) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $parkCode, $review, $createdAt);
    
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        exit();
      }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TrailBlaze</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome (icons) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
  <!-- Map JS -->
  <script src="../js/map.js" defer></script>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-green">
    <div class="container-fluid">
      <!-- Bookmark Icon on the left -->
	  <?php if (isset($_SESSION['user_id'])): ?>
        <a class="navbar-brand" href="../saved/saved.php"><i class="fas fa-bookmark"></i></a>
      <?php else: ?>
        <a></a>
      <?php endif; ?>
      
      <!-- Navbar Title (centered) -->
      <a class="navbar-brand mx-auto">TrailBlaze</a>

      <!-- Login Icon on the right -->
	  <?php if (isset($_SESSION['user_id'])): ?>
        <a class="navbar-brand" href="../logout.php"><i class="fas fa-sign-out-alt"></i></a>
      <?php else: ?>
        <a class="navbar-brand" href="../login/login_page.php"><i class="fas fa-sign-in-alt"></i></a>
      <?php endif; ?>
    </div>
  </nav>

  <div id="map-window" class="div-map">
  <!-- Map container -->
  <div id="map"></div>
  </div>
  
  <div id="details-window" style="display:none; position:relative; background-color:#f9f9f9; padding:20px; border-left:1px solid #ccc; overflow-y:auto; z-index:1000;">
    <button onclick="closeDetails()" style="position:absolute;top:15px;right:10px;">Close</button>
    <div id="details-content"></div> <!-- Shared container for Info and Reviews -->
  </div>

  <!-- Bootstrap JS and Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <!-- Park Info Window -->
  <div id="info-window" style="position:relative;">
	<?php if (isset($_SESSION['user_id'])): ?>
	  <form action="save.php" method="POST">
        <input type="hidden" id="bookmarker" name="park_code" value="code"> 
        <button type="submit">
          <i class="fa fa-bookmark-o fa-2x"></i>
        </button>
      </form>
    <?php else: ?>
      <a><input type="hidden" id="bookmarker" name="park_code"></a>
    <?php endif; ?>
  	<button onclick="closeInfo()" style="position:absolute;top:15px;right:10px;">Close</button>
    <h2 id="info-name" style="margin-right:40px;"></h2>
	<p id="info-content"></p>
	<h3>Directions</h3>
	<p id="info-directions"></p>
	<h3>Availability</h3>
	<p id="info-availability"></p>
  <a id="link" href=""><u>Learn more</u></a>
  </div>

  <!-- Initialize map -->
  <script>
    var map = L.map('map').setView([27.95, -83.12], 7); // Initialize map with coordinates

    // Add tile layer from OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add markers to the map
    L.marker([25.97, -81.08]).addTo(map)
      .bindPopup('<b>Big Cyrpress National Preserve</b><br>Park Code: BICY<br><button onclick="openInfo(\'BICY\')">Info</button> <button onclick="openReviews(\'BICY\')">Reviews</button>');
    L.marker([25.49, -80.21]).addTo(map)
      .bindPopup('<b>Biscayne National Park</b><br>Park Code: BISC<br><button onclick="openInfo(\'BISC\')">Info</button> <button onclick="openReviews(\'BISC\')">Reviews</button>');
    L.marker([28.79, -80.75]).addTo(map)
      .bindPopup('<b>Canaveral National Seashore</b><br>Park Code: CANA<br><button onclick="openInfo(\'CANA\')">Info</button> <button onclick="openReviews(\'CANA\')">Reviews</button>');
    L.marker([29.90, -81.31]).addTo(map)
      .bindPopup('<b>Castillo de San Marcos National Monument</b><br>Park Code: CASA<br><button onclick="openInfo(\'CASA\')">Info</button> <button onclick="openReviews(\'CASA\')">Reviews</button>');
    L.marker([27.52, -82.64]).addTo(map)
      .bindPopup('<b>De Soto National Memorial</b><br>Park Code: DESO<br><button onclick="openInfo(\'DESO\')">Info</button> <button onclick="openReviews(\'DESO\')">Reviews</button>');
    L.marker([24.63, -82.87]).addTo(map)
      .bindPopup('<b>Dry Tortugas National Park</b><br>Park Code: DRTO<br><button onclick="openInfo(\'DRTO\')">Info</button> <button onclick="openReviews(\'DRTO\')">Reviews</button>');
    L.marker([25.37, -80.88]).addTo(map)
      .bindPopup('<b>Everglades National Park</b><br>Park Code: EVER<br><button onclick="openInfo(\'EVER\')">Info</button> <button onclick="openReviews(\'EVER\')">Reviews</button>');
    L.marker([29.71, -81.24]).addTo(map)
      .bindPopup('<b>Fort Matanzas National Monument</b><br>Park Code: FOMA<br><button onclick="openInfo(\'FOMA\')">Info</button> <button onclick="openReviews(\'FOMA\')">Reviews</button>');
    L.marker([30.32, -87.23]).addTo(map)
      .bindPopup('<b>Gulf Islands National Seashore</b><br>Park Code: GUIS<br><button onclick="openInfo(\'GUIS\')">Info</button> <button onclick="openReviews(\'GUIS\')">Reviews</button>');
    L.marker([30.47, -81.50]).addTo(map)
      .bindPopup('<b>Timucuan Ecological & Historic Preserve</b><br>Park Code: TIMU<br><button onclick="openInfo(\'TIMU\')">Info</button> <button onclick="openReviews(\'TIMU\')">Reviews</button>');
  </script>


</body>
</html>
