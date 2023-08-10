
<?php

require_once 'header.php';
Per("admin");

if(isset($_POST['sendForm'])){
    $class_name = $_POST['class_name'];
    $query="INSERT into class(class_name) values ('$class_name')";
    $run = mysqli_query($con,$query)or die('mysql_error');
}

if(isset($_GET['delete'])){
     echo "hi";
    $ide = (int)$_GET['delete']; 
    $query="DELETE FROM class WHERE class_id =".$ide;
    $run = mysqli_query($con,$query) or die('mysql_error');
    $query="DELETE FROM exams WHERE class_id =".$ide;
    $run = mysqli_query($con,$query) or die('mysql_error');
}
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">EXAM Categories</h1>
                        <hr>
                        <div class="card mb-4">
                            <div class="card-header">
                               <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-table mr-1"></i>Add New Exam Type</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Exam Category id</th>
                                                <th>Exam Category Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                             <?php
                                                 $query = "SELECT * FROM `class` order by class_id DESC";
                                                 $run = mysqli_query($con,$query) or die('mysql error');

                                                 while ($user = mysqli_fetch_assoc($run)) {
                                                    echo '
                                                    <tr>
                                                      <td>'.$user['class_id'].'</td>
                                                      <td>'.$user['class_name'].'</td>
                                                       <td>
                                                       <a class="btn btn-danger" href="?delete='.$user['class_id'].'" onclick="return confirm(\'Are you sure you want to delete this Exam Type, all related exams will be deleted too?\');">Delete</a></td>
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



<!-- INSEST MODEL -->          <!-- insert new category -->          

<div class="modal fade" id="exampleModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Exam Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Exam Type Name:</label>
            <input type="text" required name="class_name" class="form-control" id="recipient-name">
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