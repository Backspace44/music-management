<?php
header("Content-Type: application/json");
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT * FROM artists");
    $artists = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($artists);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $genre = $data['genre'];
    $contact_info = $data['contact_info'];

    $stmt = $pdo->prepare("INSERT INTO artists (name, genre, contact_info) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $genre, $contact_info])) {
        echo json_encode(["status" => "success", "message" => "Artist added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add artist"]);
    }
}
?>
