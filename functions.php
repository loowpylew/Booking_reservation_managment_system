<?php
function emptyInputEntry($datetime, $name, $email, $message){
    $result;
    if(empty($datetime) || empty($name) || empty($email) || empty($message)) {
      $result = True; 
    }
    else {
        $result = False; 
    }
    return $result; 
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $result = True; 
    }
    else {
        $result = False; 
    }
    return $result; 
}

function datetimeCloneChecker($conn, $datetime){

    $sql = "SELECT * FROM Booking_reservation WHERE Datetime = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        die(mysqli_connect_error($conn));
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $datetime); 
    mysqli_stmt_execute($stmt); 

    $resultData = mysqli_stmt_get_result($stmt); 

    if($row = mysqli_fetch_assoc($resultData)){
        return $row; 
    }
    else{
        $result = False; 
        return $result; 
    }
    mysqli_stmt_close($stmt); 
    
}

function uidExists($conn, $username, $email){
    $sql = "SELECT * FROM user WHERE username = ? OR email = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: view/login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email); 
    mysqli_stmt_execute($stmt); 

    $resultData = mysqli_stmt_get_result($stmt); 

    if($row = mysqli_fetch_assoc($resultData)){ // issue here: doesnt seem to return object data found within
                                               // the given rows of the table 'user'.
        return $row; 
    }
    else {
        $result = False; 
        return $result; 
    }
    mysqli_stmt_close($stmt); 

}

///////////////////////////////////for login////////////////////////////////////////
function emptyInputLogin($username, $pwd){
    $result;
    if(empty($username) || empty($pwd)) {
      $result = True; 
    }
    else {
        $result = False; 
    }
    return $result; 
}

function loginUser($conn, $username, $pwd){

    $uidExists = uidExists($conn, $username, $username); 

    if($uidExists === False) { 
        header("location: views/login.php?error=wrongloginUid");
        exit(); 
    }

    //$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); // random salt added
    $pwdHashed = $uidExists["password"]; 
    $checkpwd = password_verify($pwd, $pwdHashed); 

    if($checkpwd === False){ 
        header("location: views/login.php?error=wronglogin");
        exit();
    }
    else if($checkpwd === True){  
        session_start();
        $_SESSION["userid"] = $uidExists["username"]; 
        header("location: views/customer_details.php?login=success"); 
        exit(); 
    }
    else { 
        header("location: views/login.php?error=wronglogin");
        exit();
    }
}
?>

