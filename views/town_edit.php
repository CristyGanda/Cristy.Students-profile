<?php
include_once("../db.php");
include_once("../town_city.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch town data by ID from the database
    $db = new Database();
    $town = new TownCity($db);
    $townData = $town->read($id);

    if (!$townData) {
        echo "Town city not found.";
    }
} else {
    echo "Town city ID not provided.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'name' => $_POST['name'],
    ];

    // Update the town data
    if ($town->update($id, $data)) {
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
    <title>Edit Town</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h2>Edit Town Information</h2>
    <?php if (isset($townData)): ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $townData['id']; ?>">
            <label for="name">Town City Name:</label>
            <input type="text" name="name" value="<?php echo $townData['name']; ?>">
            <input type="submit" value="Update">
        </form>
    <?php else: ?>
        <p>Town city not found.</p>
    <?php endif; ?>
    </div>
    <?php include('../templates/footer.html'); ?>
</body>
</html>
