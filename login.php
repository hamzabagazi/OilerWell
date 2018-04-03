<?php 
 //Connection + database
$user = "root"; 
$password = ""; 
$host = "localhost"; 
$dbase = "oilerwellappointment"; 
session_start(); 

 // Create connection   
$mysql = mysqli_connect($host, $user, $password);

// Check connection
if (! $mysql){
      
    die ('Cloud not connect:' . mysqli_error());
    
}

if (!mysqli_select_db($mysql, $dbase)){
    echo 'Database Not Selected';
}
   

if (isset($_POST["login"])){
    
    $username= $_POST["userName"]; 
    $password= md5($_POST["password"]); 
    
    $sql = "SELECT * FROM `login_admin` WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($mysql, $sql);
    $row= mysqli_num_rows($result); 
    
    if ($row == 1)
    {
        $_SESSION["login_user"]= $username;
        header("location:adminHomePage.php");
    }
    else {
        header("location:OilerWellAdmin.php?invalid=Your username or password are incorrect. Please try again.");
    }
    
}





?> 