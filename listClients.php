  <?php
  session_start();

  require_once('include/connexion.php');
  $data_prospect = '';
  // Filtrer par secteur d'activité
  if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = $_GET['q'];

    if ($q == 'all') {
      $data_prospect = $bdd->prepare('SELECT * FROM prospect WHERE prospect.status != ? AND prospect.online=? ORDER BY nompros');
      $data_prospect->execute(array(2, 1));
    } else {
      $data_prospect = $bdd->prepare('SELECT * FROM prospect WHERE prospect.status != ? AND prospect.online=? AND prospect.secteur=? ORDER BY nompros');
      $data_prospect->execute(array(2, 1, $q));
    }
  } else {
    $data_prospect = $bdd->prepare('SELECT * FROM prospect WHERE prospect.status != ? AND prospect.online=? ORDER BY nompros');
    $data_prospect->execute(array(2, 1));
  }

  // Filtrer par statut du client
  if (isset($_GET['statut']) && !empty($_GET['statut'])) {
    $statut = $_GET['statut'];
    $value = 0;

    if ($statut == 'conquis') $value = 2;
    elseif ($statut == 'sélectionné') $value = 0;
    elseif ($statut == 'déposé') $value = -1;
    else $value = 1;

    $data_prospect = $bdd->prepare('SELECT * FROM prospect WHERE prospect.online=? AND prospect.status=? ORDER BY nompros');
    $data_prospect->execute(array(1, $value));
  }

  ?>

  <?php if (!empty($_SESSION)) {
    $id = (int) $_SESSION['id'];
    $type = $_SESSION['type'];
  ?>
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
          .adv-table {
            padding: 3px;
          }
          p{
            padding: 9px;
          }
            
         
        </style>

        <!-- =======================================================
    Global Asset Cameroon
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
          <?php
          $con = mysqli_connect('localhost', 'c1642016c_syscrm_2', 'o_smD+L{wHOG');
          mysqli_select_db($con, 'c1642016c_syscrm_2');
          ?>
          <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
          <!--main content start-->
          <section id="main-content">
            <section class="wrapper">
              <div class="row">
                <div class="col-xs-12 col-md-8">
                  <h3><i class="fa fa-angle-right"></i> Liste des Prospects <a class="ml-5 btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span></a></h3>
                </div>

                <div class="col-xs-12 col-md-4" style="padding-top: 10px;">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="accueil.php">Accueil</a></li>
                      <li class="breadcrumb-item active">Liste des prospects</li>
                    </ol>
                  </nav>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-5">
                  <form action="listClients.php" class="form-inline" role="form">
                    <div class="form-group">
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
                        "Industrie pharmaceutique",
                        "Informatique / Télécoms",
                        "Machines et équipements / Automobile",
                        "Métallurgie / Travail du métal",
                        "Plastique / Caoutchouc",
                        "Services aux entreprises",
                        "Textile / Habillement / Chaussure",
                        "Transports / Logistique"
                      ]; ?>
                      <select class="form-inline form-control" role="form" name="q">
                        <option value="">Filtrer par secteur d'activité</option>
                        <option value="all">Tout lister</option>
                        <?php for ($i = 0; $i < count($secteur); $i++) : ?>
                          <option value="<?= $secteur[$i] ?>"><?= $secteur[$i] ?></option>
                        <?php endfor; ?>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-danger" title="Filtrer par secteur d'activité"><i class="fa fa-filter"></i> </button>
                  </form>
                </div>

                <div class="col-lg-5">
                  <form action="listClients.php" class="form-inline" role="form">
                    <div class="form-group">
                      <select class="form-inline form-control" role="form" name="statut">
                        <option value="">Filtrer par statut de l'entreprise</option>
                        <option value="libre">Libre</option>
                        <option value="déposé">Prise de contact</option>
                        <option value="sélectionné">Attribué</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-danger" title="Filtrer par statut"><i class="fa fa-filter"></i> </button>
                  </form>
                </div>

              </div>
              <br>

              <div class="row">
                <div class="col-lg-10">
                  <!-- <div> -->
                  <div class="form-group">
                    <div><strong>Imprimer la fiche d'entreprise:</strong>

                      <form method='get' class="form-inline" action='impression db.php'>

                        <select name='nompros' class="form-inline form-control">
                          <?php
                          $query = mysqli_query($con, "select * from prospect order by nompros");
                          while ($prospect = mysqli_fetch_array($query)) {
                            echo "<option value='" . $prospect['nompros'] . "'>" . $prospect['nompros'] . "</option>";
                          }
                          ?>
                        </select>
                        <!-- <input class="btn btn-info" type='submit' value='Imprimer'> -->
                        <button type="submit" class="btn btn-info"><span class="fa fa-print" title="Imprimer la fiche d'entreprise"></span></button>

                      </form>
                    </div>
                  </div>
                  <!-- </div> -->
                </div>


              </div><br>

              <div class="row mb">
                <!-- page start-->
                <div class="content-panel">

                  <?php if (isset($_GET['msg'])) : ?>
                    <?php if ($_GET['msg'] == 1) { ?>
                      <div class="alert alert-success alert-dismissable text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="mr-3 fa fa-check"></span> <strong>BRAVO!</strong> Opération effectueé avec succès !
                      </div>
                    <?php } elseif ($_GET['msg'] == 0) { ?>
                      <div class="alert alert-warning alert-dismissable text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="mr-3 fa fa-info-circle"></span> <strong>Attention!</strong> Opération échouée !
                      </div>
                    <?php } elseif ($_GET['msg'] == 2) { ?>
                      <div class="alert alert-warning alert-dismissable text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="mr-3 fa fa-info-circle"></span> <strong>Désolé!</strong> Ce prospect existe déjà !
                      </div>
                    <?php } elseif ($_GET['msg'] == 3) { ?>
                      <div class="alert alert-success alert-dismissable text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="mr-3 fa fa-check"></span> Vous venez de vous attribuer cette entreprise avec succès !
                      </div>
                    <?php } elseif ($_GET['msg'] == 3) { ?>
                      <div class="alert alert-success alert-dismissable text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="mr-3 fa fa-check"></span> <strong>BRAVO!</strong> Fichier inséré avec succès !
                      </div>
                    <?php } elseif ($_GET['msg'] == 401) { ?>
                      <div class="alert alert-warning alert-dismissable text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="mr-3 fa fa-info-circle"></span> <strong>Désolé!</strong> ce prospect ne vous est pas attribué!
                      </div>
                    <?php } ?>
                  <?php endif; ?>
                  <div class="row">
                    <div class="col-md-12">
                    <p><b>NB:</b>  <b> Le Badge</b>   <span class="text-primary fa fa-certificate"></span> Représente les entreprises attribuées;</br>     <b>Le Badge</b>    <span class="text-danger fa fa-certificate"></span>  Représente les entreprises dont la prise de contact à été éffectuer;</br>  <b>Le Badge</b>   <span class="text-success fa fa-check-circle"></span>    Représente les entreprises entièrement renseignées </br> Les entreprises sans Badge sont libre</br>  </p>
                    </div>
                  </div>

                  <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                      <thead>

                        <tr>

                          <th>N°</th>
                          <th class="hidden-phone hidden-tablet">Logo</th>
                          <th class="" width=5>Domaine</th>
                          <th class="hidden-phone hidden-tablet">Ville</th>
                          <th class="">Pieces jointes</th>
                          <th class="">Action</th>
                          </a>
                        </tr>

                      </thead>
                      <tbody>
                        <?php $k = 1; ?>
                        <?php while ($data = $data_prospect->fetch(PDO::FETCH_ASSOC)) : ?>
                          <?php
                          $q =  $bdd->prepare('SELECT NOMCOM FROM commercial WHERE IDCOM =?');
                          $q->execute(array($data['idcom']));
                          $commercial = $q->fetch(PDO::FETCH_ASSOC);
                          ?>

                          <tr>
                            <td><?= $k ?></td>
                            <td class="hidden-phone hidden-tablet">
                              <img src="images/<?= (!empty($data['photo'])) ? $data['photo'] : 'photo.jpg' ?>" class="img-thumbnail" width="50" height="50">
                            </td>
                            <td width=5>
                              <a href="" <?php if (!empty($data['idcom'])) { ?>title="Entreprise suivie par <?= $commercial['NOMCOM'] ?>" <?php } ?>>
                                <h4><?= strtoupper($data['nompros']) ?> &ensp;<span class="<?php if ($data['status'] == 1) {
                                                                                              echo 'text-primary';
                                                                                            } elseif ($data['status'] == 0) {
                                                                                              echo 'text-primary fa fa-certificate';
                                                                                            } elseif ($data['status'] == -1) {
                                                                                              echo 'text-danger fa fa-certificate';
                                                                                            } ?>"></span>
                                  <?php
                                  if (
                                    !empty($data['nompros']) && !empty($data['photo']) &&
                                    !empty($data['photo_dg']) && !empty($data['capital']) && !empty($data['vision']) &&
                                    !empty($data['valeur']) && !empty($data['mission']) && !empty($data['conviction'])
                                    && !empty($data['activite_produit']) && !empty($data['concurent']) && !empty($data['secteur']) && !empty($data['ville'])
                                  ) {
                                  ?>
                                    <span class="text-success fa fa-check-circle"></span>
                                  <?php } ?>
                              </a></h4>
                            </td>
                            <td class="hidden-phone hidden-tablet"><?= $data['ville'] ?></td>
                            <td>
                              <a data-toggle="modal" data-target="#syntheseModal<?= $data['idpros'] ?>" class="btn btn-xs" title="Ajouter des pieces jointes"><i class="fa fa-upload"></i></a>
                              <?php
                              $query = $bdd->prepare("SELECT * FROM synsthese_rdv WHERE idpros=?");
                              $query->execute(array($data['idpros']));
                              $test = $query->fetch();
                              ?>
                              <a href="syntheseController.php?action=detail&id=<?= $data['idpros'] ?>" class="btn btn-warning btn-xs" title="Consulter pieces jointes"><i class="<?= (!empty($test)) ? 'fa fa-folder' : 'fa fa-folder-open-o' ?>"></i></a>
                            </td>
                            <td class="center" style="padding: 3px;">
                              <div class="btn-group ">
                                <a href="<?= ($data['idcom'] == $_SESSION['id']) ? 'EditProspectForm.php?id=' . $data['idpros'] : 'listClients.php?msg=401' ?>" class="btn btn-primary  item-group"><span id="btnEdit"><i class="fa fa-edit"></i></span> <span id="detail">administrer</span></a>
                                <button type="button" class="btn btn-primary dropdown-toggle item-group" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                  <?php if ($_SESSION['type'] == 'Commercial') { ?>
                                    <?php if (empty($data['idcom'])) { ?>
                                      <li>
                                        <a href="editProspect.php?action=changeStatut&id=<?= $data['idpros'] ?>">
                                          <span class="fa <?= ($data['status'] == 1) ? 'fa-check-square-o' : 'fa-remove' ?>"></span> <?= ($data['status'] == 1) ? 'S\'attribué' : 'Se désattribué' ?>
                                        </a>
                                      </li>
                                      <?php if ($data['status'] != -1) { ?>
                                        <li><a href="" data-toggle="modal" data-target="#modalOffre<?= $data['idpros'] ?>"><span class="fa fa-thumbs-up"></span> Prospecter</a></li>
                                      <?php } ?>
                                      <li><a href="DeleteProspect.php?id=<?= $data['idpros'] ?>"><span class="fa fa-trash"></span> Supprimer</a></li>
                                    <?php } elseif (!empty($data['idcom']) && $_SESSION['id'] == $data['idcom']) { ?>
                                      <li>
                                        <a href="editProspect.php?action=changeStatut&id=<?= $data['idpros'] ?>">
                                          <span class="fa <?= ($data['status'] == 1) ? 'fa-check-square-o' : 'fa-remove' ?>"></span> <?= ($data['status'] == 1) ? 'S\'attribué' : 'Se désattribué' ?>
                                        </a>
                                      </li>
                                      <li><a href="" data-toggle="modal" data-target="#modalOffre<?= $data['idpros'] ?>"><span class="fa fa-thumbs-up"></span> Prospecter</a></li>
                                      <li><a href="DeleteProspect.php?id=<?= $data['idpros'] ?>"><span class="fa fa-trash"></span> Supprimer</a></li>
                                    <?php } ?>
                                  <?php } ?>

                                  <!-- <li class="divider"></li> -->
                                  <li><a href="contact_list.php?id_client=<?= $data['idpros'] ?>"><span class="fa fa-phone"></span> Lister ses contacts</a></li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                          <?php require 'include/syntheseModal.php'; ?>
                          <?php require 'include/offreModal.php'; ?>
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
            sOut += '<tr><td>Localisation</td><td>' + aData[0] + ' ' + aData[5] + '</td></tr>';
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
            //   this.insertBefore(nCloneTh, this.childNodes[0]);
            // });

            // $('#hidden-table-info tbody tr').each(function() {
            //   this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
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