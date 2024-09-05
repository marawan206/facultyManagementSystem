<?php 
session_start();
if ($_SESSION['username'] && $_SESSION['type'] == "student") {
    include_once '../include/DatabaseClass.php';
    
    $db = new database();

    $StudentID = $_SESSION['id']; 

    $sql = "SELECT * FROM students WHERE StudentID = $StudentID";
    $result = $db->display($sql);        

    $student = $result[0];

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
        

    </style>
<body class="body">
    <nav class="navbar navbar-dark">
        <a class="navbar-brand" href="#">
            hi, <?php echo $_SESSION['name']; ?>
        </a>
        <a href="student_view_courses.php" class="btn btn-custom" type="submit" name="submitLogout">My Courses 🎓🙋‍♂️</a>
        <a href="student_enroll_courses.php" class="btn btn-custom" type="submit" name="submitLogout">Enrolling courses 🎓</a>
        <a href="student_assignment.php" class="btn btn-custom" type="submit" name="submitLogout">Assignments ✏️</a>
        <a href="student_transcript.php" class="btn btn-custom" type="submit" name="submitLogout">Transcript 📃</a>
        <form action="../controller/LogoutController.php" method="post" class="form-inline" style="margin:0;">
            <button class="btn btn-custom" type="submit" name="submitLogout">❌</button>
        </form>
    </nav>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 border-right border-left">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <?php 
                    $url = "../assets/images/download.png";
                    echo '<img class="rounded-circle mt-5" width="180px" alt="your photo" src="'.$url.'" />'; //to show img 
                ?>
                <br>
                    <span class="font-weight-bold"><?php echo $student['Name']; ?></span>
                    <span class="text-black-50"><?php echo $student['Email']; ?></span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">My Profile Information</h4>
                    </div>
                    <form action="../controller/UpdateStudent.php" method="post">
                    <input type="hidden" name="StudentID" value="<?php echo $student['StudentID']; ?>">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $student['Name']; ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $student['Email']; ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Age</label>   
                                <input type="text" class="form-control" name="age" value="<?php echo $student['Age']; ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Mobile Number</label>
                                <input type="text" class="form-control" name="phone" value="<?php echo $student['Phone']; ?>"></div>
                            <div class="col-md-12">
                                <label class="labels">Address</label>
                                <input type="text" class="form-control" name="address" value="<?php echo $student['Address']; ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $student['Username']; ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>  
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-update" name="updateStudents">Update</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

</body>

<?php 
}
else
{
    header("location:../index.php");
}
?>