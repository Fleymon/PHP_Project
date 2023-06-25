<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="projekt.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f5f5f5;
            text-align: center;
        }

        .container h1 {
            margin-top: 0;
        }

        .container form {
            margin-top: 20px;
            text-align: left;
        }

        .container form label {
            display: inline-block;
            width: 120px;
        }

        .container form input[type="text"],
        .container form input[type="password"] {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
        }

        .container form input[type="checkbox"] {
            margin-top: 5px;
        }

        .container form input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .container form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .container .footer {
            margin-top: 20px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleymoNews</title>
</head>
<body>
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
<div class="container">
    <h1>Registration</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $adminRights = isset($_POST['admin_rights']) ? 1 : 0;

        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
        } else {
            $servername = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "vijesti";

            $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO korisnik (korisnicko_ime, lozinka, administratorska_prava) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $username, $hashedPassword, $adminRights);

            if ($stmt->execute()) {
                echo "Registration successful. <a href='administration.php'>Go to administration page</a>";
            } else {
                echo "Error during registration: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
    }
    ?>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required><br>
        <label for="admin_rights">Administrative Rights:</label>
        <input type="checkbox" name="admin_rights" id="admin_rights"><br>
        <input type="submit" value="Register">
    </form>
    <footer class="footer">
        <p>&copy; FLEYMONEWS DIGITAL PROPERTY / Eamon Gaš, 2023</p>
    </footer>
</div>
</body>
</html>
