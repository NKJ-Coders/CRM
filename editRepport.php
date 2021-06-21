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


    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <!-- <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet"> -->

    <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/SYSCRM-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
    <style>
        .content {
            margin: auto;
        }

        #editor {
            background-color: #FFF;
        }
    </style>
</head>

<body>

    <!-- import modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="text-success"> Voulez-vous soumettre votre rapport?</div>

                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NON</button>
                        <button type="button" class="btn btn-primary" id="yesBtn">OUI</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                <h3><i class="fa fa-angle-right"> Compte rendu du "<?php echo date('d-m-Y'); ?>"</i> </h3>


                <div class="row mb content">
                    <div class="form-group confirmMsg"></div>
                    <!-- page start-->
                    <!-- <form action="#"> -->
                    <div class="form-group">
                        <div id="toolbar"></div>
                        <div id="editor" style="height: 200px;"></div>
                    </div>

                    <div class="form-group">
                        <!-- <button class="btn btn-default">Retour</button> -->
                        <button id="saveContent" class="btn btn-primary btn-lg">Envoyer</button>
                    </div>
                    <div class="form-group ici"></div>
                    <!-- </form> -->
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
                <a href="#" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
        <!--footer end-->
    </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="lib/jquery/jquery.min.js"></script>
    <!-- <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script> -->
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="lib/bootstrap/js/bootstrap.min.js"></script> -->
    <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
    <script src="lib/jquery.scrollTo.min.js"></script>
    <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>

    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Core build with no theme, formatting, non-essential modules -->
    <!-- <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script> -->

    <!--common script for all pages-->
    <script src="lib/common-scripts.js"></script>
    <!--script for this page-->
    <script type="text/javascript">
        $(document).ready(function() {
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }],
                [{
                    'direction': 'rtl'
                }],
                [{
                    'size': ['small', false, 'large', 'huge']
                }],
                ['link', 'formula'],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                [{
                    'font': []
                }],
                [{
                    'align': []
                }],
            ];

            var options = {
                debug: 'info',
                modules: {
                    toolbar: toolbarOptions
                },
                placeholder: 'Entrez un texte ...',
                // readOnly: true,
                theme: 'snow'
            };
            var editor = new Quill('#editor', options);

            // Save data
            $('#saveContent').click(function() {
                $('#confirmModal').modal('show')

                $('#yesBtn').click(function() {
                    var editContent = editor.root.innerHTML;
                    // $('.ici').val(editContent)
                    // document.querySelector('.ici').innerHTML = editContent;
                    // editContent = JSON.stringify(editContent);
                    $.post("repportController.php", {
                            action: 'save',
                            content: editContent
                        },
                        function(res, status) {
                            var result = JSON.parse(res);
                            if (result.statut === 'ok') {
                                //     document.querySelector('.confirmMsg').innerHTML = `<div class="alert alert-success alert-dismissable">
                                //     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                //     <div class="text-center"><span class="mr-3 fa fa-check"></span> <i>Mise a jour avec succès !</i></div>
                                // </div>`
                                window.open("repportController.php?action=all")
                            } else {
                                document.querySelector('.confirmMsg').innerHTML = `<div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <div class="text-center"><i> <span class="mr-3 fa fa-info-circle"></span> Erreur d'envoi ! Veuillez saisir votre texte manuellement</i></div>
                            </div>`
                            }
                        }
                    );
                    $('#confirmModal').modal('hide')
                })
            });
        });
    </script>
</body>

</html>