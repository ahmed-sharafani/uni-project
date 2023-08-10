<?php
require_once 'header.php';
Per("admin");


$query = "SELECT * from accounts WHERE `role` = 'student'";
$query1 = "SELECT * from accounts WHERE `role` = 'teacher'";
$query2 = "SELECT * from exams";
$query3 = "SELECT * from questions";

$run = mysqli_query($con,$query) or die('mysql error');
$run1 = mysqli_query($con,$query1) or die('mysql error');
$run2 = mysqli_query($con,$query2) or die('mysql error');
$run3 = mysqli_query($con,$query3) or die('mysql error');

$countStd = mysqli_num_rows($run);
$countTeacher = mysqli_num_rows($run1);
$countexams = mysqli_num_rows($run2);
$countquestions = mysqli_num_rows($run3);


?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <hr>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body"><?=$countquestions;?> Questions</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="exams.php">View</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body"><?=$countexams;?> Exams</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="exams.php">View</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body"><?=$countTeacher;?> Teachers</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="accounts.php">View</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body"><?=$countStd;?> Students</div>
                                   
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="accounts.php">View</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                               Last 10 Registerd Accounts
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                               <th>Role</th>
                                                <th>UserName</th>
                                                <th>Full name</th>
                                                <th>email</th>
                                                <th>Gender</th>
                                                <th>Age</th>
                                                <th>Registration Date</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>

                                                <th>Role</th>
                                                <th>UserName</th>
                                                <th>Full name</th>
                                                <th>email</th>
                                                <th>Gender</th>
                                                <th>Age</th>
                                                <th>Registration Date</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                 $query = "SELECT * from accounts WHERE `role` != 'superadmin' order by id DESC limit 10";
                                                 $run = mysqli_query($con,$query) or die('mysql error');

                                                 while ($user = mysqli_fetch_assoc($run)) {
                                                    echo '
                                                    <tr>
                                                      <td>'.$user['role'].'</td>
                                                       <td>'.$user['name'].'</td>
                                                       <td>'.$user['fullName'].'</td>
                                                       <td>'.$user['email'].'</td>
                                                       <td>'.$user['gender'].'</td>
                                                       <td>'.$user['age'].'</td>
                                                       <td>'.$user['created_time'].'</td>
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
  
<?php
require_once 'footer.php';
?>

