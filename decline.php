<?php
//require 'php/config.php'; // connection to database
//require 'php/session.php'; // checking if user successfully sign in

function deleteData($con)
{
    $staff_id = $_SESSION['staff_id'];
    $doc_id = $_POST['docid'];
    $sql = "DELETE FROM document WHERE staff_id=$staff_id AND doc_id=$doc_id";
    $result = $con->query($sql);
    if ($result === true) {
        echo '<script>alert("Document is declined.")</script>';
    } else {
        echo '<script>alert("Error!")</script>';
    }
    header('Refresh: 1; URL = received.php');
}
?>