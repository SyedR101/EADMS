<?php
function profName($con) {
    $staff_id = $_SESSION['staff_id'];
    $sql = "SELECT staff_name FROM staff WHERE staff_id=$staff_id";
    $result = $con->query($sql);

    if ($con && ($result->num_rows > 0)) 
    {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {
            echo $row["staff_name"]. "<br>";
        }
    } else {
         echo "error";
    }
}
?>