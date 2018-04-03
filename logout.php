<?php 

session_start(); 
session_destroy(); 

header("location:oilerWellAdmin.php?logout=You are sucessfully logged out!"); 


?> 