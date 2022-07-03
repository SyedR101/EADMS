<!-- check if user successfully sign in -->
<?php
session_start();
if(empty($_SESSION['staff_id']) || $_SESSION['staff_id'] == ''){
    header("Location:login.php");
    die();
}
?>