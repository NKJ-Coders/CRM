  <?php

    // require_once('include/connexion.php');
    $data_prospect = '';
    // Filtrer par secteur d'activité
    if (isset($_GET['q']) && !empty($_GET['q'])) {
        $q = $_GET['q'];

        if ($q == 'all') {
            $data_prospect = $bdd->prepare('SELECT * FROM prospect WHERE prospect.status = ? AND prospect.online=?');
            $data_prospect->execute(array(2, 1));
        } else {
            $data_prospect = $bdd->prepare('SELECT * FROM prospect WHERE prospect.status = ? AND prospect.online=? AND prospect.secteur=?');
            $data_prospect->execute(array(2, 1, $q));
        }
    } else {
        $data_prospect = $bdd->prepare('SELECT * FROM prospect WHERE prospect.status = ? AND prospect.online=?');
        $data_prospect->execute(array(2, 1));
    }
    ?>


  <?php if ($type == 'admin' || $type == 'Commercial') { ?>

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

          </style>

          <!-- =======================================================
    Global Asset Cameroon
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
                              <h3><i class="fa fa-angle-right"></i> Liste des Offres</h3>
                          </div>
                          <div class="col-xs-12 col-md-4" style="padding-top: 10px;">
                              <nav aria-label="breadcrumb">
                                  <ol class="breadcrumb">
                                      <li class="breadcrumb-item"><a href="accueil.php">Accueil</a></li>
                                      <li class="breadcrumb-item  active" aria-current="page">Liste d'offres</li>
                                  </ol>
                              </nav>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-6 col-md-10">

                              <strong>Filtrer par statut</strong>
                              <div class="form-group">
                                  <form id="filter" action="offreController.php" method="GET" class="form-inline" role="form">
                                      <input type="hidden" name="action" value="list">
                                      <div class="filter-item">
                                          <select class="form-inline form-control" role="form" name="q">
                                              <option value="all">Tout lister</option>
                                              <option value="en cours">En cours</option>
                                              <option value="rejetée">Rejetée</option>
                                              <option value="validée">Validée</option>
                                          </select>
                                      </div>
                                      <div class="">
                                          <button type="submit" class="btn btn-danger" title="Filtrer par statut"><i class="fa fa-filter"></i> </button>
                                      </div>
                                  </form>
                              </div>
                          </div>


                      </div>
                      <br>

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
                                  <?php } else { ?>
                                      <div class="alert alert-success alert-dismissable text-center">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          <span class="mr-3 fa fa-check"></span> Vous venez de vous attribuer cette entreprise avec succès !
                                      </div>
                                  <?php } ?>
                              <?php endif; ?>

                              <div class="adv-table">
                                  <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered table_offre" id="hidden-table-info">
                                      <thead>

                                          <tr>

                                              <th>N°</th>
                                              <th class="">Commercial en charge</th>
                                              <th class="">Client</th>
                                              <th class="hidden-phone hidden-tablet">Date de dépot</th>
                                              <th class="hidden-phone hidden-tablet">Montant 1ère année</th>
                                              <th class="hidden-phone hidden-tablet">Montant 2, 3 & 4ème année</th>
                                              <th class="">Statut</th>
                                              <th class="">Action</th>
                                              </a>
                                          </tr>

                                      </thead>
                                      <tbody>
                                          <?php $k = 1; ?>
                                          <?php while ($data = $data_offres->fetch(PDO::FETCH_ASSOC)) : ?>

                                              <tr>
                                                  <td><?= $k ?></td>
                                                  <td>
                                                      <?= $data['NOMCOM'] ?>
                                                  </td>
                                                  <td><?= $data['nompros'] ?></td>
                                                  <td class="hidden-phone hidden-tablet"><?= $data['DATEOFFRE'] ?></td>
                                                  <td class="hidden-phone hidden-tablet"><?php if (!empty($data['montant1an'])) {
                                                                                                echo number_format($data['montant1an'], 0, ".", " ") . ' F';
                                                                                            } ?></td>
                                                  <td class="hidden-phone hidden-tablet"><?php if (!empty($data['montant2an'])) {
                                                                                                echo number_format($data['montant2an'], 0, ".", " ") . ' F';
                                                                                            } ?>
                                                  <td>
                                                      <span class="label <?php if ($data['statut'] == 0) {
                                                                                echo 'label-warning';
                                                                            } elseif ($data['statut'] == 1) {
                                                                                echo 'label-success';
                                                                            } else {
                                                                                echo 'label-danger';
                                                                            } ?>">
                                                          <?php if ($data['statut'] == 0) {
                                                                echo 'Encours...';
                                                            } elseif ($data['statut'] == 1) {
                                                                echo 'Validée';
                                                            } else {
                                                                echo 'Rejetée';
                                                            } ?>
                                                      </span>
                                                  </td>
                                                  <td class="" style="padding: 3px;">
                                                      <div class="btn-group">
                                                          <a href="offreController.php?action=detail&id=<?= $data['idoffre'] ?>" class="item-group btn btn-primary col-xs-6 col-md-8"><span id="btnEdit"><i class="fa fa-edit"></i></span> <span id="detail">Detail</span></a>
                                                          <button type="button" class="item-group btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                              <span class="caret"></span>
                                                              <span class="sr-only">Toggle Dropdown</span>
                                                          </button>
                                                          <ul class="dropdown-menu" role="menu">
                                                              <li>
                                                                  <?php if ($data['statut'] == 0) { ?>
                                                                      <a href="offreController.php?action=changeStatus&saction=denied&id=<?= $data['idoffre'] ?>">Annuler</a>
                                                                  <?php } ?>
                                                                  <?php if ($data['statut'] == 0 || $data['statut'] == -1) { ?>
                                                                      <a href="" data-toggle="modal" data-target="#modalContrat<?= $data['idoffre'] ?>">Valider</a>
                                                                  <?php } ?>
                                                              </li>
                                                              <li><a href="offreController.php?action=del&id=<?= $data['idoffre'] ?>"><span class="fa fa-trash"></span> Supprimer</a></li>
                                                              <li><a href="dashboard_offre.php?id=<?= $data['idoffre'] ?>"><span class="fa fa-print"></span> Imprimer</a></li>

                                                          </ul>
                                                      </div>
                                                  </td>
                                              </tr>

                                              <?php require 'include/contratModal.php'; ?>
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
                    //    */
                  //   var nCloneTh = document.createElement('th');
                  //   var nCloneTd = document.createElement('td');
                  //   nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
                  //   nCloneTd.className = "center";

                  //   $('#hidden-table-info thead tr').each(function() {
                  //       this.insertBefore(nCloneTh, this.childNodes[0]);
                  //   });

                  //   $('#hidden-table-info tbody tr').each(function() {
                  //       this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
                  //   });

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