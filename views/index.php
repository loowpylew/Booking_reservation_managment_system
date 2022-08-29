<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../css/desktop_friendly.css">

	  <link rel="stylesheet" media="screen and (max-width: 1024px)" href="../css/mobile_friendly.css">
    <title>Restaurant Managment System</title>
<head> 

<h1>The Hoe and Spicy Kitchen</h1>

<form action="../action_page_index.php"  method="post" id="reservation_form">
  <label style="font-size: 29px" for="booking_reservation">Book Reservation:</label>
  <input style="font-size: 29px" type="datetime-local" id="booking_reservation" min="2022-09-01T08:30" max="2022-09-30T23:30" name="datetime">
  <label style="font-size: 29px" for="name"> Name: </label> 
  <input style="font-size: 28px" type="text" id="customer name" placeholder="Your Name" name="name">
  <label style="font-size: 29px" for="email">Email: </label>
  <input style="font-size: 28px" type="text" id="email" placeholder="Email address" name="email">
  <label style="font-size: 29px" for="message">Special requests:</label>
  <textarea style="font-size: 28px" id="message" placeholder="Message" name="message"></textarea>
  <input style="font-size: 28px" type="submit" name="submit">
</form>
<div id="error_response" style="color: whitesmoke"> 
  <?php
  if(isset($_GET["error"])){
      if($_GET["error"] == "emptyinput"){
        echo "<p>Fill in all fields!</p>"; 
      }
      else if($_GET["error"] == "invalidemail"){
        echo"<p>Please insert an existing email address</p>"; 
      }
      else if($_GET["error"] == "reservation_taken"){
        echo"<p>Reservation date and time is unavailable.<p>";
        echo"<p>Please try again.<p>";
      }
  }
?> 
</div>
</body>
</html>
