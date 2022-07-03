<?php
if (isset($_POST['signin'])) {
   $staff_id = $_POST['staff_id'];
   $password = $_POST['password'];
   $faculty = $_POST['faculty'];

   if ($staff_id != null || $password != null) {
      $query = "SELECT * FROM staff WHERE staff_id=$staff_id AND staff_pass='$password' AND staff_fac='$faculty'";

      $result = mysqli_query($con, $query);

      if (mysqli_num_rows($result) == 1) {
         session_start();
         // global variable
         $_SESSION['staff_id'] = $staff_id;
         header('location:index.php');
      }
      else {
         echo '<script>alert("Invalid! Try Again")</script>';
      }   
   } else {
      echo '<script>alert("Please enter Staff ID or Password to sign in.")</script>';
   }
}
?>