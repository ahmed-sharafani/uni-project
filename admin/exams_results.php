
<?php
//this page is for students and teachers so the can see their taken exams(exam results)
require_once 'header.php';

?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Taken Exams</h1>
                        <hr>
                        <div class="card mb-4">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Exam Name</th>
                                                <th>Exam Code</th>

                                                <?php

                                                if($_SESSION['user-role'] == "student"){
                                                    echo '  <th>Teacher Name</th>
                                                      <th>Teacher Age</th>
                                                      <th>Teacher Gender</th>';
                                                    }else{
                                                      echo '  <th>Student Name</th>
                                                        <th>Student Age</th>
                                                        <th>Student Gender</th>';
                                                      }
                                                 ?>



                                                <th>Points</th>
                                                <th>Score</th>

                                                <th>Duration</th>
                                                <th>date</th>
                                                <?php

                                                if($_SESSION['user-role'] == "student"){

                                                echo "<th>action</th>";
                                                }
                                                ?>
                                            </tr>
                                        </thead>

                                        <tbody>
                                             <?php
                                                $query = "SELECT exams_taken.*,exams.*,accounts.*
                                                FROM `exams_taken`,`exams`,`accounts`
                                                where
                                                exams_taken.examId = exams.ide AND
                                                ";


                                                if($_SESSION['user-role'] == "student"){
                                                    $query .= " exams.accountId = accounts.id AND exams_taken.account_id = $getAccountId AND (exams.isEnable=0 OR exams.isPublic=1)"; //and datetime < NOW() - INTERVAL 60 MINUTE
                                                }else if($_SESSION['user-role'] == "teacher"){
                                                    $query .= " exams_taken.account_id = accounts.id AND exams.accountId = $getAccountId";
                                                }
                                                $query .= " ORDER by exams_taken.idt DESC";

                                                 $run = mysqli_query($con,$query) or die('mysql error');

                                                 while ($user = mysqli_fetch_assoc($run)) {
                                                    echo '
                                                    <tr>
                                                      <td>'.$user['examName'].'</td>
                                                       <td>'.$user['examCode'].'</td>
                                                       <td>'.$user['fullName'].'</td>
                                                       <td>'.$user['age'].'</td>
                                                       <td>'.$user['gender'].'</td>
                                                       <td>'.$user['points'].'</td>
                                                       <td>'.$user['points'].'/ '.$user['totalPoints'].'</td>
                                                       <td>'.$user['duration'].'</td>
                                                       <td>'.$user['datetime'].'</td>';                                                    
                                                     if($_SESSION['user-role'] == "student"){
                                                      echo '
                                                       <td><a href="exam_sheet_view.php?examcode='.$user['examCode'].'" class="btn btn-primary">Result</a> </td>';}
                                                    echo'</tr>';
                                                  }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>





<?php
require_once 'footer.php';
?>
