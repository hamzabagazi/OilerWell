 <?php
 
  session_start(); 
 if (!$_SESSION["login_user"])
{
    header("location:oilerWellAdmin.php?notlogedin=You are not an administrator!"); 
}
 //Connection + database
$user = "root"; 
$password = ""; 
$host = "localhost"; 
$dbase = "oilerwellappointment"; 


 // Create connection   
$mysql = mysqli_connect($host, $user, $password);

// Check connection
if (! $mysql){
      
    die ('Cloud not connect:' . mysqli_error());
    
}

if (!mysqli_select_db($mysql, $dbase)){
    echo 'Database Not Selected';
}

//convert the dateTime sql type to php type
function convert ($tableDateTime){
        
        $dateTime=  date_create($tableDateTime);
        
        return $dateTime;
    }
    
  
    



 ?>

<!DOCTYPE html>
<html lang="en">
 <head>
      <title>Friday Appointment</title>
    
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <script src="modernizr.custom.40753.js"></script>
      <!-- CSS for the table --> 
      <link href="gisttech/css/bootstrap.min_1.css" rel="stylesheet" type="text/css"/>
      <link href="gisttech/css/tableexport.min.css" rel="stylesheet" type="text/css"/>
      <!-- The end for CSS --> 
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
		  <h2> Friday Appointments</h2>  
	       <table id ="Friday-Appointments" class ="table table-bordered" >
                   <thead>
 <tr>
  <th>Id</th> 
  <th>First</th> 
  <th>Last</th> 
  <th>Date</th>
  <th>Blood</th> 
 </tr>
             </thead>
             <tbody>
 <?php
//print users records in table
   $row_counter = 1; 
  
  $sql = "SELECT  firstName, lastName, dateTime, blood FROM users WHERE dateTime LIKE '%11-09%' ORDER BY dateTime  ASC";
  $result = mysqli_query($mysql, $sql);
  
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
            echo "<tr>"
       . "<td>" . $row_counter. "</td>"
       
       . "<td>" . $row["firstName"] . "</td>"
       . "<td>" . $row["lastName"]. "</td>"
       . "<td>" .  date_format(convert ($row["dateTime"]), ' l F jS Y \a\t g:ia '). "</td>"
       . "<td>" . $row["blood"]. "</td>"
              . "</tr>";
            $row_counter++; 
}
echo "</table>";
} else { echo "0 results"; }
$mysql->close();
?>
             </tbody>
</table>
	
  </div> 
      <script src="gisttech/js/bootstrap.min_1.js" type="text/javascript"></script>
      <script src="gisttech/js/FileSaver.min.js" type="text/javascript"></script>
      <script src="gisttech/js/jquery-3.1.1.min.js" type="text/javascript"></script>
      <script src="gisttech/js/tableexport.min.js" type="text/javascript"></script>
      <script>
      $('#Friday-Appointments').tableExport();
      </script>
    </article>
	<footer>
       <p class="footerP"> 120 West Foulke Ave, Findlay, OH 45840 | (419) 434-4550 | cosiano@findlay.edu</p>
	   
	   </footer>
       
      
	</body>
   </html>