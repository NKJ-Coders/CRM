<?php
session_start();
require_once 'include/connexion.php';

extract($_POST);
// var_dump($_POST);
// exit;
if ($action == 'comm') {

    $nom = ucfirst(htmlspecialchars($nom));
    $prenom = ucfirst(htmlspecialchars($prenom));
    $adresse = ucfirst(htmlspecialchars($adresse));
    $tel = (int) $tel;
    $login = htmlspecialchars($login);
    $password = htmlspecialchars($password);
    $type = 'Commercial';

    // Verifier que deux commerciaux n'ont pas le mm nom (eviter les doublons)
    $query = $bdd->prepare("SELECT IDCOM FROM commercial WHERE NOMCOM=:nom AND PRENOMCOM=:prenom");
    $query->execute(array(
        "nom" => $nom,
        "prenom" => $prenom
    ));
    $getIdCom = $query->fetch();

    // Verifier que deux users n'ont pas le mm login (eviter les doublons)
    $q = $bdd->prepare("SELECT id FROM user WHERE login=:login");
    $q->execute(array("login" => $login));
    $getIdUser = $q->fetch();

    if (empty($getIdCom)) {

        if (empty($getIdUser)) {
            $requete = $bdd->prepare("INSERT INTO commercial(NOMCOM,PRENOMCOM,ADRESSECOM,TELCOM,nombrePoint,create_at) values(:nom,:prenom,:adresse, :tel,:nombrePoint, :create_at)");
            $status1 = $requete->execute(array(
                "nom" => $nom,
                "prenom" => $prenom,
                "adresse" => $adresse,
                "tel" => $tel,
                "nombrePoint" => 100,
                "create_at" => date('Y-m-d')

            ));

            // get last id in commercial
            $query = $bdd->prepare("SELECT Max(IDCOM) as id FROM commercial");
            $query->execute();
            $getIDs = $query->fetch();

            // input file
            $nom_photo = $_FILES['photo']['name'];
            $image_tmp = $_FILES['photo']['tmp_name'];
            // recuperer extension du fichier
            $file_extension = strrchr($nom_photo, '.');
            $file_extension = strtolower($file_extension);
            // emplacement dans le projet
            $destination = './avatar/' . strtolower($nom) . $file_extension;
            move_uploaded_file($image_tmp, $destination);

            // nom du fichier a inserer dans la BD
            $name_file = strtolower($nom) . $file_extension;


            // insert into user with last idcom
            $requete = $bdd->prepare("INSERT INTO user(idcompte, login, password, type, photo) values(:idcompte,:login,:password, :type, :photo)");
            $status2 = $requete->execute(array(
                "idcompte" => $getIDs['id'],
                "login" => $login,
                "password" => $password,
                "type" => $type,
                "photo" => $name_file

            ));
        } else {
            header('Location:inscription.php?msg=3');
        }
    } else {
        header('Location:inscription.php?msg=2');
    }

    // tester s'il y'a insertion
    if ($status1 && $status2) {
        header('Location:inscription.php?msg=1');
    } else {
        header('Location:inscription.php?msg=0');
    }
}

// inscription partenaire
if($action == 'partner'){
    $nom = ucfirst(htmlspecialchars($nom));
    $prenom = ucfirst(htmlspecialchars($prenom));
    $login = htmlspecialchars($login);
    $password = htmlspecialchars($password);
    $type = 'Partenaire';

    // Verifier que deux partenaires n'ont pas le mm nom (eviter les doublons)
    $query = $bdd->prepare("SELECT id FROM partenaire WHERE nom=:nom AND prenom=:prenom");
    $query->execute(array(
        "nom" => $nom,
        "prenom" => $prenom
    ));
    $getIdPartner = $query->fetch();

    // Verifier que deux users n'ont pas le mm login (eviter les doublons)
    $q = $bdd->prepare("SELECT id FROM user WHERE login=:login");
    $q->execute(array("login" => $login));
    $getIdUser = $q->fetch();

    if (empty($getIdPartner)) {

        if (empty($getIdUser)) {
            $requete = $bdd->prepare("INSERT INTO partenaire(nom, prenom) values(:nom,:prenom)");
            $status1 = $requete->execute(array(
                "nom" => $nom,
                "prenom" => $prenom
            ));

            // get last id in commercial
            $query = $bdd->prepare("SELECT Max(id) as id FROM partenaire");
            $query->execute();
            $getIDs = $query->fetch();

            // input file
            $nom_photo = $_FILES['photo']['name'];
            $image_tmp = $_FILES['photo']['tmp_name'];
            // recuperer extension du fichier
            $file_extension = strrchr($nom_photo, '.');
            $file_extension = strtolower($file_extension);
            // emplacement dans le projet
            $destination = './avatar/' . strtolower($nom) . $file_extension;
            move_uploaded_file($image_tmp, $destination);

            // nom du fichier a inserer dans la BD
            $name_file = strtolower($nom) . $file_extension;


            // insert into user with last idcom
            $requete = $bdd->prepare("INSERT INTO user(idcompte, login, password, type, photo) values(:idcompte,:login,:password, :type, :photo)");
            $status2 = $requete->execute(array(
                "idcompte" => $getIDs['id'],
                "login" => $login,
                "password" => $password,
                "type" => $type,
                "photo" => $name_file

            ));
        } else {
            header('Location:inscription_partner.php?msg=3');
        }
    } else {
        header('Location:inscription_partner.php?msg=2');
    }

    // tester s'il y'a insertion
    if ($status1 && $status2) {
        header('Location:inscription_partner.php?msg=1');
    } else {
        header('Location:inscription_partner.php?msg=0');
    }
}

