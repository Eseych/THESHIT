<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<link rel='stylesheet' type='text/css' href="css/bootstrap.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/header.css"/>
</head>
<header>
<div class="header">
	<div class="logo">
		<a href="home.php">DoorLock System</a>
	</div>
</div>
<?php
  if (isset($_GET['error'])) {
		if ($_GET['error'] == "wrongpasswordup") {
			echo '	<script type="text/javascript">
					 	setTimeout(function () {
			                $(".up_info1").fadeIn(200);
			                $(".up_info1").text("The password is wrong!!");
			                $("#admin-account").modal("show");
		              	}, 500);
		              	setTimeout(function () {
		                	$(".up_info1").fadeOut(1000);
		              	}, 3000);
					</script>';
		}
	}
	if (isset($_GET['success'])) {
		if ($_GET['success'] == "updated") {
			echo '	<script type="text/javascript">
			 			setTimeout(function () {
			                $(".up_info2").fadeIn(200);
			                $(".up_info2").text("Your Account has been updated");
              			}, 500);
              			setTimeout(function () {
                			$(".up_info2").fadeOut(1000);
              			}, 3000);
					</script>';
		}
	}
	if (isset($_GET['login'])) {
	    if ($_GET['login'] == "success") {
	      echo '<script type="text/javascript">

	              setTimeout(function () {
	                $(".up_info2").fadeIn(200);
	                $(".up_info2").text("You successfully logged in");
	              }, 500);

	              setTimeout(function () {
	                $(".up_info2").fadeOut(1000);
	              }, 4000);
	            </script> ';
	    }
	  }
?>
<div class="topnav" id="myTopnav">
	<a href="home.php">Home</a>
	<a href="index.php">Users</a>
    <a href="ManageUsers.php">Manage Users</a>
    <a href="UsersLog.php">Users Log</a>
    <a href="devices.php">Devices</a>
    <?php
    	if (isset($_SESSION['Admin-name'])) {
    		echo '<a href="#" data-toggle="modal" data-target="#admin-account">'.$_SESSION['Admin-name'].'</a>';
    		echo '<a href="logout.php">Log Out</a>';
    	}
    	else{
    		echo '<a href="login.php">Log In</a>';
    	}
    ?>
    <a href="javascript:void(0);" class="icon" onclick="navFunction()">
	  <i class="fa fa-bars"></i></a>
</div>
<div class="up_info1 alert-danger"></div>
<div class="up_info2 alert-success"></div>
</header>
<script>
	function navFunction() {
	  var x = document.getElementById("myTopnav");
	  if (x.className === "topnav") {
	    x.className += " responsive";
	  } else {
	    x.className = "topnav";
	  }
	}
</script>

<!-- Account Update -->
<div class="modal fade" id="admin-account" tabindex="-1" role="dialog" aria-labelledby="Admin Update" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Update Your Account Info:</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="ac_update.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-body">
	      	<label for="User-mail"><b>Admin Name:</b></label>
	      	<input type="text" name="up_name" placeholder="Enter your Name..." value="<?php echo $_SESSION['Admin-name']; ?>" required/><br>
	      	<label for="User-mail"><b>Username</b></label>
	      	<input type="email" name="up_email" placeholder="Enter your E-mail..." value="<?php echo $_SESSION['Admin-email']; ?>" required/><br>
	      	<label for="User-psw"><b>Password</b></label>
	      	<input type="password" name="up_pwd" placeholder="Enter your Password..." required/><br>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" name="update" class="btn btn-success">Save changes</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	  </form>
    </div>
  </div>
</div>


<div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
		<form action="addAppointment.php" method="POST" name="addAppointmentFrm" id="addAppointmentFrm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="appointmentModalLabel">Make an Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" class="form-control" id="names" name="name" placeholder="Enter name">
					</div>
					<div class="form-group">
						<label for="section">Section:</label>
						<!-- <input type="text" class="form-control" id="section" name="section" placeholder="Enter section"> -->
						<select id="section" name="section[]" required multiple>
						<?php
							   include 'connectDB.php';

								 $querySection = "SELECT * FROM section_tbl";
								 $result = mysqli_query($conn, $querySection);
								 while($row = mysqli_fetch_assoc($result))
								 {
							?>
							<option value="<?php echo $row['sectionID']?>"><?php echo $row['sectionName']?></option>
							<?php
						     }
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" id="emails" name="email" placeholder="Enter email">
					</div>
          <div class="form-group">
            <label for="appointmentDate">Date</label>
            <input type="date" class="form-control" id="appointmentDate" name="appointmentDate" placeholder="Enter date">
          </div>

          <div class="form-group">
            <label for="appointmentTimeStart">Time-Start</label>
            <input type="time" min="09:30" class="form-control" id="appointmentTimeStart" name="appointmentTimeStart" placeholder="Enter time">
          </div>
					<div class="form-group">
            <label for="appointmentTimeEnd">Time-End</label>
            <input type="time" class="form-control" id="appointmentTimeEnd" name="appointmentTimeEnd" placeholder="Enter time">
          </div>

          <div class="form-group">
            <label for="appointmentNotes">Reason for Appointment</label>
            <textarea class="form-control" id="appointmentNotes" name="appointmentNotes" rows="3" placeholder="Enter any additional notes or details"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="appointmentBtn" name="appointmentBtn" class="btn btn-primary">Save Appointment</button>
      </div>
    </div>
	</form>
  </div>
</div>
<!-- Modal -->


<style>
  .modal-content {
    background-color: #d4d4d4;
  }

  .modal-header {
    border-bottom: none;
  }

  .modal-footer {
    border-top: none;
  }
</style>

<script>
$(document).ready(function () {
  $("#section").CreateMultiCheckBox({ width: '230px',
             defaultText : 'Select Below', height:'250px' });
});
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0');
var yyyy = today.getFullYear();
today = yyyy + '-' + mm + '-' + dd;
$('#appointmentDate').attr('min',today);
</script>


<!-- //Account Update -->
