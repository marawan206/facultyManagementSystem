<?php
session_start();
if ($_SESSION['username'] && $_SESSION['type'] == "student") {
    include_once '../include/DatabaseClass.php';
    $db = new database();

    // Get the student's ID
    $studentID = $_SESSION['id'];

    // Fetch enrolled courses for the student
    $enrolledCourses = $db->display("
        SELECT c.CourseID, c.Room, c.ScheduleDay, c.ScheduleTime, s.Name as SubjectName
        FROM enrollments e
        JOIN courses c ON e.CourseID = c.CourseID
        JOIN subjects s ON c.SubjectID = s.SubjectID
        WHERE e.StudentID = $studentID
    ");

?>

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
            border-color:  #d7ba89;
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
        .card {
    margin-bottom: 20px;
    }
        .card-title {
    color: black;
    }
        .card-text {
    color: black;
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
        <h1>Enrolled Courses</h1>

        <?php
        // Display enrolled courses
        if (empty($enrolledCourses)) {
            echo "<p>No courses enrolled.</p>";
        } else {
            foreach ($enrolledCourses as $course) {
                echo "<div class='card mb-3'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>{$course['SubjectName']}</h5>";
                echo "<p class='card-text'>{$course['Room']} | {$course['ScheduleDay']} | {$course['ScheduleTime']}</p>";
                echo "</div>";
                echo "</div>";
            }
        }
        ?>

        <a href="student_home.php" class="btn btn-custom">Back to Home</a>
    </div>

</body>

<?php
} else {
    header("location:../index.php");
}
?>
