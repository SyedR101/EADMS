<?php

function detHeading($con)
{
    $staff_id = $_SESSION['staff_id'];
    $doc_id = $_SESSION['doc_id'];

    $sql = "SELECT * FROM document WHERE staff_id=$staff_id AND doc_id=$doc_id AND doc_date_accept IS NOT NULL";
    $result = $con->query($sql);

    if ($con && ($result->num_rows > 0)) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<h2><i class=\"fa fa-file-o\"></i> " . $row['doc_name'] . "</h2>
                    <h6><i class=\"fa fa-calendar\"></i> " . $row['doc_date_accept'] . "</h6>";
        }
    }
    else {
        echo '<script>alert("Error! No data.")</script>';
    }
}

function detBarProg($con)
{
    $staff_id = $_SESSION['staff_id'];
    $doc_id = $_SESSION['doc_id'];

    $sql = "SELECT * FROM document WHERE staff_id=$staff_id AND doc_id=$doc_id AND doc_prog_current IS NOT NULL";
    $result = $con->query($sql);

    if ($con && ($result->num_rows > 0)) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<span class=\"skill\" style=\"width:" . $row['doc_prog_current'] . "%;\"><span class=\"info_valume\">" . $row['doc_prog_current'] . "%</span></span>
                    <div class=\"progress skill-bar \">
                    <div class=\"progress-bar progress-bar-animated progress-bar-striped\" role=\"progressbar\"
                        aria-valuenow=\"" . $row['doc_prog_current'] . "\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: " . $row['doc_prog_current'] . "%;\"></div>
                    </div>";
        }
    }
    else {
        echo '<script>alert("Error! No data.")</script>';
    }
}

function tableRow($con)
{
    $doc_id = $_SESSION['doc_id'];
    $sql = "SELECT * FROM details WHERE doc_id=$doc_id ORDER BY det_date DESC, det_percent DESC";
    $result = $con->query($sql);

    $sql2 = "SELECT * FROM document WHERE doc_id=$doc_id AND doc_date_accept IS NOT NULL";
    $result2 = $con->query($sql2);
    $row2 = $result2->fetch_assoc();
    $acceptDate = $row2['doc_date_accept'];

    if ($con && ($result->num_rows > 0)) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td hidden>" . $row['det_id'] . "</td>
                    <td>
                        <a>" . $row['det_date'] . "</a>
                    </td>
                    <td>
                        <a>" . $row['det_percent'] . "%</a>
                    </td>
                    <td>
                        <a>" . $row['det_note'] . "</a>
                    </td>
                    <td></td>
                </tr>";
        }

        echo "<tr>
                <td hidden>0</td>
                <td>
                    <a>" . $acceptDate . "</a>
                </td>
                <td>
                    <a>0%</a>
                </td>
                <td>
                    <a>Accepted the document.</a>
                </td>
                <td></td>
            </tr>";
    }
    else {
        echo "<tr>
                <td hidden>0</td>
                <td>
                    <a>" . $acceptDate . "</a>
                </td>
                <td>
                    <a>0</a>
                </td>
                <td>
                    <a>Accepted the document.</a>
                </td>
                <td></td>
            </tr>";
    }
}

?>