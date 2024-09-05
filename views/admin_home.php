<?php
session_start();
if ($_SESSION['username'] && $_SESSION['type'] == "admin") { ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
    <nav class="navbar">
        <a class="navbar-brand" href="#">
            Admin - Welcome, <?php echo $_SESSION['name']; ?>
        </a>
        <a href="../views/admin_view_professors.php" class="btn btn-custom">View Professors 👨‍🏫</a>
        <a href="../views/admin_view_students.php" class="btn btn-custom">View Students 👨🏻‍🎓</a>
        <a href="../views/admin_add_student.php" class="btn btn-custom">Add Student 🎓</a>
        <a href="../views/admin_add_subject.php" class="btn btn-custom">Add Subject 📚</a>
        <a href="../views/admin_create_course.php" class="btn btn-custom">Create Course🎓 🙋‍♂️</a>
        <form action="../controller/LogoutController.php" method="post">
            <button class="btn btn-custom" type="submit" name="submitLogout">❌</button>
        </form>
    </nav>

    <div class="container">
        <div class="row">

            <div class="col-md-12 border-right border-left">

                <div class="p-3 py-5">
                    <form action="../controller/AddLevel.php" method="post">
                        <div class="form-group">
                            <label for="selectLevel">Select Level To Add</label>
                            <select class="form-control" id="selectLevel" name="selectLevel">
                                <option value="lv1">Level 1</option>
                                <option value="lv2">Level 2</option>
                                <option value="lv3">Level 3</option>
                                <option value="lv4">Level 4</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-custom">Add Level</button>
                    </form>
                </div>

                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Add New Professor</h4>
                    </div>

                    <form action="../controller/AddProfessorController.php" method="post">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Name</label>
                                <input type="text" name="fname" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Surname</label>
                                <input type="text" name="lname" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label class="labels">Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label class="labels">Degree</label>
                                <input type="text" name="degree" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label>Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Female" required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="national_id">National ID</label>
                                <input type="text" name="nationalId" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="department">Department</label>
                                <input type="text" name="department" class="form-control">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <input class="btn btn-custom" type="submit" value="Add Professor" name="submit">
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
