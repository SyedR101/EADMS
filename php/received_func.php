<?php

if (isset($_POST['decline_button'])) {
    $doc_id = $_POST['decline_button'];
    deleteData($con, $doc_id);
}
else if (isset($_POST['accept_button'])) {
    $doc_id = $_POST['accept_button'];
    acceptData($con, $doc_id);
}

function tableRow($con)
{
    $staff_id = $_SESSION['staff_id'];
    $sql = "SELECT * FROM document WHERE staff_id=$staff_id AND doc_date_accept IS NULL";
    $result = $con->query($sql);

    if ($con && ($result->num_rows > 0)) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            echo "<tr>
                    <td hidden>" . $row["doc_id"] . "</td>
                    <td>
                        <a>" . $row["doc_name"] . "</a>
                    </td>
                    <td>
                        <a>" . $row["doc_date_received"] . "</a>
                    </td>
                    <td>
                        <form method=\"post\">
                            <button type=\"submit\" name=\"decline_button\" class=\"btn btn-secondary btn-xs\" value='" . $row["doc_id"] . "'>Decline</button>
                            <button type=\"submit\" name=\"accept_button\" class=\"btn btn-primary btn-xs\" value='" . $row["doc_id"] . "'>Accept</button>
                        </form>
                    </td>
                </tr>";
        }
    }
    else {
        echo "<tr>
                    <td hidden>-1</td>
                    <td>
                        <a><i>no data</i></a>
                    </td>
                    <td>
                        <a><i>no data</i></a>
                    </td>
                    <td>
                        <button type=\"button\" class=\"btn btn-secondary btn-xs\">NULL</button>
                        <button type=\"button\" class=\"btn btn-primary btn-xs\">NULL</button>
                    </td>
                </tr>";
    }
}



function deleteData($con, $did)
{
    $staff_id = $_SESSION['staff_id'];
    $doc_id = $did;
    $sql = "DELETE FROM document WHERE staff_id=$staff_id AND doc_id=$doc_id";
    $result = $con->query($sql);
    if ($result == true) {
        echo '<script>alert("You have declined the document.")</script>';
    }
    else {
        echo '<script>alert("Error!")</script>';
    }
    header('Refresh: 1; URL = received.php');
}

function acceptData($con, $did)
{
    $staff_id = $_SESSION['staff_id'];
    $doc_id = $did;
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE document set doc_date_accept = '$date', doc_prog_current = '0' WHERE staff_id=$staff_id AND doc_id=$doc_id";
    $result = $con->query($sql);
    if ($result == true) {
        echo '<script>alert("You have accepted the document.")</script>';
    }
    else {
        echo '<script>alert("Error!")</script>';
    }
    header('Refresh: 1; URL = received.php');
}
?>