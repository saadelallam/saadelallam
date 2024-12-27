<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        h1 {
            color: #4CAF50;
            margin-bottom: 40px;
        }

        form {
            background-color: #ffffff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease-in-out, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        input[type="submit"]:active {
            transform: translateY(0);
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            form {
                padding: 20px;
                margin: 0 15px;
            }

            input[type="text"],
            input[type="password"],
            input[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<h1>LOGIN</h1>
<form action="loginpage.php" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="LOGIN">
</form>

<?php
require 'dbconnect.php'; // Include the PDO database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize inputs
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        // Check credentials in the database
        $stmt = $conn->prepare("SELECT * FROM login WHERE username = :username AND passcode = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Fetch user information
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $row['log_id'];
            $_SESSION['username'] = $username;
            $_SESSION['authorization'] = true;

            // Redirect to the landing page
            header("Location: landingpage.php");
            exit;
        } else {
            // Show error for incorrect credentials
            echo "<div class='error'>Username/Password is incorrect</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='error'>Database error: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}
?>
</body>
</html>
