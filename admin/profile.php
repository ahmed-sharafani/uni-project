<?php
require_once 'header.php';

// get data from session
$username = $_SESSION['username'];

$query="SELECT * FROM accounts where `name` = '$username' limit 1";
$run = mysqli_query($con,$query) or die('MYSQL ERROR');
$user = mysqli_fetch_assoc($run);

if(isset($_POST['sendForm'])){

  $name = $_POST['name'];
  $fullName = $_POST['fullName'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $age = $_POST['age'];
  $role = $_POST['role'];


  $password = $_POST['password'];
  if($password == ""){
    $hashpass = $user['password'];
  }else{
    $hashpass=password_hash($password , PASSWORD_DEFAULT); //hashing or encrpting the password inside the db

  }


  $query="UPDATE accounts
  SET
  `name` = '$name',
  `fullName` = '$fullName',
  `email` = '$email',
  `gender` = '$gender',
  `password` = '$hashpass',
  `age` = '$age'
  WHERE `name` = '$username'";
  $run = mysqli_query($con,$query) or die('MYSQL ERROR');
  header('location:profile.php');
  exit;
}




?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Profile</h1>
                        <hr>
                        <div class="card mb-4">

                            <div class="card-body">
                                <div class="table-responsive">
                                <div class="container bootstrap snippets bootdey">

	<div class="row">

      <div class="col-md-12">
        <!-- <form class="form-horizontal" role="form"> -->
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

<div class="form-group">
  <label for="recipient-name" class="col-form-label">Full Name:</label>
  <input type="text" required name="fullName" value="<?=$user['fullName']?>" class="form-control"  >
</div>
<div class="form-group">
  <label for="recipient-name" class="col-form-label">Email:</label>
  <input type="email" required name="email" value="<?php echo $user['email']?>" class="form-control"  >
</div>
<div class="form-group">
  <label for="recipient-name" class="col-form-label">UserName:</label>
  <input type="text" required name="name" value="<?=$user['name']?>" class="form-control"  >
</div>
<div class="form-group">
  <label for="recipient-name" class="col-form-label">Password: (Leave It Blank If You Don't Want To change</label>
  <input type="password" value="" max="20" min="6" name="password" class="form-control"  >
</div>

<div class="row">
<div class="form-group col-md-6">
  <label for="recipient-name" class="col-form-label">Gender</label>
 <select class="form-control" value="<?=$user['gender']?>" name="gender">
          <option value="male">Male</option>
          <option value="female">Female</option>
 </select>
</div>
<div class="form-group col-md-6">
  <label for="recipient-name" class="col-form-label">Age:</label>
  <input type="Number" required value="<?=$user['age']?>" name="age" class="form-control"  >
</div>
</div>

<input name="sendForm" value="Update Profile" type="submit" class="btn btn-primary"/>
</form>

      </div>
  </div>
</div>
<hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>



<?php
require_once 'footer.php';
?>
