
<?php
session_start();
require_once 'include/connexion.php';

extract($_POST);

$q = $bdd->prepare('SELECT * FROM prospect WHERE nompros=?');
$q->execute(array(ucwords(strtolower($nom))));
$pros = $q->fetch();

if (!empty($pros)) {
    header("Location:listClients.php?msg=2");
} else {

    $nom_photo = $_FILES['photo']['name'];
    $image_tmp = $_FILES['photo']['tmp_name'];

    $nom_photo_dg = $_FILES['photo_dg']['name'];
    $image_tmp_dg = $_FILES['photo_dg']['tmp_name'];
    // recuperer extension du fichier
    $file_extension = strrchr($nom_photo, '.');
    $file_extension = strtolower($file_extension);

    $file_extension_dg = strrchr($nom_photo_dg, '.');
    $file_extension_dg = strtolower($file_extension_dg);

    // emplacement dans le projet
    $destination = './images/' . strtolower($nom) . $file_extension;
    move_uploaded_file($image_tmp, $destination);

    $destination_dg = './images/dg_' . strtolower($nom) . $file_extension_dg;
    move_uploaded_file($image_tmp_dg, $destination_dg);

    // nom du fichier a inserer dans la BD
    $name_file = strtolower($nom) . $file_extension;
    $name_file_dg = 'dg_' . strtolower($nom) . $file_extension_dg;



    $capital = (int) $capital;

    $requete = $bdd->prepare("INSERT INTO prospect(photo, photo_dg, nompros, ville, equipe_dirigeante, capital, vision, valeur, mission, conviction, activite_produit, concurent, secteur, siteweb, create_at) 
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $status = $requete->execute(array(
        $name_file, $name_file_dg, ucwords(strtolower($nom)), $ville, $equipe_dirigeante, $capital, $vision, $valeur, $mission, $conviction, $activite_produit, $concurent, $secteur, $siteweb, date('Y-m-d H:i')
    ));

    // tester s'il y'a insertion
    if ($status) header("Location:listClients.php?msg=1");
    else header("Location:listClients.php?msg=0");
}
