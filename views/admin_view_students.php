<?php 
session_start();

if ($_SESSION['username'] && $_SESSION['type'] == "admin") {
    include_once '../include/DatabaseClass.php';        
    $db = new database();
    
    $sql = "SELECT * FROM user WHERE type = 'student'";
    $result = $db->display($sql);
    $numrows = $db->check($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
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
        .btn-primary {
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
        Hi, <?php echo $_SESSION['name']; ?>
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

    <div class="container mt-5">
        <?php 
        if (!$numrows) {
            echo '<p>No results found.</p>';
        } else {
        ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
                <tr id="record_<?php echo $row['id']; ?>">
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><button type="button" class="btn btn-danger" onclick="DeleteUser(<?php echo $row['id']; ?>)">Delete</button></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>

    <div class="alert alert-success" id="success" style="display: none;">
        <strong>Record removed from the database.</strong>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <script>
        function DeleteUser(studentId) {
            $.ajax({
                type: "POST",
                url: "../controller/DeleteUser.php",
                data: { id: studentId },
                dataType: 'json',
                success: function(response) {
                    if (response.result === 1) {
                        $("#record_" + studentId).remove();
                        $("#success").slideDown(500).delay(3000).slideUp(500);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    </script>
</body>
</html>

<?php 
} else {
    header("location: ../index.php");
    exit;
}
?>
