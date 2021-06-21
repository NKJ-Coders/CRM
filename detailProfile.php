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
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-datetimepicker/datertimepicker.css" />
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
    <section id="container">
        <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
        <!--header start-->
        <header class="header black-bg">
            <?php require 'include/navbar.php'; ?>
        </header>
        <!--header end-->
        <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
        <!--sidebar start-->
        <?php require 'include/sidebar.php'; ?>
        <!--sidebar end-->
        <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Mon profil</h3>
                <!--ADVANCED FILE INPUT-->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
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
                                    <div class="alert alert-success alert-dismissable text-center">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <span class="mr-3 fa fa-check"></span> <strong>BRAVO!</strong> Photo mise à jour avec succès !
                                    </div>
                                <?php } elseif ($_GET['msg'] == 3) { ?>
                                    <div class="alert alert-warning alert-dismissable text-center">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <span class="mr-3 fa fa-info-circle"></span> <strong>Attention!</strong> Veuillez selectionner une image !
                                    </div>
                                <?php } elseif ($_GET['msg'] == 4) { ?>
                                    <div class="alert alert-warning alert-dismissable text-center">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <span class="mr-3 fa fa-info-circle"></span> <strong>Désolé!</strong> Ce nom existe déjà pour un autre utilisateur !
                                    </div>
                                <?php } elseif ($_GET['msg'] == 5) { ?>
                                    <div class="alert alert-warning alert-dismissable text-center">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <span class="mr-3 fa fa-info-circle"></span> <strong>Désolé!</strong> Ce login existe déjà pour un autre utilisateur !
                                    </div>
                                <?php } ?>

                            <?php endif; ?>


                            <form method="POST" action="profileController.php" class="form-horizontal style-form" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="uploadFile">
                                <?php if ($_SESSION['type'] == 'Commercial') { ?>
                                    <input type="hidden" class="form-control" name="nom" placeholder="Nom" value="<?= $profil['NOMCOM'] ?>">
                                <?php } ?>
                                <?php if ($_SESSION['type'] == 'admin' || $_SESSION['type'] == 'Partenaire') { ?>
                                    <input type="hidden" class="form-control" name="nom" placeholder="Nom" value="<?= $profil['nom'] ?>">
                                <?php } ?>
                                <div class="form-group last">
                                    <!-- <label class="control-label col-md-3">Image Upload</label> -->
                                    <div class="col-md-9">
                                        <div class="form-group col-md-6">
                                            <img src="avatar/<?= $profil['photo'] ?>" class="img-thumbnail" width="100" height="100">
                                            <label for="photo_dg"> Photo du profil </label>
                                            <div>
                                                <br>
                                                <input type="file" name="photo" id="photo" class="form-control" accept=".jpg, .jpeg, .png">
                                                <br>
                                                <button type="submit" class="btn btn-theme04"> Mettre a jour la photo de profil</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <form action="profileController.php" method="POST">
                                <!-- <div class="col-md-6"> -->
                                <?php if ($_SESSION['type'] == 'Commercial') { ?>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?= $profil['NOMCOM'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Prenom" name="prenom" value="<?= $profil['PRENOMCOM'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Adresse" name="adresse" value="<?= $profil['ADRESSECOM'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Telephone" name="tel" value="<?= $profil['TELCOM'] ?>">
                                    </div>
                                <?php } ?>

                                <?php if ($_SESSION['type'] =='admin' || $_SESSION['type'] == 'Partenaire') { ?>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?= $profil['nom'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Prenom" name="prenom" value="<?= $profil['prenom'] ?>">
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="action" value="edit">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Login" name="login" value="<?= $profil['login'] ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" value="<?= $profil['password'] ?>" class="form-control" placeholder="Mot de passe" name="password">
                                </div>

                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                <!-- </div> -->
                            </form>
                        </div>
                        <!-- /form-panel -->
                    </div>
                    <!-- /col-lg-12 -->
                </div>
                <!-- row -->
            </section>
            <!-- /wrapper -->
        </section>
        <!-- /MAIN CONTENT -->
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
                <a href="advanced_form_components.html#" class="go-top">
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
    <!--common script for all pages-->
    <script src="lib/common-scripts.js"></script>
    <!--script for this page-->
    <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="lib/advanced-form-components.js"></script>

</body>

</html>