<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $genre = $_POST['genre'];

        $query = "UPDATE artists SET name = ?, genre = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $name, $genre, $id);
        $stmt->execute();

        header('Location: dashboard.php');
    } else {
        $query = "SELECT * FROM artists WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $artist = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Editează Artist</title>
</head>
<body>
    <h1>Editează Artist</h1>
    <form method="POST" action="">
        <label>Nume:</label><br>
        <input type="text" name="name" value="<?php echo $artist['name']; ?>" required><br>
        <label>Gen:</label><br>
        <input type="text" name="genre" value="<?php echo $artist['genre']; ?>" required><br><br>
        <button type="submit">Salvează</button>
    </form>
</body>
</html>
