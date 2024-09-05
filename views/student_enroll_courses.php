<?php
session_start();
if ($_SESSION['username'] && $_SESSION['type'] == "student") {
    include_once '../include/DatabaseClass.php';
    $db = new database();

    $conflictMessage = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $studentID = $_SESSION['id'];
        $courseID = $_POST['course_id'];

        // Fetch the schedule details of the course the student wants to enroll in
        $newCourse = $db->display("SELECT Room, ScheduleDay, ScheduleTime FROM courses WHERE CourseID = $courseID")[0];

        // Fetch the student's current enrollments
        $currentEnrollments = $db->display("
            SELECT c.CourseID, c.ScheduleDay, c.ScheduleTime 
            FROM enrollments e 
            JOIN courses c ON e.CourseID = c.CourseID 
            WHERE e.StudentID = $studentID
        ");

        // Check for conflicts
        $conflict = false;
        foreach ($currentEnrollments as $enrollment) {
            if ($enrollment['ScheduleDay'] == $newCourse['ScheduleDay'] && $enrollment['ScheduleTime'] == $newCourse['ScheduleTime']) {
                $conflict = true;
                break;
            }
        }

        if (!$conflict) {
            // Perform enrollment
            $sql = "INSERT INTO enrollments (StudentID, CourseID) VALUES ($studentID, $courseID)";

            // Execute the query
            if ($db->insert($sql)) {
                header("Location: ../views/student_enroll_courses.php");
                exit();
            } else {
                echo "Error: Unable to enroll in the course.";
            }
        } else {
            $conflictMessage = "The course conflicts with your current schedule.";
        }
    }

    $courses = $db->display("
        SELECT c.CourseID, c.Room, c.ScheduleDay, c.ScheduleTime, s.Name as SubjectName
        FROM courses c
        JOIN subjects s ON c.SubjectID = s.SubjectID
    ");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<style>
    .body {
        background-color: #192a51;
        color: #ffffff;
        font-family: Arial, sans-serif;
    }
    .navbar {
        background-color: #212529;
    }
    .navbar-brand {
        color: #ffffff;
        font-weight: bold;
    }
    .btn-custom {
        background-color: #192a51;
        color: #ffffff;
        border: 2px solid #d7ba89;
        transition: all 0.3s ease-in-out;
    }
    .btn-custom:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .container {
        background-color: #8b9eb7;
        border-radius: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 50px;
        margin-bottom: 50px;
    }
    .form-control {
        border-radius: 5px;
        border-color: #d7ba89;
    }
    label {
        font-weight: bold;
    }
    .btn-update {
        margin-top: 20px; 
        background-color: #192a51;
        color: #ffffff;
        border: 2px solid #d7ba89;
        transition: all 0.3s ease-in-out;
    }
</style>
<body class="body">
<nav class="navbar navbar-dark">
    <a class="navbar-brand" href="#">
        Student - Welcome, <?php echo $_SESSION['name']; ?>
    </a>
    <div class="d-flex justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="btn btn-custom" href="../views/student_home.php">🏠︎</a>
            </li>
        </ul>
        <form action="../controller/LogoutController.php" method="post">
            <button class="btn btn-custom ml-2" type="submit" name="submitLogout">❌</button>
        </form>
    </div>
</nav>

<div class="container">
    <h1>Available Courses</h1>
    <?php
    // Display available courses
    foreach ($courses as $course) {
        echo "<form method='post'>";
        echo "<div class='card mb-3'>";
        echo "<div class='card-body' >";
        echo "<h5 class='card-title' style='color:black;'>{$course['SubjectName']}</h5>";
        echo "<p class='card-text'style='color:black;' >{$course['Room']} | {$course['ScheduleDay']} | {$course['ScheduleTime']}</p>";
        // Hidden input for course ID
        echo "<input type='hidden' name='course_id' value='{$course['CourseID']}'>";
        // Enroll button
        echo "<button type='submit' class='btn btn-custom'>Enroll</button>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
    }
    ?>
    <a href="student_home.php" class="btn btn-custom">Back to Home</a>
</div>

<?php
if (!empty($conflictMessage)) {
    echo "<script type='text/javascript'>alert('$conflictMessage');</script>";
}
?>

</body>
</html>

<?php
} else {
    header("location:../index.php");
}
?>
    