<?php
include_once("../db.php"); // Include the Database class file
include_once("../province.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $name = htmlspecialchars($_POST['name']);
    
    // Check if name is not empty
    if (!empty($name)) {
        $data = [
            'name' => $name,
        ];

        // Instantiate the Database and Province classes
        $database = new Database();
        $province = new Province($database);

        // Attempt to create a new record
        if ($province->create($data)) {
            echo "Record inserted successfully.";
        } else {
            echo "Failed to insert the record.";
        }
    } else {
        echo "Province name cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Add Province</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
        <h1>Add Province</h1>
        <form action="" method="post" class="centered-form">
            <label for="name">Province name:</label>
            <input type="text" name="name" id="name" required>
            <input type="submit" value="Add Province">
        </form>
    </div>
    
    <?php include('../templates/footer.html'); ?>
</body>
</html>
