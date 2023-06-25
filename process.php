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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_POST['kategorija'])) {
    $category = trim($_POST['kategorija']);
    $title = $_POST['naslov'];
    $description = $_POST['sazetak'];
    $text = $_POST['tekst'];
    $check = isset($_POST['obavijest']) ? 1 : 0;
    if (isset($_FILES['slika']) && $_FILES['slika']['error'] === UPLOAD_ERR_OK) {
      $image = $_FILES['slika']['name'];
      $tmpimgname = $_FILES['slika']['tmp_name'];
      $folder = 'upload/';
      if (move_uploaded_file($tmpimgname, $folder . $image)) {
        $imgData = file_get_contents($folder . $image);
        if ($category === 'sport') {
          $stmt = $conn->prepare("INSERT INTO sport (title, description, content, image, checkbox, category) VALUES (?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("ssssis", $title, $description, $text, $imgData, $check, $category);
          $stmt->execute();
          $stmt->close();
          header('Location: sports.php?image=' . $image . '&title=' . urlencode($title) . '&description=' . urlencode($description) . '&text=' . urlencode($text));
          exit();
        } elseif ($category === 'politika') {
          $stmt = $conn->prepare("INSERT INTO politics (title, description, content, image, checkbox, category) VALUES (?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("ssssis", $title, $description, $text, $imgData, $check, $category);
          $stmt->execute();
          $stmt->close();
          header('Location: politics.php?image=' . $image . '&title=' . urlencode($title) . '&description=' . urlencode($description) . '&text=' . urlencode($text));
          exit();
        }
      } else {
        echo 'Pogreška pri spremanju slike.';
      }
    } else {
      echo 'Molimo odaberite sliku.';
    }
  } else {
    echo 'Molimo odaberite kategoriju i označite obavijest.';
  }
}
?>
<footer class="footer">
   <p>&copy; FLEYMONEWS DIGITAL PROPERTY / Eamon Gaš, 2023</p>
 </footer>
 </div>
</body>
</html>
