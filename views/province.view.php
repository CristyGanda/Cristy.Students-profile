<?php
include_once("../db.php");
include_once("../province.php");

$db = new Database();
$connection = $db->getConnection();
$province = new Province($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Province Records</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <!-- Include the header -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
        <h2>Province Records</h2>
        <table class="orange-theme">
            <thead>
                <tr>
                    <th>Province Id</th>
                    <th>Province Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamically generate rows with data from the database -->
                <?php
                $results = $province->getAll(); 
                foreach ($results as $result) {
                ?>
                <tr>
                    <td><?php echo $result['id']; ?></td>
                    <td><?php echo $result['name']; ?></td>
                    <td>
                        <a href="province_edit.php?id=<?php echo $result['id']; ?>">Edit</a>
                        |
                        <a href="province_delete.php?id=<?php echo $result['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <a class="button-link" href="province_add.php">Add New Record</a>
    </div>
    
    <!-- Include the footer -->
    <?php include('../templates/footer.html'); ?>

</body>
</html>
