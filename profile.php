<?php
session_start();

//if check login
if($_SESSION['logedin'] !== TRUE){
    header('location: login.php');
    exit();
}
// if(isset ($_POST ['submit'])){
//     session_destroy();
//     header('refresh:1; login.php');
// }
require_once 'create.php';
require_once 'components/navbar.php';

?>
<div class ="container">
    <h2>
        <?php echo "Welcome back  " . $_SESSION ['email']; echo " !"?>
    </h2>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Welcome to your personal todolist</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-12">

                <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        unset($_SESSION['status']);
                    }
                ?>

                        
            <form action="" onsubmit="return validateForm()" method="POST" >
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"></label>
                <input type="text"required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a New task Here" name="title"/>
            
            </div>
            
            <button type="submit" class="btn btn-success" name="create" >
                Save new Task
            </button>    
        </form>
</div>
            <br>
            <br>
                <div class="card mt-4">
                    <div class="card-body">
                        <form action="del.php" method="POST">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                        </th>
                                        <th style=" text-align: center;">My Task</th>
                                        <th>Creation Date</th>
                                        <th>
                                            Input 
                                        </th>
                                        <th>
                                            Input 
                                        </th>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <?php
                                        require_once 'db.php';
                                        $query = "SELECT * FROM posts";
                                        $query_run  = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($query_run) > 0) {
                                            foreach($query_run as $row) {
                                                ?>
                                                <tr>
                                                    <td style="width:10px; text-align: center;">
                                                    </td>

                                                    <td><?= $row['title']; ?></td>
                                                    <td><?= $row['created_at']; ?></td>
                                                    <td>
                                                        <a class="btn btn-warning" href="./update.php?id=<?= $row['id']; ?>">
                                                            Edit
                                                        </a>
                                                    </td>
                                                    <th>
                                                        <button type="submit" name="stud_delete_multiple_btn" value="<?= $row['id']; ?>" class="btn btn-danger">Delete</button>
                                                    </th>
                                                </tr>
                                                <?php 
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="5">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                   
                   
                    </div>
                
                                         <form action="" method="post">
                                    <div class="d-grid gap-2">
                                    <button class="btn btn-danger" value="Submit" type="submit" name="delete">DELETE ALL TASKS</button>
                                    </div></form>

                                            
                
                </div>
            </div>
            
        </div>
    </div>
<?php
require_once 'db.php';

if(isset($_POST['delete'])){
$user_id = $_SESSION['id'];
$del = "DELETE FROM posts WHERE user_id='$user_id'";

if ($conn->query($del) === TRUE) {
  echo "Record deleted successfully";
  echo("<meta http-equiv='refresh' content='1'>"); //Refresh by HTTP 'meta'
} else {
  echo "Error deleting record: " . $conn->error;
}

}

?>
<?php

require_once 'components/footer.php';
?>

       