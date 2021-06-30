<?php

function emptyInputSingup($email,$password){
$result;

if(empty($email) || empty($password)){
    $result= true;
    
}
else{
    $result = false;
}
return $result;
}

function invalidEmail($email){
$result;

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $result= true;
    
}
else{
    $result = false;
}
return $result;
}


function invalidDB($conn,$email) 
{
    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(mysqli_stmt_prepare($stmt, $sql)) {
    header("location: index.php?error=stmt");
        exit();
    }
   mysqli_stmt_bind_param($stmt,"s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

      if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
        }         
    else {
      $result = false;
    return $result;
    }
    mysqli_stmt_close($stmt);
    header("location: index.php?error=nice");
        exit();

}

// function createUser($conn,$email){


//     $sql = "INSERT INTO users (email,password) VALUES (?,?,)";{
//     $stmt = mysqli_stmt_init($conn);
//     if(mysqli_stmt_prepare($stmt, $sql))){
//     header("location: index.php?error=stmt");
//         exit();
//     }
//    mysqli_stmt_bind_param($stmt,"ss", $email,$password);
//         mysqli_stmt_execute($stmt);


//     $resultData = mysqli_stmt_get_result($stmt);
// if($row = mysqli_fetch_assoc($resultData)){
//  return $row;
// }  
// else{
//       $result = false;
//     return $result;

// }
// mysqli_stmt_close($stmt);
// }