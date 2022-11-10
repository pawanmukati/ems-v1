<?php
require('db.inc.php');
if (!isset($_SESSION['ROLE'])) {
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
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   <link rel="stylesheet" href="assets/css/themify-icons.css">
   <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
   <link rel="stylesheet" href="assets/css/flag-icon.min.css">
   <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
   <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
   <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="./style.css">
   <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
   <style>
      .dropdown-submenu {
         position: relative;
         list-style: none;
      }

      .dropdown-submenu>.dropdown-menu {
         top: 0;
         left: 100%;
         margin-top: -6px;
         margin-left: -1px;
         -webkit-border-radius: 0 6px 6px 6px;
         -moz-border-radius: 0 6px 6px;
         border-radius: 0 6px 6px 6px;
         z-index: 333 !important;
      }

      .dropdown-submenu:hover>.dropdown-menu {
         display: block;
      }

      .dropdown-submenu:hover>a:after {
         border-left-color: #fff;
      }

      .dropdown-submenu.pull-left {
         float: none;
      }

      .dropdown-submenu.pull-left>.dropdown-menu {
         left: -100%;
         margin-left: 10px;
         -webkit-border-radius: 6px 0 6px 6px;
         -moz-border-radius: 6px 0 6px 6px;
         border-radius: 6px 0 6px 6px;
      }
      .dropdown-menu{
         left: 50px;
         border: none;
         box-shadow: none;
         background-color: transparent !important;
      }
      .dropdown-menu a{
         padding: 0 !important;
      }
      .navbar .navbar-nav li.menu-item-has-children.dropdown .dropdown-menu li a:before {
         top: 13px;
      }
      .navbar .navbar-nav li.menu-item-has-children.dropdown .dropdown-menu li a[role="button"]::before{
         transform: rotate(135deg);
      }
   
   </style>
</head>

<body>
   <aside id="left-panel" class="left-panel">
      <nav class="navbar navbar-expand-sm navbar-default">
         <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
               <li class="menu-title">Menu</li>
               <?php if ($_SESSION['ROLE'] == "admin") { ?>
               <li class="menu-item-has-children ">
                  <a href="Subadmindata.php"> Subadmin</a>
               </li>
               <?php } ?>
               <?php if ($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "subadmin") { ?>
               <li class="menu-item-has-children ">
                  <a href="employee.php"> Employee </a>
               </li>
               <li class="menu-item-has-children ">
                  <a href="employee_payroll_data.php"> Employee Payroll Data </a>
               </li>
               <?php } else { ?>
               <li class="menu-item-has-children ">
                  <a href="employee-profile.php?id=<?php echo $_SESSION['USER_ID'] ?>"> Profile</a>
               </li>
               <?php } ?>
               <li class="menu-item-has-children ">
                  <a href="leave.php">Employee Leave</a>
               </li>
               <?php if ($_SESSION['ROLE'] == "subadmin") { ?>
               <li class="menu-item-has-children ">
                  <a href="subadminleave.php">My Leave</a>
               </li>
               <?php } ?>


               <li class="menu-item-has-children dropdown">
                  <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">Inventory</a>
                  <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                     <li class="dropdown-submenu">
                        <a href="#" role="button" data-toggle="dropdown" data-target="#" >Categories</a>
                        <ul class="dropdown-submenu" role="menu" aria-labelledby="dropdownSubMenu">
                           <li><a href="IT_categories.php">IT Assets</a></li>
                           <li><a href="#">Non-IT Assets</a></li>
                           <!-- <li class="dropdown-submenu">
                              <a href="#">Even More..</a>
                              <ul class="dropdown-menu">
                                 <li><a href="#">3rd level</a></li>
                                 <li><a href="#">3rd level</a></li>
                              </ul>
                           </li> -->
                        </ul>
                     </li>
                  </ul>
               </li>


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
                  <a href="employee-profile.php?id=<?php echo $_SESSION['USER_ID'] ?>"
                     class="dropdown-toggle active">Welcome
                     <?php echo $_SESSION['USER_NAME'] ?>
                  </a>
                  <a class="nav-link" href="logout.php">Logout <i class="fa fa-power-off text-dark"></i></a>
               </div>
            </div>
         </div>
      </header>