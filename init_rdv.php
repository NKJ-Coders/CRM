<?php
    session_start();

    require_once 'include/connexion.php';

    extract($_POST);
    
    $idcom = (int) $idcom;
    $idcont = (int) $idcont;
    $objet = ucfirst(htmlspecialchars($objet));
    $description = ucfirst(htmlspecialchars($description));
    $lieu = ucfirst(htmlspecialchars($lieu));

    $requete = $bdd->prepare("INSERT INTO rendez_vous(IDCOM, IDCONT, OBJETRDV, DESCRIPTIONRDV, DATERDV, LIEURDV) values(:idcom,:idcont,:objet, :descriptionrdv,:daterdv, :lieu)");
    $status = $requete->execute(array(
        "idcom" => $idcom,
        "idcont" => $idcont,
        "objet" => $objet,
        "descriptionrdv" => $description,
        "daterdv" => $date,
        "lieu" => $lieu,

    ));
    header("Location:contact_list.php?id_client=" . $idcom);

?>