<?php
session_start();
?>
<?php if (!empty($_SESSION)) {
    $type = $_SESSION['type'];
?>
    <?php if ($type == 'admin') { ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="Dashboard">
            <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
            <title>Dashio - Bootstrap Admin Template</title>

            <!-- Favicons -->
            <link href="img/favicon.png" rel="icon">
            <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

            <!-- Bootstrap core CSS -->
            <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <!--external css-->
            <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
            <!-- Custom styles for this template -->
            <link href="css/style.css" rel="stylesheet">
            <link href="css/style-responsive.css" rel="stylesheet">

            <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
        </head>

        <body>
            <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
            <div id="login-page">
                <div class="container">
                    <form class="form-login" id="form" action="inscript.php" method="POST" enctype="multipart/form-data">
                        <h2 class="form-login-heading">Inscription</h2>

                        <div id="errorMsg" class="errorMsg alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span class="mr-3 fa fa-check"></span> <strong>Attention!</strong> Vérifier que les champs requis sont bien remplis !
                        </div>

                        <?php if (isset($_GET['msg']) && $_GET['msg'] == 0) { ?>
                            <div class="alert alert-warning"><small class="text-danger">L'inscription a échoué</small></div>
                        <?php } ?>

                        <?php if (isset($_GET['msg']) && $_GET['msg'] == 1) { ?>
                            <div class="alert alert-success"><small class="text-success">Inscription efectuée avec succès !</small></div>
                        <?php } ?>

                        <?php if (isset($_GET['msg']) && $_GET['msg'] == 2) { ?>
                            <div class="alert alert-warning"><small class="text-danger">Un autre commercial possede deja le même nom!</small></div>
                        <?php } ?>

                        <?php if (isset($_GET['msg']) && $_GET['msg'] == 3) { ?>
                            <div class="alert alert-warning"><small class="text-danger">Un autre utilisateur possede deja le même Login!</small></div>
                        <?php } ?>

                        <!-- first step -->
                        <div class="login-wrap first-step">

                            <input type="file" class="form-control" name="photo" id="photo" autofocus accept=".jpg, .jpeg, .png">
                            <br>
                            <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" autofocus>
                            <br>
                            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" autofocus>
                            <br>
                            <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" autofocus>
                            <br>
                            <input type="text" class="form-control" name="tel" id="tel" placeholder="Telephone" autofocus>
                            <input type="hidden" class="form-control" name="action" id="comm" value="comm">
                            <br><br>

                            <div class="d-flex flex-sm-row justify-content-center">
                                <a href="accueil.php" class="btn btn-outline-info">Quitter</a>
                                <a href="" class="btn btn-info pull-right toStep2">Suivant</a>
                            </div>
                        </div>

                        <!-- second step -->
                        <div class="login-wrap second-step">
                            <input type="text" class="form-control" name="login" id="login" placeholder="Login" autofocus>
                            <br>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" autofocus>
                            <br>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Retapez Mot de passe" autofocus>
                            <br>
                            <div id="errorMsg2" class="errorMsg2 text-danger text-italic"> Veuillez confirmer avec le même mot de passe.</div>
                            <br><br>

                            <div class="d-flex flex-sm-row justify-content-center">
                                <a href="" class="btn btn-outline-info toStep1">Précédent</a>
                                <button type="submit" id="toSubmit" class="btn btn-info pull-right toSubmit">S'inscrire</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- js placed at the end of the document so the pages load faster -->
            <script src="lib/jquery/jquery.min.js"></script>
            <script src="lib/bootstrap/js/bootstrap.min.js"></script>
            <!--BACKSTRETCH-->
            <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
            <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
            <script>
                $.backstretch("img/login-bg.jpg", {
                    speed: 500
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('.second-step').hide();
                    $('.errorMsg').hide();
                    $('.errorMsg2').hide();

                    var nom = $('#nom'),
                        prenom = $('#prenom'),
                        adresse = $('#adresse'),
                        tel = $('#tel'),
                        objection = $('#objection'),
                        date = $('#date_offre'),
                        description = $('#description');

                    $('.toStep2').on('click', function(e) {
                        e.preventDefault();

                        if (nom.val() != '' && prenom.val() != '' && adresse.val() != '' && tel.val() != '') {
                            $('.first-step').hide();
                            $('.second-step').fadeIn();
                        } else {
                            $('.errorMsg').fadeIn();
                        }
                    });

                    $('.toStep1').on('click', function(e) {
                        e.preventDefault();

                        $('.second-step').hide();
                        $('.first-step').fadeIn();

                    });

                    // $('.toSubmit').on('click', function(e) {
                    //     e.preventDefault();


                    // if ($('#login').val() != '' && $('#password').val() != '') {
                    //     $('#confirmPassword').on('input', function() {
                    //         if ($('#confirmPassword').val() === $('#password').val()) {
                    //             alert('ok');
                    //             $('.errorMsg2').fadeOut();
                    //             $('#toSubmit').setAttribute('class', 'btn btn-info pull-right toSubmit');
                    //         } else {
                    //             $('.errorMsg2').fadeIn();
                    //         }
                    //     });
                    // }

                    // });

                    var login = document.querySelector('#login'),
                        password = document.querySelector('#password'),
                        confirm = document.querySelector('#confirmPassword'),
                        submit = document.querySelector('.toSubmit'),
                        errMsg = document.querySelector('#errorMsg'),
                        errMsg2 = document.querySelector('#errorMsg2'),
                        form = document.querySelector('#form');


                    submit.addEventListener('click', function(e) {
                        e.preventDefault();

                        if (login.value != '' && password.value != '' && confirm.value != '') {
                            if (password.value === confirm.value) {
                                form.submit();
                            } else {
                                // errMsg2.classList.remove('errorMsg2');
                                $('.errorMsg2').fadeIn();
                            }
                        } else {
                            $('.errorMsg').fadeIn();

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