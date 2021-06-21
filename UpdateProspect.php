
<?php
session_start();
require_once 'include/connexion.php';

extract($_POST);

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


$param = [];
$param[0]['col'] = 'photo';
$param[0]['val'] = $name_file;
$param[1]['col'] = 'nompros';
$param[1]['val'] = htmlspecialchars($nom);
$param[2]['col'] = 'idcom';
$param[2]['val'] = (int) $idcom;
$param[3]['col'] = 'capital';
$param[3]['val'] = $capital;
$param[4]['col'] = 'vision';
$param[4]['val'] = htmlspecialchars($vision);
$param[5]['col'] = 'valeur';
$param[5]['val'] = htmlspecialchars($valeur);
$param[6]['col'] = 'mission';
$param[6]['val'] = htmlspecialchars($mission);
$param[7]['col'] = 'activite_produit';
$param[7]['val'] = htmlspecialchars($activite_produit);
$param[8]['col'] = 'concurent';
$param[8]['val'] = htmlspecialchars($concurent);
$param[9]['col'] = 'secteur';
$param[9]['val'] = htmlspecialchars($secteur);
$param[10]['col'] = 'siteweb';
$param[10]['val'] = htmlspecialchars($siteweb);
$param[11]['col'] = 'equipe_dirigeante';
$param[11]['val'] = htmlspecialchars($equipe_dirigeante);
$param[12]['col'] = 'conviction';
$param[12]['val'] = htmlspecialchars($conviction);
$param[13]['col'] = 'photo_dg';
$param[13]['val'] = $name_file_dg;
$param[14]['col'] = 'create_at';
$param[14]['val'] = date('Y/m/d');
$status = add('prospect', $param);
$nom_photo = $_FILES['photo']['name'];
$image_tmp = $_FILES['photo']['tmp_name'];
move_uploaded_file($image_tmp,'images/'.$nom_photo);

$nom_photo_dg = $_FILES['photo_dg']['name'];
$image_tmp_dg = $_FILES['photo_dg']['tmp_name'];
move_uploaded_file($image_tmp_dg,'images/'.$nom_photo_dg);

if(!empty($nom_photo)) { 
    // empty : vide
    // si le $nom_photo n'est pas vide alors la photo sera modifiée
    $requete="UPDATE prospect SET 
                idcom=?,photo=?,photo_dg=?,nompros=?,
                equipe_dirigeante=?,capital=?,vision=?,
                valeur=?,mission=?,conviction=?,activite_produit=?,
                concurent=?,secteur=?,siteweb=?
                where id=?";

    $valeur=array($idcom,$name_file,$name_file_dg,$nom,
                $equipe_dirigeante,$capital,$vision, 
                $valeur,$tel,$mission,$conviction,
                $activite_produit,$concurent,$secteur,
                 $siteweb);
}else{ 
    // si le $nom_photo est vide alors la photo ne sera pas modifiée
    $requete="UPDATE prospect SET 
                idcom=?,photo=?,photo_dg=?,nompros=?,
                equipe_dirigeante=?,capital=?,vision=?,
                valeur=?,mission=?,conviction=?,activite_produit=?,
                concurent=?,secteur=?,siteweb=?
                where id=?";

    $valeur=array($idcom,$name_file,$name_file_dg,$nom,
                $equipe_dirigeante,$capital,$vision, 
                $valeur,$tel,$mission,$conviction,
                $activite_produit,$concurent,$secteur,
                 $siteweb);
                 $msg= "prospect modifié avec succes";
}


// tester s'il y'a insertion
if (!empty($status)) header("Location:listClients.php?msg=1");
else header("Location:listClients.php?msg=0");
