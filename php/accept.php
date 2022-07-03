<?php
require 'php/config.php'; // connection to database
require 'php/session.php'; // checking if user successfully sign in

$id = $_REQUEST['cid'];

header('Refresh: 1; URL = received.php');
?>