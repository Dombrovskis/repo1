<?php
session_start();
require_once 'db.php';

if(isset($_POST['stud_delete_multiple_btn'])){
    $id = $_POST['stud_delete_multiple_btn'];

    $update = "DELETE FROM posts WHERE id IN($id) ";
    $query_run = mysqli_query($conn, $update);

    if($query_run)
    {
        $_SESSION['status'] = "Selected Data Deleted Successfully";
        header("Location: profile.php");
    }
    else
    {
        $_SESSION['status'] = "Multiple Data Not Deleted";
        header("Location: profile.php");
    }
} 

