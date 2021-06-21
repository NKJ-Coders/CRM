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
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                        <h3><i class="fa fa-angle-right"> Modifier les informations sur l'offre</i> </h3>
                    </div>

                    <div class="col-xs-12 col-md-4" style="padding-top: 10px;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="accueil.php">Accueil</a></li>
                                <li class="breadcrumb-item"><a href="offreController.php?action=list">Liste d'offres</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Détail</li>
                            </ol>
                        </nav>
                    </div>
                </div>


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
                            <form action="offreController.php" method="POST">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label>Montant première année</label>
                                            <div>
                                                <input type="text" class="form-control" name="firstyear" value="<?= (!empty($data['montant1an'])) ? $data['montant1an'] : '' ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Montant 2ième, 3ième & 4ième année </label>
                                            <div>
                                                <input type="text" class="form-control" name="montant" value="<?= (!empty($data['montant1an'])) ? $data['montant1an'] : '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Date de dépot</label>
                                            <div>
                                                <input type="date" name="dateoffre" class="form-control" id="" value="<?= (!empty($data['DATEOFFRE'])) ? $data['DATEOFFRE'] : '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="idpros" value="<?= $data['idpros'] ?>">
                                    <input type="hidden" name="action" value="edit">
                                    <input type="hidden" name="idoffre" value="<?= $data['idoffre'] ?>">

                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label>Description de l'offre</label>
                                            <div>
                                                <textarea name="description" class="form-control" id="" cols="30" rows="10"><?= (!empty($data['DESCRIPTIONOFFRE'])) ? $data['DESCRIPTIONOFFRE'] : '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <div class="text-center">
                                        <a href="offreController.php?action=list" class="btn btn-default">Retour</a>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
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