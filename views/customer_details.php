<?php
    session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <!--<link rel="stylesheet" href="../css/desktop_friendly.css">-->
    <link rel="stylesheet" media="screen and (max-width: 1024px)" href="../css/mobile_friendly.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"> 
    <title>Customer_details_page</title>
<head> 

<body style="margin: 50px";> 
<h1>Customer Details Manager</h1>
    <br> 
    <table class="table">
        <thread> 
            <tr> 
                <th>ID</th> 
                <th>Datetime</th> 
                <th>Name</th> 
                <th>Email</th> 
                <th>Message<th> 
            </tr>
        </thread>

        <tbody> 
            <?php 
                $host = "sql8.freesqldatabase.com";

                $dbname = "sql8515172";
                
                $username = "sql8515172";
                
                $password = "5I4KLZjtPL";

                $connection = new mysqli($host, $username, $password, $dbname);

                if (!$connection) {

                    die("Connection failed: " . mysqli_connect_error());
                 
                 }

                //reads all rows from connected database (phpmyadmin)
                $sql = "SELECT * FROM Booking_reservation"; 
                $result = $connection->query($sql);

                if(!$result) {
                    die("Invalid query" . $connection->error); 
                }

                //read data of each row
                while($row =$result->fetch_assoc()){ 
                    echo "<tr> 
                              <td>" . $row["ID"] . "</td> 
                              <td>" . $row["Datetime"] . "</td>
                              <td>" . $row["Name"] . "</td> 
                              <td>" . $row["Email"] . "</td>
                              <td>" . $row["Message"] . "</td>
                              <td>
                                  <a class='btn btn-primary btn-sm' href='update'>Update</a>
                                  <a class='btn btn-danger btn-sm'href='delete'>Delete</a>
                              <td> 
                          </tr>";
                }
            ?>
        </tbody>
    </table>  
</body> 
</html> 