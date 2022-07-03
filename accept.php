<?php
   require 'php/config.php';        // connection to database
   require 'php/session.php';       // checking if user successfully sign in

   header('Refresh: 1; URL = received.php');
?>