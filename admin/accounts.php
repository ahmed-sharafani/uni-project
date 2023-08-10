
<?php

require_once 'db_connect.php';

if(isset($_POST['sendForm'])){

    $name = $_POST['name']; 
    $fullName = $_POST['fullName']; 
    $email = $_POST['email']; 
    $password = $_POST['password']; 
    $gender = $_POST['gender']; 
    $age = $_POST['age']; 
    $role = $_POST['role']; 
    $hashpass=password_hash($password , PASSWORD_DEFAULT); //hashing or encrpting the password inside the db


    $query="INSERT into accounts(`name`,fullName,`email`,`password`,gender,age,`role`) 
    values ('$name','$fullName','$email','$hashpass','$gender',$age,'$role')";
    $run = mysqli_query($con,$query) or die('MYSQL ERROR');
}

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete']; 
    $query="DELETE FROM accounts WHERE id = $id";
    $query2="DELETE FROM exams WHERE accountId = $id";
    $run = mysqli_query($con,$query) or die('MYSQL ERROR');
    $run = mysqli_query($con,$query2) or die('MYSQL ERROR');
}
require_once 'header.php';
Per("admin");

?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Accounts</h1>
                        <hr>
                        <div class="card mb-4">
                            <div class="card-header">
                               <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">  <i class="fas fa-user"></i> Add New Account </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                               <th>Role</th>
                                                <th>UserName</th>
                                                <th>Full name</th>
                                                <th>Email</th>
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
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Age</th>
                                                <th>Registration Date</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                 $query = "SELECT * from accounts WHERE `role` != 'superadmin' order by id DESC";
                                                 $run = mysqli_query($con,$query) or die('mysql error');

                                                 while ($user = mysqli_fetch_assoc($run)) {
                                                    echo '
                                                    <tr>';

                                                    if($user['role'] == "teacher"){
                                                      echo '<td style="color:green">Teacher</td>';
                                                    }else{
                                                      echo '<td style="color:orange">Student</td>';

                                                    }
                                                      echo '<td>'.$user['name'].'</td>
                                                       <td>'.$user['fullName'].'</td>
                                                       <td>'.$user['email'].'</td>
                                                       <td>'.$user['gender'].'</td>
                                                       <td>'.$user['age'].'</td>
                                                       <td>'.$user['created_time'].'</td>
                                                       <td>
                                                       <a class="btn btn-danger" href="?delete='.$user['id'].'" onclick="return confirm(\'Are you sure you want to delete this Account?\');">Delete</a>
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



<!-- INSEST MODEL -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Full Name:</label>
            <input type="text" required name="fullName" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="email" required name="email" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">UserName:</label>
            <input type="text" required name="name" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Password:</label>
            <input type="password" max="20" min="6" required name="password" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Role Name:</label>
           <select class="form-control" name="role">
                    <option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
           </select>
          </div>
          <div class="row">
          <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Gender</label>
           <select class="form-control" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
           </select>
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Age:</label>
            <input type="Number" required name="age" class="form-control" id="recipient-name">
          </div>
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