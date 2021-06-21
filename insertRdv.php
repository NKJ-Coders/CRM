<?php
session_start();
require_once 'include/connexion.php';

extract($_POST);

$requete = $bdd->prepare("INSERT INTO rendez_vous(IDCOM, IDCONT, OBJETRDV, DESCRIPTIONRDV, DATERDV, HEURERDV, LIEURDV, statut, online) values(:idcom,:idcont,:objet,:descriptionrdv,:daterdv, :heurerdv,:lieu,:statut,:onlinerdv)");
$status = $requete->execute(array(
    "idcom" => $_POST["idcom"],
    "idcont" => $_POST["idcont"],
    "objet" => $_POST["objetrdv"],
    "descriptionrdv" => $_POST["descriptionrdv"],
    "daterdv" => $_POST["daterdv"],
    "heurerdv" => $_POST['heurerdv'],
    "lieu" => $_POST["lieurdv"],
    "statut" => 0,
    "onlinerdv" => 0
));

// tester s'il y'a insertion
header("Location:calendar.php?msg=1");
