<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
require 'config.php';

// Preluare artiști
$query = "SELECT * FROM artists";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bun venit, <?php echo $_SESSION['username']; ?>!</h1>
    <a href="logout.php">Deconectare</a>

    <h2>Lista Artiștilor</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nume</th>
            <th>Gen</th>
            <th>Acțiuni</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['genre']; ?></td>
            <td>
                <a href="edit_artist.php?id=<?php echo $row['id']; ?>">Editează</a> |
                <a href="delete_artist.php?id=<?php echo $row['id']; ?>">Șterge</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <h3>Adaugă Artist</h3>
    <form action="add_artist.php" method="POST">
        <label>Nume:</label><br>
        <input type="text" name="name" required><br>
        <label>Gen:</label><br>
        <input type="text" name="genre" required><br><br>
        <button type="submit">Adaugă</button>
    </form>
</body>
</html>
