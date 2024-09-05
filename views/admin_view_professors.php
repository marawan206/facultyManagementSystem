<?php
session_start();

if ($_SESSION['username'] && $_SESSION['type'] == "admin") {
    include_once '../include/DatabaseClass.php';
    $db = new Database();

    // Initialize variables
    $selectedDepartment = "";
    $result = [];
    $numrows = 0;

    // Check if the search form is submitted
    if (isset($_POST['searchDepartment']) && !empty($_POST['department'])) {
        $selectedDepartment = $_POST['department'];
        $sql = "SELECT * FROM professors WHERE Department = '$selectedDepartment'";
    } else {
        // Default query without filtering by department
        $sql = "SELECT * FROM professors";
    }

    $result = $db->display($sql);
    $numrows = $db->check($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin professors</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #192a51;
            font-family: Arial, sans-serif;
            color: #ffffff;
        }
        .navbar {
            background-color: #212529;

        }
        .navbar-brand {
            color: #ffffff;
            font-weight: bold;
        }
        .container {
            background-color: #8b9eb7;
            border-radius: 20px;    
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
            margin-bottom: 50px;
            border: solid;
            border-color: #d7ba89;
        }ذ
        .form-group label {
            font-weight: bold;
        }
        .btn-custom {
            background-color: #192a51;
            color: #ffffff;
            border: solid;
            border-color: #d7ba89;
            transition: all 0.3s ease-in-out;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-primary{
            background-color: #192a51;
            color: #ffffff;
            border: none;
            transition: all 0.3s ease-in-out;
        }
        #success {
            display: none;
            margin-top: 20px;
        }
        
    </style>
</head>
<body>

<nav class="navbar navbar-dark">
    <a class="navbar-brand" href="#">
       Admin - Hi, <?php echo $_SESSION['name']; ?>
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

<div class="container mt-4">
    <!-- Search form -->
    <form action="" method="post">
        <div class="form-group">
            <label for="department">Search by Department:</label>
            <select class="form-control" id="department" name="department">
                <option value="">All Departments</option>
                <?php
                $departments = $db->display("SELECT DISTINCT Department FROM professors");
                foreach ($departments as $department) {
                    $selected = ($selectedDepartment == $department['Department']) ? 'selected' : '';
                    echo "<option value='" . $department['Department'] . "' $selected>" . $department['Department'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="searchDepartment">Search</button>
    </form>

    <?php
    if ($numrows === 0) {
        echo '<p>No results found.</p>';
    } else {
    ?>
    <!-- Display results table -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Degree</th>
                    <th>Department</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $professor) { ?>
                <tr id="record_<?php echo $professor['ProfessorID']; ?>">
                    <td><?php echo $professor['Name']; ?></td>
                    <td><?php echo $professor['Degree']; ?></td>
                    <td><?php echo $professor['Department']; ?></td>
                    <td><?php echo $professor['Username']; ?></td>
                    <td><?php echo $professor['Password']; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="EditProfessor(<?php echo $professor['ProfessorID']; ?>)">Edit</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="DeleteUser(<?php echo $professor['ProfessorID']; ?>)">Delete</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>

<div class="alert alert-success" id="success">
    <strong>Record removed from the database.</strong>
</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

<script>
    function DeleteUser(ProfessorID) {
        $.ajax({
            type: "POST",
            data: {id: ProfessorID},
            url: "../controller/DeleteUser.php",
            dataType: 'json',
            success: function(response) {
                if (response.result === 1) {
                    $("#record_" + ProfessorID).remove();
                    $("#success").slideDown(500).delay(3000).slideUp(500);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    function EditProfessor(ProfessorID) {
        // Redirect to the edit_professor.php page or use AJAX to load the edit form dynamically
        window.location.href = "../controller/EditProfessorController.php?id=" + ProfessorID;
    }
</script>

</body>
</html>

<?php
} else {
    header("location:../index.php");
    exit; // Ensure script stops executing after redirection
}
?>
