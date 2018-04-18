<?php 

session_start(); 

if (!$_SESSION["login_user"])
{
    header("location:oilerWellAdmin.php?notlogedin=You are not Administrator!"); 
}
else {
    $welcome= "<h3 style='color: black;'> Welcome : " .$_SESSION['login_user']."</h3>";
}

?> 

<!DOCTYPE html>
<html lang="en">
 <head>
      <title>Home Page</title>
    
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
		  <h2> Home</h2>  
	
		    <?php echo $welcome; ?>
                        
                      <fieldset class ="requiredInfoChange" align="center">
                          <form action="mondayTable.php" style="padding: 0;">
                            <input type="submit" id="adminApptTableBtn"  value="Monday Appointments" name="monday">
                          </form>
                          
                          <form action="tuesdayTable .php" style="padding: 0;">
                            <input type="submit" id="adminApptTableBtn"  value="Tuesday Appointments" name="tuesday">
                            </form>
                          
                         <form action="wednesdayTable.php" style="padding: 0;">
                            <input type="submit" id="adminApptTableBtn"  value="Wednesday Appointments" name="wednesday">
                               </form>
                            
                         <form action="thursdayTable.php" style="padding: 0;">
                             <input type="submit" id="adminApptTableBtn"  value="Thursday Appointments" name="thursday">
                             </form>
                             
                         <form action="fridayTable .php" style="padding: 0;">
                            <input type="submit" id="adminApptTableBtn"  value="Friday Appointments" name="Friday">
                            </form>
                             
                         <form action="appointmentTable.php" style="padding: 0;">				
                              <input type="submit" id="adminApptTableBtn" value="Database" name="database" >
                          </form>
                          <form action="reminderEmail.php" style="padding: 0;">				
                              <input type="submit" id="adminApptTableBtn" value="Send Reminder" name="reminder" >
                          </form>
                            
			</fieldset> 
				 <form  action="logout.php" method="post">
                                     
                               <fieldset class="nextButton">
                   
                                   <input type="submit" id="nextButton" value="Logout" style="float: right;" >
                            </fieldset>
			  </form>
	
  </div> 
     
    </article>
	<footer>
       <p class="footerP"> 120 West Foulke Ave, Findlay, OH 45840 | (419) 434-4550 | cosiano@findlay.edu</p>
	   
	   </footer>
       
      
	</body>
   </html>
   