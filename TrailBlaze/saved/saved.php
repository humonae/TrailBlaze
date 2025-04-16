#!/usr/local/bin/php
<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saved Parks</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome (icons) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-green">
    <div class="container-fluid">
      <!-- Map Icon on the left -->
      <a class="navbar-brand" href="../map/map.php"><i class="fas fa-map"></i></a>
      
      <!-- Navbar Title (centered) -->
      <a class="navbar-brand mx-auto">TrailBlaze</a>

      <!-- Logout Icon on the right -->
      <a class="navbar-brand" href="../logout.php"><i class="fas fa-sign-out-alt"></i></a>
    </div>
  </nav>

  <div class="div-saved">
  
	<?php
	require("getSaved.php");
	?>
	
  </div>

</body>
</html>