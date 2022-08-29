<?php

$host = "sql8.freesqldatabase.com";

$dbname = "sql8515172";

$username = "sql8515172";

$password = "5I4KLZjtPL";

// Create connection

$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection

if (!$conn) {

   die("Connection failed: " . mysqli_connect_error());

}

echo "Connected successfully";

$mysqli = new mysqli($host, $username, $password, $dbname);

?>