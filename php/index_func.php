<?php

function topDocProg($con)
{
    $staff_id = $_SESSION['staff_id'];
    $sql = "SELECT * FROM document WHERE staff_id=$staff_id AND doc_date_accept IS NOT NULL AND doc_date_complete IS NULL";

    if ($result = $con->query($sql)) {

        // Return the number of rows in result set
        $rowcount = mysqli_num_rows($result);

        // Display result
        echo "<p class=\"total_no\">" . $rowcount . "</p>";
    }
}

function topDocSub($con)
{
    $staff_id = $_SESSION['staff_id'];
    $sql = "SELECT * FROM document WHERE staff_id=$staff_id AND doc_date_complete IS NOT NULL";

    if ($result = $con->query($sql)) {

        // Return the number of rows in result set
        $rowcount = mysqli_num_rows($result);

        // Display result
        echo "<p class=\"total_no\">" . $rowcount . "</p>";
    }
}

function topDocAcc($con)
{
    $staff_id = $_SESSION['staff_id'];
    $sql = "SELECT * FROM document WHERE staff_id=$staff_id AND doc_date_accept IS NOT NULL";

    if ($result = $con->query($sql)) {

        // Return the number of rows in result set
        $rowcount = mysqli_num_rows($result);

        // Display result
        echo "<p class=\"total_no\">" . $rowcount . "</p>";
    }
}

function latestDocProg($con)
{
    $staff_id = $_SESSION['staff_id'];
    $sql = "SELECT * FROM document WHERE staff_id=$staff_id 
                ORDER BY doc_date_complete DESC, doc_date_accept DESC, doc_date_received DESC,
                CONCAT(doc_date_complete, doc_date_accept, doc_date_received) DESC";
    $result = $con->query($sql);

    if ($con && ($result->num_rows > 0)) {
        $count = 0;
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            if ($row['doc_date_complete'] != null) {
                echo "<li>
                    <span>
                    <span class=\"name_user\">" . $row['doc_name'] . "</span>
                    <span class=\"msg_user\">Progress: 100%<br>" . $row['doc_date_complete'] . "</span>
                    <span class=\"time_ago\">Completed</span>
                    </span>
                </li>";
            }
            elseif ($row['doc_date_complete'] == null && $row['doc_date_accept'] != null) {
                $doc_id = $row['doc_id'];
                $doc_percent = $row['doc_prog_current'];
                $sql2 = "SELECT * FROM details WHERE doc_id=$doc_id AND det_percent=$doc_percent ";
                $result2 = $con->query($sql2);
                $date = null;

                if($con && ($result2->num_rows > 0)) {
                    $row2 = $result2->fetch_assoc();
                    $date = $row2['det_date'];
                } else {
                    $date = $row['doc_date_accept'];
                }

                echo "<li>
                    <span>
                    <span class=\"name_user\">" . $row['doc_name'] . "</span>
                    <span class=\"msg_user\">Progress: " . $row['doc_prog_current'] . "%<br>" . $date . "</span>
                    <span class=\"time_ago\">In Progress</span>
                    </span>
                </li>";
            }
            else {
                echo "<li>
                    <span>
                    <span class=\"name_user\">" . $row['doc_name'] . "</span>
                    <span class=\"msg_user\">Received at: <br>" . $row['doc_date_received'] . "</span>
                    <span class=\"time_ago\">Received</span>
                    </span>
                </li>";
            }

            $count++;

            if ($count > 4) {
                break;
            }
        }
    }
    elseif ($con && ($result->num_rows == 0)) {
        echo "<span class=\"center\"><i>no document</i></span>";
    }
    else {
        echo "<span><i>error</i></span>";
    }
}

function docProg($con)
{
    $staff_id = $_SESSION['staff_id'];
    $sql = "SELECT * FROM document WHERE staff_id=$staff_id AND doc_date_accept IS NOT NULL AND doc_date_complete IS NULL ORDER BY doc_date_accept";
    $result = $con->query($sql);

    if ($con && ($result->num_rows > 0)) {
        $count = 0;
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<span class=\"skill\" style=\"width:100%;\">" . $row['doc_name'] . "<span class=\"info_valume\">" . $row['doc_prog_current'] . "%</span></span>                  
            <div class=\"progress skill-bar\">
               <div class=\"progress-bar progress-bar-animated progress-bar-striped\" role=\"progressbar\" aria-valuenow=\"" . $row['doc_prog_current'] . "\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: " . $row['doc_prog_current'] . "%;\">
               </div>
            </div>";

            $count++;

            if ($count > 9) {
                break;
            }
        }
    }
    elseif ($con && ($result->num_rows == 0)) {
        echo "<span><i>no document currently in progress</i></span>";
    }
}

function indexAlert($con)
{
    $staff_id = $_SESSION['staff_id'];
    $sql = "SELECT staff_fac FROM staff WHERE staff_id=$staff_id";
    $result = $con->query($sql);
    $text_alert = "";

    if ($con && ($result->num_rows > 0)) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            switch ($row["staff_fac"]) {
                case "AS":
                    $text_alert = "Applied Sciences";
                    break;
                case "AP":
                    $text_alert = "Architecture, Planning & Surveying";
                    break;
                case "EC":
                    $text_alert = "College of Engineering Studies";
                    break;
                case "CS":
                    $text_alert = "Computer & Mathematical Sciences";
                    break;
                case "DS":
                    $text_alert = "Dentistry";
                    break;
                case "HS":
                    $text_alert = "Health Sciences";
                    break;
                case "MB":
                    $text_alert = "Medicine";
                    break;
                case "PH":
                    $text_alert = "Pharmacy";
                    break;
                case "AT":
                    $text_alert = "Plantation & Agrotechnology";
                    break;
                case "SR":
                    $text_alert = "Sport Science & Recreation";
                    break;
                case "AM":
                    $text_alert = "Administrative Science & Policy Studies";
                    break;
                case "CA":
                    $text_alert = "College of Creative Arts";
                    break;
                case "MC":
                    $text_alert = "Communication & Media Studies";
                    break;
                case "ED":
                    $text_alert = "Education";
                    break;
                case "LW":
                    $text_alert = "Law";
                    break;
                case "AC":
                    $text_alert = "Accountancy";
                    break;
                case "BA":
                    $text_alert = "Business & Management";
                    break;
                case "HM":
                    $text_alert = "Hotel & Tourism Mangement";
                    break;
                case "IM":
                    $text_alert = "Information Management";
                    break;
                default:
                    $text_alert = "Not Found";
            }

            echo "<div class=\"padding_infor_info\">
                    <div class=\"alert alert-success\" role=\"alert\">Welcome! Faculty of " . $text_alert . "</div>
                    </div>";
        }
    }
    else {
        echo "error";
    }
}
?>