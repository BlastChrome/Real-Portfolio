<?php

//Variables for connecting to the local server
$servername = "localhost";  
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName = "portfoliodb"; 

//using myswli_connect to create a detabase connection
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);  

//Checking for connection failure
if(!$conn){
    die("Connection Failed: ".mysqli_coonect_error());
}