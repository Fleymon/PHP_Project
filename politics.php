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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vijesti";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM politics WHERE checkbox = 0";
$result = $conn->query($sql);
$politicsArticles = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<div id="page-container">
  <div class="articles">
    <div class="category">
      <h2>POLITICS</h2>
    </div>
    <?php foreach ($politicsArticles as $article) { ?>
      <div class="content">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($article['image']); ?>" alt="Article Image" class="img1">
        <article class="frame">
          <h1><a href="clanak.php?id=<?php echo $article['ID']; ?>"><?php echo $article['title']; ?></a></h1>
          <p><?php echo $article['description']; ?></p>
        </article>
      </div>
    <?php } ?>
  </div>
  <footer class="footer">
    <p>&copy; FLEYMONEWS DIGITAL PROPERTY / Eamon Gaš, 2023</p>
  </footer>
</div>
</body>
</html>
