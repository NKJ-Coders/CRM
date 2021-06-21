<?php
session_start();

try {
	$bdd = new PDO('mysql:host=localhost;dbname=c1642016c_syscrm_2;charset=utf8', 'c1642016c_syscrm_2', 'o_smD+L{wHOG');
	} catch (Exception $e) {
		die('Error : ' . $e->getMessage());
}


if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end'])) {
	

	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = "#FFD700";
	$idcont = (int) $_POST['idcont'];
	$idcom = (int) $_SESSION['id'];

	$sql = "INSERT INTO events(idcont, idcom, title, start, end, color) values (?, ?, ?, ?, ?, ?)";

	echo $sql;

	$query = $bdd->prepare($sql);
	if ($query == false) {
		print_r($bdd->errorInfo());
		die('Erreur prepare');
	}
	$sth = $query->execute(array($idcont, $idcom, $title, $start, $end, $color));
	if ($sth == false) {
		print_r($query->errorInfo());
		die('Erreur execute');
	}
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
