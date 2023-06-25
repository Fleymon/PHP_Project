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
$sql = "SELECT * FROM sport WHERE checkbox = 0";
$result = $conn->query($sql);
$sportArticles = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM politics WHERE checkbox = 0";
$result = $conn->query($sql);
$politicsArticles = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>
<div id="page-container">
  <div class = "articles">
    <div class="category">
    <h2>SPORTS</h2>
  </div>
    <div class="content">
      <img src="nikola1.jpg" alt="Nikola Jokić" class="img1">
      <article class = "frame">
      <h1>Nikola Jokić and the Denver Nuggets</h1>
        <p> The Denver Nuggets are 2023 NBA champions after a thrilling and hard-fought 94-89 win over the Miami Heat in Game 5 of the 2023 NBA Finals. It is the first championship for the Nuggets since joining the NBA as part of the NBA/ABA merger in 1976. Larry O’Brien served as NBA Commissioner when the Nuggets joined the NBA and now 47 years later, the Nuggets hoisted the Larry O’Brien Trophy for the first time as league champions.
        </p>
      </article>
    </div>
    <div class="content">
      <img src="liga.avif" alt="Nation's League" class="img1">
      <article class = "frame">
      <h1>Nation's League finals</h1>
        <p>
          Croatia reached their maiden Nations League final thanks to a thrilling 4-2 victory after extra time against hosts Netherlands on Wednesday, and they return to Rotterdam here aiming to secure the first victory in their history at a final tournament. Spain, meanwhile, left it late but beat Italy 2-1 thanks to an 88th-minute Joselu winner, and will hope to go one better than in 2021, when they lost 2-1 to France in the final.
          These two nations have certainly been involved in some entertaining contests over the years. Their first competitive meeting came at UEFA EURO 2012, with Spain winning the Group C game 1-0 thanks to a late Jesús Navas goal. Croatia got revenge four years later at EURO 2016 by triumphing 2-1 in Group D.
If history is anything to go by, goals should be guaranteed in this final.
        </p>
      </article>
    </div>
    <?php foreach ($sportArticles as $article) { ?>
    <div class="content">
      <img src="data:image/jpeg;base64,<?php echo base64_encode($article['image']); ?>" alt="Article Image" class = "img1">
        <article class = "frame">
        <h1><a href="clanak.php?id=<?php echo $article['ID']; ?>"><?php echo $article['title']; ?></a></h1>
        <p><?php echo $article['description']; ?></p>
              </article>
    </div>
<?php } ?>
    <div class="category">
      <h2>POLITICS</h2>
    </div>
    <div class="content">
      <img src="putin.jpg" alt="Vladimir Putin" class="img1">
      <article class = "frame">
      <h1>Russia VS Ukraine: Putin confirms nuclear weapons in Belarus</h1>
        <p>
          Russian President Vladimir Putin has confirmed that Russia has sent nuclear arms to its ally Belarus which borders Ukraine. In an angry speech, Putin has called Ukrainian leader Volodymyr Zelenskyy a “disgrace” to the Jewish people and says Kyiv has no chance of winning the war. Explosions were heard in Kyiv and air raid sirens blared as a delegation of African leaders are on a peace mission, hoping to mediate between Ukraine and Russia. It is “highly likely” that explosives    planted.   President Vladimir Putin has proclaimed the end of “neo-colonialism” in international politics and praised Russia’s economic strategy following its ruptured ties with the West.
        </p>
      </article>
    </div>
    <div class="content">
      <img src="trump.jpg" alt="Vladimir Putin" class="img1">
      <article class = "frame">
      <h1>Former Trump Defense secretary brands him a security threat</h1>
        <p>
          Painting him as a security risk, former Defense Secretary Mark Esper on Sunday added his voice to those critical of former President Donald Trump for his handling of classified information after his presidency.

Esper, who served in Trump’s Cabinet, said: “People have described him as a hoarder when it comes to these type of documents. But clearly, it was unauthorized, illegal and dangerous.”

Speaking on CNN’s “State of the Union,” Esper compared Trump’s legal case — he was recently indicted on 37 charges related to his post-presidency handling of secret documents — to that of Jack Teixeira, a Massachusetts Air National Guard member accused of posting secret and sensitive military documents on social media. Teixeira was indicted Thursday.
        </p>
      </article>
    </div>
    <?php foreach ($politicsArticles as $article) { ?>
    <div class="content">
      <img src="data:image1/jpeg;base64,<?php echo base64_encode($article['image']); ?>" alt="Article Image" class = "img1">
            <article class = "frame">
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
