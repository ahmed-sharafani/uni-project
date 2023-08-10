<?php
if(!isset($_SESSION['user-role'])){
    header("location:../login.php");
    exit;
}


function Per($val){

    if($val == "teacher"){
        if($_SESSION['user-role'] != "teacher"){
            header("location:profile.php");
            exit; 
        }
    }else if($val == "student"){

        if($_SESSION['user-role'] != "student"){
            header("location:profile.php");
            exit; 
        }

    }else if($val == "admin"){
        if($_SESSION['user-role'] != "admin"){
            header("location:profile.php");
            exit; 
        }
    }else if($val == "admin_teacher"){
        if($_SESSION['user-role'] != "admin" && $_SESSION['user-role'] != "teacher" ){
            header("location:profile.php");
            exit; 
        }
    }else if($val == "admin_student"){
        if($_SESSION['user-role'] != "admin" && $_SESSION['user-role'] != "student" ){
            header("location:profile.php");
            exit; 
        }
    }else if($val == "teacher_student"){
        if($_SESSION['user-role'] != "teacher" && $_SESSION['user-role'] != "student" ){
            header("location:profile.php");
            exit; 
        }
    }
    

}