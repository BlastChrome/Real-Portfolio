<?php 
if(isset($_POST['hSubmit'])){ 
    require 'cdbh.inc.php';  

    //taking user input from forms; assigning data to variables
    $hireName = $_POST['hname'];
    $hireEmail = $_POST['hemail'];
    $hireContact = $_POST['hcontact'];
    $hireSite = $_POST['hsite']; 
    $hireHear = $_POST['hhear'];
    $hirePrice = $_POST['hprice'];  
    $hireDate = $_POST['hdate'];
    $hireMessage = $_POST['hproposal'];   

    // Error Handlers 

    // Checking for empty field submit
    if(empty($hireName) || empty($hireEmail)){
        header("Location: ../hire.html?error=emptyforms"."&hname=".$hireName."&hemail=".$hireEmail.
                                                         "&hcontact=".$hireContact.
                                                        "&hsite=".$hsite."&hprice=".$hirePrice.
                                                        "&proposal=".$hireMessage);
        exit();
    } 
    // Checking for invalid email and website  
    elseif(!filter_var($hireEmail, FILTER_VALIDATE_EMAIL) && !filter_var($hireSite, FILTER_VALIDATE_URL)){
        header("Location: ../hire.html?error=invalidmailsite&hemail=".$hireEmail."&hproposal=".$hireMessage); 
        exit(); 
    }  
    // checking for invalid email
    elseif(!filter_var($hireEmail, FILTER_VALIDATE_EMAIL)){
        header("Location: ../hire.html?error=invalidmail&hemail=".$hireEmail); 
        exit(); 
    }  
    //checking for an invalid website
    elseif(!filter_var($hireSite, FILTER_VALIDATE_URL)){
        header("Location: ../hire.html?error=invalidsite&hsite=".$hireSite); 
        exit();
    }  

    //insert data into database using prepared statements 

    else{
        // insert user into the database 
        $sql = "INSERT INTO hire (hName, hEmail, hContact, hSite, hHear, hPrice, hDate, hProposal)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        //create prepared statement 
        $stmt = mysqli_stmt_init($conn);   

        //check for connection failure 
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../hire.html?error=sqlerror"); 
            exit(); 
        }  else{
            // finallly send data to database
            mysqli_stmt_bind_param($stmt, "ssssssss", $hireName,$hireEmail, $hireContact, $hireSite, $hireHear, $hirePrice, $hireDate, $hireMessage); 
            mysqli_stmt_execute($stmt); 
            header("Location: ../hire.html?contact=success"); 
            exit(); 
        }
    } 


    //Closing the database connection
    mysqli_stmt_close($stmt); 
    mysqli_close($conn);
    
} 
// Sends the user back to the hire page, if they access the php file w/o pressing submit
else{
    header("Location: ../hire.html"); 
    exit();   
}