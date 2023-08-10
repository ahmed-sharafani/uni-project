
<?php
require_once 'header.php';

require_once 'db_connect.php';

if(!isset($_POST['examcode'])){
    header("location:index.php");
    exit;
  }


$examcode = $_POST['examcode'];
$examq = "SELECT * FROM exams,class WHERE class.class_id = exams.class_id and examCode = '$examcode' limit 1";
$exam = mysqli_query($con,$examq) or die('MYSQL ERROR');
$examData = mysqli_fetch_assoc($exam);
$rowcount = mysqli_num_rows($exam);



if($rowcount == 0){
	echo "<script>alert('The Exam Code Is Not Correct')</script>";
	echo "<center>The Exam Code Is Not Correct <br>";
	echo "<a href='take_exam.php'>Back</a></center>";
	die('');
}

if($examData['isEnable'] == 0){

	echo "<script>alert('The Exam Is Disabled currently ')</script>";
	echo "<center>The Exam Is Disabled currently <br>";
	echo "<a href='take_exam.php'>Back</a></center>";
	die('');
}



// get account id for this student
$username = $_SESSION['username'];

$query="SELECT * FROM accounts where `name` = '$username' limit 1";
$run = mysqli_query($con,$query) or die('MYSQL ERROR');
$userData = mysqli_fetch_assoc($run);

$getAccountId = $userData['id'];

$examId = $examData['ide'];

// check if the student is taken the exam 
$istakenq = "SELECT * FROM exams_taken WHERE examId = $examId and account_id = $getAccountId limit 1";
$istaken = mysqli_query($con,$istakenq) or die('MYSQL ERROR');

if( mysqli_num_rows($istaken) > 0){
	echo "<script>alert('TThe Exam Is Taken By You')</script>";

	echo "<center>The Exam Is Taken By You <br>";
	echo "<a href='take_exam.php'>Back</a></center>";
	die('');
}


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
			Exam Category: <?=$examData['class_name'];?> <br>
			Exam Name: <?=$examData['examName'];?> <br>
			Exam Code: <?=$examData['examCode'];?> <br>
			Exam Time: <span id="examtime" style="color:green"><?=$examData['exam_duration'];?></span> Seconds <br>
			Remain Time: <span id="leftTime" style="color:red"><?=$examData['exam_duration'];?></span> Seconds To Finish The Exam
		</div>
		<br>
		<div class="card">
			<div class="card-body">
				<form action="exam_sheet_insert.php" id="sheet_form" method="post">
				<input type="hidden" name="examId" value="<?=$examId;?>">
				<input type="hidden" name="AccountCode" value="<?=$getAccountId;?>">
				<input type="hidden" id="Duration" name="Duration" value="<?=$examData['exam_duration'];?>">
				<input type="hidden" name="Exam_Duration" value="<?=$examData['exam_duration'];?>">
				<input type="hidden" name="sendForm" value="for auto submit">

				<?php
				  while ($questionData = mysqli_fetch_assoc($questions)) {
				?>
				
                <ul class="q-items list-group mt-4 mb-4">
					<li class="q-field list-group-item">
						<strong><?=$questionData['question'];?></strong> (<?=$questionData['Points'];?> points)
						<br>
						<ul class='list-group mt-4 mb-4'>
							<li class="answer list-group-item">
								<label><input type="radio" name="answer[<?=$questionData['idq'];?>]" value="1"> <?=$questionData['answer1'];?></label>
							</li>
                            <li class="answer list-group-item">
								<label><input type="radio" name="answer[<?=$questionData['idq'];?>]" value="2"> <?=$questionData['answer2'];?></label>
							</li>

						<?php
							if($questionData['answer3'] != ""){
						?>
                            <li class="answer list-group-item">
								<label><input type="radio" name="answer[<?=$questionData['idq'];?>]" value="3"> <?=$questionData['answer3'];?></label>
							</li>
						<?php
						}
						?>		
							<?php
							if($questionData['answer4'] != ""){
						?>	
                            <li class="answer list-group-item">
								<label><input type="radio" name="answer[<?=$questionData['idq'];?>]" value="4"> <?=$questionData['answer4'];?></label>
							</li>
							<?php
						}
						?>	
						</ul>
					</li>
				</ul>

				<?php
				  }
				?>
				<input type="submit" name="sendForm" value="Submit Results" class="btn btn-block btn-primary"/>
				</form>
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
<script>

// FOR SELECT RADIO ON CLICK 
	$(document).ready(function(){
		$('.answer').each(function(){
		$(this).click(function(){
			$(this).find('input[type="radio"]').prop('checked',true)
			$(this).css('background','#00c4ff3d')
			$(this).siblings('li').css('background','white')
		})
		})
	})
</script>

<script>

// FOR TIME AUTO SUMBMIT
var c = document.getElementById("examtime").innerHTML;
function myCounter() {
  document.getElementById("leftTime").innerHTML = --c;
  document.getElementById("Duration").value = c;

  if(c == 0){
	  alert("your time is finish");
	  document.getElementById("sheet_form").submit();
	  
  }
}

setInterval(myCounter, 1000);

</script>