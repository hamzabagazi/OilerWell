<?php 
session_start();


   
?>
<!DOCTYPE html>
<html lang="en">
 <head>
      <title>OilerWell</title>
      
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
		  <h2> Summary</h2>  
                  <form action="submitAppt.php" method="post">
                      
			 <div class="summary-preview">
			       <div class="table-row">
                     <div class="table-cell">
                       <p>Name:</p>
                     </div>
                       <div class="table-cell">
                         <p> <?php  echo $_SESSION['firstName'] ?> <?php  echo $_SESSION['lastName'] ?>  </p>
                       </div>
                   </div>
				   <div class="table-row">
                     <div class="table-cell">
                       <p>Email:</p>
                     </div>
                       <div class="table-cell">
                         <p> <?php  echo $_SESSION['email'] ?></p>
                       </div>
                   </div>
				   <div class="table-row">
                     <div class="table-cell">
                       <p>Phone:</p>
                     </div>
                       <div class="table-cell">
                         <p> <?php  echo $_SESSION['phone'] ?></p>
                       </div>
                   </div>
				   
				   <div class="table-row">
                     <div class="table-cell">
                       <p>PA student blood draw:</p>
                     </div>
                       <div class="table-cell">
                         <p> <?php  echo $_SESSION['drawblood']  ?></p>
                       </div>
                   </div>
				   <div class="table-row">
                     <div class="table-cell">
                       <p>Appointment Time:</p>
                     </div>	
                       <div class="table-cell">
                        <!-- <p class="summary-date" class="summary-time"></p> --> 
                          <p > <?php  echo date_format(date_create($_SESSION['dateTime']), 'g:ia \o\n l F jS Y'); ?>   </p>  
                       </div>
                   </div>
				  
				   
			 
		    </div>
                      
			  <input type="hidden" name="firstName" value=" <?php echo $_SESSION['firstName'];?>" >
		
                       <input type="hidden" name="lastName" value=" <?php echo $_SESSION['lastName'];?>">
				
                       <input type="hidden" name="email" value=" <?php echo $_SESSION['email'];?>">
				
                       <input type="hidden" name="phone" value=" <?php echo $_SESSION['phone'];?>">
			
                       <input type="hidden" name="drawblood" value=" <?php echo $_SESSION['drawblood'];?>">
                       <input type="hidden" name="dateTime" value=" <?php echo $_SESSION['dateTime'];?>">
                        <input type="hidden" name="purpose" value=" <?php echo $_SESSION['purpose'];?>">
                      
                       
			  <fieldset class="nextButton">
                              <input type="submit" name="submit" id="nextButton" value="Submit"  style="float: right;">
                   </fieldset>
                  </form>
                      <button id="backButton" style="float: left; margin-top:-79px;" onclick="goBack()" >Back</button>
		 <script> 
                             
            function goBack() {
              window.history.back();
                } 
                </script> 

		</div> 
   
    </article>
	<footer>
       <p class="footerP"> 120 West Foulke Ave, Findlay, OH 45840 | (419) 434-4550 | cosiano@findlay.edu</p>
	   
	   </footer>
	   <script src="script.js"></script>
	</body>
   </html>