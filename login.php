<?php
session_start();
if(isset($_SESSION['user-role'])){
  if($_SESSION['user-role'] == "teacher"){
      header("location:admin/exams.php");
  }else if($_SESSION['user-role'] == "student"){
      header("location:admin/take_exam.php");
  }else if($_SESSION['user-role'] == "admin"){
      header("location:admin/index.php");
  }
    exit;
}

if(isset($_GET['register'])){
    echo "<script>alert('You Have Registered Successfully')</script>";

}
if(isset($_POST['sendForm'])){

    // cehck password if correct redirect to admin panel
    $pass = $_POST['password'];
    $name = $_POST['name'];

    require_once 'admin/db_connect.php';

    // $query = "SELECT * FROM ";
    // $passcheck = password_verify($password, $dbp['password']);


    $query = "SELECT * from accounts WHERE `name` = '$name' limit 1";
    $run = mysqli_query($con,$query);
    $num_rows = mysqli_num_rows($run);

    if($num_rows == 0){
        echo "<script>alert('Error Login Please Try Again')</script>"; //user name already exists
    }else{
        $data = mysqli_fetch_assoc($run);
        if(password_verify($pass, $data['password'])){ //if pass is correct


                $_SESSION['user-role'] = $data['role'];
                $_SESSION['username'] = $data['name'];

                if($data['role'] == "teacher"){
                    header("location:admin/exams.php");
                }else if($data['role'] == "student"){
                    header("location:admin/take_exam.php");
                }else if($data['role'] == "admin"){
                    header("location:admin/index.php");
                }

                exit;

        }else{
            echo "<script>alert('Password Is Not Correct, Please Try Again')</script>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Take a Quiz Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Premium Bootstrap 4 Landing Page Template" />
        <meta name="keywords" content="bootstrap 4, premium, marketing, multipurpose" />
        <meta content="Themesdesign" name="author" />
        <!-- favicon -->
        <link rel="shortcut icon" href="images/favicon.ico" />
        <!-- css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <!-- magnific pop-up -->
        <link rel="stylesheet" type="text/css" href="css/magnific-popup.css" />
        <!-- magnific pop-up -->
        <link rel="stylesheet" type="text/css" href="css/ion.rangeSlider.min.css" />
        <!-- Pe-icon-7 icon -->
        <link rel="stylesheet" type="text/css" href="css/pe-icon-7-stroke.css" />
        <!-- Swiper CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <div class="account-home-btn d-none d-sm-block">
           <a href="index.php" class="text-primary">Home</a>
        </div>


        <section class="bg-account-pages align-items-center">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-5">
                        <div class="form-box bg-white">
                            <div class="p-4">

                                <div class="text-center mt-3">
                                    <a href="index.php"><img src="images/logo-dark.png" alt="" height="33" width="110"></a>
                                    <p class="text-muted mt-3">Sign in to continue.</p>
                                </div>

                                <div class="p-2 custom-form">
                                     <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="name" required class="form-control" placeholder="Enter Username">
                                        </div>

                                        <div class="form-group">
                                            <label for="userpassword">Password</label>
                                            <input type="password" name="password" required min="6" max="20" class="form-control"placeholder="Enter password">
                                        </div>

                                        <div class="mt-4">
                                            <input name="sendForm" value="Log In" type="submit"class="btn btn-primary btn-block"/>
                                        </div>

                                        <!--<div class="mt-4 pt-1 mb-0 text-center">
                                            <a href="password-forget.php" class="text-dark"><i class="mdi mdi-lock"></i> Forgot your
                                                password?</a>
                                        </div>-->
                                        <div class="mt-4 mb-0 text-center">
                                            <p class="mb-0">Don't have an account ? <a href="signup.php" class="text-success">Sign Up</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>





    </body>
</html>
