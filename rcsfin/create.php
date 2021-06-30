<?php

if(isset($_POST['create'])){

    $title = $_POST['title'];
    $user_id = $_SESSION['id'];
     require_once 'db.php';
     $sql= "INSERT INTO posts (user_id, title) VALUES ('$user_id','$title')";

     if($conn->query($sql) === TRUE){
        //  echo 'done';
     }else {
         echo 'not done';
     }
}

?>