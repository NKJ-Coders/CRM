<?php
session_start();

try {
	$bdd = new PDO('mysql:host=localhost;dbname=c1642016c_syscrm_2;charset=utf8', 'c1642016c_syscrm_2', 'o_smD+L{wHOG');
} catch (Exception $e) {
	die('Error : ' . $e->getMessage());
}

$prospects = $bdd->prepare("SELECT * FROM prospect as p, commercial as c WHERE p.idcom = c.IDCOM AND p.idcom=?");
$prospects->execute(array($_SESSION['id']));


$sql = "SELECT id, title, start, end, color FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>
<?php if (isset($_SESSION) && !empty($_SESSION)) {
	$type = $_SESSION['type'];
?>
	<?php if ($type == 'Commercial') { ?>

		<!DOCTYPE html>
		<html lang="fr">

		<head>

			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">
			<meta name="author" content="Dashboard">
			<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
			<title>SYSCRM</title>

			<!-- Favicons -->
			<link href="../img/favicon.png" rel="icon">
			<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

			<title>Rendez-Vous</title>

			<!-- Bootstrap Core CSS -->
			<link href="css/bootstrap.min.css" rel="stylesheet">
			<!--external css-->
			<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
			<!-- Custom styles for this template -->
			<link href="css/style.css" rel="stylesheet">
			<link href="css/style-responsive.css" rel="stylesheet">

			<!-- FullCalendar -->
			<link href='css/fullcalendar.css' rel='stylesheet' />


			<!-- Custom CSS -->
			<style>
				.container {
					width: 70%;
					margin-left: 20%;
					background-color: #FFF;
					color: #000;
					padding-bottom: 15px;
				}

				.fc-center>h2 {
					color: #000;
				}

				.fc-widget-content {
					color: gray;
				}

				@media (max-width: 768px) {
					.container {
						width: 100%;
						margin-left: 0px;
						font-size: 10px;
					}

					/* .fc-toolbar, .fc-view-container {
						width: 100%;
					} */

					.fc-center>h2 {

						font-size: 15px;
					}

				}
			</style>

		</head>

		<body>
			<!--header start-->
			<header class="header black-bg">
				<?php include 'navbar.php'; ?>
			</header>
			<!--header end-->
			<!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR Acceuil
        *********************************************************************************************************************************************************** -->
			<!--sidebar start-->
			<?php require('sidebar.php'); ?>
			<!--sidebar end-->
			<div class="container">
				<!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->


				<h1>Rendez-Vous</h1>
				<div id="calendar" class="col-md-12">
				</div>

				<!-- /.row -->

				<!-- Modal -->
				<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form class="form-horizontal" method="POST" action="addEvent.php" id="addform">

								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Rendez-vous</h4>
								</div>
								<div class="modal-body">
									<div class="alert alert-warning alert-dismissable text-center" id="msg">
										<i><span class="mr-3 fa fa-info-circle"></span> veuillez selectionner un contact</i>
									</div>
									<div class="form-group">
										<label for="color" class="col-sm-2 control-label">Entreprise</label>
										<div class="col-sm-10">
											<select name="idpros" class="form-control" id="idpros">
												<option value="">Selectionner une entreprise</option>
												<?php while ($prospect = $prospects->fetch(PDO::FETCH_ASSOC)) : ?>
													<option value="<?= $prospect['idpros'] ?>"><?= $prospect['nompros'] ?></option>
												<?php endwhile; ?>

											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Contact</label>
										<div class="col-sm-10">
											<select name="idcont" class="form-control" id="contact"></select>
										</div>
									</div>


									<div class="form-group">
										<label for="title" class="col-sm-2 control-label">Description</label>
										<div class="col-sm-10">
											<textarea name="title" id="title" cols="30" rows="6" placeholder="Description" class="form-control"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="start" class="col-sm-2 control-label">Date et Heure</label>
										<div class="col-sm-10">
											<input type="datetime-local" name="start" class="form-control" id="start">
										</div>
									</div>
									<!-- <div class="form-group">
										<label for="end" class="col-sm-2 control-label"></label>
										<div class="col-sm-10"> -->
											<input type="hidden" name="end" class="form-control" id="end" readonly>
										<!-- </div>
									</div> -->

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
									<button type="submit" class="btn btn-primary" id="submit">Ajouter</button>
								</div>
							</form>
						</div>
					</div>
				</div>



				<!-- Modal -->
				<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form class="form-horizontal" method="POST" action="editEventTitle.php">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Modifier</h4>
								</div>
								<div class="modal-body">

									<div class="form-group">
										<label for="title" class="col-sm-2 control-label">Description</label>
										<div class="col-sm-10">
											<textarea name="title" id="title" cols="30" rows="6" placeholder="Description" class="form-control"></textarea>

										</div>
									</div>
									<div class="form-group">
										<label for="color" class="col-sm-2 control-label">Statut</label>
										<div class="col-sm-10">
											<select name="color" class="form-control" id="color">
												<option value="">Selectionner</option>
												<!-- <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option> -->
												<!-- <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option> -->
												<option style="color:#008000;" value="#008000">&#9724; Effectuer</option>
												<option style="color:#FFD700;" value="#FFD700">&#9724; En cour</option>
												<!-- <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option> -->
												<option style="color:#FF0000;" value="#FF0000">&#9724; Annuler</option>
												<!-- <option style="color:#000;" value="#000">&#9724; Negro</option> -->

											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<div class="checkbox">
												<label class="text-danger"><input type="checkbox" name="delete">Supprimer</label>
											</div>
										</div>
									</div>

									<input type="hidden" name="id" class="form-control" id="id">


								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
									<button type="submit" class="btn btn-primary">Modifier</button>
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
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
			<!-- /.container -->

			<!-- jQuery Version 1.11.1 -->
			<script src="js/jquery.js"></script>

			<!-- Bootstrap Core JavaScript -->
			<script src="js/bootstrap.min.js"></script>

			<!-- FullCalendar -->
			<script src='js/moment.min.js'></script>
			<script src='js/fullcalendar/fullcalendar.min.js'></script>
			<script src='js/fullcalendar/fullcalendar.js'></script>
			<script src='js/fullcalendar/locale/fr.js'></script>
			<script class="include" type="text/javascript" src="../lib/jquery.dcjqaccordion.2.7.js"></script>
			<script src="../lib/jquery.scrollTo.min.js"></script>
			<!--common script for all pages-->
			<script src="../lib/common-scripts.js"></script>


			<script>
				$(document).ready(function() {

					var date = new Date();
					var yyyy = date.getFullYear().toString();
					var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
					var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();

					$('#calendar').fullCalendar({
						header: {
							language: 'es',
							left: 'prev,next today',
							center: 'title',
							right: 'month,basicWeek,basicDay',

						},
						defaultDate: yyyy + "-" + mm + "-" + dd,
						editable: true,
						eventLimit: true, // allow "more" link when too many events
						selectable: true,
						selectHelper: true,
						select: function(start, end) {

							$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
							$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
							$('#ModalAdd').modal('show');
						},
						eventRender: function(event, element) {
							element.bind('dblclick', function() {
								$('#ModalEdit #id').val(event.id);
								$('#ModalEdit #title').val(event.title);
								$('#ModalEdit #color').val(event.color);
								$('#ModalEdit').modal('show');
							});
						},
						eventDrop: function(event, delta, revertFunc) { // si changement de position

							edit(event);

						},
						eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

							edit(event);

						},
						events: [
							<?php foreach ($events as $event) :

								$start = explode(" ", $event['start']);
								$end = explode(" ", $event['end']);
								if ($start[1] == '00:00:00') {
									$start = $start[0];
								} else {
									$start = $event['start'];
								}
								if ($end[1] == '00:00:00') {
									$end = $end[0];
								} else {
									$end = $event['end'];
								}
							?> {
									id: '<?php echo $event['id']; ?>',
									title: '<?php echo str_replace("'", "\'", $event['title']); ?>',
									start: '<?php echo $start; ?>',
									color: '<?php echo $event['color']; ?>',
								},
							<?php endforeach; ?>
						]
					});

					function edit(event) {
						start = event.start.format('YYYY-MM-DD HH:mm:ss');
						if (event.end) {
							end = event.end.format('YYYY-MM-DD HH:mm:ss');
						} else {
							end = start;
						}

						id = event.id;

						Event = [];
						Event[0] = id;
						Event[1] = start;
						Event[2] = end;

						$.ajax({
							url: 'editEventDate.php',
							type: "POST",
							data: {
								Event: Event
							},
							success: function(rep) {
								if (rep == 'OK') {
									alert('Date modifier avec succès');
								} else {
									alert('Erreur de modification');
								}
							}
						});
					}

					$('#msg').hide();

					$('#submit').click(function(e) {

						var val = $('#contact').val();

						if (val == null) {
							e.preventDefault();
							$('#msg').show();
						} else {
							$('#addform').submit();
						}
					});

					// Filtre des contact en fonction de l'entreprise
					$('#idpros').on('change', function() {
						let val = this.options[this.selectedIndex].value;
						$.get("filterContact.php", {
								idpros: val,
							},
							function(res, status) {
								let result = document.getElementById('contact');

								let results = JSON.parse(res);
								// console.log(results.length);
								result.innerHTML = '';
								for (var j = 0; j < results.length; j++) {
									var options = document.createElement('option');
									console.log(results[j].IDCONT);
									options.value = results[j][0];
									options.text = results[j][1];
									result.appendChild(options);
								}
							}
						);
					});

				});
			</script>

		</body>

		</html>

	<?php } else { ?>
		<?php include '../401.php'; ?>
	<?php } ?>
<?php } else { ?>
	<?php include '../401.php'; ?>
<?php } ?>