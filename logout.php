<?php
   session_start();
   unset($_SESSION["staff_id"]);
   unset($_SESSION['doc_id']);

   header('Refresh: 1; URL = login.php');
?>