#!/usr/local/bin/php
<?php
session_start();
session_unset();
session_destroy();
header("Location: map/map.php");
exit;
?>