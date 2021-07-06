<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title = 'HLH Radiology Department'; ?></title>
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/service.css'); ?>" />
    <link href='https://fonts.googleapis.com/css?family=Coda' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/kd5id7zhyr77w5xlcd0rgsc6x0ubp2lc6a82fvpprmu13fkl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

  <navigation>
    <div class="top">
        <img src="../../public/images/hlh.png" class="d-flex justify-content-center" alt="HLH Radiology Department" id="logo">
    </div>
    <ul>
      <li><a href="<?php echo url_for('/index.php'); ?>">Main</a></li>

        <?php
        if (isset($_SESSION['userLevel'])) {
            if(!$_SESSION['userLevel'] == 1) {
                echo '<li><a href=register_patient.php>Register Patient</a></li>';
            }        
            else{
            echo '<li><a href=register_patient.php>Register Patient</a></li>';}
        }
        elseif (isset($_SESSION['nhsno'])) {}
        ?>

        <?php
        if (isset($_SESSION['userLevel'])) {
            if($_SESSION['userLevel'] > 0)
                echo '<li><a href=patients.php>Patients</a></li>';
        }
        ?>

        <?php
        if (isset($_SESSION['userLevel'])||isset($_SESSION['nhsno'])) {
        }else{
                echo '<li><a href=../../public/user_login.php>Staff Login</a></li>';
        }
        ?>

        <?php
       if (isset($_SESSION['userLevel'])) {
           if($_SESSION['userLevel'] > 2){
           echo '<li><a href=users.php>Staff</a></li>';
       }}
        ?>

<?php
        if (isset($_SESSION['userLevel'])) {
                echo '<li><a class= "logoutButton" href=user_logout.php>Logout</a></li>';
        }
        ?>


    </ul>
  </navigation>

