<?php
header("Content-Type: application/json");
require_once "config.php";

$type = $_GET["type"] ?? "trending";
$query = $_GET["query"] ?? "";

$baseUrl = "https://api.themoviedb.org/3";

switch ($type) {
    case "search":
        $endpoint = "/search/movie?query=" . urlencode($query);
        break;

    case "top_rated":
        $endpoint = "/movie/top_rated";
        break;

    case "popular":
        $endpoint = "/movie/popular";
        break;

    default:
        $endpoint = "/trending/movie/week";
}

$url = $baseUrl . $endpoint;

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer " . TMDB_TOKEN,
        "Content-Type: application/json"
    ]
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

http_response_code($httpCode);
echo $response;
?>
