<?php
if(isset($_POST["submit"])){ 
    
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'db_connection.php';
    require_once 'functions.php'; 
   
    if(emptyInputLogin($username, $pwd) != False) { 
       header("location: views/login.php?error=emptyinput");
       exit(); 
    }

    uidExists($conn, $username, $username);
}
else {
    header("location: views/login.php");
    exit(); 
}
    
?> 
}
 
 
