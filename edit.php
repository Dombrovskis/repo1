
<?php
session_start();
require_once 'db.php';



if(isset($_POST['stud_edit_multiple_btn'])){

    
   
        $id = $_POST['id'];
        $title= $_POST['title'];
        $created_at = $_POST['created_at'];                 

        $query = "UPDATE posts SET id='$id', title='$title', created_at='$created_at' WHERE id='$id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
         {
         echo '<script> alert("Data Updated"); </script>';
         header("location:index.php");                                      
         }
         else
        {
        echo '<script> alert("Data Not Updated"); </script>';
         }
                    }
?>

