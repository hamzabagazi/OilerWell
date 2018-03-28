<?php

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
$phone = "5";
$dateTime="dateTime";
$blood = "bloodAns";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
$emailPost = trim($_POST['email']);

$codePost = $_POST['code'];


$sql = "SELECT * FROM `users` WHERE email = '$emailPost' AND code = '$codePost'";

 $result = mysqli_query($mysql, $sql);

 if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
         $id= trim($row["id"]);
         $firstName = trim($row["firstName"]);
         $lastName = trim($row["lastName"]);
         $email = trim($row["email"]);
         $phone = trim($row["phone"]);
         $dateTime = trim($row["dateTime"]);
         $blood = trim($row["blood"]);
         $code = trim($row["code"]);
         $status = 'none';
        
         
     }
     
 }
 
 else {
     
     echo '<script language="javascript">';
        echo 'alert("No results match your input. Plese make sure you input the right Email and Code")';
        echo '</script>';
             
 }
//$success = database_insert(sprintf("insert into registrations (sname, pname) values ('%s','%s')", $sname, $pname));
//if ($success == true)
//redirect_to('Success.php');
// if first display, or error, the html below will show.
// on error, text boxes will have previously entered values.
}

 function convert ($dateTime){
        
        $fomattedDateTime=  date_create($dateTime);
        
        return $fomattedDateTime;
    }
?>


<!DOCTYPE html>
<html lang="en">
 <head>
       <title>OilerWell</title>
      <!-- 
         Lakeland Reeds Bed & Breakfast main web page
         Filename: index.html

         Author:   
         Date:     
         
      -->
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
                <form  action="ChangeAppt.php" method="post">
		     <fieldset class ="requiredInfoChange">
				
				<label for="emailinput">
					<p class= "labelP" style="display: block">Email:</p>
					<input type="email" name="email" id="emailinput"
					placeholder="Email" required >
				</label>
				<label for="confirmationCodeinput">
					<p class= "labelP">Confirmation Code:</p>
					<input type="tel" name="code" id="codeInput" placeholder="Code"   maxlength="5" required >
					    <input type="submit" id="goButton" value="View">
				</label>
				 
				</fieldset>
			  </form>
                
                
                <form action="DateAndTime.php" method="post"> 
				 
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
                        <!-- <p class="summary-date" class="summary-time"></p> --> 
                          <p > <?php  echo date_format(convert($dateTime), 'g:ia \o\n l jS F Y'); ?>  </p>  
                       </div>
                   </div>
				  
 
	</div>
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