<?php
if (isset($_GET['title'])) {
    $title = urlencode($_GET['title']);
    $apiKey = "8767ca43"; // Replace with your OMDB API key
    $apiUrl = "https://www.omdbapi.com/?s=$title&apikey=$apiKey";

    $response = file_get_contents($apiUrl);
    echo $response;
} else {
    echo json_encode(["Response" => "False", "Error" => "No title provided"]);
}
?>
