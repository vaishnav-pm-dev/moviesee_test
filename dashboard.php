<?php
session_start();
require 'config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["movie_id"])) {
    $movie_title = $_POST["movie_title"];
    $movie_id = $_POST["movie_id"];
    $poster_url = $_POST["poster_url"];

    $stmt = $conn->prepare("INSERT INTO favorite_movies (user_id, movie_title, movie_id, poster_url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $movie_title, $movie_id, $poster_url);
    $stmt->execute();
}

// Fetch favorite movies
$fav_movies = $conn->query("SELECT * FROM favorite_movies WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/custom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="container">
        <header class="flex w-full justify-between items-center my-4">
            <a href="/">
                <h2>moviesee</h2>
            </a>
            <div class="flex gap-2 items-center">
                <form id="searchForm" class="flex">
                    <input type="text" id="movieTitle" placeholder="Search movies..." required class="min-w-48 border border-gray-400">
                    <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 30 30">
                            <path d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"></path>
                        </svg></button>
                </form>
                
            </div>
        </header>
        <div class="grid grid-cols-12 gap-2">
            <div class="side-bar col-span-2 h-full bg-gray-300 flex flex-col justify-between mb-2 rounded-xl">
                <ul class="flex flex-col gap-2">
                    <li class=" hover:bg-gray-200"><a href="/" class="px-4 py-2">Dashboard</a></li>
                    <li class=" hover:bg-gray-200"><a href="#" class="px-4 py-2">Favorite</a></li>
                    <li class=" hover:bg-gray-200"><a href="#" class="px-4 py-2">Settings</a></li>
                </ul>
                <a href="logout.php" class="px-4 py-2 hover:bg-gray-200">Logout</a>
            </div>
            <div class="main sm:col-span-10 col-span-12 max-h-[80vh] overflow-auto">
                <!-- Search Results -->
                <div id="movieResults" class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4"></div>
                <!--Added Favorite Movies  -->
                <h3 class="lg:text-4xl text-2xl font-semibold sticky top-0 bg-gray-300 py-2 mb-3 rounded-xl">Your Favorite Movies</h3>
                <ul class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
                    <?php while ($row = $fav_movies->fetch_assoc()) : ?>
                        <!-- Movie card -->
                        <li>
                            <div class="movie-card flex flex-col">
                            <img src="<?= $row['poster_url'] ?>" class="h-full max-h-90">
                            <p class="text-xl py-2"><?= $row['movie_title'] ?></p>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>

    <script src="js/custom.js"></script>
</body>

</html>