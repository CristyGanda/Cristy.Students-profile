<?php
include_once("../db.php");
include_once("../student.php");
include_once("../student_details.php");

// Check if the student ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch student data by ID from the database
    $db = new Database();
    $student = new Student($db);
    $student_details = new StudentDetails($db);
    
    // Retrieve student data
    $studentData = $student->read($id);
    
    // Retrieve student details data
    $studentDetailsData = $student_details->read($id);

    // Check if the student and details data are retrieved successfully
    if (!$studentData) {
        echo "Student not found.";
        exit; // Stop further execution if student data is not found
    }

    if (!$studentDetailsData) {
        echo "Student details not found.";
        exit; // Stop further execution if student details data is not found
    }
} else {
    echo "Student ID not provided.";
    exit; // Stop further execution if ID is not provided
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'id' => $_POST['id'],
        'student_number' => $_POST['student_number'],
        'first_name' => $_POST['first_name'],
        'middle_name' => $_POST['middle_name'],
        'last_name' => $_POST['last_name'],
        'gender' => $_POST['gender'],
        'birthday' => $_POST['birthday'],
    ];

    $details_data = [
        'contact_number' => $_POST['contact_number'],
        'street' => $_POST['street'],
        'town_city' => $_POST['town_city'],
        'province' => $_POST['province'],
        'zip_code' => $_POST['zip_code'],
    ];

    // Instantiate the Database and Student classes
    $db = new Database();
    $student = new Student($db);
    $studentDetails = new StudentDetails($db);

    // Call the update method to update the student data
    if ($student->update($id, $data)) {
        echo "Student updated successfully.";
    } else {
        echo "Failed to update student record.";
    }

    // Call the update method to update the student details data
    if ($studentDetails->update($id, $details_data)) {
        echo "Student details updated successfully.";
    } else {
        echo "Failed to update student details record.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Edit Student</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
        <h2>Edit Student Information</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $studentData['id']; ?>">

            <!-- Form fields for student data -->
            <!-- ... (existing fields) ... -->

            <!-- Form fields for student details data -->
            <!-- ... (existing fields) ... -->

            <input type="submit" value="Update">
        </form>
    </div>

    <?php include('../templates/footer.html'); ?>
</body>
</html>
