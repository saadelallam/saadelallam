<?php
// Include the database connection
require 'dbconnect.php';

try {
    // Fetch all students from the 'etudiant' table
    $sql = "SELECT * FROM affietu";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch all rows as an associative array
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etudiant Table</title>
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

        table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
            text-align: left;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .button-container {
            margin-top: 20px;
            text-align: center;
        }

        .button-container a {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.2s;
        }

        .button-container a:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        .button-container a:active {
            transform: translateY(0);
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
<h1>Etudiant Table</h1>

<!-- Table displaying students -->
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Etablissement</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($students)): ?>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student['ID']) ?></td>
                <td><?= htmlspecialchars($student['nom_complet']) ?></td>
                <td><?= htmlspecialchars($student['email']) ?></td>
                <td><?= htmlspecialchars($student['etablissement']) ?></td>
                <td>
                    <a href="modify_etudiant.php?ID=<?= htmlspecialchars($student['ID']) ?>">Modify</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No students found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<!-- Add New Etudiant Button -->
<div class="button-container">
    <a href="add_etudiant.php">Add New Etudiant</a>
</div>

<!-- Go Back Button -->
<div class="button-container">
    <a href="landingpage.php" class="go-back-button">Go Back</a>
</div>

</body>
</html>
