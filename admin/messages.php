
<?php


require_once 'header.php';
Per("admin");


if(isset($_GET['delete'])){
    $id = (int)$_GET['delete']; 
    $query="DELETE FROM messages WHERE message_id = $id";
    $run = mysqli_query($con,$query) or die('MYSQL ERROR');
}


?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Contact Messages</h1>
                        <hr>
                        <div class="card mb-4">

                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                    <th>firstname</th>
                                                    <th>lastname</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>message</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                 $query = "SELECT * from messages order by message_id DESC";
                                                 $run = mysqli_query($con,$query) or die('mysql error');

                                                 while ($user = mysqli_fetch_assoc($run)) {
                                                    echo '<tr>
                                                      <td>'.$user['firstname'].'</td>
                                                        <td>'.$user['lastname'].'</td>
                                                        <td>'.$user['email'].'</td>
                                                        <td>'.$user['phone'].'</td>
                                                        <td>'.$user['message'].'</td>
                                                        <td>'.$user['create_date'].'</td>
                                                       <td>
                                                       <a class="btn btn-danger" href="?delete='.$user['message_id'].'" onclick="return confirm(\'Are you sure you want to delete this Account?\');">Delete</a>
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



<?php
require_once 'footer.php';
?>