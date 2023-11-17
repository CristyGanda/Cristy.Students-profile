<?php
include_once("../db.php");
include_once("../province.php");

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch province data by ID from the database
    $db = new Database();
    $province = new Province($db);
    $provinceData = $province->read($id);

    // Check if the province data is retrieved successfully
    if (!$provinceData) {
        echo "Province is not found.";
        exit; // Stop further execution to avoid processing the form with invalid data
    }
} else {
    echo "Province ID is not provided.";
    exit; // Stop further execution if ID is not provided
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'name' => $_POST['name'],
    ];

    // Call the update method to update the province data
    if ($province->update($id, $data)) {
        echo "Record updated successfully.";
    } else {
        echo "Failed to update the record.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Edit Province</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
        <h2>Edit Province Information</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $provinceData['id']; ?>">
            
            <label for="name">Province Name:</label>
            <input type="text" name="name" value="<?php echo $provinceData['name']; ?>">
            
            <input type="submit" value="Update">
        </form>
    </div>
    <?php include('../templates/footer.html'); ?>
</body>
</html>
