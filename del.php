
<?php
session_start();
require_once 'db.php';

// if(isset($_POST['checkbox_name']) && $_POST['checkbox_name']!="")
// {
//     echo 'checkbox is checked'; 
// }

if(isset($_POST['stud_delete_multiple_btn'])){
    // if(){


    // }

    $all_id = $_POST['stud_delete_id'];
    $extract_id = implode(',' , $all_id);
    // // echo $extract_id;

    // $all_id = isset($_POST['stud_delete_multiple_btn']) && is_array($_POST['stud_delete_multiple_btn']) ? $_POST['stud_delete_multiple_btn'] : [];
    // $extract_id =implode(',', $all_id);

    $query = "DELETE FROM posts WHERE id IN($extract_id) ";
    $query_run = mysqli_query($conn, $query);

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
?>



<!-- <?php
// if(isset($_POST['delete']))
// {
//     $id = $_POST['id'];

//     $query = "DELETE FROM student WHERE id='$id' ";
//     $query_run = mysqli_query($connection, $query);

//     if($query_run)
//     {
//         echo '<script> alert("Data Deleted"); </script>';
//         header("location:index.php");
//     }
//     else
//     {
//         echo '<script> alert("Data Not Deleted"); </script>';
//     }
// }

?> -->