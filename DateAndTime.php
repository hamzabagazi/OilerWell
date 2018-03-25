<?php 

 session_start();
  if (!isset($_SESSION["count"])) {
    $_SESSION["count"] = 0;
}  

if ($_SESSION["count"] == 24){
    $_SESSION["count"] = 0; 
}
$mysql = new mysqli('localhost', 'root', '');

if (! $mysql){
      
    die ('Cloud not connect:' . mysqli_error());
    
}

if (!mysqli_select_db($mysql, 'oilerwellappointment')){
    echo 'Database Not Selected';
}



function  checkDatabased (){
    $count = $_SESSION["count"]; 
    
  $dates = array("6:30", "6:40", "6:50", "7:00", "7:10", "7:20", "7:30", "7:40", 
"7:50", "8:00", "8:10", "8:20", "8:30", "8:40", "8:50", "9:00", "9:10", "9:20"
        , "9:30", "9:40", "9:50", "10:00", "10:10", "10:20", "10:30"); 

 $mon630 = "SELECT count(*) FROM `users` WHERE date LIKE '%monday%' AND time LIKE '%$dates[$count]%'";
 //$mysql = new mysqli('localhost', 'root', '');
 //if (!mysqli_select_db($mysql, 'oilerwellappointment')){
 //   echo 'Database Not Selected';
//}
      $result = mysqli_query($GLOBALS['mysql'], $mon630);
    $duplicate = $result->fetch_row();
    
    // increment(); 
  
  
 echo $duplicate[0];
 
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
     <!-- <script src="modernizr.custom.40753.js"></script> -->
      <link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
	   <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="styles.css">
	  <link rel="shortcut icon" href="images/oilerwell_logo_icon.ico">
        <!--  <script src="js/script.js" type="text/javascript"></script> -->
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
		
		 <h2> Date And Time </h2>  
		  
		   
		   
		
		
		<form class="dateForm cf" action= "apptSummary.php" method="post" > 
			 <p class="generalP"> Please Select Date:  </p> 
			 <section class="plan cf">
				
                             <input type="radio" name="selectedDate" id="free" value="Monday, November 5th" checked onclick= "mondayFunction()"><label class="free-label four col" for="free">Mon 11/5</label>
				<input type="radio" name="selectedDate" id="basic" value="Tuesday, November 6th"><label class="basic-label four col" for="basic">Tue 11/6</label>
				<input type="radio" name="selectedDate" id="premium" value="Wednesday, November 7th"><label class="premium-label four col" for="premium">Wed 11/7</label>
				<input type="radio" name="selectedDate" id="b" value="Thursday, November 8th" ><label class="b-label four col" for="b">Thu 11/8</label>
				<input type="radio" name="selectedDate" id="p" value="Friday, November 9th"><label class="p-label four col" for="p">Fri 11/9</label>
			</section>
  
             
			
			<p class="generalP"> Please Select Time:  </p>
			
			<section class="plan cf">
				
				<input type="radio" name="selectedTime" id="1" value="6:30AM" checked><label class="free-label four col" for="1">6:30AM</label>
				<input type="radio" name="selectedTime" id="2" value="6:40AM" ><label class="basic-label four col" for="2">6:40AM</label>
				<input type="radio" name="selectedTime" id="3" value="6:50AM"><label class="premium-label four col" for="3">6:50AM</label>
				<input type="radio" name="selectedTime" id="4" value="7:00AM" ><label class="b-label four col" for="4">7:00AM</label>
				<input type="radio" name="selectedTime" id="5" value="7:10AM"><label class="p-label four col" for="5">7:10AM</label>
				
			</section>
			<section class="plan cf">
				
				<input type="radio" name="selectedTime" id="6" value="7:20AM"><label class="free-label four col" for="6">7:20AM</label>
				<input type="radio" name="selectedTime" id="7" value="7:30AM"><label class="basic-label four col" for="7">7:30AM</label>
				<input type="radio" name="selectedTime" id="8" value="7:40AM"><label class="premium-label four col" for="8">7:40AM</label>
				<input type="radio" name="selectedTime" id="9" value="7:50AM"><label class="b-label four col" for="9">7:50AM</label>
				<input type="radio" name="selectedTime" id="10" value="8:00AM"><label class="p-label four col" for="10">8:00AM</label>
				
			</section>
			
			<section class="plan cf">
				
				<input type="radio" name="selectedTime" id="11" value="8:10AM"><label class="free-label four col" for="11">8:10AM</label>
				<input type="radio" name="selectedTime" id="12" value="8:20AM"><label class="basic-label four col" for="12">8:20AM</label>
				<input type="radio" name="selectedTime" id="13" value="8:30AM"><label class="premium-label four col" for="13">8:30AM</label>
				<input type="radio" name="selectedTime" id="14" value="8:40AM"><label class="b-label four col" for="14">8:40AM</label>
				<input type="radio" name="selectedTime" id="15" value="8:50AM"><label class="p-label four col" for="15">8:50AM</label>
				
			</section>
			
			<section class="plan cf">
				
				<input type="radio" name="selectedTime" id="16" value="9:00AM"><label class="premium-label four col" for="16">9:00AM</label>
				<input type="radio" name="selectedTime" id="17" value="9:10AM"<><label class="b-label four col" for="17">9:10AM</label>
				<input type="radio" name="selectedTime" id="18" value="9:20AM"><label class="p-label four col" for="18">9:20AM</label>
				<input type="radio" name="selectedTime" id="19" value="9:30AM"><label class="premium-label four col" for="19">9:30AM</label>
				<input type="radio" name="selectedTime" id="20" value="9:40AM"><label class="b-label four col" for="20">9:40AM</label>
				
			</section>
			
			<section class="plan cf">
			<input type="radio" name="selectedTime" id="21" value="9:50AM"><label class="p-label four col" for="21">9:50AM</label>
				<input type="radio" name="selectedTime" id="22" value="10:00AM"><label class="premium-label four col" for="22">10:00AM</label>
				<input type="radio" name="selectedTime" id="23" value="10:10AM"><label class="b-label four col" for="23">10:10AM</label>
				<input type="radio" name="selectedTime" id="24" value="10:20AM"><label class="p-label four col" for="24">10:20AM</label>
				<input type="radio" name="selectedTime" id="25" value="10:30AM"><label class="p-label four col" for="25">10:30AM</label>
			</section>
		
		       <!-- Hidden input to transfer it to the other page --> 
                       
                       <input type="hidden" name="firstName" value=" <?php echo $_POST['firstName'];?>" >
		
                       <input type="hidden" name="lastName" value=" <?php echo $_POST['lastName'];?>">
				
                       <input type="hidden" name="email" value=" <?php echo $_POST['email'];?>">
				
                       <input type="hidden" name="phone" value=" <?php echo $_POST['phone'];?>">
			
                       <input type="hidden" name="drawblood" value=" <?php echo $_POST['drawblood'];?>">
					

		
	
		  <fieldset class="nextButton">
                    
                      <input type="submit" id="nextButton" value="Next"  href="apptSummary.html"  style="float: right;">
                   </fieldset>
                       
                       
		 </form>
                   <script> 
                             
                             
function mondayFunction(){
  
var temp ;
 temp = "<?php checkDatabased();?>"; 
for (i = 0; i <25; i++){
   

  temp = "<?php checkDatabased();?>"; 
alert(temp);
alert("test"+i);


    
  }

}
                             
                             
  </script>            

		</div> 
   
    </article>
	<footer>
       <p class="footerP"> 120 West Foulke Ave, Findlay, OH 45840 | (419)434-4550 | cosiano@findlay.edu</p>
	   
	   </footer>
	   <!-- <script src="script.js"></script> -->
	</body>
   </html>