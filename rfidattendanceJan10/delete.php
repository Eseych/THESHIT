<?php
$conn = mysqli_connect("localhost","root","");
$db = mysqli_select_db($conn, 'rfidattendance');

if(isset($_POST['delete']))
{
  $appointmentID = $_POST['appointmentID'];

  $query = "DELETE FROM appointment_tbl WHERE appointmentID = $appointmentID";
  $query_run = mysqli_query($conn, $query);

  if($query_run){
    echo '<script> alert ("Appointment Cancelled"); </script>';
    header("location:home.php");
  } else {
    echo '<script> alert ("Appointment not Cancelled"); </script>';
  }
}
 ?>
