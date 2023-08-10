<?php
session_start();
require_once 'permission.php';
require_once 'db_connect.php';
$username = $_SESSION['username'];

$query="SELECT * FROM accounts where `name` = '$username' limit 1";
$run = mysqli_query($con,$query) or die('MYSQL ERROR');
$userData = mysqli_fetch_assoc($run);

$getAccountId = $userData['id'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Take a Quiz</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Exams Managment</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <a class="btn" style="color:white" href="logout.php">Logout</a>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">


                            <?php
                                 if($_SESSION['user-role'] == "admin"){
                            ?>
                             <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <?php } ?>

                            <div class="sb-sidenav-menu-heading">Adminstration</div>
                            <?php
                                 if($_SESSION['user-role'] == "student"){
                            ?>

                            <a class="nav-link" href="take_exam.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Take an Exam
                            </a>
                           <?php } ?>
                           <?php
                                 if($_SESSION['user-role'] == "teacher" || $_SESSION['user-role'] == "student"){
                            ?>

                            <?php
                                 if($_SESSION['user-role'] == "admin" || $_SESSION['user-role'] == "teacher"){
                            ?>
                            <a class="nav-link" href="exams.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Exams
                            </a>
                            <?php } ?>
                            <a class="nav-link" href="exams_results.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Exams Results
                            </a>
                            <?php } ?>


                            <div class="sb-sidenav-menu-heading">Profile</div>

                           
                            <?php
                                 if($_SESSION['user-role'] == "admin"){
                            ?>
                             <a class="nav-link" href="exam_types.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Exams Types
                            </a>

                            <a class="nav-link"  href="accounts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Accounts
                            </a>
                           
                            <?php } ?>

                            <!-- for all  -->
                            <a class="nav-link" href="profile.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Profile
                            </a>


                            <?php
                                 if($_SESSION['user-role'] == "admin"){
                            ?>
                         
                                <div class="sb-sidenav-menu-heading">Support</div>
                                <a class="nav-link"  href="messages.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                    Messages
                                </a>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?=$_SESSION['user-role'];?>
                    </div>
                </nav>
            </div>
