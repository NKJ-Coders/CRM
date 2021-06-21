 <?php
session_start();

require_once('include/connexion.php');

$query = $bdd->prepare('SELECT * FROM objection WHERE IDCONT = ' . $_GET['id']);
$query->execute();
$data = $query->fetch();

if (!empty($data)) extract($data);
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

<body oncopy="return false" oncut="return false" onpaste="return false">

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
                <h3><i class="fa fa-angle-right"></i> Objections </h3>


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
                            <form action="objection.php" method="POST">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>
                                            <h4>Prix</h4>
                                        </label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="prix" id="prix" value="1" <?= (isset($prix) && $prix == 1) ? 'checked' : '' ?>>
                                                Oui
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="prix" id="prix" value="0" <?= (isset($prix) && $prix == 0) ? 'checked' : '' ?>>
                                                Non
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>
                                            <h4>Reponses:</h4>
                                        </label>
                                        <div>
                                            <textarea name="reponses" class="form-control" id="" cols="30" rows="10"><?php if (!empty($reponses)) {
                                                                                                                            echo $reponses;
                                                                                                                        } ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="idcont" value="<?= $_GET['id'] ?>">

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>
                                            <h4>Pas interessé:</h4>
                                        </label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="pas_interesser" id="pas_interesser" value="1" <?= (isset($pas_interesser) && $pas_interesser == 1) ? 'checked' : '' ?>>
                                                Oui
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="pas_interesser" id="pas_interesser" value="0" <?= (isset($pas_interesser) && $pas_interesser == 0) ? 'checked' : '' ?>>
                                                Non
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>
                                            <h4>Pas besoin d'innovation:</h4>
                                        </label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="pas_besoin_innov" id="pas_besoin_innov" value="1" <?= (isset($pas_besoin_innov) && $pas_besoin_innov == 1) ? 'checked' : '' ?>>
                                                Oui
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="pas_besoin_innov" id="pas_besoin_innov" value="0" <?= (isset($pas_besoin_innov) && $pas_besoin_innov == 0) ? 'checked' : '' ?>>
                                                Non
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>
                                            <h4>On verra:</h4>
                                        </label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="on_verra" id="on_verra" value="1" <?= (isset($on_verra) && $on_verra == 1) ? 'checked' : '' ?>>
                                                Oui
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="on_verra" id="on_verra" value="0" <?= (isset($on_verra) && $on_verra == 0) ? 'checked' : '' ?>>
                                                Non
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>
                                            <h4>Nous aider:</h4>
                                        </label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="nous_aider" id="nous_aider" value="1" <?= (isset($nous_aider) && $nous_aider == 1) ? 'checked' : '' ?>>
                                                Oui
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="nous_aider" id="nous_aider" value="0" <?= (isset($nous_aider) && $nous_aider == 0) ? 'checked' : '' ?>>
                                                Non
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>
                                            <h4>Manque de temps:</h4>
                                        </label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="manque_de_tmps" id="manque_de_tmps" value="1" <?= (isset($manque_de_tmps) && $manque_de_tmps == 1) ? 'checked' : '' ?>>
                                                Oui
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="manque_de_tmps" id="manque_de_tmps" value="0" <?= (isset($manque_de_tmps) && $manque_de_tmps == 0) ? 'checked' : '' ?>>
                                                Non
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br><br>

                                <div class="text-center">
                                    <a href="contact_list.php?id_client=<?= $_GET['id'] ?>" class="btn btn-default">Annuler</a>
                                    <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Enregistrer</button>
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

<script>
$(document).keydown(function(event){
    if(event.keyCode == 123){
        return false;
    }else if(event.ctrlKey && event.shiftKey && event.keyCode == 73){
        return false;
    }
});

document.addEventListener('contextmenu', event => event.preventDefaut());

</script>

</html>