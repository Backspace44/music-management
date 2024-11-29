<?php
session_start();
require 'config.php'; // Conexiunea la baza de date

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action']; // Valoarea selectată: 'signin' sau 'signup'
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Criptare simplă pentru parolă

    if ($action === 'signin') {
        // Logare utilizator
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php'); // Redirecționare la dashboard
        } else {
            $error = "Nume de utilizator sau parolă incorectă!";
        }
    } elseif ($action === 'signup') {
        // Înregistrare utilizator nou
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Numele de utilizator este deja folosit!";
        } else {
            $query = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $success = "Contul a fost creat cu succes! Te poți autentifica acum.";
            } else {
                $error = "A apărut o eroare la crearea contului.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Autentificare/Înregistrare</title>
</head>
<body>
    <h1>Autentificare/Înregistrare</h1>
    <?php 
    if (isset($error)) echo "<p style='color:red;'>$error</p>"; 
    if (isset($success)) echo "<p style='color:green;'>$success</p>"; 
    ?>
    <form method="POST" action="">
        <label>Utilizator:</label><br>
        <input type="text" name="username" required><br>
        <label>Parolă:</label><br>
        <input type="password" name="password" required><br><br>
        
        <label>Alege acțiunea:</label><br>
        <input type="radio" name="action" value="signin" checked> Logare<br>
        <input type="radio" name="action" value="signup"> Înregistrare<br><br>
        
        <button type="submit">Continuă</button>
    </form>
</body>
</html>
