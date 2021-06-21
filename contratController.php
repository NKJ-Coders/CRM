<?php
session_start();

include 'include/connexion.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    // Add
    if ($action == 'add') {
        extract($_POST);
        $idoffre = (int) $idoffre;
        $idpros = (int) $idpros;
        $ecart = htmlspecialchars($ecart);
        $validite = htmlspecialchars($validite);
        $proposition = htmlspecialchars($proposition);
        $date = date("Y-m-d");

        $query = $bdd->prepare("INSERT INTO contrat(idoffre, idpros, proposition, validite, ecart, create_at) VALUES(?,?,?,?,?,?)");
        $status = $query->execute(array($idoffre, $idpros, $proposition, $validite, $ecart, $date));

        $query = $bdd->prepare('UPDATE offre SET statut = ? WHERE idoffre = ?');
        $query->execute(array(1, $idoffre));

        $req = $bdd->prepare('UPDATE prospect SET status = ? WHERE idpros = ?');
        $req->execute(array(2, $idpros));

        // tester s'il y'a insertion
        if ($status) header("Location:offreController.php?action=list&msg=1");
        else header("Location:offreController.php?action=list&msg=0");
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    // Add
    if ($action == 'list') {
        if (!empty($_SESSION)) {
            $id = (int) $_SESSION['id'];
            $type = $_SESSION['type'];
            $data_contrat = '';

            if ($_SESSION['type'] == 'admin') {
                $data_contrat = $bdd->prepare(
                    'SELECT cont.idoffre, cont.idpros, cont.proposition, cont.validite, cont.ecart, cont.create_at, cont.online, cont.statut, o.IDCOM, c.NOMCOM, c.PRENOMCOM, p.nompros, p.photo
                FROM offre as o, commercial as c, prospect as p, contrat as cont 
                WHERE cont.idoffre=o.idoffre AND cont.idpros=p.idpros AND o.IDCOM=c.IDCOM AND o.online=1'
                );
                $data_contrat->execute();
            } elseif ($_SESSION['type'] == 'Commercial') {
                $data_contrat = $bdd->prepare(
                    'SELECT cont.id, cont.idoffre, cont.idpros, cont.proposition, cont.validite, cont.ecart, cont.create_at, cont.online, cont.statut, o.IDCOM, c.NOMCOM, c.PRENOMCOM, p.nompros, p.photo
                FROM offre as o, commercial as c, prospect as p, contrat as cont 
                WHERE cont.idoffre=o.idoffre AND cont.idpros=p.idpros AND o.IDCOM=c.IDCOM AND o.online=1 AND o.IDCOM=?'
                );
                $data_contrat->execute(array($_SESSION['id']));
            }

            include 'listContrat.php';
        } else {
            include '401.php';
        }
    }
}
