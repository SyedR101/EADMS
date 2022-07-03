<?php
require 'php/config.php'; // connection to database
require 'php/session.php'; // checking if user successfully sign in
require 'php/profile.php'; // show the staff name on the sidebar
require 'php/sidebar.php';    // show sidebar menu option
require 'php/details_func.php'; // contain functions for details page
?>

<!-- HTML Page -->
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Electronic Academic Document Monitoring System</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <link rel="icon" href="images/fevicon.png" type="image/png" />
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <!-- site css -->
   <link rel="stylesheet" href="style.css" />
   <!-- responsive css -->
   <link rel="stylesheet" href="css/responsive.css" />
   <!-- color css -->
   <link rel="stylesheet" href="css/colors.css" />
   <!-- select bootstrap -->
   <link rel="stylesheet" href="css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="css/perfect-scrollbar.css" />
   <!-- custom css -->
   <link rel="stylesheet" href="css/custom.css" />
   <!-- timeline css -->
   <link rel="stylesheet" href="css/timeline.css" />
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="dashboard dashboard_1">
   <div class="full_container">
      <div class="inner_container">
         <!-- Sidebar  -->
         <nav id="sidebar">
            <div class="sidebar_blog_1">
               <div class="sidebar-header">
                  <div class="logo_section">
                     <a href="index.php"><img class="logo_icon img-responsive" src="images/logo/uitm_icon.svg"
                           alt="#" /></a>
                  </div>
               </div>
               <div class="sidebar_user_info">
                  <div class="icon_setting"></div>
                  <div class="user_profle_side">
                     <div class="user_img"><img class="img-responsive" src="images/layout_img/user_img.jpg" alt="#" />
                     </div>
                     <div class="user_info">
                        <h6><label id="sidebar_username"><?php profName($con); ?></label></h6>
                        <p><span class="online_animation"></span> Online</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="sidebar_blog_2">
               <h4>Menu</h4>
               <?php sidebar($con); ?>
            </div>
         </nav>
         <!-- end sidebar -->
         <!-- right content -->
         <div id="content">
            <!-- topbar -->
            <div class="topbar">
               <nav class="navbar navbar-expand-lg navbar-light">
                  <div class="full">
                     <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                           class="fa fa-bars"></i></button>
                     <div class="logo_section">
                        <a href="index.php"><img class="img-responsive" src="images/logo/uitm.svg" alt="#" /></a>
                     </div>
                  </div>
               </nav>
            </div>
            <!-- end topbar -->
            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Details</h2>
                        </div>
                     </div>
                  </div>
                  <!-- document's name + date apply -->
                  <div class="">
                     <div class="heading1 margin_0">
                        <?php detHeading($con); ?>
                     </div>
                  </div>
                  <!-- progress bar -->
                  <div class="">
                     <div class="widget_progress_bar">
                        <div class="progress_bar">
                           <!-- Skill Bars -->
                           <?php detBarProg($con); ?>
                        </div>
                     </div>
                  </div>
                  <!-- buttons for the document -->
                  <div align="center">
                     <div class="button_block">
                        <form method="post">
                           <a href="ongoing.php" name="back_button" class="btn cur-p btn-secondary">Back</a>
                           <button type="button" class="btn cur-p btn-primary" data-toggle="modal" data-target="#updateModal">Update Progress</button>
                           <button type="button" class="btn cur-p btn-primary" data-toggle="modal" data-target="#completeModal">Complete Progress</button>
                        </form>
                     </div>
                  </div></br>
                  <!-- latest progress details -->
                  <div class="full price_table padding_infor_info">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="table-responsive-sm">
                              <table class="table table-striped projects">
                                 <thead class="thead-dark">
                                    <tr>
                                       <th style="width: 2%" hidden>Doc ID</th>
                                       <th style="width: 15%">Date Updated</th>
                                       <th style="width: 2%">Percentage</th>
                                       <th>Note</th>
                                       <th style="width: 10%">Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php tableRow($con); ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- footer -->
               <div class="container-fluid">
                  <div class="footer">
                     <p>Copyright © 2018 Designed by html.design. All rights reserved.<br><br>
                        Distributed By: <a href="https://themewagon.com/">ThemeWagon</a>
                     </p>
                  </div>
               </div>
            </div>
            <!-- end dashboard inner -->
         </div>
      </div>
      <!-- Update Modal -->
      <div class="modal fade" id="updateModal">
         <div class="modal-dialog">
            <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <h4 class="modal-title">Update Progress</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <!-- Modal body -->
               <div class="modal-body">
               <form action="details.php" method="POST">
                  <fieldset>
                     <div class="field form-row row mb-3">
                        <label class="col-sm-4 col-form-label">New Percentage: </label>
                        <input class="form-control" type="number" name="percent" placeholder="Enter New Percentage" />
                     </div>
                     <div class="field form-row row mb-3">
                        <label class="col-sm-2 col-form-label">Note: </label>
                        <input class="form-control" type="note" name="note" placeholder="Enter Note" />
                     </div>
                  </fieldset>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary" name="update_button">Update</button>
                  </div>
               </form>
               </div>
            </div>
         </div>
      </div>
      <!-- Complete Modal -->
      <div class="modal fade" id="completeModal">
         <div class="modal-dialog">
            <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <h4 class="modal-title">Confirm Complete Progress?</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <!-- Modal body -->
               <div class="modal-body">
                  This action is permanent.
               </div>
               <!-- Modal footer -->
               <form action="details.php" method="POST">
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary" name="complete_button">Confirm</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- end update model popup -->
   </div>
   <!-- jQuery -->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <!-- wow animation -->
   <script src="js/animate.js"></script>
   <!-- select country -->
   <script src="js/bootstrap-select.js"></script>
   <!-- owl carousel -->
   <script src="js/owl.carousel.js"></script>
   <!-- chart js -->
   <script src="js/Chart.min.js"></script>
   <script src="js/Chart.bundle.min.js"></script>
   <script src="js/utils.js"></script>
   <script src="js/analyser.js"></script>
   <!-- nice scrollbar -->
   <script src="js/perfect-scrollbar.min.js"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
   <!-- custom js -->
   <script src="js/custom.js"></script>
   <script src="js/chart_custom_style1.js"></script>
</body>

</html>