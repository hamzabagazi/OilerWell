<?php

$mysql = new mysqli('localhost', 'root', '');

if (! $mysql){
      
    die ('Cloud not connect:' . mysqli_error());
    
}

if (!mysqli_select_db($mysql, 'oilerwellappointment')){
    echo 'Database Not Selected';
}

$output = ''; 

if (isset($_POST["export_excel"]))
{
    $sql = "SELECT id, firstName, lastName, date, time, blood FROM users";
  $result = mysqli_query($mysql, $sql);
  
  if ($result->num_rows > 0) {
      $output .=' '
              . '<table class= "table" bordered="1">'
              . '<tr> '
              . '    <th>Id</th> 
                    <th>First</th> 
                    <th>Last</th> 
                    <th>Date</th>
                    <th>Time</th> 
                    <th>Blood</th>  
                  <tr> ';
      
      while($row = mysqli_fetch_array($result)) {
          $output .=''
                  . '<tr>'
                  . '<td>' .$row["id"].'</td>'
                  . '<td>' .$row["firstName"].'</td>'
                  . '<td>' .$row["lastName"].'</td>'
                  . '<td>' .$row["date"].'</td>'
                  .'<td>' .$row["time"].'</td>'
                  .'<td>' .$row["blood"].'</td>';
      }
       $output.= '</table>';     
 
       header("Content-Type: application/vnd.ms-excel");       
       header("Content-Disposition: attachment; filename= Appointment.xls"); 
       echo $output; 
                  
   }
      
}
 
?>