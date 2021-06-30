<?php
session_start();


require_once 'components/navbar.php';
    $dangerr ="";
    $success ="";
    $wrongpass ="";
    if (isset($_POST['submit'])){ 
    $email = $_POST['logEmail'];
    $password = $_POST['logPassword'];

    require_once 'db.php';
    $sql="SELECT id, email, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    

       
   if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (password_verify($password,$row['password'])){
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['logedin'] = true;
        $success= '
                 <div class="alert alert-success" role="alert">
                 Welcome to your TODO list!
                  </div>   ';
        header('location: profile.php');
        
    } else {
       $wrongpass= '<div class="alert alert-danger" role="alert">
        Oops , This Password is wrong!
        </div>';
    }
    } else {
        $dangerr= '<div class="alert alert-danger" role="alert">
        Oops , This Email is not registrated on this website!
        </div>';
    }
} 
?>

<div class="container">
    <div class="log">
        <h1>Login</h1>
        <?php echo $success,$dangerr,$wrongpass?> 
        
        <form action="" onsubmit="return validateForm()" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="logEmail"/>
                <div id="emailHelp" class="form-text">
                    We'll never share your email with anyone else.
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" required class="form-control" id="exampleInputPassword1"name="logPassword" />
            </div>
            <!-- <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" class="btn btn-primary" name="submit">
                Submit
            </button>
            <a href="./index.php" style="margin-left: 20px">Register</a>
        </form>
    </div>
</div>

<?php

require_once 'components/footer.php';
?>
