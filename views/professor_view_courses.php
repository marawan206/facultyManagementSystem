<?php
session_start();
if ($_SESSION['username'] && $_SESSION['type'] == "professor") {
    include_once '../include/DatabaseClass.php';		
    $db = new database();
    
    $professorID = $_SESSION['id']; 

    $sql = "SELECT courses.*, subjects.Name 
            FROM courses
            INNER JOIN subjects ON courses.SubjectID = subjects.SubjectID
            WHERE ProfessorID = $professorID";

    $result = $db->display($sql);

    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Courses</title>
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
    border-color:  #d7ba89;
}

.labels {
    font-weight: bold;
}


</style>
<body class="body">
    <nav class="navbar">
        <a class="navbar-brand" href="#">
            Professor - Hi, <?php echo $_SESSION['name']; ?>
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
        <?php
        if (!empty($result)) {
            echo "<table class='table table-bordered'>
                    <thead class='thead-dark'>
                        <tr>
                            <th scope='col'>Course ID</th>
                            <th scope='col'>Subject ID</th>
                            <th scope='col'>Room</th>
                            <th scope='col'>Schedule Day</th>
                            <th scope='col'>Schedule Time</th>
                            <th scope='col'>Duration Hours</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($result as $row) {
                echo "<tr>
                        <td>{$row['CourseID']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['Room']}</td>
                        <td>{$row['ScheduleDay']}</td>
                        <td>{$row['ScheduleTime']}</td>
                        <td>{$row['DurationHours']}</td>
                    </tr>";
            }

            echo "</tbody>
                </table>";
        } else {
            echo "<p class='text-danger'>No courses assigned.</p>";
        }
        ?>
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
