<?php 
session_start();
 
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
// if form submitted with post method
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //make sure that the user select a date 
        if (isset($_POST['selectedDate'])){
         //make sure the user select a time     
            if (isset($_POST['selectedTime'])){
                
                 $selectedDate = $_POST['selectedDate'];
                 $selectedTime = $_POST['selectedTime'];
                 $dateTime = trim($selectedDate." ". $selectedTime);
                 $_SESSION['dateTime'] = $dateTime; 
                 header("location: apptSummary.php");   
            }
            
            else {
                 echo '<script language="javascript">';
                 echo 'alert("Please select a time ")';
                 echo '</script>';
            }
           
        }
        else {
           echo '<script language="javascript">';
                 echo 'alert("Please select a date ")';
                 echo '</script>'; 
            

       }
        
}


?>

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
 <head>
       <title>Appointment Date-OilerWell</title>
     
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
		 
		
 <form class="dateForm cf" action= "DateAndTime.php" method="post" > 
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
       //make dynamic times buttons on the fly       
     $counter = 1;
     $hour = 6;
     $minute = 30;
         
     for ($j =0; $j<5; $j++)
         {
                              
           echo '<section class="plan cf">';
                  
           for ($i=0; $i<5; $i++)
           {
           
              echo '<input type="radio" name="selectedTime" id="'.$hour.':'.$minute.'" value=' . $hour. ':'.$minute.'><label class="label four col" for="'.$hour.':'.$minute.'"  id="'.$hour.':'.$minute.'L" >' . $hour . ':'.$minute.' AM</label>';
                                  
              $counter++;
              $minute += 10;
             //reset the minute to zero
              if( $minute >= 60)
                  {
                   $minute -= 60;
                   $hour++;
                if ($minute == 0)
                    {
                      $minute= $minute."0";
                      }
                   
                      
                    }
                    
              }
                             
   	       echo'</section>';
             }
        ?>
     
   <button id="nextButton" style="float: right;"> Next</button>
                      
 </form>
    <button id="backButton" style="float: left;" onclick="goBack()" >Back</button>

         
<script> 
  //lineup the back button on the postion of next button                            
 $(document).ready(function(){
     
   var nextButtonPos = $("#nextButton").position();
   document.getElementById('backButton').style.position = "absolute";
   document.getElementById("backButton").style.top = nextButtonPos.top + "px";
 });              
  
  //function will return the url for the previous page  
  function goBack() {
    window.history.back();
}

//disable all the buttons that all the slots on were taken
function disableButtons(selectedDay){


undisableButtons(); //clear all the disabled buttons and the chosen one 
var duplicateArray = []; //array will hold the times that the slots in it been taken
var temp; 
var tempTime; 
var time; 
var date; 


duplicateArray= JSON.parse('<?php duplicate();?>'); //copy the taken times from php array

for (i = 0; i < duplicateArray.length; i++){
   
temp= duplicateArray[i];
  
  date = temp.substring(5, 10);
  tempTime = temp.substring(11, 16);
  //only disable the appoitment times on the selected date
  if (selectedDay === date){
     
     var removeZero = tempTime.substring(0, 1);
     if (removeZero === '0'){
         time = tempTime.substring(1, 5);
         
         } 
         else {
             time = tempTime; 
         }
       //disabled the button and change the color and strike the text
       document.getElementById(time).disabled =true ; 
        var label = document.getElementById(time+"L");
        label.style.color = "red"; 
        label.style.setProperty ("text-decoration", "line-through");
}

  }

}
//clear the dates and times buttons 
function undisableButtons(){
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
//function will increment the minute every 10 mins
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