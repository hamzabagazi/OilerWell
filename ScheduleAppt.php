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
// if form submitted with post method
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_SESSION['firstName']=  htmlspecialchars ($_POST['firstName']);   
    $_SESSION['lastName'] =  htmlspecialchars ($_POST['lastName']);
    $_SESSION['email']=  htmlspecialchars ($_POST['email']);
    $_SESSION['phone'] =  htmlspecialchars ($_POST['phone']);
    $_SESSION['drawblood'] =  htmlspecialchars ($_POST['drawblood']);
    $_SESSION['purpose'] = "schedule"; 
    header("location: DateAndTime.php");    
}

?> 


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Schedule An Appointment-OilerWell</title>

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
         <!-- navigation bar --> 
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
           <h2> Schedule An Appointment </h2>
           
             <p class="form-instructions">* indicates a required field</p>
           <form class ="formGeneral" action="ScheduleAppt.php" method="post" >

               <fieldset class ="requiredInfoSignUp">
                   <label for="nameinput">
                      <p class= "labelP">Name: </p>
              
                      <input type="text" name="firstName" id="firstinput"
                               placeholder="First" pattern="^[a-zA-Z-''-'\s]{1,50}$"
                                   required >
                       <input type="text" name="lastName" id="lastinput"
                                placeholder="Last" pattern="^[a-zA-Z-''-'\s]{1,50}$"
                                required >
                        </label>

                        <label for="emailinput">
                            <p class= "labelP">Email:</p>
                            <input type="email" name="email" id="emailinput"
                                   placeholder="Email" required>
                        </label>
                      </fieldset>
                    <fieldset class ="phoneInput">
                        <label for="phoneinput">
                            <p class= "labelP">Phone:</p>
                            <input type="tel" name="phone" id="phoneinput" placeholder="Phone Number"   minlength="10" maxlength="16" >
                        </label>
                    </fieldset>

                    <fieldset class ="bloodQuestion">
                        <p class="bloodQuestionP">Are you willing to have a PA student draw your blood?</p>
                        <label for="yes">
                            <input type="radio" name="drawblood" id="AnswerYes" value="Yes" checked>
                            Yes
                        </label>
                        <label for="no">
                            <input type="radio" name="drawblood" id="AnswerNo" value="No">
                            No
                        </label>
                    </fieldset>

                    <fieldset class="nextButton">
                        <input type="submit" id="nextButton" value="Next"  style="float: right;">
                    </fieldset>
  
          </form>
        </div> 
    <script> 
                
    document.getElementById('phoneinput').addEventListener('keyup',function(evt){
        
       var phoneNumber = document.getElementById('phoneinput');
       var charCode = (evt.which) ? evt.which : evt.keyCode;
       phoneNumber.value = phoneFormat(phoneNumber.value);
       
});

// A function to format text to look like a phone number
function phoneFormat(input){
   // Strip all characters from the input except digits
     input = input.replace(/\D/g,'');

   // Trim the remaining input to ten characters, to preserve phone number format
     input = input.substring(0,10);

   // Based upon the length of the string, we add formatting as necessary
     var size = input.length;
     if(size == 0){
           input = input;
       }
       else if(size < 4){
                input = '('+input;
        }else if(size < 7){
                input = '('+input.substring(0,3)+') '+input.substring(3,6);
        }else{
                input = '('+input.substring(0,3)+') '+input.substring(3,6)+' - '+input.substring(6,10);
        }
        return input; 
      }
 </script> 
    
    </article>
        <footer>
            <p class="footerP"> 120 West Foulke Ave, Findlay, OH 45840 | (419) 434-4550 | cosiano@findlay.edu</p>

        </footer>
        <script src="script.js"></script>
    </body>
</html>