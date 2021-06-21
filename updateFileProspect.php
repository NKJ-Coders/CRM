<?php
session_start();

include 'include/connexion.php';

if (isset($_FILES) && !empty($_FILES)) {

    extract($_POST);

    if ($action == 'updateFileLogo') {
        // var_dump($_FILES);
        // exit;
        $nom_photo = $_FILES['photo']['name'];
        $image_tmp = $_FILES['photo']['tmp_name'];

        // recuperer extension du fichier
        $file_extension = strrchr($nom_photo, '.');
        $file_extension = strtolower($file_extension);

        // emplacement dans le projet
        $destination = './images/' . strtolower($nom) . $file_extension;
        move_uploaded_file($image_tmp, $destination);

        // nom du fichier a inserer dans la BD
        $name_file = strtolower($nom) . $file_extension;

        // var_dump($destination);
        // exit;

        $query = $bdd->prepare("UPDATE prospect SET photo=? WHERE idpros=?");
        $status = $query->execute(array($name_file, $idpros));
    }
    if ($action == 'updateFileDg') {
        $nom_photo_dg = $_FILES['photo_dg']['name'];
        $image_tmp_dg = $_FILES['photo_dg']['tmp_name'];

        // recuperer extension du fichier
        $file_extension_dg = strrchr($nom_photo_dg, '.');
        $file_extension_dg = strtolower($file_extension_dg);

        // emplacement dans le projet
        $destination_dg = './images/dg_' . strtolower($nom) . $file_extension_dg;
        move_uploaded_file($image_tmp_dg, $destination_dg);

        // nom du fichier a inserer dans la BD
        $name_file_dg = 'dg_' . strtolower($nom) . $file_extension_dg;

        $query = $bdd->prepare("UPDATE prospect SET photo_dg=? WHERE idpros=?");
        $status = $query->execute(array($name_file_dg, $idpros));
        
    }
// tester s'il y'a insertion
if ($status) header("Location:EditProspectForm.php?id=" . $idpros . "&msg=1");
else header("Location:EditProspectForm.php?id=" . $idpros . "&msg=0");
} else {
    extract($_POST);
    header("Location:EditProspectForm.php?id=" . $idpros . "&msg=0");
}