
<?php
session_start();
require_once 'include/connexion.php';

$idpros = (int) $_GET['id'];
// $idpros=$_GET['id'];
// $requete="DELETE from prospect where id=?";

// $data_prospect=array($idpros);
            
// $resultat=$bdd->prepare($requete);
// $resultat->execute($data_prospect);


// création de la requête


$requete = $bdd->prepare("UPDATE prospect SET online=-1 where idpros=?") 
;
$status=$requete->execute(array($idpros));


if ($status) header("Location:listClients.php?msg=1");
else header("Location:listClients.php?msg=0");


?>