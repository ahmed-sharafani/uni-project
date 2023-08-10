
<?php
require_once 'db_connect.php';

if(!isset($_POST['sendForm'])){
    header("location:index.php");
    exit;
}

$examId = $_POST['examId'];
$AccountCode = $_POST['AccountCode'];
$Duration = $_POST['Duration'];
$Exam_Duration = $_POST['Exam_Duration'];
$taken_duration =  $_POST['Exam_Duration'] - $Duration;
$answer = $_POST['answer']; // array of answers 


$examq = "SELECT * FROM exams WHERE ide = '$examId' limit 1";
$exam = mysqli_query($con,$examq) or die('MYSQL ERROR');
$examData = mysqli_fetch_assoc($exam);


// GET ALL QUESTIONS
$questionsq = "SELECT * FROM questions WHERE examId = $examId";
$questions = mysqli_query($con,$questionsq) or die('MYSQL ERROR');

$score = 0;
$points = 0;
while ($questionData = mysqli_fetch_assoc($questions)) {
      foreach($answer as $questionId => $Answer) {
            if($questionId == $questionData['idq']){
                $insertAnswerw = "INSERT INTO answer(question_id,answered_index,account_id,exam_id) VALUES ($questionId,$Answer,$AccountCode,$examId)";
                mysqli_query($con,$insertAnswerw) or die('MYSQL ERROR');

                if($Answer == $questionData['correct']){
                    $score++;
                    $points += $questionData['Points'];
                }
            }
     }
}


$insertAnswerw = "INSERT INTO exams_taken(account_id,score,points,examId,duration) VALUES ($AccountCode,$score,$points,$examId,$taken_duration)";
mysqli_query($con,$insertAnswerw) or die('MYSQL ERROR');


header('location:exams_results.php');
exit;