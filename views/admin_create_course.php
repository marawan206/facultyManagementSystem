<?php 
session_start();
if($_SESSION['username'] && $_SESSION['type'] == "admin")
{?>

<?php 
	include_once '../include/DatabaseClass.php';		
	$db = new database();

    // Assuming you have functions to fetch subjects and professors from the database
    $subjects = $db->display("SELECT SubjectID, Name FROM subjects");
    $professors = $db->display("SELECT ProfessorID, Name FROM professors");

?>

<head>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
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
        }
        label {
            font-weight: bold;
        }

    </style>
</head>

<body>

<nav class="navbar  ">
        <a class="navbar-brand" href="#">
            Admin - Welcome, <?php echo $_SESSION['name']; ?>
        </a>
        <div class="d-flex justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-custom" href="../views/admin_home.php">🏠︎</a>
                </li>
            </ul>
            <form action="../controller/LogoutController.php" method="post">
                <button class="btn btn-custom ml-2" type="submit" name="submitLogout">❌</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4">Create Course</h2>
        <form action="../controller/AddCourseController.php" method="post">

            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select class="form-control" id="subject" name="subject" required>
                    <?php
                    foreach ($subjects as $subject) {
                        echo "<option value='{$subject['SubjectID']}'>{$subject['Name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="professor" class="form-label">Professor</label>
                <select class="form-control" id="professor" name="professor" required>
                    <?php
                    foreach ($professors as $professor) {
                        echo "<option value='{$professor['ProfessorID']}'>{$professor['Name']}</option>";
                    }   
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="room" class="form-label">Room</label>
                <input type="text" class="form-control" id="room" name="room" required>
            </div>

            <div class="mb-3">
                <label for="schedule_day">Day of the Week:</label>
                <input type="text" class="form-control" id="schedule_day" name="schedule_day" placeholder="e.g., Monday" required>
            </div>

            <div class="mb-3">
                <label for="schedule_time">Schedule Time:</label>
                <input type="time" class="form-control" id="schedule_time" name="schedule_time" required>
            </div>

            <button type="submit" class="btn btn-custom">Create Course</button>
        </form>
    </div>
</body>

<?php 
}
else
{
	header("location:../index.php");
}
?>