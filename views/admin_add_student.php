<?php
session_start();
if ($_SESSION['username'] && $_SESSION['type'] == "admin") {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #192a51;
            color: #ffffff;
            padding-top: 20px;
        }
        .navbar {
            background-color: #212529;
            margin-bottom: 20px;
            margin-top: -20px;
        }
        .navbar-brand {
            color: #ffffff;
            font-weight: bold;
        }
        .btn-custom {
            margin-right: 10px;
            background-color: #192a51;
            color: #ffffff;
            border: 2px solid #d7ba89;
            transition: all 0.3s ease-in-out;
        }
        .container {
            background-color: #8b9eb7;
            border-radius: 20px;
            padding: 20px;
        }
        .labels {
            color: #000000;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark">
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
                <button class="btn btn-custom" type="submit" name="submitLogout">❌</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3 py-5">
                    <h4 class="text-center mb-4">Add New Student</h4>
                    <form action="../controller/AddStudentController.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labels">First Name</label>
                                <input type="text" name="fname" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Last Name</label>
                                <input type="text" name="lname" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Male" id="male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Female" id="female" required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">National ID</label>
                                <input type="text" name="nationalId" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Department</label>
                                <input type="text" name="department" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Level</label>
                                <select class="form-control" name="level" required>
                                    <option value="lv1">Level 1</option>
                                    <option value="lv2">Level 2</option>
                                    <option value="lv3">Level 3</option>
                                    <option value="lv4">Level 4</option>
                                </select>
                            </div>
                            <!-- Add additional fields here if needed -->
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-custom">Add Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
} else {
    header("location:../index.php");
}
?>
