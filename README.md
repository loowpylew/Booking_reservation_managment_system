# Booking_reservation_managment_system

This application is incomplete. The general structure of the applictaion is as follows: 

At the current time of writing, the application has not been hosted on a remote server so will have to be run locally if you would like to view the 
pages on your pc/desktop. 

You can use XXAMP to host on your windows machine. Simply copy and paste the project folder in 'htdocs' found within the XXAMP folder, start up an 
apache web server and type up 'localhost'. 

The website uses a remote server (phpmyadmin to store user input/staff login details. 

Link to server: https://www.phpmyadmin.co/index.php?db=sql8515172&table=Booking_reservation&target=sql.php

The login details to the server are provided within the mySQL_server_details.txt file. 

There is currently no way of accessing the login page and customer details page via buttons i.e. staff user clicks submit within login page to be redirected to the
customer details page. Or from the main page 'index.php' to the login page. For now, you will have to type in the directory to where the file is located.

index.php - allows customers to submit a booking reservation i.e. datetime, Name, Email and a message if they have any special requests required for the reservation. 
The date time selector is limited to the current month i.e. September and no one user can book the same datetime. If they do, the user is presented with a message 
stating that the datetime selected has already been reserved. This is achieved via querying the online database (phpmyadmin) which will compare the inputted date 
against any existing dates stored. If the dates are not identicle, all user information inputted within the form is stored within the 'booking reservations' 
table schema.

<img width="960" alt="image" src="https://user-images.githubusercontent.com/65728188/187217736-a2a6a3e2-ce18-45a6-9994-18d64b112dfe.png">

![image](https://user-images.githubusercontent.com/65728188/187218027-4fd1c27c-47d6-41ea-8fd8-cd4b3b019c42.png)

If the user does not complete all inputs, an error message will display requesting the user to fill in all fields. 
<img width="959" alt="image" src="https://user-images.githubusercontent.com/65728188/187218326-51288591-f2ce-499d-9817-ba3e503cfa7b.png">


If the email does not follow an offical email format, the user will be requested to enter in a correct email address. 
<img width="960" alt="image" src="https://user-images.githubusercontent.com/65728188/187218495-ce69e0c9-4f48-467f-b7ee-f7e9bc8cfd06.png">

<img width="959" alt="image" src="https://user-images.githubusercontent.com/65728188/187218874-28d7a719-704e-4a3a-9a08-84ead1e8e97e.png">



Improvements I would like to add to this page: 
- datetime local widget highlights times that have already been chosen. This will make it apparant to the user which date times have been selected. 
- A limit on the number of resevartions in a given hour to about 15. The assumption is that there are 20 physical tables with an excess of chairs that can 
 be provided for customers. The extra five tables will be used to componensate for a large number of customers for a given booking reservation. 
- An input so the user can provide the number of individuals they're booking for in order for the staff of the resturant to lay out the correct number of chairs
  condements, cutlery etc on and around the table/tables. 
  
login.php - This allows members of staff to login to the admin account which gives way to access to customer booking reseravtion details. 
The login page accepts 3 forms of input: 
- Username/Email 
- Password 
In the instance the email is the wrong format, and error response will be displayed stating to enter an email address. 
If the password is wrong, an error message will display stating that the login details are incorrect. 

<img width="960" alt="image" src="https://user-images.githubusercontent.com/65728188/187219010-64293492-fd6c-4486-9b33-4f2241479f98.png">


As of the time of writing, i have been experiencing issues with trying to grab the object data from the user table within the php code functions.php where the select
query searches for either a username or email and if it finds the row data that corresponds with the user input, the 'mysqli_fetch_assoc($resultData)' should return
TRUE, but the row data keeps returning NULL so it skips to the else part of the condition and returns false, displaying a login error within the login page thus
have been unable to redirect the user to the customer_details page.
 
SECTION OF CODE WHERE I EXPERIENCING THE ISSUE: 


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

customer_details.php - For now, all the user can do is view each row within the table that has been stored within the databese i.e. datetime, name, email address,
and special requests. Buttons have been provided to update/delete reservations in the case a customer decides to ammend their request or cancel their reservation. 
As of the time writing, no CRUD operations can be performed on this data. 

<img width="958" alt="image" src="https://user-images.githubusercontent.com/65728188/187219150-df67e0d3-ce23-4996-984c-9e450f7b35d7.png">

Improvements I would like to add to this page:
- Allow admin users to have the ability to update/delete reservations. 

Security measures put in place: 
To prevent SQL injection orginating from the user input form. I have used places holders i.e.  $sql = "SELECT * FROM Booking_reservation WHERE Datetime = ?";
and then binded the user input with the placeholder i.e.  mysqli_stmt_bind_param($stmt, "s", $datetime); so that no extra characters/statements can concentenated
onto the existing query. This is just one instance of this technique being used within the code. 

The login password for the admin account has been hashed using a random salt algorithm so that when the password is compared against the non-hashed user input 
value, the user input will be converted to the same hash value if the password is correct. Given web scrapers can be used to input thousands of random passwords
into user input forms, this prevents users from being able to access easily guessable passwords or ones that can be generated within a short space of time.

Further security improvemnets I would like to add: 
For obvious reasons, I would set user permissions on the customer_details.php page to prevent online users from being able to directory browse across associated 
directory paths/easy to guess. 

Limit the number of password entries. Once again , this is to prevent web scraper scripts being able to enter an unlimited number of possible passwords. 


            
