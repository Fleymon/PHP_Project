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
<body class="clanak-page">
  <?php
  if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vijesti";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM sport WHERE ID = $articleId";
    $result = $conn->query($sql);
    $article = $result->fetch_assoc();
    if (!$article) {
      $sql = "SELECT * FROM politics WHERE ID = $articleId";
      $result = $conn->query($sql);
      $article = $result->fetch_assoc();
    }
    $conn->close();
    if ($article) {
      ?>
      <div class="content">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($article['image']); ?>" alt="Article Image" class="img1">
        <article class="frame">
          <h1><?php echo $article['title']; ?></h1>
          <hr>
          <p><?php echo $article['description']; ?></p>
          <hr>
          <p><?php echo $article['content']; ?></p>
        </article>
      </div>
      <?php
    } else {
      echo "Article not found.";
    }
  } else {
    echo "Invalid article ID.";
  }
  ?>
  <footer class="footer">
     <p>&copy; FLEYMONEWS DIGITAL PROPERTY / Eamon Gaš, 2023</p>
   </footer>
   </div>
  </body>
  </html>
