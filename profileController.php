<?php
session_start();

include 'include/connexion.php';


if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'detail') {
        // var_dump($_SESSION['id']);
        // exit;
        $profil = '';
        $query = '';

        if ($_SESSION['type'] == 'Commercial') {
            $query = $bdd->prepare("SELECT * FROM commercial as c, user as u WHERE c.IDCOM = u.idcompte AND c.IDCOM = ? AND u.type='Commercial'");
        }
        if ($_SESSION['type'] == 'admin') {
            $query = $bdd->prepare("SELECT * FROM admin as a, user as u WHERE a.id = u.idcompte AND a.id = ? AND u.type='admin'");
        }
        if ($_SESSION['type'] == 'Partenaire') {
            $query = $bdd->prepare("SELECT * FROM partenaire as p, user as u WHERE p.id = u.idcompte AND p.id = ? AND u.type='Partenaire'");
        }

        $query->execute(array($_SESSION['id']));
        $profil = $query->fetch(PDO::FETCH_ASSOC);
        // var_dump($profil);
        // exit;

        include 'detailProfile.php';
    }
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];


    if ($action == 'edit') {
        extract($_POST);

        if ($_SESSION['type'] == 'Commercial') {
            $query = $bdd->prepare("UPDATE Commercial SET NOMCOM=?, PRENOMCOM=?, ADRESSECOM=?, TELCOM=? WHERE IDCOM=?");
            $status1 = $query->execute(array($nom, $prenom, $adresse, $tel, $_SESSION['id']));
        }
        if ($_SESSION['type'] == 'admin') {
            $query = $bdd->prepare("UPDATE admin SET nom=?, prenom=? WHERE id=?");
            $status1 = $query->execute(array($nom, $prenom, $_SESSION['id']));
        }
        if ($_SESSION['type'] == 'Partenaire') {
            $query = $bdd->prepare("UPDATE partenaire SET nom=?, prenom=? WHERE id=?");
            $status1 = $query->execute(array($nom, $prenom, $_SESSION['id']));
        }
        $query = $bdd->prepare("UPDATE user SET login=?, password=? WHERE idcompte=? AND type=?");
        $status2 = $query->execute(array($login, $password, $_SESSION['id'], $_SESSION['type']));

        $_SESSION['nom'] = $nom;

        if ($status1 && $status2) header('Location:profileController.php?action=detail&msg=1');
        else header('Location:profileController.php?action=detail&msg=0');
    }

    if ($action == 'uploadFile') {
        extract($_POST);

        if (!empty($_FILES['photo']['name'])) {

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
            
            $query = $bdd->prepare("UPDATE user SET photo=? WHERE idcompte=? AND type=?");
            $status = $query->execute(array($name_file, $_SESSION['id'], $_SESSION['type']));

            $_SESSION['photo'] = $name_file;

            if ($status) header('Location:profileController.php?action=detail&msg=2');
            else header('Location:profileController.php?action=detail&msg=0');
        } else {
            header('Location:profileController.php?action=detail&msg=3');
        }
    }
}
