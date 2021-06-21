<?php
session_start();
require_once 'include/connexion.php';


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        extract($_POST);

        $q = $bdd->prepare("SELECT MAX(ids) as maxId FROM synsthese_rdv");
        $q->execute();
        $value = $q->fetch();

        $nom_piece1 = $_FILES['piece']['name'];
        $pdf_tmp_1 = $_FILES['piece']['tmp_name'];

        // recuperer extension du fichier
        $file_extension_1 = strrchr($nom_piece1, '.');
        $file_extension_1 = strtolower($file_extension_1);

        $maxId = $value['maxId'] + 1;
        // emplacement dans le projet
        $destination_1 = './Documents/piece_' .  $maxId . $file_extension_1;
        move_uploaded_file($pdf_tmp_1, $destination_1);

        // nom du fichier a inserer dans la BD
        $name_file_1 = 'piece_' . $maxId . $file_extension_1;

        // $idcom = (int) $idcom;
        // $param = [];
        // $param[0]['col'] = 'illustration';
        // $param[0]['val'] = $name_file_1;
        // $param[1]['col'] = 'idpros';
        // $param[1]['val'] = (int) $id;
        // $param[2]['col'] = 'type';
        // $param[2]['val'] = ucfirst($type);

        // $status = add('synsthese_rdv', $param);
        
        // $requete = $bdd->prepare("synsthese_rdv SET idpros=?, illustration=?,type=?");
        // $status = $requete->execute(array(
        //     $idpros, $illustration, $type
        // ));
        $id = (int) $id;
        $type = ucfirst($type);
        $requete = $bdd->prepare("INSERT INTO synsthese_rdv (idpros, illustration, type) 
        VALUES(?,?,?)");
        $status = $requete->execute(array(
             $id, $name_file_1, $type

        ));

        // tester s'il y'a insertion
        if ($status) header("Location:listClients.php?msg=3");
        else header("Location:listClients.php?msg=0");
    }

    if ($action == 'update') {
        extract($_POST);

        $nom_piece1 = $_FILES['piece']['name'];
        $pdf_tmp_1 = $_FILES['piece']['tmp_name'];

        // recuperer extension du fichier
        $file_extension_1 = strrchr($nom_piece1, '.');
        $file_extension_1 = strtolower($file_extension_1);

        $maxId = $value['maxId'] + 1;
        // emplacement dans le projet
        $destination_1 = './Documents/piece_' .  $ids . $file_extension_1;
        move_uploaded_file($pdf_tmp_1, $destination_1);

        // nom du fichier a inserer dans la BD
        $name_file_1 = 'piece_' . $ids . $file_extension_1;

        $requete = $bdd->prepare("UPDATE synsthese_rdv SET 
        illustration=?
        where ids=?");
        $status = $requete->execute(array(
            $name_file_1,
            $ids
        ));

        if ($status) header("Location:syntheseController.php?action=detail&id=" . $id . "&msg=1");
        else header("Location:syntheseController.php?action=detail&id=" . $id . "&msg=0");
    }
}

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'detail') {
        if (isset($_GET['id'])) {

            $id = (int)$_GET['id'];
            $decharges = $bdd->prepare('SELECT * FROM synsthese_rdv WHERE idpros = ? AND type=?');
            $decharges->execute(array($id, 'Decharge'));

            $offres_tech = $bdd->prepare('SELECT * FROM synsthese_rdv WHERE idpros = ? AND type=?');
            $offres_tech->execute(array($id, 'Offre technique'));

            $offres_fin = $bdd->prepare('SELECT * FROM synsthese_rdv WHERE idpros = ? AND type=?');
            $offres_fin->execute(array($id, 'Offre financière'));

            $lettres = $bdd->prepare('SELECT * FROM synsthese_rdv WHERE idpros = ? AND type=?');
            $lettres->execute(array($id, 'Lettre de mission'));

            // if (!empty($decharges)) $decharges = $decharges;

            require 'decharges.php';
        } else {
            require '404.php';
        }
    }

    if ($action == 'delete') {
        if (isset($_GET['id'])) {

            $id = (int)$_GET['id'];
            $idpros = (int)$_GET['idpros'];

            $requete = $bdd->prepare("UPDATE synsthese_rdv SET 
        online=?
        where ids=?");
            $status = $requete->execute(array(
                    -1,
                    $id
                ));

            header("Location:syntheseController.php?action=detail&id=" . $idpros);
        }
    }
}
