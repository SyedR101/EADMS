<?php

function sidebar($con) {
    echo "<ul class=\"list-unstyled components\">
            <li><a href=\"index.php\"><i class=\"fa fa-dashboard yellow_color\"></i> <span>Dashboard</span></a></li>
            <li><a href=\"ongoing.php\"><i class=\"fa fa-clock-o orange_color\"></i> <span>Ongoing</span></a></li>
            <li><a href=\"received.php\"><i class=\"fa fa-download purple_color\"></i> <span>Received</span></a></li>
            <li><a href=\"completed.php\"><i class=\"fa fa-check-square-o purple_color2\"></i> <span>Completed</span></a></li>
            <li><a href=\"logout.php\"><i class=\"fa fa-sign-out blue2_color\"></i> <span>Logout</span></a></li>
        </ul>";
}

?>