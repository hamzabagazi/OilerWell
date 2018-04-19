<?php 

session_start();
session_destroy(); 

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


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';




 //initialize the user information to php variables 
    $firstName = trim($_POST['firstName']);   
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $drawblood = trim($_POST['drawblood']);
    $dateTime = trim($_POST['dateTime']);
    
  //make sure there's a request from ether SignUp/Change Appt  
  if(isset($_POST['purpose'])){
    
      $purpose = trim($_POST['purpose']);
      //do the process for change Appointment 
      if ($purpose == "change")
      {
        $sql = "SELECT * FROM `users` WHERE firstName = '$firstName' AND email = '$email'";
    
    $result = mysqli_query($mysql, $sql);
   
   //update the database with the new appointment date.
if ($result->num_rows > 0){
     while($row = $result->fetch_assoc()){
    $id = trim($row["id"]);
    $code = trim($row["code"]);
     }
     
   $sql = "UPDATE users SET dateTime='$dateTime' WHERE id='$id'";
   
    if (mysqli_query($mysql, $sql)){
        
           header("refresh:0; url=main.html");
           
       email ($firstName, $lastName, $email, $phone, $dateTime, $drawblood, $code);   
      
      echo '<script language="javascript">';
      echo 'alert("Your appointment has been successfully rescheduled, Thank you.")';
      echo '</script>';
        
    }
   
    else {
       
        echo '<script language="javascript">';
        echo 'alert("Unable to reschedule your appointment, Please try again. ")';
        echo '</script>';
        
        header("refresh:0; url= ScheduleAppt.php");
       }
    }   
          
 }//end of changing Appointment part 
  
 //do the process for schedule Appointment 
 elseif ($purpose == "schedule"){
     
     //make sure that no one signup twice
    $sql = "SELECT * FROM `users` WHERE firstName = '$firstName' AND lastName= '$lastName' AND email = '$email'";
    
    $result = mysqli_query($mysql, $sql);
   
     //if there is no match in the database it will insert the user data to the database 
     if ($result->num_rows == 0){
    //assign a special code to the user      
    $code =  code (); 
    $sql = "INSERT INTO users (firstName, lastName, email, phone, dateTime, blood, code)"
            . "VALUES('$firstName', '$lastName', '$email', '$phone',  '$dateTime', '$drawblood', '$code')"; 

     if (mysqli_query($mysql, $sql)){
       
      //send a confirmation email to the user     
     email ($firstName, $lastName, $email, $phone, $dateTime, $drawblood, $code);
       header("refresh:0; url=main.html");
        echo '<script language="javascript">';
        echo 'alert("Thank you, your appointment has been scheduled!")';
        echo '</script>';
       }
       else {
           header("refresh:0; url=ScheduleAppt.php");
          echo '<script language="javascript">';
        echo 'alert("Appointment could not be added to the database!, Please try again.")';
        echo '</script>';
      
         }
}//end of matching data if statement
  
  else {
        
         header("refresh:0; url=ScheduleAppt.php");
          echo '<script language="javascript">';
        echo 'alert("These credentials have already been used: \nPlease '
          . 'check your email for a confirmation. \nIf you are attempting to reschedule go to View/Change appointment page. ")';
        echo '</script>';
      
     }
  }
  else {
    
        header("refresh:0; url=ScheduleAppt.php");
        
             echo '<script language="javascript">';
        echo 'alert("Appointment could not be added to the database!")';
        echo '</script>';
    
        }
  
      
   }
  
  else{
     echo '<script language="javascript">';
        echo 'alert("Unable to process your request, Please try again.")';
        echo '</script>'; 
          header("refresh:0; url= ScheduleAppt.php");
    }

    
  
function email ($firstName, $lastName, $email, $phone, $dateTime, $drawblood, $code){
    //send an email to the user when they Signup or Change Appointment
   $mail = new PHPMailer(true);       // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;            // Enable verbose debug output
    $mail->isSMTP();    
   $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);// Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';            // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                    // Enable SMTP authentication
    $mail->Username = 'oilerwell@gmail.com';   // SMTP username
    $mail->Password = 'Oiler123';              // SMTP password
    $mail->SMTPSecure = 'tls';                 // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                         // TCP port to connect to
    $mail->SMTPSecure = false;
    //Recipients
    $mail->setFrom('no_reply@oilerwell.com', 'no_reply@oilerwell.com');
    $mail->addReplyTo('no_reply@oilerwell.com', '');
    $mail->addAddress($email);                 // Add a recipient
   

    //Attachments
    $mail->addAttachment('attachment/AHAemailannouncement.pdf',  'AHAemailannouncement.pdf') ;        // Add attachments
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail-> AddEmbeddedImage('images/OilerWellEmail.png', 'oilerWellLogo', 'OilerWellEmail.png');
    $mail->Subject = 'OilerWell Appointment Confirmation';
    $mail->Body    = '<body> <img src=" cid:oilerWellLogo"  alt="OilerWell Logo" > '
            . '<table rules="all" style="border-color: #666;" cellpadding="10"> '
            . '<tr style="background: #eee;"><td><strong>Name:</strong> </td><td> '. $firstName . ' '. $lastName .' </td></tr> '
            . '<tr><td><strong>Email:</strong> </td><td> '. $email .' </td></tr> '
            . '<tr><td><strong>Phone:</strong> </td><td>' . $phone . '</td></tr>'
            . ' <tr><td><strong>Are you willing to have a PA student draw your blood?</strong> </td><td>' . $drawblood . '</td></tr> '
            . '<tr><td><strong>Appointment Time:</strong> </td><td>' . date_format(date_create($dateTime), 'm/d/Y \a\t H:i \A\M') . '</td></tr>'
            . ' <tr><td><strong>Confirmation code:</strong> </td><td>' . $code . '</td></tr> '
            . '</table> '
            . '<P><b>*Note:</b> You need to use the confirmation code to View/Change the appointment.</p> '
            . '</body>';
    $mail->AltBody = 'OilerWell Appointment';
   
    $mail->send();
} 
   catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}  
    
}


function code (){
    $uniqueCode = TRUE; 
    // Create a random code and make sure that there's no duplicate code number
   while ($uniqueCode){
        
       $code= rand(10000,99999); 
       $query = "SELECT * FROM users WHERE code = '$code'"; 
       $result = mysqli_query($GLOBALS['mysql'], $query);
      if(mysqli_num_rows($result) == 0) {
        $uniqueCode = FALSE; 
      }
       
         }
         
      return $code; 
    }   


?>
