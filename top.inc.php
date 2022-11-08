<?php
require('db.inc.php');
if(!isset($_SESSION['ROLE'])){
	header('location:login.php');
	die();
}
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Dashboard Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="./style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body>
      <aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">Menu</li>
                  <?php if($_SESSION['ROLE']=="admin"){ ?>
                     <li class="menu-item-has-children dropdown">
                        <a href="Subadmindata.php" > Subadmin</a>
                     </li>
				      <?php } ?>
                  <?php if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="subadmin" ){ ?>
                     <li class="menu-item-has-children dropdown">
                        <a href="employee.php" > Employee </a>
                     </li>
                     <li class="menu-item-has-children dropdown">
                        <a href="employee_payroll_data.php" > Employee Payroll Data </a>
                     </li>
				      <?php } else { ?>
				      <li class="menu-item-has-children dropdown">
                     <a href="employee-profile.php?id=<?php echo $_SESSION['USER_ID']?>" > Profile</a>
                  </li>
				  <?php } ?>
                  <li class="menu-item-has-children dropdown">
                        <a href="leave.php" >Employee Leave</a>
                  </li>
               <?php if( $_SESSION['ROLE']=="subadmin" ){ ?>
                  <li class="menu-item-has-children dropdown">
                        <a href="subadminleave.php" >My Leave</a>
                  </li>
               <?php } ?>
               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header d-flex">
                  <a class="navbar-brand" href="employee.php"><img src="images/Logo.svg" alt="Logo"></a>
               </div>
            </div>
            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right d-flex align-items-center">
                     <a href="employee-profile.php?id=<?php echo $_SESSION['USER_ID']?>" class="dropdown-toggle active" >Welcome <?php echo $_SESSION['USER_NAME']?></a>
                     <a class="nav-link" href="logout.php">Logout <i class="fa fa-power-off text-dark"></i></a>
                  </div>
               </div>
            </div>
         </header>