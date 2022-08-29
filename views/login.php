<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <!--Boostrap css file is linked before the custom css file to overwrite the default properties of the bootstrap file-->
  <!--Bootsrap css file-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <style>
  .signup-form-form{ 
    margin-left: 20%; 
  }

  input[type=text], select {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=password], select {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button[type=submit] {
  width: 50%;
  background-color: #63C5DA;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button[type=submit]:hover {
  background-color: #52B2BF;
}

.signup-form{ 
  margin-top: 3%; 
  margin-left: 15%; 
}

.title > h1 { 
  margin-top: 5%;  
  margin-left: 45%; 
  margin-bottom: 5%; 
  font: bold; 
}
.border {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  padding-top: 0px;
}

#error_response{
  margin-left: 35%; 
}
</style>
</head>
  <body>
  <div class="title"> 
    <h1>Staff Login</h1> 
  </div> 
    <div class="border">
      <section class="signup-form"> 
        <div class="signup-form-form">
          <form action="../action_page_login.php" method="post">  
              <input type="text" name="uid" placeholder="Username/Email..."> 
              <input type="password" name="pwd" placeholder="Password..."> 
              <button type="submit" name="submit">Login</button> 
          </form> 
        </div>
        <div id="error_response"> 
         <?php 
             if(isset($_GET["error"])){
                if($_GET["error"] == "emptyinput"){
                    echo "<p>Fill in all fields!</p>"; 
                }
                else if($_GET["error"] == "invalidemail"){
                    echo"<p>Please insert an existing email address</p>"; 
                }
                else if($_GET["error"] == "wronglogin"){
                  echo"<p>Incorrect login information</p>"; 
                }
            }
          ?> 
      </div>
       </section> 
     </div>
</head> 
</body> 
</html> 
  