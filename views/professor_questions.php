<?php
session_start();
if ($_SESSION['username'] && $_SESSION['type'] == "professor") {

    include_once '../include/DatabaseClass.php';
    $db = new database();
    $professorID = $_SESSION['id'];
    $coursesSql = "SELECT c.CourseID, s.Name AS SubjectName FROM courses c
                   JOIN subjects s ON c.SubjectID = s.SubjectID
                   WHERE c.ProfessorID = $professorID";
    $coursesResult = $db->display($coursesSql);


    ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Professor Home</title>
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
            margin-right: 10px;
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

        .labels {
            font-weight: bold;
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
            Professor - Welcome, <?php echo $_SESSION['name']; ?>
        </a>
        <div class="d-flex justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-custom" href="../views/professor_home.php">🏠︎</a>
                </li>
            </ul>
            <form action="../controller/LogoutController.php" method="post">
                <button class="btn btn-custom ml-2" type="submit" name="submitLogout">❌</button>
            </form>
        </div>
    </nav>

        <div class="container mt-3">
            <form action="../controller/AddQuestionController.php" method="post">
                <h2>Add Question</h2>
                <div class="form-group">
                    <label for="course_select">Select Course:</label>
                    <select class="form-control" id="course_select" name="CourseID" required>
                        <?php foreach ($coursesResult as $course): ?>
                            <option value="<?php echo $course['CourseID']; ?>"><?php echo $course['SubjectName']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="question_text">Question Text:</label>
                    <textarea class="form-control" name="TextQuestion" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-custom">Add Question</button>
                <a href="professor_home.php" class="btn btn-custom">Back</a>
            </form>
        </div>

        <script src="../assets/js/jquery-3.6.0.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
    </body>

    </html>

    <?php
} else {
    header("location:../index.php");
}
?>