<?php
if (isset($_SESSION) && !empty($_SESSION)) {
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

            <!-- Custom CSS -->
            <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
            <!-- Custom CSS -->
            <link href="dist/css/style.min.css" rel="stylesheet">
            <link href="assets/libs/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
            <!-- <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet"> -->
            <link rel="stylesheet" type="text/css" href="assets/libs/jquery-minicolors/jquery.minicolors.css">
            <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
            <style>
                .el-element-overlay,
                .wrapper {
                    padding: 10px;
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
                        <h2><i class="fa fa-angle-right"> Pièces jointes </i> </h2>


                        <!-- <div class="row mb"> -->
                        <!-- page start-->
                        <!-- <div class="content-panel">


                                <div class="container"> -->

                        <!-- <div class="card">
                                        <div class="card-body"> -->

                        <!-- Decharges pdf-->
                        <div class="row el-element-overlay">
                            <div class="col-md-12">
                                <h4 class="card-title" id="piece">Décharges de prise de contact</h4>
                            </div>
                            <hr>

                            <?php while ($decharge = $decharges->fetch(PDO::FETCH_ASSOC)) { ?>

                                <?php if ($decharge['online'] != -1) { ?>
                                    <div class="col-lg-3 col-md-6">
                                        <!-- <div class="card"> -->
                                        <div class="el-card-item">
                                            <div class="el-card-avatar el-overlay-1"><embed src="./Documents/<?= $decharge['illustration'] ?>" type="application/pdf" width="350" height="150" />
                                                <div class="el-overlay">
                                                    <ul class="list-style-none el-info">
                                                        <li class="el-item"><a class="btn default btn-outline el-link" href="./Documents/<?= $decharge['illustration'] ?>" target="_blank" title="Visualiser le fichier"><i class="mdi mdi-magnify-plus"></i></a></li>
                                                        <li class="el-item"><a class="btn default btn-outline el-link" href="syntheseController.php?action=delete&idpros=<?= $_GET['id'] ?>&id=<?= $decharge['ids'] ?>" title="Supprimer"><i class="fa fa-trash"></i></a></li>
                                                        <li class="el-item"><a type="button" data-toggle="modal" data-target="#modal_decharge<?= $decharge['ids'] ?>" class="btn default btn-outline el-link" title="Modifier"><i class="fa fa-edit"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="el-card-content">
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="modal fade" id="modal_decharge<?= $decharge['ids'] ?>" tabindex="-1" role="dialog" aria-labelledby="piece" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color:#18A4E5; color:#FFF">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        Modification de la décharge
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="padding:25px 25px 25px 25px; background-color:#F0F3F4">
                                                    <form class="form-horizontal" method="POST" action="syntheseController.php?action=update&id=<?= $decharge['ids'] ?>" enctype="multipart/form-data">
                                                        <div class="custom-file">
                                                            <input type="hidden" name="action" value="update">
                                                            <input type="hidden" name="ids" value="<?= $decharge['ids'] ?>">
                                                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="piece" required accept=".pdf">
                                                            <label class="custom-file-label" for="validatedCustomFile">Importer un doc *.pdf </label>

                                                        </div>
                                                        <hr>
                                                        <div class="col-md-8 text-right">
                                                            <button type="button" data-dismiss="modal" aria-label="Close" class=" close_DivFormAddPj btn btn-md btn-outline-dark" id="ts-dark">
                                                                Annuler
                                                            </button><button type="submit" class="btn btn-md btn-outline-primary" id="ts-success">
                                                                Valider
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <br>

                        <!-- Offre technique pdf-->
                        <div class="row el-element-overlay">
                            <div class="col-md-12">
                                <h4 class="card-title" id="piece">Offres Techniques</h4>
                            </div>
                            <hr>

                            <?php while ($offre_tech = $offres_tech->fetch(PDO::FETCH_ASSOC)) { ?>

                                <?php if ($offre_tech['online'] != -1) { ?>
                                    <div class="col-lg-3 col-md-6">
                                        <!-- <div class="card"> -->
                                        <div class="el-card-item">
                                            <div class="el-card-avatar el-overlay-1"><embed src="./Documents/<?= $offre_tech['illustration'] ?>" type="application/pdf" width="350" height="150" />
                                                <div class="el-overlay">
                                                    <ul class="list-style-none el-info">
                                                        <li class="el-item"><a class="btn default btn-outline el-link" href="./Documents/<?= $offre_tech['illustration'] ?>" target="_blank" title="Visualiser le fichier"><i class="mdi mdi-magnify-plus"></i></a></li>
                                                        <li class="el-item"><a class="btn default btn-outline el-link" href="syntheseController.php?action=delete&idpros=<?= $_GET['id'] ?>&id=<?= $offre_tech['ids'] ?>" title="Supprimer"><i class="fa fa-trash"></i></a></li>
                                                        <li class="el-item"><a type="button" data-toggle="modal" data-target="#modal_offreTech<?= $offre_tech['ids'] ?>" class="btn default btn-outline el-link" title="Modifier"><i class="fa fa-edit"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="el-card-content">
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="modal fade" id="modal_offreTech<?= $offre_tech['ids'] ?>" tabindex="-1" role="dialog" aria-labelledby="piece" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color:#18A4E5; color:#FFF">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        Modification de l'offre technique
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="padding:25px 25px 25px 25px; background-color:#F0F3F4">
                                                    <form class="form-horizontal" method="POST" action="syntheseController.php" enctype="multipart/form-data">
                                                        <div class="custom-file">
                                                            <input type="hidden" name="ids" value="<?= $offre_tech['id'] ?>">
                                                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                                            <input type="hidden" name="action" value="update">
                                                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="piece" required accept=".pdf">
                                                            <label class="custom-file-label" for="validatedCustomFile">Importer un doc *.pdf </label>

                                                        </div>
                                                        <hr>
                                                        <div class="col-md-8 text-right">
                                                            <button type="button" data-dismiss="modal" aria-label="Close" class=" close_DivFormAddPj btn btn-md btn-outline-dark" id="ts-dark">
                                                                Annuler
                                                            </button><button type="submit" class="btn btn-md btn-outline-primary" id="ts-success">
                                                                Valider
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <br>

                        <!-- Offre technique pdf-->
                        <div class="row el-element-overlay">
                            <div class="col-md-12">
                                <h4 class="card-title" id="piece">Offres Finnancières</h4>
                            </div>
                            <hr>

                            <?php while ($offre_fin = $offres_fin->fetch(PDO::FETCH_ASSOC)) { ?>

                                <?php if ($offre_fin['online'] != -1) { ?>
                                    <div class="col-lg-3 col-md-6">
                                        <!-- <div class="card"> -->
                                        <div class="el-card-item">
                                            <div class="el-card-avatar el-overlay-1"><embed src="./Documents/<?= $offre_fin['illustration'] ?>" type="application/pdf" width="350" height="150" />
                                                <div class="el-overlay">
                                                    <ul class="list-style-none el-info">
                                                        <li class="el-item"><a class="btn default btn-outline el-link" href="./Documents/<?= $offre_fin['illustration'] ?>" target="_blank" title="Visualiser le fichier"><i class="mdi mdi-magnify-plus"></i></a></li>
                                                        <li class="el-item"><a class="btn default btn-outline el-link" href="syntheseController.php?action=delete&idpros=<?= $_GET['id'] ?>&id=<?= $offre_fin['ids'] ?>" title="Supprimer"><i class="fa fa-trash"></i></a></li>
                                                        <li class="el-item"><a type="button" data-toggle="modal" data-target="#modal_decharge<?= $offre_fin['ids'] ?>" class="btn default btn-outline el-link" title="Modifier"><i class="fa fa-edit"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="el-card-content">
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="modal fade" id="modal_decharge<?= $offre_fin['ids'] ?>" tabindex="-1" role="dialog" aria-labelledby="piece" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color:#18A4E5; color:#FFF">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        Modification de l'offre finnancière
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="padding:25px 25px 25px 25px; background-color:#F0F3F4">
                                                    <form class="form-horizontal" method="POST" action="syntheseController.php" enctype="multipart/form-data">
                                                        <div class="custom-file">
                                                            <input type="hidden" name="action" value="update">
                                                            <input type="hidden" name="ids" value="<?= $offre_fin['ids'] ?>">
                                                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="piece" required accept=".pdf">
                                                            <label class="custom-file-label" for="validatedCustomFile">Importer un doc *.pdf </label>

                                                        </div>
                                                        <hr>
                                                        <div class="col-md-8 text-right">
                                                            <button type="button" data-dismiss="modal" aria-label="Close" class=" close_DivFormAddPj btn btn-md btn-outline-dark" id="ts-dark">
                                                                Annuler
                                                            </button><button type="submit" class="btn btn-md btn-outline-primary" id="ts-success">
                                                                Valider
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <br>

                        <!-- Lettre de mission pdf-->
                        <div class="row el-element-overlay">
                            <div class="col-md-12">
                                <h4 class="card-title" id="piece">Lettre de mission</h4>
                            </div>
                            <hr>

                            <?php while ($lettre = $lettres->fetch(PDO::FETCH_ASSOC)) { ?>

                                <?php if ($offre_fin['online'] != -1) { ?>
                                    <div class="col-lg-3 col-md-6">
                                        <!-- <div class="card"> -->
                                        <div class="el-card-item">
                                            <div class="el-card-avatar el-overlay-1"><embed src="./Documents/<?= $lettre['illustration'] ?>" type="application/pdf" width="350" height="150" />
                                                <div class="el-overlay">
                                                    <ul class="list-style-none el-info">
                                                        <li class="el-item"><a class="btn default btn-outline el-link" href="./Documents/<?= $lettre['illustration'] ?>" target="_blank" title="Visualiser le fichier"><i class="mdi mdi-magnify-plus"></i></a></li>
                                                        <li class="el-item"><a class="btn default btn-outline el-link" href="syntheseController.php?action=delete&idpros=<?= $_GET['id'] ?>&id=<?= $lettre['ids'] ?>" title="Supprimer"><i class="fa fa-trash"></i></a></li>
                                                        <li class="el-item"><a type="button" data-toggle="modal" data-target="#modal_decharge<?= $lettre['ids'] ?>" class="btn default btn-outline el-link" title="Modifier"><i class="fa fa-edit"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="el-card-content">
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="modal fade" id="modal_decharge<?= $lettre['ids'] ?>" tabindex="-1" role="dialog" aria-labelledby="piece" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color:#18A4E5; color:#FFF">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        Modification de la Lettre de mission
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="padding:25px 25px 25px 25px; background-color:#F0F3F4">
                                                    <form class="form-horizontal" method="POST" action="syntheseController.php" enctype="multipart/form-data">
                                                        <div class="custom-file">
                                                            <input type="hidden" name="action" value="update">
                                                            <input type="hidden" name="ids" value="<?= $lettre['ids'] ?>">
                                                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="piece" required accept=".pdf">
                                                            <label class="custom-file-label" for="validatedCustomFile">Importer un doc *.pdf </label>

                                                        </div>
                                                        <hr>
                                                        <div class="col-md-8 text-right">
                                                            <button type="button" data-dismiss="modal" aria-label="Close" class=" close_DivFormAddPj btn btn-md btn-outline-dark" id="ts-dark">
                                                                Annuler
                                                            </button>
                                                            <button type="submit" class="btn btn-md btn-outline-primary" id="ts-success">
                                                                Valider
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <br>

                        <!-- ICI -->
                        <!-- </div> -->
                        <!-- page end-->
                        <!-- </div> -->
                        <!-- /row -->
                        <!-- </div>
                            </div> -->
                        <!-- </div> -->
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

            <!-- All Jquery -->
            <!-- ============================================================== -->
            <script src="assets/libs/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap tether Core JavaScript -->
            <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
            <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
            <script src="assets/extra-libs/sparkline/sparkline.js"></script>
            <!--Wave Effects -->
            <script src="dist/js/waves.js"></script>
            <!--Menu sidebar -->
            <script src="dist/js/sidebarmenu.js"></script>
            <!--Custom JavaScript -->
            <script src="dist/js/custom.min.js"></script>
            <script src="dist/js/myjs.js"></script>
            <!--This page JavaScript -->
            <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
            <!-- Charts js Files -->
            <script src="assets/libs/flot/excanvas.js"></script>
            <script src="assets/libs/flot/jquery.flot.js"></script>
            <script src="assets/libs/flot/jquery.flot.pie.js"></script>
            <script src="assets/libs/flot/jquery.flot.time.js"></script>
            <script src="assets/libs/flot/jquery.flot.stack.js"></script>
            <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
            <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
            <script src="dist/js/pages/chart/chart-page-init.js"></script>
            <script src="assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
            <script src="assets/libs/magnific-popup/meg.init.js"></script>

            <!-- this page js -->
            <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
            <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
            <script src="assets/extra-libs/DataTables/datatables.min.js"></script>

            <!-- This Page JS -->
            <script src="assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
            <script src="dist/js/pages/mask/mask.init.js"></script>
            <script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
            <script src="assets/libs/select2/dist/js/select2.min.js"></script>
            <script src="assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
            <script src="assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
            <script src="assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
            <script src="assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
            <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
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

            <script>
                //***********************************//
                // For select 2
                //***********************************//
                $(".select2").select2();

                /*colorpicker*/
                $('.demo').each(function() {
                    //
                    // Dear reader, it's actually very easy to initialize MiniColors. For example:
                    //
                    //  $(selector).minicolors();
                    //
                    // The way I've done it below is just for the demo, so don't get confused
                    // by it. Also, data- attributes aren't supported at this time...they're
                    // only used for this demo.
                    //
                    $(this).minicolors({
                        control: $(this).attr('data-control') || 'hue',
                        position: $(this).attr('data-position') || 'bottom left',

                        change: function(value, opacity) {
                            if (!value) return;
                            if (opacity) value += ', ' + opacity;
                            if (typeof console === 'object') {
                                console.log(value);
                            }
                        },
                        theme: 'bootstrap'
                    });

                });
                /*datwpicker*/
                jQuery('.mydatepicker').datepicker();
                jQuery('#datepicker-autoclose').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                var quill = new Quill('#editor', {
                    theme: 'snow'
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