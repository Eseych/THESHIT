<?php
  include ('connectDB.php');

  if(isset($_POST['appointmentBtn'])){
    $nameTxt = $_POST['name'];
    $emailTxt = $_POST['email'];
    $appointmentDateTxt = date('Y-m-d', strtotime($_POST['appointmentDate']));
    $appointmentTimeStartTxt =$_POST['appointmentTimeStart'];
    $appointmentTimeEndTxt =$_POST['appointmentTimeEnd'];
    $appointmentNotesTxt = $_POST['appointmentNotes'];
    $appointtedSections = array('');
    // echo $nameTxt;

    $addAppointmentQuery = "INSERT INTO `appointment_tbl`(`name`, `email`, `date`, `timeStart`, `timeEnd`,`reason`, `isActive`) VALUES ('$nameTxt','$emailTxt','$appointmentDateTxt','$appointmentTimeStartTxt','$appointmentTimeEndTxt','$appointmentNotesTxt', 1)";
    $result = mysqli_query($conn, $addAppointmentQuery);
    if($result)
    {
      $id = mysqli_insert_id($conn);
      foreach($_POST['section'] as $sectionTxt) {
        $addAppointmentSection = "INSERT INTO `appointedsection`(`appointmentId`, `sectionID`) VALUES ('$id','$sectionTxt')";
        mysqli_query($conn, $addAppointmentSection);
      }
    }else {
      echo "Error";
    }

    // echo $emailTxt;
    // echo $appointmentDateTxt;
    // echo $appointmentTimeTxt;
    // echo $appointmentNotesTxt;

    header("Location: home.php");
    exit();
  }
?>
