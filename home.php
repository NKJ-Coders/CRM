<?php
session_start();

// var_dump($_SESSION);
// exit;
require_once('include/connexion.php');

// Lister commerciaux
$com = $bdd->prepare('SELECT * FROM commercial ORDER BY NOMCOM');
$com->execute();

// DONNEES DES DIFFERENTS GRAPH
$query = $bdd->prepare('SELECT COUNT(IDCOM) AS nbre_offre, DATEOFFRE FROM offre WHERE IDCOM = ? AND statut =? GROUP BY MONTH(DATEOFFRE)');
$query->execute(array($_GET['id'], 0));

$query2 = $bdd->prepare('SELECT COUNT(o.IDCOM) AS nombre_contrat, c.create_at as create_at FROM offre AS o, contrat AS c WHERE c.idoffre = o.idoffre AND o.IDCOM = ? AND c.online=? GROUP BY MONTH(c.create_at)');
$query2->execute(array($_GET['id'], 1));

$query3 = $bdd->prepare('SELECT COUNT(id) AS nombre_rdv, start FROM events WHERE idcom = ? AND color=? GROUP BY MONTH(start)');
$query3->execute(array($_GET['id'], '#0071c5'));

$prospects = $bdd->prepare("SELECT * FROM prospect as p, commercial as c WHERE p.idcom = c.IDCOM AND p.idcom=?");
$prospects->execute(array($_GET['id']));
// $data = $query3->fetch();
// var_dump($data);
// exit;
$date = [];
$nbre = [];
while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
  extract($data);
  // conversion de la date en mois et en langue francaise
  setlocale(LC_TIME, 'fr_FR', 'fra_FRA');
  $month = strftime("%B", strtotime($DATEOFFRE));
  $mois = utf8_encode($month);

  $date[] = strtoupper($mois);
  $nbre[] = (int) $nbre_offre;
}

$date_contrat = [];
$nbre_contrat = [];
while ($data_contrat = $query2->fetch(PDO::FETCH_ASSOC)) {
  extract($data_contrat);
  // conversion de la date en mois et en langue francaise
  setlocale(LC_TIME, 'fr_FR', 'fra_FRA');
  $month = strftime("%B", strtotime($create_at));
  $mois = utf8_encode($month);

  $date_contrat[] = strtoupper($mois);
  $nbre_contrat[] = (int) $nombre_contrat;
}

$date_rdv = [];
$nbre_rdv = [];
while ($data_rdv = $query3->fetch(PDO::FETCH_ASSOC)) {
  extract($data_rdv);
  // conversion de la date en mois et en langue francaise
  setlocale(LC_TIME, 'fr_FR', 'fra_FRA');
  $month = strftime("%B", strtotime($start));
  $mois = utf8_encode($month);

  $date_rdv[] = strtoupper($mois);
  $nbre_rdv[] = (int) $nombre_rdv;
}
// echo json_encode($nbre);
// exit;
?>

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
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>

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
      <?php include 'include/navbar.php'; ?>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <?php include('include/sidebar.php'); ?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row" style="margin-top: 10px;">
        <div class="col-lg-3">
          <select class="form-control" name="id" id="id">
                <option>Entreprises Suivies</option>
                <option>                 </option>
                  <?php while ($prospect = $prospects->fetch(PDO::FETCH_ASSOC)) : ?>
                  	<option value="<?= $prospect['idpros'] ?>"><?= $prospect['nompros'] ?></option>
												<?php endwhile; ?>
              </select>
        </div>
          <?php if ($_SESSION['type'] == 'admin') {
          ?>
            <div class="col-lg-9"></div>
            <div class="col-lg-3">
              <form action="home.php" class="form-inline" role="form">
                <div class="form-group">
                  <select class="form-control" name="id" id="id">
                    <?php while ($data_com = $com->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option value="<?= $data_com['IDCOM'] ?>" <?php if ($_GET['id'] == $data_com['IDCOM']) {
                                                                  echo 'selected';
                                                                } ?>><?= $data_com['NOMCOM'] ?></option>
                    <?php } ?>
                  </select>
                  
                </div>
                <div class="row" style="margin-left: 200px; margin-top: -34px;">
                <button type="submit" class="btn btn-default">Afficher</button>
                </div>
              </form>
              
            </div>
          <?php  }
          ?>
        </div>
        <div class="row">
          <div class="col-lg-6 main-chart">
            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3>STATISTIQUE DES OFFRES PAR MOIS</h3>
            </div>
            <div>
              <canvas id="offres"></canvas>
            </div>
            <!--custom chart end-->

            <hr>
          </div>
          <div class="col-lg-6 main-chart">

            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3>STATISTIQUE DES CONTRATS PAR MOIS</h3>
            </div>
            <div>
              <canvas id="contrats"></canvas>
            </div>
            <!--custom chart end-->

            <hr>
          </div>
        </div>
        <div class="row">

          <div class="col-md-6 main-chart">

            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3>STATISTIQUE DES ENTRETIENS PAR MOIS</h3>
            </div>
            <div>
              <canvas id="entretien"></canvas>
            </div>
            <!--custom chart end-->
          </div>
          <div class="col-md-2"></div>
          <!-- SERVER STATUS PANELS -->
          <div class="col-md-4 col-sm-4 mb">
            <div class="grey-panel pn donut-chart">
              <div class="grey-header">
                <h5>Pourcentage des points restant pour ce mois</h5>
              </div>
              <p style="font-size: 6.1em; color: #fe0d13">
                <?php
                $data = [];
                $q = $bdd->prepare('SELECT * FROM commercial WHERE IDCOM = ?');
                $q->execute(array($_GET['id']));
                $data = $q->fetch();
                echo $data['nombrePoint'] . ' Pts';
                ?>
              </p>
              <div class="row">
                <div class="col-sm-6 col-xs-6 goleft">
                  <p>Total: </p>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <h4>100 points</h4>
                </div>
              </div>
            </div>
            <!-- /grey-panel -->
          </div>
          <!-- /col-lg-3 -->
        </div>


        <!-- /row -->
      </section>
    </section>
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
        <a href="index.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
        </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>

  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Bienvenue sur SYSCRM!',
        // (string | mandatory) the text inside the notification
        text: 'Passez la souris sur moi pour activer le bouton Fermer. Vous pouvez masquer la barre latérale gauche en cliquant sur le bouton à côté du logo',
        // (string | optional) the image to display on the left
        image: 'img/ui-sam.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });
  </script>
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
      // GRAPH WITH CHARTJS
      var offres = document.getElementById('offres').getContext('2d');
      var contrats = document.getElementById('contrats').getContext('2d');
      var entretien = document.getElementById('entretien').getContext('2d');

      // Graph offres
      var chart = new Chart(offres, {

        type: 'bar',

        data: {
          labels: <?= json_encode($date) ?>,
          datasets: [{
            label: 'Nombre d\'offres',
            backgroundColor: 'rgb(255,69,0)',
            borderColor: 'rgba(255,69,0, 0.4)',
            data: <?= json_encode($nbre) ?>
          }]
        },

        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });

      // Graph des contrats
      var chart = new Chart(contrats, {

        type: 'bar',

        data: {
          labels: <?= json_encode($date_contrat) ?>,
          datasets: [{
            label: 'Nombre de contrats',
            backgroundColor: '#00FF00',
            borderColor: 'white',
            data: <?= json_encode($nbre_contrat) ?>
          }]
        }

        // options: {}
      });

      // Graph des entretiens
      var chart = new Chart(entretien, {

        type: 'bar',

        data: {
          labels: <?= json_encode($date_rdv) ?>,
          datasets: [{
            label: 'Nombre d\'entretiens',
            backgroundColor: '#F5F50C',
            borderColor: 'white',
            data: <?= json_encode($nbre_rdv) ?>
          }]
        }

        // options: {}
      });


    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>
</body>

</html>