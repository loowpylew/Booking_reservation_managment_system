<?php

$datetime = $_POST["datetime"];
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"]; 

var_dump($datetime, $name, $email, $message);

if(isset($_POST["submit"])){ 
    
    $datetime = $_POST["datetime"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    var_dump($datetime, $name, $email, $message);

    require_once 'db_connection.php';
    require_once 'functions.php'; 
   
    if(emptyInputEntry($datetime, $name, $email, $message) != False) { 
       header("location: views/index.php?error=emptyinput");
       exit(); 
    }
    
    if(invalidEmail($email) != False) { 
       header("location: views/index.php?error=invalidemail");
       exit(); 
     }

    $result = $mysqli->query("SELECT COUNT(Datetime) FROM Booking_reservation");

    $no_of_entries = $result->fetch_array()[0] ?? '';

    if($no_of_entries == 0) {
        $sql = "INSERT INTO Booking_reservation (Datetime, Name, Email, Message) VALUES (?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($conn); 

        if (! mysqli_stmt_prepare($stmt, $sql)){
            die(mysqli_connect_error($conn));
        }


        mysqli_stmt_bind_param($stmt, "ssss", 
                               $datetime,
                               $name, 
                               $email, 
                               $message);

        mysqli_stmt_execute($stmt);

        echo "Record saved";


    }
    else if ($no_of_entries >= 1){ 
        $matches = datetimeCloneChecker($conn, $datetime);

        if($matches == True) { 
            header("location: views/index.php?error=reservation_taken");
            exit(); 
        }
        else {
            $sql = "INSERT INTO Booking_reservation (Datetime, Name, Email, Message) VALUES (?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($conn); 

            if (! mysqli_stmt_prepare($stmt, $sql)){
                die(mysqli_connect_error($conn));
            }


            mysqli_stmt_bind_param($stmt, "ssss", 
                                   $datetime,
                                   $name, 
                                   $email, 
                                   $message);

            mysqli_stmt_execute($stmt);

            echo "Record saved";
            
        }
    }
}
else {
    header("location: views/index.php");
    exit(); 
}
    
?> 
 
 
