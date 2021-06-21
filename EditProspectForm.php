<?php
session_start();

require_once('include/connexion.php');


$data_prospect = $bdd->prepare('SELECT * FROM prospect WHERE idpros = ?');
$data_prospect->execute(array($_GET['id']));
$data = $data_prospect->fetch();
// var_dump($data);
// exit;
if (!empty($data)) extract($data);

$secteur_activite = $secteur;


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
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <h3><i class="fa fa-angle-right"></i> Modifier les informations du Prospect</h3>
                            </div>
                            <div class="col-xs-12 col-md-4" style="padding-top: 10px;">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="accueil.php">Accueil</a></li>
                                        <li class="breadcrumb-item"><a href="listClients.php">Liste des prospects</a></li>
                                        <li class="breadcrumb-item  active" aria-current="page">Administrer</li>
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

                                    <div class="row">
                                        <form action="updateFileProspect.php" method="POST" enctype="multipart/form-data">

                                            <input type="hidden" name="action" value="updateFileLogo">
                                            <div class="form-group col-md-6">
                                                <input type="hidden" class="form-control" name="nom" value="<?= (!empty($nompros)) ? $nompros : '' ?>">
                                                <input type="hidden" name="idpros" value="<?= (!empty($idpros)) ? $idpros : '' ?>">
                                                <img src="images/<?= (!empty($photo)) ? $photo : 'photo.jpg' ?>" class="img-thumbnail" width="100" height="100">
                                                <label for="photo"> Logo de l'entreprise </label>
                                                <div>
                                                    <br>
                                                    <input type="file" name="photo" id="photo" class="form-control" accept=".jpg, .jpeg, .png">
                                                    <br>
                                                    <button type="submit" class="btn btn-danger">Modifier</button>
                                                </div>
                                            </div>
                                        </form>
                                        <form action="updateFileProspect.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="action" value="updateFileDg">
                                            <input type="hidden" class="form-control" name="nom" value="<?= (!empty($nompros)) ? $nompros : '' ?>">
                                            <input type="hidden" name="idpros" value="<?= (!empty($idpros)) ? $idpros : '' ?>">
                                            <div class="form-group col-md-6">
                                                <img src="images/<?= (!empty($photo_dg)) ? $photo_dg : 'photo.jpg' ?>" class="img-thumbnail" width="100" height="100">
                                                <label for="photo_dg"> Photo du DG <span style="color:red"> *-5pts </label>
                                                <div>
                                                    <br>
                                                    <input type="file" name="photo_dg" id="photo_dg" class="form-control" accept=".jpg, .jpeg, .png">
                                                    <br>
                                                    <button type="submit" class="btn btn-danger">Modifier</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <form action="editProspect.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="idpros" value="<?= $_GET['id'] ?>">

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Nom du Prospect</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="nom" value="<?= (!empty($nompros)) ? $nompros : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Ville</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="ville" value="<?= (!empty($ville)) ? $ville : '' ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Equipe Dirrigeante </label>
                                                    <div>
                                                        <input type="text" class="form-control" name="equipe_dirigeante" value="<?= (!empty($equipe_dirigeante)) ? $equipe_dirigeante : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Secteur d'activités <span style="color:red"> *-3pts</span></label>
                                                    <div>
                                                        <?php $secteur = [
                                                            "Agroalimentaire",
                                                            "Banque / Assurance",
                                                            "Bois / Papier / Carton / Imprimerie",
                                                            "BTP / Matériaux de construction",
                                                            "Chimie / Parachimie",
                                                            "Commerce / Négoce / Distribution",
                                                            "Édition / Communication / Multimédia",
                                                            "Électronique / Électricité",
                                                            "Études et conseils",
                                                            "Energie électrique",
                                                            "Industrie pharmaceutique",
                                                            "Insdutrie de Pétrole",
                                                            "Industrie de Savonerie",
                                                            "Industrie de Raffinerie",
                                                            "Informatique / Télécoms",
                                                            "Machines et équipements / Automobile",
                                                            "Métallurgie / Travail du métal",
                                                            "Plastique / Caoutchouc",
                                                            "Services aux entreprises",
                                                            "Textile / Habillement / Chaussure",
                                                            "Transports / Logistique"


                                                        ]; ?>
                                                        <select name="secteur" id="" class="form-control custom-select">
                                                            <?php for ($i = 0; $i < count($secteur); $i++) : ?>
                                                                <option value="<?= $secteur[$i] ?>" <?= ($secteur_activite == $secteur[$i]) ? 'selected' : '' ?>><?= $secteur[$i] ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Capital <span style="color:red"> *-3pts</span></label>
                                                    <div>
                                                        <input type="text" class="form-control" name="capital" value="<?= (!empty($capital)) ? $capital : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Site Web <span style="color:red"> *-3pts</span></label>
                                                    <div>
                                                        <input type="text" class="form-control" name="siteweb" value="<?= (!empty($siteweb)) ? $siteweb : '' ?>">
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group col-md-6">
                            <label>Adresse </label>
                            <div>
                                <input type="text" class="form-control" name="adresse">
                            </div>
                        </div> -->
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Vision <span style="color:red"> *-5pts</span></label>
                                                    <div>

                                                        <textarea name="vision" id="vision" class="form-control" rows="3"><?= (!empty($vision)) ? $vision : '' ?></textarea>

                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Valeur <span style="color:red"> *-5pts</span> </label>
                                                    <div>

                                                        <textarea name="valeur" id="valeur" class="form-control" rows="3"><?= (!empty($valeur)) ? $valeur : '' ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Mission <span style="color:red"> *-5pts</span></label>
                                                    <div>

                                                        <textarea name="mission" id="mission" class="form-control" rows="3"><?= (!empty($mission)) ? $mission : '' ?></textarea>

                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Conviction <span style="color:red"> *-5pts</span> </label>
                                                    <div>
                                                        <textarea name="conviction" id="input" class="form-control" rows="3"><?= (!empty($conviction)) ? $conviction : '' ?></textarea>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Activites et Produits <span style="color:red"> *-3pts</span></label>
                                                    <div>

                                                        <textarea name="activite_produit" id="activite_produit" class="form-control" rows="3"><?= (!empty($activite_produit)) ? $activite_produit : ''  ?></textarea>

                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Concurents <span style="color:red"> *-3pts</span></label>
                                                    <div>

                                                        <textarea name="concurent" id="concurent" class="form-control" rows="3"><?= (!empty($concurent)) ? $concurent : '' ?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php //if ($type == 'Commercial') { 
                                        ?>
                                        <div class="text-center">
                                            <a href="listClients.php" class="btn btn-default">Annuler</a>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>

                                        </div>
                                        <?php //} 
                                        ?>
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
    <?php header('Location: index.php'); ?>
<?php } ?>