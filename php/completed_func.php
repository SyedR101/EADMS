<?php

if (isset($_POST['details2_button'])) {
    $staff_id = $_SESSION['staff_id'];
    $doc_id = $_POST['details2_button'];

    $sql = "SELECT * FROM document WHERE staff_id=$staff_id AND doc_id=$doc_id";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if ($con && ($result->num_rows > 0)) {
        if ($row['doc_prog_current'] == 100) {
            $_SESSION['doc_id'] = $doc_id;
            header('location:detComp.php');
        }
        else {
            echo '<script>alert("Error! This document is not completed yet.")</script>';
        }
    }
    else {
        echo '<script>alert("Error! No data.")</script>';
    }


}

function tableRow($con)
{
    $staff_id = $_SESSION['staff_id'];
    $sql = "SELECT * FROM document WHERE staff_id=$staff_id AND  doc_date_complete IS NOT NULL AND doc_prog_current = 100 ORDER BY doc_date_complete";
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
                        <a>" . $row["doc_date_accept"] . "</a>
                    </td>
                    <td>
                        <a>" . $row["doc_date_complete"] . "</a>
                    </td>
                    <td>
                        <form method=\"post\">
                            <button type=\"submit\" name=\"details2_button\" class=\"btn btn-info btn-xs\" value='" . $row["doc_id"] . "'>Details</button>
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
                    <a><i>no data</i></a>
                </td>
                <td>
                        <a><i>no data</i></a>
                    </td>
                <td>
                    <button type=\"button\" name=\"\" class=\"btn btn-info btn-xs\" value=''>NULL</button>
                </td>
            </tr>";
    }
}
?>