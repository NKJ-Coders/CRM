<?php
include 'include/connexion.php';

function UpdateByIdRdv($table, $id, $param)
{
    if (!empty($param) && is_array($param)) {
        $bdd = dbConnect();

        $sql = "UPDATE " . $table . " SET ";
        for ($i = 0; $i < count($param); $i++) {
            $val = $param[$i]['val'];
            $col = $param[$i]['col'];
            if ($i == 0) $sql .= $col . "='" . $val . "' ";
            if ($i != 0) $sql .= " ," . $col . "='" . $val . "' ";
        } //fin for

        $sql .= " WHERE IDRDV='$id'";

        $req = $bdd->prepare($sql);
        return $req->execute();
        $req->closeCursor;
    } else {
        return 0;
    }
}

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $action = $_GET['action'];
    $id = (isset($_GET['id'])) ? (int) $_GET['id'] : NULL;



    // Approuver le rdv
    if ($action == 'approve' && !empty($id)) {
        $requete = $bdd->prepare("UPDATE events SET 
        color=?
        where id=?");
        $statut = $requete->execute(array('#008000', $id));
    }

    // Annuler le rdv
    if ($action == 'denied' && !empty($id)) {
        $requete = $bdd->prepare("UPDATE events SET 
        color=?
        where id=?");
        $statut = $requete->execute(array('#FF0000', $id));
    }

    // relancer un rdv
    if ($action == 'relance' && !empty($id)) {

        $requete = $bdd->prepare("UPDATE events SET 
        color=?, title=?, start=?
        where id=?");
        $statut = $requete->execute(array('#FFD700', $_GET['title'], $_GET['start'], $id));
    }

}

// tester s'il y'a insertion
if ($statut) header("Location:mesRdv.php");
else header("Location:mesRdv.php");
