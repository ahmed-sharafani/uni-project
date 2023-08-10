
<?php
//add new question page
require_once 'db_connect.php';

if(!isset($_GET['id'])){
  header("location:index.php");
  exit;
}
$id = (int)$_GET['id'];

$getExamDataQuery = "SELECT * FROM exams where ide = $id";


$run = mysqli_query($con,$getExamDataQuery) or die('mysql error');
$examData = mysqli_fetch_assoc($run);




if(isset($_POST['sendForm'])){



    $Points = (int)$_POST['Points'];
    $question = $_POST['question'];
    $answer1 = $_POST['answer1'];
    $answer2 = $_POST['answer2'];
    $answer3 = $_POST['answer3'];
    $answer4 = $_POST['answer4'];
    $correct = $_POST['is_right'];
    $examId = $id;

    if($correct == 3 && ($answer3 == "")){
      die("The Correct Answer Is empty ! ");
    }
    if($correct == 4 && ($answer3 == "" || $answer4 == "")){
      die("The Correct Answer Is empty or answer 3 is empty ! ");
    }
    $total = $examData['totalPoints'];


    $queryq = "SELECT sum(points) as 'pp' from questions WHERE examId = $id order by idq DESC";
    $run = mysqli_query($con,$queryq) or die('mysql error');
    $Qdata = mysqli_fetch_assoc($run);
    $sumPoints = $Qdata['pp'];



$sumPoints2 = $Points + $sumPoints;



    if($sumPoints2 > $total){
      echo "<script>alert('the Points is grater than total !!')</script>";
    }else{
      $query="INSERT into questions(Points,question,answer1,answer2,answer3,answer4,correct,examId)
       values ($Points,'$question','$answer1','$answer2','$answer3','$answer4',$correct,$examId)";
      $run = mysqli_query($con,$query) or die('MYSQL ERROR');
    }



}

if(isset($_GET['delete'])){

    $idq  = (int)$_GET['delete'];


    $querye = "SELECT isEnable  from exams WHERE ide = $id";
    $run = mysqli_query($con,$querye) or die('mysql error');
    $i = mysqli_fetch_assoc($run);
    $isEnable = $i['isEnable'];

    if($isEnable==0){
    $query="DELETE FROM questions WHERE idq  = $idq ";
    $run = mysqli_query($con,$query) or die('MYSQL ERROR');}

    else{
        echo "<script>alert('questions cant be deleted while exam is published.');</script>";
    }
}



require_once 'header.php';
per('admin_teacehr');
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><?=$examData['examName'];?></h1>
                        <hr>
                        <div class="card mb-4">

                            <div class="card-body">
                            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">  <i class="fas fa-table"></i> Add New Question </button>

                                <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                    <th>Question</th>
                                                    <th>Correct Answer(index)</th>
                                                    <th>Question's Points</th>
                                                    <th>Action</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                 $query = "SELECT * from questions WHERE examId = $id order by idq DESC";
                                                 $run = mysqli_query($con,$query) or die('mysql error');

                                                 $query = "SELECT examCode from exams WHERE ide = $id";
                                                 $r = mysqli_query($con,$query) or die('mysql error');
                                                 $user1 = mysqli_fetch_assoc($r);

                                                 while ($user = mysqli_fetch_assoc($run)) {
                                                    echo '<tr>
                                                        <td>'.$user['question'].'</td>
                                                        <td>'.$user['correct'].'</td>
                                                        <td>'.$user['Points'].'</td>

                                                       <td>
                                                       <a href="exam_sheet_view_exam_answers.php?examcode='.$user1['examCode'].'" class="btn btn-info">View Questions</a>

                                                       <a class="btn btn-danger" href="?id='.$id.'&delete='.$user['idq'].'" onclick="return confirm(\'Are you sure you want to delete this Account?\');">Delete</a>
                                                       </td>
                                                    </tr>
                                                    ';
                                                  }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>










                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >  <!--code for add new question-->
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">

							<h4 class="modal-title" id="myModallabel">Add a New Question</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?=$id?>" method="post">
							<div class ="modal-body">
								<div id="msg"></div>
                                <div class="form-group">
									<label>Points For this Question</label>
									<input type="number" name="Points" min="1" max="1000" equired="required" class="form-control" />
								</div>
								<div class="form-group">
									<label>Question</label>
									<input type="hidden" name="id" />
									<textarea rows='3' name="question" required="required" class="form-control" ></textarea>
								</div>
									<label>Options:</label>

								<div class="form-group">
									<textarea rows="2" name ="answer1"  required class="form-control" ></textarea>
									<span>
									<label><input type="radio" name="is_right" checked class="is_right" value="1"> <small>Question's Answer</small></label>
									</span>
									<br>
									<textarea rows="2" name ="answer2" required class="form-control" ></textarea>
									<label><input type="radio" name="is_right" class="is_right" value="2"> <small>Question's Answer</small></label>
									<br>
									<textarea rows="2" name ="answer3" value="" class="form-control" ></textarea>
									<label><input type="radio" name="is_right" class="is_right" value="3"> <small>Question's Answer</small></label>
									<br>
									<textarea rows="2" name ="answer4" value="" class="form-control" ></textarea>
									<label><input type="radio" name="is_right" class="is_right" value="4"> <small>Question's Answer</small></label>
								</div>

							</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input name="sendForm" value="Confirm Data" type="submit" class="btn btn-primary"/>
                                </form>

                            </div>
					</div>
				</div>
			</div>


<?php
require_once 'footer.php';
?>
