
<?php
//this page is for exam questions answers for teacher
require_once 'header.php';

require_once 'db_connect.php';

if(!isset($_GET['examcode'])){
    header("location:index.php");
    exit;
  }


$examcode = $_GET['examcode'];
$examq = "SELECT * FROM exams,class WHERE class.class_id = exams.class_id and examCode = '$examcode' limit 1";

$exam = mysqli_query($con,$examq) or die('MYSQL ERROR');
$examData = mysqli_fetch_assoc($exam);
$rowcount = mysqli_num_rows($exam);



/*if($rowcount == 0){
	echo "<script>alert('The Exam Code Is Not Correct')</script>";
	echo "<center>The Exam Code Is Not Correct <br>";
	echo "<a href='take_exam.php'>Back</a></center>";
	die('');
}*/

/*if($examData['isEnable'] == 0){

	echo "<script>alert('The Exam Is Disabled currently ')</script>";
	echo "<center>The Exam Is Disabled currently <br>";
	echo "<a href='take_exam.php'>Back</a></center>";
	die('');
}*/



// get account id for this student
$username = $_SESSION['username'];

$query="SELECT * FROM accounts where `name` = '$username' limit 1";
$run = mysqli_query($con,$query) or die('MYSQL ERROR');
$userData = mysqli_fetch_assoc($run);

$getAccountId = $userData['id'];

$examId = $examData['ide'];




// get exam questions

// get exam questions
if($examData['isRand'] == 1){
	$questionsq = "SELECT * FROM questions WHERE examId = $examId Order by rand()";

}else{
	$questionsq = "SELECT * FROM questions WHERE examId = $examId";
}

$questions = mysqli_query($con,$questionsq) or die('MYSQL ERROR');

if($rowcount == 0){
	echo "<script>alert('No Qeustion In This Exam<')</script>";
	echo "<center>No Qeustion In This Exam<br>";
	echo "<a href='take_exam.php'>Back</a></center>";
	die('');
}



?>

<div id="layoutSidenav_content">
    <main>
  
	
	<div class="container-fluid" style="margin-top:20px">
		<div class="col-md-12 alert alert-primary"> 
			Exam's Category: <?=$examData['class_name'];?> <br>
			Exam's Name: <?=$examData['examName'];?> <br>
			Exam's Code: <?=$examData['examCode'];?> <br>
			Exam's Total Points: <?=$examData['totalPoints'];?> <br>
			Exam's Time: <span id="examtime" style="color:green"><?=$examData['exam_duration'];?></span> Seconds <hr>
		</div>
		<br>
		<div class="card">
			<div class="card-body">
				<input type="hidden" name="examId" value="<?=$examId;?>">
				<input type="hidden" name="AccountCode" value="<?=$getAccountId;?>">
				<input type="hidden" id="Duration" name="Duration" value="<?=$examData['exam_duration'];?>">
				<input type="hidden" name="Exam_Duration" value="<?=$examData['exam_duration'];?>">

				<?php
				  while ($questionData = mysqli_fetch_assoc($questions)) {
				?>
				
                <ul class="q-items list-group mt-4 mb-4">
					<li class="q-field list-group-item">
						<strong><?=$questionData['question'];?></strong> (<?=$questionData['Points'];?> points)
						<br>
						<ul class='list-group mt-4 mb-4'>
						<?php
							if($questionData['correct'] == 1){
								echo '<li class="answer list-group-item" style="background-color:green">
									<label > '. $questionData['answer1'] .'</label>
									</li>';
							}else{
								echo '<li class="answer list-group-item" style="background-color:red">
								<label>'. $questionData['answer1'] .'</label>
								</li>';
							}
							if($questionData['correct'] == "2"){
								echo '<li class="answer list-group-item" style="background-color:green">
									<label > '. $questionData['answer2'] .'</label>
									</li>';
							}else{
								echo '<li class="answer list-group-item" style="background-color:red">
								<label > '. $questionData['answer2'] .'</label>
								</li>';
							}
						
							if($questionData['answer3'] != ""){
								if($questionData['correct'] == 3){
									echo '<li class="answer list-group-item" style="background-color:green">
									<label >'. $questionData['answer3'] .'</label>
									</li>';
								}else{
									echo '<li class="answer list-group-item" style="background-color:red">
									<label>'. $questionData['answer3'] .'</label>
									</li>';
								}
							}
							if($questionData['answer4'] != ""){
								if($questionData['correct'] == 4){
									echo '<li class="answer list-group-item" style="background-color:green">
									<label >'. $questionData['answer4'] .'</label>
									</li>';
								}else{
									echo '<li class="answer list-group-item" style="background-color:red">
									<label>'. $questionData['answer4'] .'</label>
									</li>';
								}

							}
						?>	
						</ul>
					</li>
				</ul>

				<?php
				  }
				?>

			</div>	
		</div>
	</div>


	<style>
		li.answer{
			cursor: pointer;
		}
		li.answer:hover{
			background: #00c4ff3d;
		}
		li.answer input:checked{
			background: #00c4ff3d;
		}
</style>

<?php
	require_once 'footer.php';
?> 

