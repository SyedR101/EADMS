<?php
require 'php/config.php';     // connection to database
require 'php/login_func.php'; // contain functions for login page
?>

<!-- HTML page -->
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
   </head>
   <body class="inner_page login">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                        <img width="210" src="images/logo/uitm.svg" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                     <form action="login.php" method="POST">
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Staff ID</label>
                              <input type="staff_id" name="staff_id" placeholder="Enter Staff ID" />
                           </div>
                           <div class="field">
                              <label class="label_field">Password</label>
                              <input type="password" name="password" placeholder="Enter Password" />
                           </div>
                           <div class="field">
                              <label for="fac" class="label_field">Faculty</label>
                              <select id="fac" name="faculty">
                                 <option value="AS">Applied Sciences</option>
                                 <option value="AP">Architecture, Planning & Surveying</option>
                                 <option value="EC">College of Engineering Studies</option>
                                 <option value="CS">Computer & Mathematical Sciences</option>
                                 <option value="DS">Dentistry</option>
                                 <option value="HS">Health Sciences</option>
                                 <option value="MB">Medicine</option>
                                 <option value="PH">Pharmacy</option>
                                 <option value="AT">Plantation & Agrotechnology</option>
                                 <option value="SR">Sport Science & Recreation</option>
                                 <option value="AM">Administrative Science & Policy Studies</option>
                                 <option value="CA">College of Creative Arts</option>
                                 <option value="MC">Communication & Media Studies</option>
                                 <option value="ED">Education</option>
                                 <option value="LW">Law</option>
                                 <option value="AC">Accountancy</option>
                                 <option value="BA">Business & Management</option>
                                 <option value="HM">Hotel & Tourism Mangement</option>
                                 <option value="IM">Information Management</option>
                               </select>
                           </div>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button class="main_bt" name="signin">Sign In</button>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>