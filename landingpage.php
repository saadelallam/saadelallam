<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Button Navigation</title>
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

        .button-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            padding: 15px 25px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.2s;
            text-align: center;
        }

        .button:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        .button:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
<h1>Welcome! Choose an Action</h1>
<div class="button-container">
    <!-- Button 1: View Etudiant Table -->
    <a href="etudiant_table.php" class="button">View Etudiant Table</a>

    <!-- Button 2: View Etablissement Table -->
    <a href="etablissement_table.php" class="button">View Etablissement Table</a>
</div>
</body>
</html>
