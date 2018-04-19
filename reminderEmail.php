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


 //count number of records in database
 $sql = "SELECT * FROM `users`";
    
 $result = mysqli_query($mysql, $sql);
   
 $totalRecords = $result->num_rows; 
    //make sure there's records in database
    if ($totalRecords > 0){
         while($record = $result->fetch_assoc()) {
          
           $firstName= $record["firstName"];
           $lastName=$record["lastName"]; 
           $email= $record["email"]; 
           $phone = $record["phone"];
           $dateTime= $record["dateTime"];
           $drawblood= $record["blood"];
           $code= $record["code"];
             
    email ($firstName, $lastName, $email, $phone, $dateTime, $drawblood, $code);
           
       
         }
          
         header("refresh:0; url=adminHomePage.php");
        echo '<script language="javascript">';
        echo 'alert("All the reminder emails has been sent")';
        echo '</script>'; 
     }
     
     else {
         header("refresh:0; url=adminHomePage.php");
        echo '<script language="javascript">';
        echo 'alert("There is no records in database to send reminder email with")';
        echo '</script>'; 
     }
     

     
     
     
 function email ($firstName, $lastName, $email, $phone, $dateTime, $drawblood, $code){
    //send an email to the user 
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
    $mail->Subject = 'OilerWell Appointment Reminder';
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

//convert the dateTime sql type to php type 
function convert ($tableDateTime){
        
        $dateTime=  date_create($tableDateTime);
        
        return $dateTime;
    }
?>