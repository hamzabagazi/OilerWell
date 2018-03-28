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


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';




 
    $firstName = trim($_POST['firstName']);   
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $drawblood = trim($_POST['drawblood']);
    $selectedDate = $_POST['selectedDate'];
    $selectedTime = $_POST['selectedTime'];
    $dateTime = trim($selectedDate." ". $selectedTime);
   // $selectedTime = trim($_POST['selectedTime']);
    $uniqueCode = TRUE; 
    $format; 
    
    
   
    
    // Creat a random code and make sure that there's no duplicate code number
   while ($uniqueCode){
        
       $code= rand(10000,99999); 
       $query = "SELECT * FROM users WHERE code = '$code'"; 
    $result = mysqli_query($mysql, $query);
      if(mysqli_num_rows($result) == 0) {
        $uniqueCode = FALSE; 
      }
        //else {
        //    echo "inside the loop";
        //}
      
    }

   
    $sql = "SELECT * FROM `users` WHERE firstName = '$firstName' AND email = '$email'";
    
    $result = mysqli_query($mysql, $sql);
   
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
       // header("location: ScheduleAppt.php");
             echo '<script language="javascript">';
        echo 'alert("Unable to reschedule your appointment, Please try again. ")';
        echo '</script>';
    }
}
elseif ($result->num_rows == 0){
  
    $sql = "INSERT INTO users (firstName, lastName, email, phone, dateTime, blood, code)"
            . "VALUES('$firstName', '$lastName', '$email', '$phone',  '$dateTime', '$drawblood', '$code')"; 

        if (mysqli_query($mysql, $sql)){
       
             
     email ($firstName, $lastName, $email, $phone, $dateTime, $drawblood, $code);
       header("refresh:0; url=main.html");
          echo '<script language="javascript">';
        echo 'alert("Thank you, your appointment has been scheduled!")';
        echo '</script>';
       }
}

else {
    
        header("refresh:1; url=ScheduleAppt.php");
        header("location: ScheduleAppt.php");
             echo '<script language="javascript">';
        echo 'alert("Appointment could not be added to the database!")';
        echo '</script>';
    
}


function email ($firstName, $lastName, $email, $phone, $dateTime, $drawblood, $code){
   $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();    
   $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);// Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';   // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'oilerwell@gmail.com';                 // SMTP username
    $mail->Password = 'Oiler123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->SMTPSecure = false;
    //Recipients
    $mail->setFrom('no_reply@oilerwell.com');
    $mail->addAddress($email);     // Add a recipient
   
  //  $mail->addReplyTo('info@example.com', 'Information');
   

    //Attachments
    $mail->addAttachment('attachment/AHAemailannouncement.pdf',  'AHAemailannouncement.pdf') ;        // Add attachments
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail-> AddEmbeddedImage('images/OilerWellEmail.png', 'oilerWellLogo');
    $mail->Subject = 'OilerWell Appointment';
    $mail->Body    = '<body> <img src=" cid:oilerWellLogo"  alt="OilerWell Logo" > '
            . '<table rules="all" style="border-color: #666;" cellpadding="10"> '
            . '<tr style="background: #eee;"><td><strong>Name:</strong> </td><td> '. $firstName . ' '. $lastName .' </td></tr> '
            . '<tr><td><strong>Email:</strong> </td><td> '. $email .' </td></tr> '
            . '<tr><td><strong>Phone:</strong> </td><td>' . $phone . '</td></tr>'
            . ' <tr><td><strong>Are you willing to have a PA student draw your blood?</strong> </td><td>' . $drawblood . '</td></tr> '
            . '<tr><td><strong>Appointment Time:</strong> </td><td>' . $dateTime . '</td></tr>'
            . ' <tr><td><strong>Confirmation code:</strong> </td><td>' . $code . '</td></tr> '
            . '</table> '
            . '<P><b>*Note:</b> You need to use the confirmation code to View/Change the appointment.</p> '
            . '</body>';
    $mail->AltBody = 'OilerWell Appointment';
    
  

    $mail->send();
   // echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}  
    
}

   


?>
