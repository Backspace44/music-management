<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $genre = $_POST['genre'];

    $query = "INSERT INTO artists (name, genre) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $name, $genre);
    $stmt->execute();

    header('Location: dashboard.php');
}
?>
