<?php
session_start();
if(isset($_SESSION['user-role'])){
    header("location:admin/index.php");
    exit;
}
require_once 'admin/db_connect.php';

if(isset($_POST['sendForm'])){

    $name = $_POST['name'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $role = $_POST['role'];
    $hashpass=password_hash($password , PASSWORD_DEFAULT); //hashing or encrpting the password inside the db

    $query="INSERT into accounts(`name`,fullName,`email`,`password`,gender,age,`role`)
    values ('$name','$fullName','$email','$hashpass','$gender',$age,'$role')";
    $run = mysqli_query($con,$query) or die('MYSQL ERROR');


    header("location:login.php?register=you have registered successfully");
    exit;
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SignUp - Take a Quiz</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <div class="account-home-btn d-none d-sm-block">
        <a href="index.php" class="text-primary">Home</a>
        </div>


        <section class="bg-account-pages align-items-center" style="margin-top: 50px;">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-5">
                        <div class="form-box bg-white">
                            <div class="p-4">

                                <div class="text-center mt-3">
                                    <a href="index.php"><img src="images/logo-dark.png" alt="" height="33" width="110"></a> <!-- height="24" -->
                                    <p class="text-muted mt-3">Sign up for a new Account</p>
                                </div>

                                <div class="p-2 m-12 custom-form">
                                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label  class="col-form-label">Full Name: *</label>
                                                <input type="text" required name="fullName" class="form-control" id="recipient-name" pattern='([A-Za-z]{3,12}[ ][A-Za-z]{3,12}[ ][A-Za-z]{3,12})'   placeholder='ex: ahmed omer ali'>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-form-label">Email:</label>
                                                <input type="email" required name="email" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">UserName:</label>
                                                <input type="text" required name="name" class="form-control" id="recipient-name" pattern='([A-Za-z]{3,12}[\d]{0,6}[\._]?[A-Za-z]{0,12}[\d]{0,6})' title='user name must  only contain letters, numbers, and periods and underscores and be larger than 3 charecters'  required  class='form-control'>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-form-label">Password:</label>
                                                <input type="password" max="20" min="6" required name="password" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Role:</label>
                                            <select class="form-control" name="role">
                                                        <option value="teacher">Teacher</option>
                                                        <option value="student">Student</option>
                                            </select>
                                            </div>
                                            <div class="row">
                                            <div class="form-group col-md-6">
                                                <label  class="col-form-label">Gender</label>
                                            <select class="form-control" name="gender" >
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                            </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="recipient-name" class="col-form-label">Age:</label>
                                                <input type="Number" min="7" max="100" required name="age" class="form-control" id="recipient-name">
                                            </div>
                                            </div>

                                        <div class="mt-3">
                                            <input name="sendForm" value="Sign Up" type="submit"class="btn btn-primary btn-block"/>

                                        </div>
                                        <br>
                                        <div class="mt-4 mb-0 text-center">
                                            <p class="mb-0">have an account ? <a href="login.php" class="text-success">Sign in</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- javascript -->
        <script src="js/jquery.min.js"></script>

    </body>
</html>
