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
</br>
</br>
</br>
</br>
</br>
</br>


    <div class="container">
        <div class="row justify-content-center">
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

                    <?php
                        require_once 'db.php';

                            $id = $_GET['id'];
                            $query_run = mysqli_query($conn,"SELECT * FROM posts WHERE id=('$id')");
                            $row= mysqli_fetch_array($query_run);

                            if(count($_POST) > 0) {
                                mysqli_query($conn,"UPDATE posts set title='" . $_POST['title'] . "' WHERE id=('$id')");
                                $_SESSION['status'] = "Selected Data Updated Successfully";
                                header("Location: profile.php");
                            }

                        ?>
                            <br>
                        <form name="postUpdate" method="post" action="">
                            <div><?php if(isset($message)) { echo $message; } ?></div>
                            <tr>
                                <input type="text" class="form-control" name="title" value="<?= $row['title']; ?>"/>
                                <h3><td>Created at: <?= $row['created_at']; ?></td></h3>
                            </tr>
                            <th>
                                    <div class="d-grid gap-2">
                                    <button class="btn btn-success" value="Submit" type="submit" name="id">Save and Return</button>
                                    </div>
                                
                            </th>
                        </form>
                </div>
            </div>
        </div>

    </div>
</div>



<?php
require_once 'components/footer.php';
?>
