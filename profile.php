<?php

session_start();
//if check login
if($_SESSION['logedin'] !== TRUE){
    header('location: login.php');
        exit();
}
require_once 'create.php';
require_once 'components/navbar.php';
?>

<h4  style=" text-align: center; margin-top: 40px;">
  <?php echo "Hello " . $_SESSION ['email']; echo " !"?>
</h4>


<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 style=" text-align: center;">Hope here will be todolist</h4>
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
                <input type="text"required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title"/>
                <div id="emailHelp" class="form-text">
                    New todo list
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" name="create" >
                Create a new Task.
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
                                        <!-- <form action="del.php" method="POST"> -->
                                        <th>
                                            <button type="submit" name="stud_delete_multiple_btn" class="btn btn-danger">Delete</button>
                                        </th>
                                    <!-- </form> -->
                                        <!-- <th>ID</th>
                                        <th>Name</th> -->
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

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
                                                ?>
                                                <!-- <div class="checkbox-group required"> -->
                                                <tr>
                                                    <td style="width:10px; text-align: center;">
                                                        <input type="checkbox" name="stud_delete_id[]" value="<?= $row['id']; ?>">
                                                    </td>
                                                    <!-- <td><?= $row['id']; ?></td> -->
                                                    <!-- <td><?= $row['user_id']; ?></td> -->
                                                    <td><?= $row['title']; ?></td>
                                                    <td><?= $row['created_at']; ?></td>
                                                    <form action="edit.php" method="POST">
                                                    <td><input type="text" class="form-control" name="edit"/></td>

                                                    <td><button type="submit" name="edit" class="btn btn-success" value="<?= $row['id']; ?>">Edit</button></td>
                                                    </form>

                                                </tr>   

                                                <!-- <div> -->
                                                     <!-- <a href="http://jquery.com/">jQuery</a>
                                                        <script src="jquery.js"></script>
                                                        <script>
                                                    
                                                        $( document ).ready(function() {
                                                            $( "a" ).click(function( event ) {
                                                                alert( "The link will no longer take you to jquery.com" );
                                                                event.preventDefault();
                                                            });
                                                        });
                                                    
                                                        </script>
                                                        <script >
                                                            $cbx_group = $("input:checkbox[name^='group']");
                                                                $cbx_group.on("click", function() {
                                                                    if ($cbx_group.is(":checked")) {
                                                                        // checkboxes become unrequired as long as one is checked
                                                                        $cbx_group.prop("required", false).each(function() {
                                                                            this.setCustomValidity("");
                                                                        });
                                                                    } else {
                                                                        // require checkboxes and set custom validation error message
                                                                        $cbx_group.prop("required", true).each(function() {
                                                                            this.setCustomValidity("Please select at least one checkbox.");
                                                                        });
                                                                    }
                                                                });
                                                        </script> -->



                                                    
                                                    
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
                </div>
            </div>
            
        </div>
    </div>



<?php
require_once 'db.php';

if(isset($_POST['delete_all'])){
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
<form action="" method="post">
<button name="delete_all" style="margin-left:61px" class="btn btn-danger">DELETE ALL POSTS</button></form>
<!-- 
<form action="" method="post">
<a href="last.php" class="done-button" name="delete">DELETE ALL POSTS 2</a></form>

<?php
require_once 'components/footer.php';
?>


