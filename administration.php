<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "vijesti";

    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, lozinka, administratorska_prava FROM korisnik WHERE korisnicko_ime = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['lozinka'])) {
            if ($row['administratorska_prava'] == 1) {
                // Login successful and user has administrative rights
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $username;
                $_SESSION['admin_rights'] = $row['administratorska_prava'];
                $stmt->close();
                $conn->close();
                header("Location: administration.php");
                exit;
            } else {
                // User does not have administrative rights
                $error_message = "Access Denied. You do not have the necessary permissions to access the administration page.";
            }
        } else {
            // Incorrect password
            $error_message = "Invalid username or password.";
        }
    } else {
        // User not found
        $error_message = "Invalid username or password.";
        echo "<a href = 'registration.php'>Register here</a>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="projekt.css">
    <style>
    body {
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    h1, h2 {
        text-align: center;
    }
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
    }
    label {
        margin-bottom: 10px;
    }
    input[type="text"],
    select {
        width: 200px;
        padding: 5px;
        margin-bottom: 10px;
    }
    input[type="submit"] {
        width: 100px;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleymoNews - Administration</title>
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
    <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) : ?>
        <h1>Administration Login</h1>
        <?php if (isset($error_message)) : ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <input type="submit" name="login" value="Log In">
        </form>
    <?php else : ?>
        <?php if ($_SESSION['admin_rights'] == 1) : ?>
            <?php
            if (isset($_POST['remove'])) {
                $articleId = $_POST['article_id'];
                $table = $_POST['table'];
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "vijesti";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "DELETE FROM $table WHERE ID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $articleId);
                if ($stmt->execute()) {
                    echo "Article successfully removed.";
                } else {
                    echo "Error removing the article: " . $conn->error;
                }
                $stmt->close();
                $conn->close();
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
                $articleId = $_POST['article_id'];
                $table = $_POST['table'];
                $newContent = $_POST['new_content'];
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "vijesti";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "UPDATE $table SET content = ? WHERE ID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $newContent, $articleId);
                if ($stmt->execute()) {
                    echo "Article content updated successfully.";
                } else {
                    echo "Error updating article content: " . $conn->error;
                }
                $stmt->close();
                $conn->close();
            }
            ?>
            <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
            <p>You are logged in as <?php echo $_SESSION['username']; ?>.</p>
            <h2>Remove Article</h2>
            <form method="POST">
                <label for="article_id">Article ID:</label>
                <input type="number" name="article_id" id="article_id" required><br>
                <label for="table">Table:</label>
                <select name="table" id="table">
                    <option value="sport">Sports</option>
                    <option value="politics">Politics</option>
                </select><br>
                <input type="submit" name="remove" value="Remove Article">
            </form>
            <h2>Update Article Content</h2>
            <form method="POST">
                <label for="article_id">Article ID:</label>
                <input type="number" name="article_id" id="article_id" required><br>
                <label for="table">Table:</label>
                <select name="table" id="table">
                    <option value="sport">Sports</option>
                    <option value="politics">Politics</option>
                </select><br>
                <label for="new_content">New Content:</label>
                <textarea name="new_content" id="new_content" rows="4" cols="50" required></textarea><br>
                <input type="submit" name="update" value="Update Article">
            </form>
        <?php else : ?>
            <p>Access Denied. You do not have the necessary permissions to access the administration page.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
