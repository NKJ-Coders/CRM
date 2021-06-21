<?php
include 'include/connexion.php';

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $action = $_GET['action'];
    $id = (isset($_GET['id'])) ? (int) $_GET['id'] : NULL;

    // Commerciaux
    if ($action == 'Commerciaux' && !empty($id)) {
        $requete = $bdd->prepare("UPDATE commercial SET 
        online=?
        where IDCOM=?");
        $statut = $requete->execute(array(1, $id));
    }

    // Prospects
    if ($action == 'Prospects' && !empty($id)) {
        $requete = $bdd->prepare("UPDATE prospect SET 
        online=?
        where idpros=?");
        $statut = $requete->execute(array(1, $id));
    }

    // Contacts
    if ($action == 'Contacts' && !empty($id)) {
        $requete = $bdd->prepare("UPDATE contactprospect SET 
        online=?
        where IDCONT=?");
        $statut = $requete->execute(array(1, $id));
    }

    // tester s'il y'a insertion
    if ($statut) header("Location:corbeille.php?action=" . $action . "&msg=1");
    else header("Location:corbeille.php?action=" . $action . "&msg=0");
}
