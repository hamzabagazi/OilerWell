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
			      <a class="tenth before after" href="ScheduleAppt.html"> Schedule Appointment </a>
				</span>
			  </div>
               <div class="wrapper">
				<span class="square">
			       <a class="tenth before after" href="changeAppt.html"> View/Change Appointment </a>
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
		  <h2> Appointments</h2>  
	       <table>
 <tr>
  <th>Id</th> 
  <th>First</th> 
  <th>Last</th> 
  <th>Date</th>
  <th>Time</th> 
  <th>Blood</th> 
 </tr>
 <?php
$mysql = new mysqli('localhost', 'root', '');

 // Check connection
if (! $mysql){
      
    die ('Cloud not connect:' . mysqli_error());
    
}

if (!mysqli_select_db($mysql, 'oilerwellappointment')){
    echo 'Database Not Selected';
}
 

  
  $sql = "SELECT id, firstName, lastName, date, time, blood FROM users";
  $result = mysqli_query($mysql, $sql);
  
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstName"] . "</td><td>"
. $row["lastName"]. "</td><td>" . $row["date"]. "</td><td>" . $row["time"]. "</td><td>" . $row["blood"]. "</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$mysql->close();
?>
</table>
	<form action="excel.php" method="post" class ="centerButton"> 
            <input type="submit" id="nextButton" name="export_excel" class="btn btn-succes" value="Export to Excel"  />  
      </form> 	 
  </div> 
      
   
    </article>
	<footer>
       <p class="footerP"> 120 West Foulke Ave, Findlay, OH 45840 | (419) 434-4550 | cosiano@findlay.edu</p>
	   
	   </footer>
	</body>
   </html>