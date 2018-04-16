<?php 
//loguot from the admin page 
session_start(); 
session_destroy(); 

header("location:oilerWellAdmin.php?logout=You are sucessfully logged out!"); 


?> 