<?php
session_start();
  require_once('include/connexion.php');
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
  <link href="lib/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <style>
    .fc-header-title h2 {
        margin-top: 0;
        font-size: 16px;
        white-space: nowrap;
        color: black;
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
    <?php include 'include/navbar.php'; ?>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
    <?php include('include/sidebar.php'); ?>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Calendar</h3>
        <!-- page start-->
        <div class="row mt">
          <aside class="col-lg-3 mt">
            <h4><i class="fa fa-angle-right"></i> Ajouter un rendez-vous</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
              Ajouter
            </button>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un rendez-vous</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="insertRdv.php" method="POST">
                      <div class="row">
                          <div class="form-group col-md-6">
                              <label>Commercial</label>
                              <div>
                                  <select name="idcom" id="idcom" style="width: 100%;">
                                      <?php
                                          $data_commerciaux = $bdd->prepare('SELECT * FROM commercial');
                                          $data_commerciaux->execute();
                                          while ($data = $data_commerciaux->fetch(PDO::FETCH_ASSOC)) {
                                              echo '<option value="'.$data["IDCOM"].'">'.$data["NOMCOM"].' '.$data["PRENOMCOM"].'</option>';
                                          }
                                      ?>
                                      
                                  </select>
                              </div>
                          </div>
                          <div class="form-group col-md-6">
                              <label>Contact prospect</label>
                              <div>
                                  <select name="idcont" id="idcont" style="width: 100%;">
                                      <?php
                                          $data_contactprospect = $bdd->prepare('SELECT * FROM contactprospect');
                                          $data_contactprospect->execute();
                                          while ($data = $data_contactprospect->fetch(PDO::FETCH_ASSOC)) {
                                              echo '<option value="'.$data["IDCONT"].'">'.$data["NOMCONT"].' '.$data["PRENOMCONT"].'</option>';
                                          }
                                      ?>
                                      
                                  </select>
                              </div>
                          </div>
                          <div class="form-group col-md-6">
                              <label>Objet</label>
                              <div>
                                <input type="text" name="objetrdv" id="objetrdv" style="width: 100%;">
                              </div>
                          </div>
                          <div class="form-group col-md-6">
                              <label>Date</label>
                              <div>
                                <input type="date" name="daterdv" id="daterdv" style="width: 100%;">
                              </div>
                          </div>
                          <div class="form-group col-md-6">
                              <label>Heure</label>
                              <div>
                                <input type="time" name="heurerdv" id="heurerdv" style="width: 100%;">
                              </div>
                          </div>
                          <div class="form-group col-md-6">
                              <label>Lieu</label>
                              <div>
                                <input type="text" name="lieurdv" id="lieurdv" style="width: 100%;">
                              </div>
                          </div>
                          <div class="form-group col-md-6">
                              <label>Description</label>
                              <div>
                                <textarea name="descriptionrdv" id="descriptionrdv" style="width: 100%;"></textarea>
                              </div>
                          </div>
                          <div class="col-md-12" style="display: flex;justify-content: center;align-items: center;">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                          </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div id="external-events">
              <div class="external-event label label-theme">My Event 1</div>
              <div class="external-event label label-success">My Event 2</div>
              <div class="external-event label label-info">My Event 3</div>
              <div class="external-event label label-warning">My Event 4</div>
              <div class="external-event label label-danger">My Event 5</div>
              <div class="external-event label label-default">My Event 6</div>
              <div class="external-event label label-theme">My Event 7</div>
              <div class="external-event label label-info">My Event 8</div>
              <div class="external-event label label-success">My Event 9</div>
              <p class="drop-after">
                <input type="checkbox" id="drop-remove"> Remove After Drop
              </p>
            </div> -->
          </aside>
          <aside class="col-lg-9 mt">
            <section class="panel">
              <div class="panel-body">
                <div id="calendar" class="has-toolbar"></div>
              </div>
            </section>
          </aside>
        </div>
        <!-- page end-->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
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
        <a href="calendar.php#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>

      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="lib/fullcalendar/fullcalendar.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <!-- <script src="lib/calendar-conf-events.js"></script> -->
  <script>
    var Script = function () {


/* initialize the external events
 -----------------------------------------------------------------*/

$('#external-events div.external-event').each(function() {

    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
    // it doesn't need to have a start or end
    var eventObject = {
        title: $.trim($(this).text()) // use the element's text as the event title
    };

    // store the Event Object in the DOM element so we can get to it later
    $(this).data('eventObject', eventObject);

    // make the event draggable using jQuery UI
    $(this).draggable({
        zIndex: 999,
        revert: true,      // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
    });

});


/* initialize the calendar
 -----------------------------------------------------------------*/

var date = new Date();
var d = date.getDate();
var m = date.getMonth();
var y = date.getFullYear();

$('#calendar').fullCalendar({
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
    },
    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar !!!
    drop: function(date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
            // if so, remove the element from the "Draggable Events" list
            $(this).remove();
        }

    },
    

          events:[
            <?php
                $data_rdv = $bdd->prepare('SELECT * FROM rendez_vous, commercial,contactprospect  WHERE rendez_vous.IDCOM = commercial.IDCOM && rendez_vous.IDCONT = contactprospect.IDCONT');
                $data_rdv->execute();
                while ($data = $data_rdv->fetch(PDO::FETCH_ASSOC)) {
                  echo "{ title: 'Rendez-vous avec ".$data['NOMCONT']." ".$data['PRENOMCONT']." au lieu dit ".$data['LIEURDV']." avec pour objet: ".$data['OBJETRDV']."', start: '".$data['DATERDV']."', A: '".$data['HEURERDV']."' },";
                }
            ?>
          ]
      });


      }();
      function update() {
            plot.setData([ getRandomData() ]);
            // since the axes don't change, we don't need to call plot.setupGrid()
            plot.draw();

            setTimeout(update, updateInterval);
        }

        update();
    
  </script>

</body>

</html>
