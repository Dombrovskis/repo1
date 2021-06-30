<?php

if (isset($_POST["submit"])){
    $email = $_POST['regEmail'];
    $password = $_POST['regPassword'];
    require_once 'db.php';
    require_once 'func.php';



    if(emptyInputSingup($email,$password) !== false){
        header("location: index.php?error=emtyinput");
        exit();
    }
    if (invalidEmail($email) !== false){
         header("location: index.php?error=emtyinput");
        exit();

    }
    if (invalidDB($conn,$email) !== false){
         header("location: index.php?error=emtyinput");
        exit();

    }
    // createUser($conn,$email,$password);
}
else {
    header("location: index.php");
        exit();

}