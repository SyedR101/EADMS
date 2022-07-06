<?php

if (isset($_POST['update_button'])) {
    $staff_id = $_SESSION['staff_id'];
    $doc_id = $_SESSION['doc_id'];
    $date = date('Y-m-d H:i:s');
    $percent = null;
    $note = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["percent"])) {
            $percent = null;
        }
        else {
            $percent = test_input($_POST["percent"]);
        }
    }

    if (empty($_POST["note"])) {
        $note = "";
    }
    else {
        $note = test_input($_POST["note"]);
    }

    $sql = "SELECT * FROM document WHERE staff_id=$staff_id AND doc_id=$doc_id";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $currentProg = $row['doc_prog_current'];

    if ($percent != null && $percent > $currentProg && $percent < 100) {
        $sql2 = "INSERT INTO details VALUES (NULL, '$doc_id', '$percent', '$date', '$note')";
        $result2 = $con->query($sql2);

        $sql3 = "UPDATE document SET doc_prog_current='$percent' WHERE staff_id='$staff_id' AND doc_id='$doc_id'";
        $result3 = $con->query($sql3);

        if ($result2 == true && $result3 == true) {
            echo '<script>alert("Progress has been updated.")</script>';
        }
        elseif ($result2 == true && $result3 != true) {
            echo '<script>alert("Details has been updated. But current progress hasnt.")</script>';
        }
        elseif ($result2 != true && $result3 == true) {
            echo '<script>alert("Details hasnt been updated. But current progress has.")</script>';
        }
        else {
            echo '<script>alert("Error updating progress.")</script>';
        }
    }
    elseif ($percent != null && ($percent <= $currentProg || $percent > 100)) {
        echo '<script>alert("New percentage cannot be lower than current progress and more than 100%.")</script>';
    }
    elseif ($percent == 100) {
        echo '<script>alert("Use Complete Progress button to apply 100% to the document.")</script>';
    }
    else {
        echo '<script>alert("New percentage is invalid. Cannot be empty.")</script>';
    }
}

if (isset($_POST['delete_button'])) {
    $det_id = $_POST['delete_button'];
    deleteData($con, $det_id);
}

if (isset($_POST['complete_button'])) {
    $staff_id = $_SESSION['staff_id'];
    $doc_id = $_SESSION['doc_id'];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO details VALUES (NULL, '$doc_id', 100, '$date', 'Progress Completed')";
    $result = $con->query($sql);

    $sql2 = "UPDATE document SET doc_date_complete='$date', doc_prog_current=100 WHERE staff_id='$staff_id' AND doc_id='$doc_id'";
    $result2 = $con->query($sql2);

    header('Refresh: 1; URL = ongoing.php');

    if ($result == true && $result2 == true) {
        echo '<script>alert("The document progress is completed.")</script>';
    }
    else {
        echo '<script>alert("Error!")</script>';
    }
}

function deleteData($con, $detid)
{
    $staff_id = $_SESSION['staff_id'];
    $doc_id = $_SESSION['doc_id'];
    $det_id = $detid;
    $sql = "DELETE FROM details WHERE det_id=$det_id AND doc_id=$doc_id";
    $result = $con->query($sql);

    $sql2 = "SELECT * FROM details WHERE doc_id=$doc_id ORDER BY det_date DESC, det_percent DESC";
    $result2 = $con->query($sql2);
    $row2 = $result2->fetch_assoc(); // will fetch first row out of many
    $currentProg = $row2['det_percent'];

    $sql3 = "UPDATE document SET doc_prog_current='$currentProg' WHERE staff_id='$staff_id' AND doc_id='$doc_id'";
    $result3 = $con->query($sql3);

    if ($result == true && $result3 == true) {
        echo '<script>alert("The details have been deleted.\nThe progress has been updated.")</script>';
    }
    else {
        echo '<script>alert("Error!")</script>';
    }

    header('Refresh: 1; URL = details.php');
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

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
        echo "error";
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
        echo "error";
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
                    <td>
                        <form method=\"post\">
                            <button type=\"submit\" name=\"delete_button\" class=\"btn btn-info btn-xs\" value='" . $row['det_id'] . " '>Delete</button>
                        </form>
                    </td>
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