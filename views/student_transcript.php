<?php
session_start();
if ($_SESSION['username'] && $_SESSION['type'] == "student") {
    include_once '../include/DatabaseClass.php';
    $db = new database();

    // Get the student's ID
    $studentID = $_SESSION['id'];


    $sql = "SELECT c.Room, c.ScheduleDay, c.ScheduleTime, s.Name AS SubjectName, a.Grade
    FROM enrollments e
    JOIN courses c ON e.CourseID = c.CourseID
    JOIN subjects s ON c.SubjectID = s.SubjectID
    LEFT JOIN questions q ON e.CourseID = q.CourseID
    LEFT JOIN answers a ON q.QuestionID = a.QuestionID AND e.StudentID = a.StudentID";

    $transcriptInfo = $db->display($sql);

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
        

    </style>

<body class="body">
<nav class="navbar">
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

    <div class="container mt-5">
        <h1>Student Transcript</h1>

        <?php
        // Display transcript information
        if (!empty($transcriptInfo)) {
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>Subject Name</th>";
            echo "<th scope='col'>Room</th>";
            echo "<th scope='col'>Schedule Day</th>";
            echo "<th scope='col'>Schedule Time</th>";
            echo "<th scope='col'>Grade</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            foreach ($transcriptInfo as $row) {
                echo "<tr>";
                echo "<td>{$row['SubjectName']}</td>";
                echo "<td>{$row['Room']}</td>";
                echo "<td>{$row['ScheduleDay']}</td>";
                echo "<td>{$row['ScheduleTime']}</td>";
                echo isset($row['Grade']) ? "<td>{$row['Grade']}</td>" : "<td>No Grade</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No transcript information found for the student.</p>";
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