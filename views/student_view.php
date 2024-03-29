<?php
include_once("../db.php");
include_once("../student.php");

$db = new Database();
$connection = $db->getConnection();
$student = new Student($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
        <h2>Student Records</h2>
        <table class="orange-theme">
            <thead>
                <tr>
                    <th>Student Number</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Birthdate</th>
                    <th>Contact number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $results = $student->displayAll();
                foreach ($results as $result) {
                    $details = $student->getStudentDetails($result['id']);
                ?>
                <tr>
                    <td><?php echo $result['student_number']; ?></td>
                    <td><?php echo $result['first_name']; ?></td>
                    <td><?php echo $result['middle_name']; ?></td>
                    <td><?php echo $result['last_name']; ?></td>
                    <td><?php echo ($result['gender'] == 1) ? 'F' : 'M'; ?></td>
                    <td><?php echo date('F j, Y', strtotime($result['birthday'])); ?></td>
                    <td><?php echo $details['contact_number']; ?></td>
                    <td>
                        <a href="student_edit.php?id=<?php echo $result['id']; ?>">Edit</a>
                        |
                        <a href="student_delete.php?id=<?php echo $result['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <a class="button-link" href="student_add.php">Add New Record</a>
    </div>

    <!-- Include the footer -->
    <?php include('../templates/footer.html'); ?>
</body>
</html>
