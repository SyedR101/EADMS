<?php

if (isset($_POST['details_button'])) {
    $doc_id = $_POST['details_button'];
    $_SESSION['doc_id'] = $doc_id;
    header('location:details.php');
}

function tableRow($con)
{
    $staff_id = $_SESSION['staff_id'];
    $sql = "SELECT * FROM document WHERE staff_id=$staff_id AND doc_date_accept IS NOT NULL AND doc_date_complete IS NULL ORDER BY doc_date_accept";
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
                    <td class=\"project_progress\">
                        <div class=\"progress progress_sm\">
                            <div class=\"progress-bar progress-bar-animated progress-bar-striped\" role=\"progressbar\" aria-valuenow=\"" . $row["doc_prog_current"] . "\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: " . $row["doc_prog_current"] . "%;\"></div>
                        </div>
                        <small>" . $row["doc_prog_current"] . "% Completed</small>
                    </td>
                    <td>
                        <form method=\"post\">
                            <button type=\"submit\" name=\"details_button\" class=\"btn btn-info btn-xs\" value='" . $row["doc_id"] . "'>Details</button>
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
                <td class=\"project_progress\">
                    <div class=\"progress progress_sm\">
                        <div class=\"progress-bar progress-bar-animated progress-bar-striped\" role=\"progressbar\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 0%;\"></div>
                    </div>
                    <small><i>no data</i></small>
                </td>
                <td>
                    <button type=\"submit\" name=\"details_button\" class=\"btn btn-info btn-xs\" value=''>NULL</button>
                </td>
            </tr>";
    }
}

?>