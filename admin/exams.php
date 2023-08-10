
<?php

require_once 'header.php';
Per('admin_teacher');

if(isset($_POST['sendForm'])){

    $accountId = (int)$_POST['accountId'];
    $totalPoints = (int)$_POST['totalPoints'];
    $examCode = $_POST['examCode'];
    $examName = $_POST['examName'];
    $exam_duration = $_POST['exam_duration'];
    $isPublic = $_POST['isPublic'];
    $isEnable = 0;
    $isRand = $_POST['isRand'];
    $class_id = $_POST['class_id'];



    $querySameName = "SELECT examName from exams where accountId = $accountId and examName = '$examName'";

    $run2 = mysqli_query($con,$querySameName) or die('MYSQL ERROR');

    if(mysqli_num_rows($run2) > 0){
      echo"<script>alert('Exam Name have been Used by you, try another name');</script>";
    }else{
      $query="INSERT into exams(totalPoints,examName,accountId,examCode,exam_duration,isPublic,isEnable,isRand,class_id)
       values ($totalPoints,'$examName',$accountId,'$examCode',$exam_duration,$isPublic,$isEnable,$isRand,$class_id)";
      $run = mysqli_query($con,$query) or die('MYSQL ERROR');
    }




}

if(isset($_GET['delete'])){
    $ide = (int)$_GET['delete'];
    $query="DELETE FROM exams WHERE ide = $ide";
    $run = mysqli_query($con,$query) or die('MYSQL ERROR');

    $query="DELETE FROM  questions WHERE examId = $ide";
    $run = mysqli_query($con,$query) or die('MYSQL ERROR');

    $query="DELETE FROM  answer WHERE exam_id = $ide";
    $run = mysqli_query($con,$query) or die('MYSQL ERROR');
}

if(isset($_GET['Publish'])){
    $isEnable = (int)$_GET['Publish'];
    $ide = (int)$_GET['ide'];

    /*  the teacher code ...$getExamQuestionsPoints=$db->query("select sum(Points) as tp from questions where examId=$ide");
    $totalQuestionsPoints= $getExamQuestionsPoints[0]['tp'];
    $getExamTotalPoint=$db->query("select totalPoints from exams where ide=$ide limit 1");
    $theTotalPoint=$getExamTotalPoint[0]['totalPoints'];*/
     $query="select sum(Points) as tp from questions where examId=$ide;";
                 $run=mysqli_query($con,$query)or die('MYSQL ERROR');
                 $a=mysqli_fetch_assoc($run);
                 $totalQuestionsPoints=$a['tp'];

     $query="select totalPoints,isEnable from exams where ide=$ide ;";
                 $run=mysqli_query($con,$query)or die('MYSQL ERROR');
                 $a=mysqli_fetch_assoc($run);
                 $theTotalPoint=$a['totalPoints'];
                 $isEnablee=$a['isEnable'];

    if($totalQuestionsPoints < $theTotalPoint and $isEnablee==0){

      //echo "<script>alret('exam can not be published cause the total question points is less than the exam points.')</script>";
          echo "<script>alert('exam can not be published cause the total questions points is less than the exam points.');</script>";

      //die('exam .');
    }

    else{

    $query="UPDATE exams set isEnable = $isEnable WHERE ide = $ide";
    $run = mysqli_query($con,$query) or die('MYSQL ERROR');
    header('location:exams.php');
  }
}
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Exams</h1>
                        <hr>
                        <div class="card mb-4">
                            <div class="card-header">
                               <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">  <i class="fas fa-table mr-1"></i>Add New Exam </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Exam Category</th>
                                                <th>Exam Name</th>
                                                <th>Exam Code</th>
                                                <th>Exam Duration Seconds</th>
                                                <th>Total Points</th>

                                                <th>Exam State</th>
                                                <th>Exam Type</th>
                                                <th>Teacher Name</th>
                                                <th>Count Question</th>
                                                <th>Created Time</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                             <?php


                                                 $query = "SELECT class.*,exams.*,accounts.*,(SELECT count(*) from questions where exams.ide = examId) as countquestion
                                                  FROM `exams`,`accounts`,`class`
                                                 where exams.accountId = accounts.id and exams.class_id = class.class_id order by exams.ide DESC";

                                                  if($_SESSION['user-role'] == "teacher"){
                                                    $query = "SELECT class.*,exams.*,accounts.*,(SELECT count(*) from questions where exams.ide = examId) as countquestion
                                                    FROM `exams`,`accounts`,`class`
                                                   where exams.accountId = accounts.id and exams.class_id = class.class_id and accounts.id = $getAccountId order by exams.ide DESC";
                                                  }
                                                 $run = mysqli_query($con,$query) or die('mysql error');

                                                 while ($user = mysqli_fetch_assoc($run)) {
                                                    echo '
                                                    <tr>
                                                      <td>'.$user['class_name'].'</td>
                                                      <td>'.$user['examName'].'</td>
                                                       <td>'.$user['examCode'].'</td>
                                                       <td>'.$user['exam_duration'].'</td>';
                                                      echo '<td>'.$user['totalPoints'].'</td>';

                                                        if($user['isEnable'] == 1){
                                                            echo '<td style="color:green">Enabled</td>';
                                                        }else{
                                                            echo '<td style="color:red">Disabled</td>';

                                                        }
                                                      if($user['isPublic'] == 1){
                                                          echo '<td style="color:green">Public</td>';
                                                      }else{
                                                          echo '<td style="color:red">Private</td>';

                                                      }
                                                       echo '<td>'.$user['fullName'].'</td>
                                                       <td>'.$user['countquestion'].'</td>
                                                       <td>'.$user['exam_created_time'].'</td>
                                                       <td>';
                                                       if($user['isEnable'] == 1){
                                                        echo '<a class="btn btn-warning" href="?Publish=0&ide='.$user['ide'].'" onclick="return confirm(\'Are you sure you want to UnPublish Exam?\');">UnPublish Exam</a>';
                                                      }else{
                                                        echo '<a class="btn btn-danger" href="?Publish=1&ide='.$user['ide'].'" onclick="return confirm(\'Are you sure you want to Publish Exam?\');">Publish Exam</a>';

                                                      }

                                                       echo '<a href="qustions.php?id='.$user['ide'].'" class="btn btn-primary">EXAM QUESTIONS</a>
                                                       <a class="btn btn-danger" href="?delete='.$user['ide'].'" onclick="return confirm(\'Are you sure you want to delete this Exam?\');">Delete</a></td>
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



<!-- INSEST MODEL -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="row">
           <div class="form-group col-md-6">
              <label for="recipient-name" class="col-form-label">Exam Name:</label>
              <input type="text" required name="examName" class="form-control" id="recipient-name">
            </div>
            <div class="form-group col-md-6">
              <label for="recipient-name" class="col-form-label">Exam Code:</label>
              <input type="text" minlength="3" maxlength="20" required name="examCode" class="form-control" id="recipient-name">
            </div>
        </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Exam Duration in Seconds</label>
            <input type="number" min="60" max="9000" required name="exam_duration" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Total Points</label>
            <input type="number" min="2" max="1000" required name="totalPoints" class="form-control" id="recipient-name">
          </div>


        <div class="row">
           <div class="form-group col-md-6">
              <label for="recipient-name" class="col-form-label">Question Order:</label>
              <select class="form-control" name="isRand">
                <option value="0">Normal</option>
                 <option value="1">Random</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="recipient-name" class="col-form-label">Exam Type (public or private):</label>
                <select class="form-control" name="isPublic">
                  <option value="1">Exam is Public (for all student)</option>
                  <option value="0">Exam Is Private (By Code)</option>
                </select>
            </div>
        </div>



          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Exam Teacher:</label>
           <select class="form-control" name="accountId">
            <?php
               $query = "SELECT * FROM `accounts` where `role` = 'teacher' order by id";

               if($_SESSION['user-role'] == "teacher"){
                  $query = "SELECT * FROM `accounts` where id = $getAccountId order by id";
               }
                $run = mysqli_query($con,$query) or die('mysql error');

                while ($user = mysqli_fetch_assoc($run)) {
                    echo '
                    <option value="'.$user['id'].'">'.$user['fullName'].' ('.$user['name'].')</option>';
                }
            ?>
           </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Exam Category:</label>
           <select class="form-control" name="class_id">
            <?php
                $query = "SELECT * FROM `class` order by class_id";
                $run = mysqli_query($con,$query) or die('mysql error');

                while ($user = mysqli_fetch_assoc($run)) {
                    echo '
                    <option value="'.$user['class_id'].'">'.$user['class_name'].'</option>';
                }
            ?>
           </select>
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
