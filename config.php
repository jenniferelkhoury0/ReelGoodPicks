<?php
// TMDB API
define("TMDB_TOKEN", "YOUR_TMDB_TOKEN_HERE");

// DATABASE CONNECTION
$host = "localhost";
$user = "root";
$password = "";
$database = "movie_db";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
