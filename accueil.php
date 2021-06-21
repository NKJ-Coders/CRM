  <?php
    session_start();

    $id = (int) $_SESSION['id'];
    $type = $_SESSION['type'];

    require_once('include/connexion.php');

    ?>

  <?php if (!empty($_SESSION)) { ?>
      <?php if ($type == 'admin' || $type == 'Commercial' || $type == 'Partenaire') { ?>

          <!DOCTYPE html>
          <html lang="en">

          <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <meta name="description" content="">
              <meta name="author" content="Dashboard">
              <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
              <title>SYSCRM</title>

              <!-- Favicons -->
              <link href="img/favicon.png" rel="icon">
              <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

              <!-- Bootstrap core CSS -->
              <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
              <!--external css-->
              <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
              <link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
              <link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
              <link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" />

              <!-- Bootstrap core CSS -->
              <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
              <!-- Custom styles for this template -->
              <link href="css/style.css" rel="stylesheet">
              <link href="css/style-responsive.css" rel="stylesheet">
              <style>
                  body {
                      background: url('./images/home_bg.jpg');
                  }
              </style>

              <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/SYSCRM-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
          </head>

          <body>

              <!-- import modal -->
              <?php require 'include/modalFormProspect.php'; ?>

              <section id="container">
                  <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
                  <!--header start-->
                  <header class="header black-bg">
                      <?php include 'include/navbar.php' ?>
                  </header>
                  <!--header end-->
                  <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR Acceuil
        *********************************************************************************************************************************************************** -->
                  <!--sidebar start-->
                  <?php require('include/sidebar.php'); ?>
                  <!--sidebar end-->
                  <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
                  <!--main content start-->
                  <section id="main-content">
                      <section class="wrapper">
                      </section>
                      <!-- /wrapper -->
                  </section>
                  <!-- /MAIN CONTENT -->
                  <!--main content end-->
              </section>
              <!-- js placed at the end of the document so the pages load faster -->
              <script src="lib/jquery/jquery.min.js"></script>
              <script src="lib/bootstrap/js/bootstrap.min.js"></script>
              <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script>
              <script src="lib/bootstrap/js/bootstrap.min.js"></script>
              <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
              <script src="lib/jquery.scrollTo.min.js"></script>
              <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
              <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
              <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>
              <!--common script for all pages-->
              <script src="lib/common-scripts.js"></script>
          </body>

          </html>
      <?php } else { ?>
          <?php include '401.php'; ?>
      <?php } ?>
  <?php } else { ?>
      <?php include '401.php'; ?>
  <?php } ?>