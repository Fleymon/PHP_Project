<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="projekt.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleymoNews</title>
</head>
<nav class="navbar">
    <div><a href="projekt.php" class="logo">FleymoNews</a></div>
    <ul class="nav-links">
        <div class="menu">
            <li><a href="projekt.php">Home</a></li>
            <li><a href="sports.php">Sport</a></li>
            <li><a href="politics.php">Politics</a></li>
            <li><a href="writenews.html">Write FleymoNews</a></li>
            <li><a href="administration.php">Administration</a></li>
            <li><a href="registration.php">Register</a></li>
            <li><a href="logout.php">Logout</a></li>
        </div>
    </ul>
</nav>
<body>

<?php
session_start();

// Odjava korisnika
$_SESSION = array();

session_destroy();

// Redirekcija na početnu stranicu ili neku drugu stranicu
header("Location: projekt.php");
exit;
?>
<footer class="footer">
   <p>&copy; FLEYMONEWS DIGITAL PROPERTY / Eamon Gaš, 2023</p>
 </footer>
 </div>
</body>
</html>
