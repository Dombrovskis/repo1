<?php
require_once 'components/navbar.php';

$email = $password = "";

$success="";

if(isset($_POST['submit'])) {
$email = $_POST['regEmail'];
$password = $_POST['regPassword'];
require_once 'db.php';

$hash = password_hash($password,PASSWORD_DEFAULT);

$sql= "INSERT INTO users (email,password)VALUES('$email','$hash')";    
    if($conn->query($sql) === TRUE){   
        $success= '
                 <div class="alert alert-success" role="alert">
                 Congratulations with successful registration!
                  </div>   ';
    
            header('refresh:2; login.php');
    
    }else {
        echo 'error' . $sql . $conn->error;
    }
}
?>

<div class="container">
    <div class="log">
        <h1>Register</h1>
        <?php echo $success?>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="regEmail"/>
                <div id="emailHelp" class="form-text">
                  
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password"  class="form-control" id="exampleInputPassword1"name="regPassword" />
            </div>
            
            <!-- <div class="mb-3 form-check">
                <input type="checkbox"  class="form-check-input" id="exampleCheck1" />
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" class="btn btn-primary" name="submit">
                Submit
            </button>
            <a href="./login.php" style="margin-left: 20px">Login</a>
        </form>
    </div>
</div>

<?php
require_once 'components/footer.php';
?>
