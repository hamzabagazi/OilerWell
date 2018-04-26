<?php
session_start(); 

//Connection + database
$user = "root"; 
$password = ""; 
$host = "localhost"; 
$dbase = "oilerwellappointment"; 


 // Create connection   
$mysql = new mysqli($host, $user, $password);

// Check connection
if (! $mysql){
      
    die ('Cloud not connect:' . mysqli_error());
    
}

if (!mysqli_select_db($mysql, $dbase)){
    echo 'Database Not Selected';
}



$status='display:none;';
$firstName = "first";
$lastName = "last";
$email = "email";
$phone = "none";
$dateTime="dateTime";
$blood = "bloodAns";

//get the email and code number to view the appointment
if (count($_GET)>0)
{
    
$emailPost =  htmlspecialchars (trim($_GET['email']));

$codePost =  htmlspecialchars ($_GET['code']);


$sql = "SELECT * FROM `users` WHERE email = '$emailPost' AND code = '$codePost'";

 $result = mysqli_query($mysql, $sql);
//make sure there is matching result in the database
 if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
  
         
         $GLOBALS['firstName'] = trim($row["firstName"]);
         $GLOBALS['lastName']= trim($row["lastName"]);
         $GLOBALS['email'] = trim($row["email"]);
         $GLOBALS['phone'] = trim($row["phone"]);
         $GLOBALS['dateTime'] = trim($row["dateTime"]);
         $GLOBALS['blood'] = trim($row["blood"]);
         $_SESSION['purpose'] = "change"; 
         $status = 'none';
         
        
        
         
     }
     
 }
 
 else {
     
     echo '<script language="javascript">';
        echo 'alert("No results match your input. please make sure you input the right Email and Code")';
        echo '</script>';
             
    }
 
 
}
// if the user request a change appointment request
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
       global $firstName; 
    global $lastName; 
    global $email; 
    global $phone; 
    global $blood;
     $_SESSION['firstName']= $_POST['firstName'];   
    $_SESSION['lastName'] =  $_POST['lastName'];
    $_SESSION['email']= $_POST['email'];
    $_SESSION['phone'] =  $_POST['phone'];
    $_SESSION['drawblood'] = $_POST['drawblood'];
    header("location: DateAndTime.php"); 
     
 }





?>


<!DOCTYPE html>
<html lang="en">
 <head>
       <title>Change-OilerWell</title>
      
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <script src="modernizr.custom.40753.js"></script>
      <link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
	   <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="styles.css">
	  <link rel="shortcut icon" href="images/oilerwell_logo_icon.ico">
   </head>
   
   <body>
   <header>
         
         <h1><a href="main.html"><img src="images/OilerWell_Logo_resized.png" width="859" height="267" alt=" OilerWell Main logo"></a></h1>
		  
   </header>
   
   <nav class="sitenavigation">
   
   
       
			<div class="wrapper">
               <span class="square">
               <a class="tenth before after" href="main.html"> Home</a>
              </span>
              </div>
			  <div class="wrapper">
				<span class="square">
				     <a class="tenth before after" href="guidelines.html"> Guidelines </a>
				</span>
			  </div>
                <div class="wrapper">
				<span class="square">
			      <a class="tenth before after" href="ScheduleAppt.php"> Schedule Appointment </a>
				</span>
			  </div>
               <div class="wrapper">
				<span class="square">
			       <a class="tenth before after" href="changeAppt.php"> View/Change Appointment </a>
				</span>
			  </div>
               <div class="wrapper">
				<span class="square">
			       <a class="tenth before after" href="location.html"> Location </a> 
				</span>
			  </div>
        
   </nav>
   
   
  <article>
        <div class="container">
		<h2> View/Change An Appointment </h2> 
		<p class="generalP"> Enter the email you used to sign-up and the confirmation code from the email.  </p>
                <form  action="ChangeAppt.php" method="get">
		     <fieldset class ="requiredInfoChange">
				
				<label for="emailinput">
					<p class= "labelP" style="display: block">Email:</p>
					<input type="email" name="email" id="emailinput"
					placeholder="Email" required >
				</label>
				<label for="confirmationCodeinput">
					<p class= "labelP">Confirmation Code: <small>(provided in confirmation email)</small></p>
					<input type="tel" name="code" id="codeInput" placeholder="Code"   maxlength="5" required >
					    <input type="submit" id="goButton" value="View">
				</label>
				 
				</fieldset>
			  </form>
                
                
                <form action="ChangeAppt.php" method="POST"> 
				 
                    <div class="summary-preview"  style="<?php echo  $status; ?>">
                      <div class="table-row">
                     <div class="table-cell">
                       <p>Name:</p>
                     </div>
                       <div class="table-cell">
                         <p> <?php  echo $firstName ?> <?php  echo $lastName ?>  </p>
                       </div>
                   </div>
				   <div class="table-row">
                     <div class="table-cell">
                       <p>Email:</p>
                     </div>
                       <div class="table-cell">
                         <p> <?php  echo $email ?></p>
                       </div>
                   </div>
				   <div class="table-row">
                     <div class="table-cell">
                       <p>Phone:</p>
                     </div>
                       <div class="table-cell">
                         <p> <?php  echo $phone ?></p>
                       </div>
                   </div>
				   
				  
				   <div class="table-row">
                     <div class="table-cell">
                       <p>Appointment Time:</p>
                     </div>	
                       <div class="table-cell">
                       
                          <p > <?php  echo date_format(date_create($dateTime), 'g:ia \o\n l F jS Y'); ?>  </p>  
                       </div>
                   </div>
				  
 
	</div>
     <!-- pass all the user info from variables to session variables -->          
           <input type="hidden" name="firstName" value=" <?php echo $firstName;?>" >
		
           <input type="hidden" name="lastName" value=" <?php echo $lastName;?>">
				
           <input type="hidden" name="email" value=" <?php echo $email;?>">
				
            <input type="hidden" name="phone" value=" <?php echo $phone;?>">
		
            <input type="hidden" name="drawblood" value=" <?php echo $blood;?>">
            
            <input type="hidden" name="dateTime" value=" <?php echo $dateTime;?>">
		  
				
                <fieldset class="nextButton">
               <input type="submit" id="nextButton" value="Change" style="float: right; <?php echo  $status; ?>" >
                   </fieldset>
		  </form>
		</div> 
   
    </article>
	<footer>
       <p class="footerP"> 120 West Foulke Ave, Findlay, OH 45840 | (419) 434-4550 | cosiano@findlay.edu</p>
	   
	   </footer>
	</body>
   </html>