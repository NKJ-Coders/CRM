 <?php
    session_start();
    $type = $_SESSION['type'];

    $idprosp = $_GET['id_client'];

    require_once('include/connexion.php');
    $data_contact = $bdd->prepare('SELECT * FROM contactprospect as c, prospect as p WHERE c.IDPROS = p.idpros AND c.IDPROS = :idprosp AND c.online=1');
    $data_contact->execute(array('idprosp' => $idprosp));

    // recuperer l'entreprise prospect
    $query = $bdd->prepare('SELECT nompros FROM prospect as p WHERE p.idpros = :idprosp');
    $query->execute(array('idprosp' => $idprosp));
    $entreprise = $query->fetch();
    ?>

 <?php if (isset($_SESSION) && !empty($_SESSION)) { ?>
     <?php if ($type == 'Commercial' || $type == 'admin' || $type == 'Partenaire') { ?>
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
                 .adv-table {
                     padding: 5px;
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
             <?php require 'include/contact/modalFormContact.php'; ?>
             <?php require 'include/confirmModal.php'; ?>

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
        MAIN SIDEBAR MENU
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
                         <h3><i class="fa fa-angle-right"></i> Liste des Contacts <a class="ml-5 btn btn-primary" data-toggle="modal" data-target="#myModalContact"><span class="fa fa-plus"></span></a></h3>


                         <div class="row mb">
                             <!-- page start-->
                             <div class="content-panel">

                                 <?php if (isset($_GET['msg'])) : ?>
                                     <?php if ($_GET['msg'] == 1) { ?>
                                         <div class="alert alert-success alert-dismissable">
                                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                             <span class="mr-3 fa fa-check"></span> <strong>BRAVO!</strong> Contact inséré avec succès !
                                         </div>
                                     <?php } else { ?>
                                         <div class="alert alert-warning alert-dismissable">
                                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                             <span class="mr-3 fa fa-info-circle"></span> <strong>Attention!</strong> erreur d'insertion !
                                         </div>
                                     <?php } ?>
                                 <?php endif; ?>

                                 <div class="adv-table">
                                     <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                                         <thead>
                                             <tr>
                                                 <th>N°</th>
                                                 <th>Nom</th>
                                                 <th>Entreprise</th>
                                                 <th>Poste</th>
                                                 <th class="hidden-phone hidden-tablet">Adresse</th>
                                                 <th>Telephone</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php $k = 1; ?>
                                             <?php while ($data = $data_contact->fetch(PDO::FETCH_ASSOC)) : ?>
                                                 <tr class="gradeX">
                                                     <td><?= $k ?></td>
                                                     <td><?= $data['NOMCONT'] . ' ' . $data['PRENOMCONT'] ?></td>
                                                     <td class="hidden-phone"><?= $data['nompros'] ?></td>
                                                     <td"><?= $data['POSTECONT'] ?></td>
                                                         <td class="hidden-phone hidden-tablet"><?= $data['ADRESSECONT'] ?></td>
                                                         <td><?= $data['TELCONT'] ?></td>
                                                         <td class="center d-flex p-2">
                                                             <div class="btn-group">
                                                                 <a href="editContactForm.php?id=<?= $data['IDCONT'] ?>" class="btn btn-primary item-group"><span id="btnEdit"><i class="fa fa-edit"></i></span> <span id="detail">Detail</span></a>
                                                                 <button type="button" class="btn btn-primary dropdown-toggle item-group" data-toggle="dropdown">
                                                                     <span class="caret"></span>
                                                                     <span class="sr-only">Toggle Dropdown</span>
                                                                 </button>
                                                                 <ul class="dropdown-menu" role="menu">
                                                                     <li><a href="" class="dropdown-item"><span class="fa fa-trash"></span> Supprimer</a></li>

                                                                     <li class="divider"></li>
                                                                     <li><a href="questionnaireForm.php?id=<?= $data['IDCONT'] ?>">Consulter questionnaire</a></li>
                                                                     <li><a href="objectionForm.php?id=<?= $data['IDCONT'] ?>">Consulter les objections</a></li>
                                                                 </ul>
                                                             </div>
                                                         </td>
                                                 </tr>
                                                 <?php require 'include/rdvModal.php'; ?>

                                                 <?php $k++; ?>
                                             <?php endwhile; ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                             <!-- page end-->
                         </div>
                         <!-- /row -->
                     </section>
                     <!-- /wrapper -->
                 </section>
                 <!-- /MAIN CONTENT -->
                 <!--main content end-->
                 <!--footer start-->
                 <footer class="site-footer">
                     <div class="text-center">
                         <p>
                             &copy; Copyrights <strong>Global Asset Cameroon</strong>. All Rights Reserved
                         </p>
                         <div class="credits">
                             <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/SYSCRM-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
                             Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
                         </div>
                         <a href="listClients.php#" class="go-top">
                             <i class="fa fa-angle-up"></i>
                         </a>
                     </div>
                 </footer>
                 <!--footer end-->
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
             <!--script for this page-->
             <script type="text/javascript">
                 /* Formating function for row details */
                 function fnFormatDetails(oTable, nTr) {
                     var aData = oTable.fnGetData(nTr);
                     var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                     sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
                     sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
                     sOut += '<tr><td>Extra info:</td><td>En cour...</td></tr>';
                     sOut += '</table>';

                     return sOut;
                 }

                 $(document).ready(function() {
                     /*
                      * Insert a 'details' column to the table
                      */
                     var nCloneTh = document.createElement('th');
                     var nCloneTd = document.createElement('td');
                     nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
                     nCloneTd.className = "center";

                     $('#hidden-table-info thead tr').each(function() {
                         this.insertBefore(nCloneTh, this.childNodes[0]);
                     });

                     $('#hidden-table-info tbody tr').each(function() {
                         this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
                     });

                     /*
                      * Initialse DataTables, with no sorting on the 'details' column
                      */
                     var oTable = $('#hidden-table-info').dataTable({
                         "aoColumnDefs": [{
                             "bSortable": false,
                             "aTargets": [0]
                         }],
                         "aaSorting": [
                             [1, 'asc']
                         ]
                     });

                     /* Add event listener for opening and closing details
                      * Note that the indicator for showing which row is open is not controlled by DataTables,
                      * rather it is done here
                      */
                     $('#hidden-table-info tbody td img').live('click', function() {
                         var nTr = $(this).parents('tr')[0];
                         if (oTable.fnIsOpen(nTr)) {
                             /* This row is already open - close it */
                             this.src = "lib/advanced-datatable/media/images/details_open.png";
                             oTable.fnClose(nTr);
                         } else {
                             /* Open this row */
                             this.src = "lib/advanced-datatable/images/details_close.png";
                             oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
                         }
                     });
                 });
             </script>


             <!-- Modal -->

         </body>

         </html>
     <?php } else { ?>
         <?php include '401.php'; ?>
     <?php } ?>
 <?php } else { ?>
     <?php include '401.php'; ?>
 <?php } ?>