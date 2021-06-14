<?php
session_start();
$conn = mysqli_connect("remotemysql.com", "NVBXd4n6Q9", "cyJkBWARLr", "NVBXd4n6Q9");
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$Pid=$_SESSION['Pid'];
$email_id=$_SESSION['email_id'];
$username=$_SESSION['username'];

if(isset($_POST['submit'])){
         $vdate = mysqli_real_escape_string($conn, $_REQUEST['vdate']);
         $visit_date=date_create($vdate);
         date_format($visit_date,"d-m-Y");
         $datetime1 = date_create($vdate);

         $date = date("d-m-Y");
         //echo $date;
         $datetime2 = date_create($date);
  
        $interval = date_diff($datetime1, $datetime2);

        $diff = $interval->format('%R%a');

        if (is_numeric($diff))
              $number = $diff + 0;
        else // Let the number be 0 if the string is not a number
      $number = 0;

        if($diff > 0)
            echo '<script>alert("Enter a valid date of visit")</script>';

          else{
            $_SESSION['vdate'] = $vdate;
            header('location:book_slot.php');
          }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Appointment</title>
  <link rel="stylesheet" href="book.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
<div class="responsive">
    <div class="navigation"><br><br>
        <ul>
            <li><a href="main.php"><i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;Home</a></li>
            <li style="background-color: #014;"><a href="#"><i class="fas fa-calendar-check"></i>&nbsp;&nbsp;&nbsp;Book an Appointment</a></li>
            <li><a href="viewappointments.php"><i class="fas fa-address-card"></i>&nbsp;&nbsp;&nbsp;View Appointments</a></li>
            <li><a href="cancel.php"><i class="fas fa-window-close"></i>&nbsp;&nbsp;&nbsp;Cancel Appointments</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;Logout</a></li>
        </ul>
    </div>


      <form action="book.php" method="post">
      <div class="subcontainer"><br>
        <label style="color: #014">Fill the form to book your appointment</label><br><br><br>
        <label><b style="font-size: 20px;">Name:</b></label><br>
        <input type="text" name="username" disabled placeholder=<?php echo $_SESSION['username'];?>><br>


        <div class="form-group">
          <label for="vdate"><b style="font-size: 20px;">Date of Visit</b> (yyyy-mm-dd):</label><br>
            <input type="text" id="vdate" name="vdate" placeholder="yyyy-mm-dd" required=" " 
            pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"><br><br>
        </div>
<br>
        <center><input type="submit" name="submit" id="btn" class="button1" value="Continue"></center>
    </div>
</form>
</div>
</body>
</html>
