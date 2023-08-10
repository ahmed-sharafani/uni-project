
<?php

require_once 'header.php';
Per('studnet');
if(isset($_POST['sendForm'])){

    $accountId = (int)$_POST['accountId'];
    $examCode = $_POST['examCode'];
    $examName = $_POST['examName'];
    $exam_duration = $_POST['exam_duration'];
    $isPublic = $_POST['isPublic'];
    $isEnable = $_POST['isEnable'];

    $query="INSERT into exams(examName,accountId,examCode,exam_duration,isPublic,isEnable)
     values ('$examName',$accountId,'$examCode',$exam_duration,$isPublic,$isEnable)";
    $run = mysqli_query($con,$query) or die('MYSQL ERROR');
}

if(isset($_GET['delete'])){
    $ide = (int)$_GET['delete'];
    $query="DELETE FROM exams WHERE ide = $ide";
    $run = mysqli_query($con,$query) or die('MYSQL ERROR');
}
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Exams</h1>
                        <hr>
                        <div class="card mb-4">
                            <div class="card-header">
                               <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">  <i class="fas fa-table mr-1"></i> Start an Exam</button>
                            </div>
                            <div class="card-body">
                            <h1 class="mt-4">LAST Public Exams</h1>

                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Exam Category</th>
                                                <th>Exam Name</th>
                                                <th>Exam Code</th>
                                                <th>Exam Duration</th>
                                                <th>Teacher Name</th>
                                                <th>No. of Questions</th>
                                                <th>Created Time</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                             <?php
                                                 $query = "SELECT class.*,exams.*,accounts.*,(SELECT count(*) from questions
                                                 where exams.ide = examId) as countquestion
                                                  FROM `exams`,`accounts`,class
                                                 where exams.accountId = accounts.id and
                                                 class.class_id = exams.class_id and
                                                  exams.isPublic = 1 order by exams.ide DESC LIMIT 100";
                                                 $run = mysqli_query($con,$query) or die('mysql error');

                                                 while ($user = mysqli_fetch_assoc($run)) {
                                                    echo '
                                                    <tr>
                                                      <td>'.$user['class_name'].'</td>
                                                      <td>'.$user['examName'].'</td>
                                                       <td style="color:green">'.$user['examCode'].'</td>
                                                       <td>'.$user['exam_duration'].' Seconds</td>';

                                                       echo '<td>'.$user['fullName'].'</td>
                                                       <td>'.$user['countquestion'].'</td>
                                                       <td>'.$user['exam_created_time'].'</td>
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
        <h5 class="modal-title" id="exampleModalLabel">Start New Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="exam_sheet.php" method="post">

          <div class="form-group">
            <label class="col-form-label">Exam Code:</label>
            <input type="text" required name="examcode" class="form-control" id="recipient-name">
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
