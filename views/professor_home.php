<?php
session_start();
if ($_SESSION['username'] && $_SESSION['type'] == "professor") { ?>

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
<body class='body'>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            hi, Prof, <?php echo $_SESSION['name']; ?>

        </a>
        <a href="professor_view_courses.php" class="btn btn-custom" type="submit" name="submitLogout">View My Courses 👨🏻‍🏫</a>
        <a href="professor_questions.php" class="btn btn-custom" type="submit" name="submitLogout">Add Questions ❓</a>
        <a href="professor_manage_students.php" class="btn btn-custom" type="submit" name="submitLogout">Manage Students ⚙️</a>
        <form action="../controller/LogoutController.php" method="post" class="form-inline" style="margin:0;">
            <button class="btn btn-custom" type="submit" name="submitLogout">❌</button>
        </form>
    </nav>

    <div class="container mt-4">
        <h2>Welcome, Professor <?php echo $_SESSION['name']; ?></h2>

        <div class="alert alert-info" role="alert">
            <p>As a professor, you play a crucial role in shaping the educational experience of your students. This dashboard provides you with tools to manage your courses, add questions to assessments, and oversee your students' progress.</p>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Important Updates
            </div>
            <div class="card-body">
                <h5 class="card-title">News and Announcements</h5>
                <p class="card-text">Stay tuned for important updates and announcements related to your courses and academic activities.</p>
                <a href="#" class="btn btn-custom">Read More</a>
            </div>
        </div>

        <!-- Add more content as needed -->
    </div>

	
</body>


<?php
} else {
    header("location:../index.php");
}
?>