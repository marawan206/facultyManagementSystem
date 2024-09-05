<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once '../include/DatabaseClass.php';       
    $db = new database();

    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $nationalId = $_POST['nationalId'];
    $dob = $_POST['dob'];
    $department = $_POST['department'];
    $level = $_POST['level']; // Assuming this is the student's level

    // You can perform additional validation here

    // Example: Insert the new student into the database
    // Replace this with your actual database logic
    // $sql = "INSERT INTO students (fname, lname, username, password, gender, nationalId, dob, department, level) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("sssssssss", $fname, $lname, $username, $password, $gender, $nationalId, $dob, $department, $level);
    // $stmt->execute();
    // $stmt->close();
    
    // For demonstration purposes, let's assume the student was successfully added
    $success_message = "Student added successfully!";
} else {
    // If the form was not submitted via POST method, redirect back to the form page
    header("Location: ../views/admin_add_student.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Added</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add any additional styles or scripts if needed -->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if (isset($success_message)) : ?>
                    <div class="alert alert-success mt-3" role="alert">
                        <?php echo $success_message; ?>
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Error adding student. Please try again.
                    </div>
                <?php endif; ?>
                <a href="../views/admin_add_student.php" class="btn btn-primary mt-3">Back to Add Student</a>
            </div>
        </div>
    </div>
</body>
</html>
