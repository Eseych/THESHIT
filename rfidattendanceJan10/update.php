<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
$conn = mysqli_connect("localhost","root","");
$db = mysqli_select_db($conn, 'rfidattendance');

$appointmentID = $_POST['appointmentID'];

$query = "SELECT * FROM appointment_tbl WHERE appointmentID = $appointmentID";
$query_run = mysqli_query($conn, $query);

if($query_run)
{
  while($row = mysqli_fetch_array($query_run)) {
    ?>
<div class="container">
  <div class ="jumbotron">
    <h2>Update Appointment</h2>
    <hr>
    <form action ="" method="post">
      <input type="hidden" name="appointmentID" value="<?php echo $row['appointmentID'] ?>">
      <div class="form-group">
        <label for=""> Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>" placeholder= "Enter Student Name" required />
      </div>
      <div class="form-group">
        <label for=""> Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo $row['email'] ?>" placeholder= "Enter Student Email" required />
      </div>
      <button type="submit" name="update" class="btn btn-primary"> Update Appointment</button>
      <a href="home.php" class="btn btn-danger"> Cancel </a>
    </form>

    <?php
    if(isset($_POST['update']))
    {
      $name = $_POST['name'];
      $email = $_POST['email'];

      $query = "UPDATE appointment_tbl SET name='$name', email='$email' WHERE appointmentID='$appointmentID'";
      $query_run = mysqli_query($conn, $query);

      if($query_run)
      {
      echo '<script> alert ("Appointment Updated");</script>';
      header("location:home.php");
      }
      else {
        echo '<script> alert ("Appointment not updated");</script>';
      }
    }
     ?>
  </div>
</div>
    <?php
  }
} else {
  echo '<script> alert ("No reocrd found");</script>';
}
 ?>
</body>
</html>
