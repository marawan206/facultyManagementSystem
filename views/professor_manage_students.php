<?php
session_start();
if ($_SESSION['username'] && $_SESSION['type'] == "professor") { 

    include_once '../include/DatabaseClass.php';
    $db = new database();

    $sql = "SELECT a.*, q.TextQuestion, s.Name AS StudentName
            FROM answers a
            LEFT JOIN questions q ON a.QuestionID = q.QuestionID
            LEFT JOIN students s ON a.StudentID = s.StudentID";

    $result = $db->display($sql);
    $numrows = $db->check($sql);

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
<body class ="body">
<nav class="navbar">
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
    <div class="container mt-5">
        <?php
        if (!$numrows) {
            echo '<p class="mt-3">No results found.</p>';
        } else {
            foreach ($result as $row) {
        ?>
		<form action="../controller/AddGradesController.php" method="post" class="mt-3">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Text Question: <?php echo $row['TextQuestion']; ?></h5>
                    <p class="card-text">Student Name: <?php echo $row['StudentName']; ?></p>
                    <p class="card-text">Text Answer: <?php echo $row['FileURL']; ?></p>
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="text" class="form-control" name="Grade" id="grade" value="<?php echo $row['Grade']; ?>">
                    </div>
                    <input type="hidden" name="AnswerID" value="<?php echo $row['AnswerID']; ?>">
                    <button type="submit" class="btn btn-custom">Add Grades</button>
                </div>
            </div>
		</form>
        <?php
            }
        }
        $db->conn->close();
        ?>
    </div>
    
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

	
</body>


<?php
} else {
    header("location:../index.php");
}
?>