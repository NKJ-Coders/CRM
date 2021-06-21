<?php
session_start();



require_once('include/connexion.php');


$data_contact = $bdd->prepare('SELECT * FROM contactprospect WHERE IDCONT = ?');
$data_contact->execute(array($_GET['id']));
$data = $data_contact->fetch();
// var_dump($data);
// exit;
if (!empty($data)) extract($data);


?>

<?php if (isset($_SESSION) && !empty($_SESSION)) {
    $type = $_SESSION['type'];
     ?>
    <?php if ($type == 'Commercial' || $type == 'admin') { ?>
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
                        <h3><i class="fa fa-angle-right">Modifier les informations du Prospect</i> </h3>


                        <div class="row mb">
                            <!-- page start-->
                            <div class="content-panel">
                                <?php if (isset($_GET['msg'])) : ?>
                                    <?php if ($_GET['msg'] == 1) { ?>
                                        <div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <span class="mr-3 fa fa-check"></span> <strong>BRAVO!</strong> Mise a jour avec succès !
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <span class="mr-3 fa fa-info-circle"></span> Echec d'insertion
                                        </div>
                                    <?php } ?>
                                <?php endif; ?>

                                <div class="container">
                                    <form action="editContact.php" method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" name="idcont" value="<?= $IDCONT ?>">
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label>Nom du contact</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="nom" value="<?= (!empty($NOMCONT)) ? $NOMCONT : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label>Prenom </label>
                                                    <div>
                                                        <input type="text" class="form-control" name="prenom" value="<?= (!empty($PRENOMCONT)) ? $PRENOMCONT : '' ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label>Poste </label>
                                                    <div>
                                                        <input type="text" class="form-control" name="poste" value="<?= (!empty($POSTECONT)) ? $POSTECONT : '' ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label>Adresse</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="adresse" value="<?= (!empty($ADRESSECONT)) ? $ADRESSECONT : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label>Telephone </label>
                                                    <div>
                                                        <input type="text" class="form-control" name="tel" value="<?= (!empty($TELCONT)) ? $TELCONT : '' ?>">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <div class="text-center">
                                                <button type="button" class="btn btn-default">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                            </div>
                                        </div>
                                    </form>
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
                            &copy; Copyrights <strong>SYSCRM</strong>. All Rights Reserved
                        </p>
                        <div class="credits">
                            <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/SYSCRM-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->

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
        </body>

        </html>
    <?php } else { ?>
        <?php include '401.php'; ?>
    <?php } ?>
<?php } else { ?>
    <?php include '401.php'; ?>
<?php } ?>