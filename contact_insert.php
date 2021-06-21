<?php
session_start();
require_once 'include/connexion.php';

extract($_POST);
// var_dump($_POST);
// exit;
$nom = ucfirst(htmlspecialchars($nom));
$prenom = ucfirst(htmlspecialchars($prenom));
$poste = ucfirst(htmlspecialchars($poste));
$adresse = ucfirst(htmlspecialchars($adresse));
$tel = htmlspecialchars($tel);

$requete = $bdd->prepare("INSERT INTO contactprospect(IDPROS, NOMCONT, PRENOMCONT, POSTECONT, ADRESSECONT, TELCONT) values(:idpros,:nomcont,:prenomcont, :poste,:adresse, :tel)");
$status = $requete->execute(array(
    "idpros" => $idpros,
    "nomcont" => $nom,
    "prenomcont" => $prenom,
    "poste" => $poste,
    "adresse" => $adresse,
    "tel" => $tel,

));
// tester s'il y'a insertion
if ($status) header("Location:contact_list.php?id_client=" . $idpros . "&msg=1");
else header("Location:contact_list.php?id_client=" . $idpros . "&msg=1");
