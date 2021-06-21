
<?php
session_start();
require_once 'include/connexion.php';


// $idpros=$_GET['id'];
// $requete="DELETE from prospect where id=?";

// $data_prospect=array($idpros);
            
// $resultat=$bdd->prepare($requete);
// $resultat->execute($data_prospect);


// création de la requête

if(isset($_GET['action'])){
    $action = $_GET['action'];
    if(isset($_GET['id']) && $action=='Del' && !empty($_GET['id'])){
        $IDCOM = (int) $_GET['id'];
        $requete = $bdd->prepare("UPDATE commercial SET online=-1 where IDCOM=?") ;
        $status=$requete->execute(array($IDCOM));
    }
}



if ($status) header("Location:listCommerciaux.php?msg=1");
else header("Location:listCommerciaux.php?msg=0");


?>