<?php
require 'config.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login");
    exit();
}

$user_id = $_SESSION["user_id"];
$movie_id = $_POST["movie_id"];
$movie_title = $_POST["movie_title"];
$poster_url = $_POST["poster_url"];

$stmt = $conn->prepare("INSERT INTO favorite_movies (user_id, movie_id, movie_title, poster_url) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $user_id, $movie_id, $movie_title, $poster_url);

if ($stmt->execute()) {
    $_SESSION["success"] = "Movie added to favorites!";
} else {
    $_SESSION["error"] = "Failed to add movie. Please try again.";
}

header("Location: dashboard");
exit();
?>
