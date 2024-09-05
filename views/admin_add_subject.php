<?php
session_start();
if ($_SESSION['username'] && $_SESSION['type'] == "admin") { ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Subject</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        .custom-dropdown {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .custom-dropdown select {
            height: 45px;
            width: 100%;
            padding: 10px;
            border: 2px solid #d7ba89;
            border-radius: 5px;
            background-color: #454d55;
            color: #ffffff;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }
        .custom-dropdown select:focus {
            outline: none;
        }
        .custom-dropdown::after {
            content: '\25BC';
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #ffffff;
            pointer-events: none;
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
                <button class="btn btn-custom ml-2" type="submit" name="submitLogout">❌</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>Add Subject</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="p-3 py-5">
                    <form action="../controller/AddSubjectController.php" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select class="form-control" id="level" name="level" required>
                                <?php
                                foreach ($levels as $level) {
                                    echo "<option value='{$level['LevelID']}'>{$level['LevelName']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="number" class="form-control" id="semester" name="semester" required>
                        </div>
                        <button type="submit" class="btn btn-custom ">Add Subject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>        
        function navigateTo(url) {
            if (url) {
                // Redirect to the selected page
                window.location.href = url;
            }
        }
    </script>
</body>
</html>

<?php
} else {
    header("location:../index.php");
}
?>
