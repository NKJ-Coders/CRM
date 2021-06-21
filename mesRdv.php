<?php
session_start();



require_once('include/connexion.php');
// $data_rdv = $bdd->prepare('SELECT * FROM rendez_vous as r, contactprospect as cont, prospect as p WHERE r.IDCONT=cont.IDCONT AND cont.IDPROS=p.idpros');

?>
<?php if (isset($_SESSION) && !empty($_SESSION)) {
    $type = $_SESSION['type'];
    if ($type == 'Commercial') {
        $data_rdv = $bdd->prepare('SELECT * FROM events as e, contactprospect as cont, prospect as p, commercial as c WHERE e.idcont=cont.IDCONT AND cont.IDPROS=p.idpros AND c.IDCOM=e.idcom AND e.idcom=?');
        $data_rdv->execute(array($_SESSION['id']));
    }
    if ($type == 'admin') {
        $data_rdv = $bdd->prepare('SELECT * FROM events as e, contactprospect as cont, prospect as p, commercial as c WHERE e.idcont=cont.IDCONT AND cont.IDPROS=p.idpros AND c.IDCOM=e.idcom');
        $data_rdv->execute();
    }
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

            <style>
                .adv-table {
                    padding: 3px;
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
                                    <h3><i class="fa fa-angle-right"></i> Mes Rendez-vous</h3>
                                </div>
                                <div class="col-xs-12 col-md-4" style="padding-top: 10px;">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="accueil.php">Accueil</a></li>
                                            <li class="breadcrumb-item  active" aria-current="page">Liste des RDV</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>


                        <div class="row mb">
                            <!-- page start-->
                            <div class="content-panel">

                                <?php if (isset($_GET['msg'])) : ?>
                                    <?php if ($_GET['msg'] == 1) { ?>
                                        <div class="alert alert-success alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <span class="mr-3 fa fa-check"></span> <strong>BRAVO!</strong> Fichier inséré avec succès !
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-warning alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <span class="mr-3 fa fa-info-circle"></span> <strong>Attention!</strong> erreur d'operation !
                                        </div>
                                    <?php } ?>
                                <?php endif; ?>

                                <div class="adv-table">
                                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th class="">Entreprise</th>
                                                <th class="hidden-phone hidden-tablet">Contact</th>
                                                <?php if ($type == 'admin') { ?>
                                                    <th class="">Commercial</th>
                                                <?php } ?>
                                                <th class="hidden-phone hidden-tablet">Objet</th>
                                                <th class="">Date</th>
                                                <th class="">Heure</th>
                                                <th style="width: 140px">Statut</th>
                                                <th style="width: 100px">Action</th>
                                            </tr>

                                        <tbody>
                                            <?php $k = 1; ?>
                                            <?php while ($data = $data_rdv->fetch(PDO::FETCH_ASSOC)) : ?>
                                                <?php
                                                $date = explode(" ", $data['start']);
                                                ?>
                                                <tr>
                                                    <td><?= $k ?></td>
                                                    <td><?= $data['nompros'] ?></td>
                                                    <td class="hidden-phone hidden-tablet"><?= $data['NOMCONT'] ?></td>
                                                    <?php if ($type == 'admin') { ?>
                                                        <td><?= $data['NOMCOM'] ?></td>
                                                    <?php } ?>
                                                    <td class="hidden-phone hidden-tablet"><?= $data['title'] ?></td>
                                                    <td><?= $date[0] ?></td>
                                                    <td class=""><?= $date[1] ?></td>
                                                    <td class="center p-2">
                                                        <?php if ($data['color'] == '#008000') { ?>
                                                            <span class="label label-success label-mini">Effectué</span>
                                                        <?php } elseif ($data['color'] == '#FFD700') { ?>
                                                            <span class="label label-warning label-mini">En cours</span>
                                                        <?php } else { ?>
                                                            <span class="label label-danger label-mini">Annulé</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="center p-2">

                                                        <?php if ($data['color'] == '#FFD700') {  ?>
                                                            <a href="rdvController.php?action=approve&id=<?= $data['id'] ?>" class="btn btn-success btn-xs" title="Approuver"><i class="fa fa-check"></i></a>
                                                            <a href="rdvController.php?action=denied&id=<?= $data['id'] ?>" class="btn btn-danger btn-xs" title="Annuler"><i class="fa fa-remove"></i></a>
                                                        <?php } elseif ($data['color'] == '#FF0000') { ?>
                                                            <a data-toggle="modal" data-target="#ModalAdd<?= $data['id'] ?>" class="btn btn-primary btn-xs" title="Relancer"><i class="fa fa-repeat"></i></a>
                                                        <?php } ?>
                                                        <!-- <a class="btn btn-danger btn-xs" title="Supprimer"><i class="fa fa-trash-o "></i></a> -->
                                                    </td>

                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalAdd<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form class="form-horizontal" method="GET" action="rdvController.php">
                                                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                                <input type="hidden" name="action" value="relance">

                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Relancer le rendez-vous</h4>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group">
                                                                        <label for="title" class="col-sm-2 control-label">Description</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" value="<?= $data['title'] ?>" name="title" class="form-control" id="title" placeholder="Description">
                                                                        </div>
                                                                    </div>
                                                                    <br><br>
                                                                    <div class="form-group">
                                                                        <label for="start" class="col-sm-2 control-label">Date et Heure</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="datetime-local" name="start" class="form-control" value="<?= $date[0] . ' ' . $date[1] ?>" id="start">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="end" class="col-sm-2 control-label"></label>
                                                                        <div class="col-sm-10">
                                                                            <input type="hidden" name="end" class="form-control" id="end" readonly>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-primary">Relancer</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php $k++; ?>
                                            <?php endwhile; ?>

                                        </tbody>
                                    </table>
                                </div>
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
                    // var nCloneTh = document.createElement('th');
                    // var nCloneTd = document.createElement('td');
                    // nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
                    // nCloneTd.className = "center";

                    // $('#hidden-table-info thead tr').each(function() {
                    //     this.insertBefore(nCloneTh, this.childNodes[0]);
                    // });

                    // $('#hidden-table-info tbody tr').each(function() {
                    //     this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
                    // });

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