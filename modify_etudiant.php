<?php
// Include the database connection
require 'dbconnect.php';

try {
    // Get the student ID from the URL
    if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
        $student_id = $_GET['ID'];

        // Fetch the student's data from the 'etudiant' table
        $sql = "SELECT * FROM affietu WHERE ID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $student_id]);

        // Check if the student exists
        if ($stmt->rowCount() > 0) {
            $student = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Student not found!";
            exit;
        }
    } else {
        echo "Invalid request!";
        exit;
    }

    // Update the student's information if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $etablissement = $_POST['etablissement'];

        // Update the student's data in the database
        $update_sql = "UPDATE affietu SET nom_complet = :name, email = :email, etablissement = :etablissement WHERE ID = :id";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->execute([
            'name' => $name,
            'email' => $email,
            'etablissement' => $etablissement,
            'id' => $student_id
        ]);

        echo "Student updated successfully!";
        // Redirect to the table page
        header("Location: etudiant_table.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Etudiant</title>
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
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .go-back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .go-back-button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
<h1>Modify Etudiant</h1>
<form action="modify_etudiant.php?ID=<?php echo htmlspecialchars($student_id); ?>" method="POST">
    <input type="text" name="name" value="<?php echo htmlspecialchars($student['nom_complet']); ?>" placeholder="Name" required>
    <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" placeholder="Email" required>
    <input type="text" name="etablissement" value="<?php echo htmlspecialchars($student['etablissement']); ?>" placeholder="Etablissement" required>
    <input type="submit" value="Update">
</form>

<!-- Go Back Button -->
<a href="etudiant_table.php" class="go-back-button">Go Back</a>
</body>
</html>
