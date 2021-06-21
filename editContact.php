<?php
session_start();
require_once 'include/connexion.php';

extract($_POST);

$idcont = (int) $idcont;
$nom = ucfirst(htmlspecialchars($nom));
$prenom = ucfirst(htmlspecialchars($prenom));
$poste = ucfirst(htmlspecialchars($poste));
$adresse = ucfirst(htmlspecialchars($adresse));
$tel = htmlspecialchars($tel);

$requete = $bdd->prepare("UPDATE contactprospect SET NOMCONT=?, PRENOMCONT=?, POSTECONT=?, ADRESSECONT=?, TELCONT=?
        where IDCONT=?");
$status = $requete->execute(array(
    $nom, $prenom, $poste, $adresse, $tel, $idcont
));

// tester s'il y'a insertion
    if ($status) header("Location:editContactForm.php?id=" . $idcont . "&msg=1");
    else header("Location:editContactForm.php?id=" . $idcont . "&msg=0");