<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Management</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h1>Music Management System</h1>
    <h2>Artists</h2>
    
    <!-- Form pentru adăugarea unui artist -->
    <form id="addArtistForm">
        <input type="text" id="name" placeholder="Name" required>
        <input type="text" id="genre" placeholder="Genre" required>
        <input type="text" id="contact_info" placeholder="Contact Info" required>
        <button type="submit">Add Artist</button>
    </form>
    
    <h3>Artist List</h3>
    <ul id="artistList"></ul>

    <script src="js/script.js"></script>
</body>
</html>
