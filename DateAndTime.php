<?php 

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

function duplicate(){
    $full=array(); 

 $duplicates = "SELECT dateTime, count(*) counter from users group by dateTime having counter > 3";
 
      $result = mysqli_query($GLOBALS['mysql'], $duplicates);
     // $duplicate = $result->fetch_row();
       if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
          
         $full[]= trim($row["dateTime"]);
         
         
     }
     
     echo json_encode($full);

}
}

?>

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
 <head>
       <title>OilerWell</title>
     
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
 
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
		
		 <h2> Date And Time </h2>  
		  
		
		<form class="dateForm cf" action= "apptSummary.php" method="post" > 
			 <p class="generalP"> Please Select Date:  </p> 
			 <section class="plan cf">
				
                             <input type="radio" name="selectedDate" id="free" value="2018-11-05"  onclick= "disableButtons('11-05')"><label class="free-label four col" for="free">Mon 11/5</label>
				<input type="radio" name="selectedDate" id="basic" value="2018-11-06" onclick= "disableButtons('11-06')"><label class="label four col" for="basic">Tue 11/6</label>
				<input type="radio" name="selectedDate" id="premium" value="2018-11-07" onclick= "disableButtons('11-07')"><label class="label four col" for="premium">Wed 11/7</label>
				<input type="radio" name="selectedDate" id="b" value="2018-11-08" onclick= "disableButtons('11-08')"><label class="label four col" for="b">Thu 11/8</label>
				<input type="radio" name="selectedDate" id="p" value="2018-11-09" onclick= "disableButtons('11-09')"><label class="label four col" for="p">Fri 11/9</label>
			</section>
  
             
			
			<p class="generalP"> Please Select Time:  </p>
			
                        <?php 
                         $counter = 1;
                                $hour = 6;
                                $minute = 30;
                          for ($j =0; $j<5; $j++){
                              
                             
			echo '<section class="plan cf">';
                            
				
                                for ($i=0; $i<5; $i++){
                                    
                                    
                              
                                   echo '<input type="radio" name="selectedTime" id="'.$hour.':'.$minute.'" value=' . $hour. ':'.$minute.'><label class="label four col" for="'.$hour.':'.$minute.'"  id="'.$hour.':'.$minute.'L" >' . $hour . ':'.$minute.' AM</label>';
                                  
                                  $counter++;
                                
                                    $minute += 10;
                                    if( $minute >= 60){
                                        $minute -= 60;
                                        $hour++;
                                        if ($minute == 0){
                                            $minute= $minute."0";
                                        }
                                    }
                                }
                             
			echo'</section>';
                        }
                        ?>

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
                             
                         
function disableButtons(selectedDay){

undisalbeButtons();
var dublicetArray = []; 
var temp; 
var tempTime; 
var time; 
var date; 


dublicetArray= JSON.parse('<?php duplicate();?>');

for (i = 0; i < dublicetArray.length; i++){
   
temp=dublicetArray[i];
  
  date = temp.substring(5, 10);
  tempTime = temp.substring(11, 16);
  
  if (selectedDay === date){
     
     
     var removeZero = tempTime.substring(0, 1);
     if (removeZero === '0'){
         time = tempTime.substring(1, 5);
         
         } 
         else {
             time = tempTime; 
         }
    
       document.getElementById(time).disabled =true ; 
        var label = document.getElementById(time+"L");
        label.style.color = "red"; 
           label.style.setProperty ("text-decoration", "line-through");
}

  }

}

function undisalbeButtons(){
        var tempTime='06:30' ;
        var time; 
         for (i=0; i<25; i++){
       var removeZero = tempTime.substring(0, 1);
     if (removeZero === '0'){
         time = tempTime.substring(1, 5);
         
         } 
         else {
             time = tempTime; 
         }
        //make the buttons undisable 
      document.getElementById(time).disabled =false ; 
      document.getElementById(time).checked = false;
        var label = document.getElementById(time+"L");
        label.style.color = "white"; 
        label.style.setProperty ("text-decoration", "none"); 
            
          tempTime= addMinutes(time, 10);
       }
    
}

 function addMinutes(time, minsToAdd) {
  function D(J){ return (J<10? '0':'') + J;};
  var piece = time.split(':');
  var mins = piece[0]*60 + +piece[1] + +minsToAdd;

  return D(mins%(12*60)/60 | 0) + ':' + D(mins%60);  
}  




                         
                             
  </script>            

		</div> 
   
    </article>
	<footer>
       <p class="footerP"> 120 West Foulke Ave, Findlay, OH 45840 | (419)434-4550 | cosiano@findlay.edu</p>
	   
	   </footer>
	  
	</body>
   </html>