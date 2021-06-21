<?php
session_start();

include 'include/connexion.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        extract($_POST);
        $firstyear = (int) str_replace(" ", "", $firstyear);
        $montant = (int) str_replace(" ", "", $montant);
        $description = $description;
        $idcom = $_SESSION['id'];
        $idpros = (int) $idpros;

        $query = $bdd->prepare("INSERT INTO offre(IDCOM, idpros, DATEOFFRE, DESCRIPTIONOFFRE, montant1an, montant2an, montant3an, montant4an) VALUES(?,?,?,?,?,?,?,?)");
        $status = $query->execute(array($idcom, $idpros, $dateoffre, $description, $firstyear, $montant, $montant, $montant));

        // statut -1 = client prospecté
        $requete = $bdd->prepare("UPDATE prospect SET idcom=?, status=? WHERE idpros=?");
        $requete->execute(array($idcom, -1, $idpros));

        // tester s'il y'a insertion
        if ($status) header("Location:listClients.php?msg=1");
        else header("Location:listClients.php?msg=0");
    }
    if ($action == 'edit') {
        extract($_POST);
        $firstyear = (int) str_replace(" ", "", $firstyear);
        $montant = (int) str_replace(" ", "", $montant);
        $description = $description;
        $idoffre = (int) $idoffre;

        $requete = $bdd->prepare("UPDATE offre SET DATEOFFRE=?, DESCRIPTIONOFFRE=?, montant1an=?, montant2an=?, montant3an=?, montant4an=? WHERE idoffre=?");
        $status = $requete->execute(array($dateoffre, $description, $firstyear, $montant, $montant, $montant, $idoffre));

        // tester s'il y'a insertion
        if ($status) header("Location:offreController.php?action=detail&id=" . $idoffre . "&msg=1");
        else header("Location:offreController.php?action=detail&id=" . $idoffre . "&msg=0");
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // lister les offres
    if ($action == 'list') {
        if (!empty($_SESSION)) {
            $type = $_SESSION['type'];
            $data_offres = '';

            if (isset($_GET['q']) && !empty($_GET['q'])) { // Filtrer par statut de l'offre
                $q = $_GET['q'];

                if ($_SESSION['type'] == 'Commercial') {
                    if ($q == 'en cours') {
                        $data_offres = $bdd->prepare(
                            'SELECT o.IDCOM, o.idpros, c.NOMCOM, p.nompros, o.DATEOFFRE, o.DESCRIPTIONOFFRE, o.montant1an, o.montant2an, o.idoffre, o.OBJECTIONOFFRE, o.statut, o.online
                FROM offre as o, commercial as c, prospect as p 
                WHERE o.IDCOM = c.IDCOM AND o.idpros = p.idpros AND o.online=1 AND o.IDCOM=? AND o.statut = ?'
                        );
                        $data_offres->execute(array($_SESSION['id'], 0));
                    }
                    if ($q == 'rejetée') {
                        $data_offres = $bdd->prepare(
                            'SELECT o.IDCOM, o.idpros, c.NOMCOM, p.nompros, o.DATEOFFRE, o.DESCRIPTIONOFFRE, o.montant1an, o.montant2an, o.idoffre, o.OBJECTIONOFFRE, o.statut, o.online
                FROM offre as o, commercial as c, prospect as p 
                WHERE o.IDCOM = c.IDCOM AND o.idpros = p.idpros AND o.online=1 AND o.IDCOM=? AND o.statut = ?'
                        );
                        $data_offres->execute(array($_SESSION['id'], -1));
                    }
                    if ($q == 'validée') {
                        $data_offres = $bdd->prepare(
                            'SELECT o.IDCOM, o.idpros, c.NOMCOM, p.nompros, o.DATEOFFRE, o.DESCRIPTIONOFFRE, o.montant1an, o.montant2an, o.idoffre, o.OBJECTIONOFFRE, o.statut, o.online
                FROM offre as o, commercial as c, prospect as p 
                WHERE o.IDCOM = c.IDCOM AND o.idpros = p.idpros AND o.online=1 AND o.IDCOM=? AND o.statut = ?'
                        );
                        $data_offres->execute(array($_SESSION['id'], 1));
                    }
                    if ($q == 'all') {
                        $data_offres = $bdd->prepare(
                            'SELECT o.IDCOM, o.idpros, c.NOMCOM, p.nompros, o.DATEOFFRE, o.DESCRIPTIONOFFRE, o.montant1an, o.montant2an, o.idoffre, o.OBJECTIONOFFRE, o.statut, o.online
                FROM offre as o, commercial as c, prospect as p 
                WHERE o.IDCOM = c.IDCOM AND o.idpros = p.idpros AND o.online=1 AND o.IDCOM=?'
                        );
                        $data_offres->execute(array($_SESSION['id']));
                    }
                } elseif ($_SESSION['type'] == 'admin') {
                    if ($q == 'en cours') {
                        $data_offres = $bdd->prepare(
                            'SELECT o.IDCOM, o.idpros, c.NOMCOM, p.nompros, o.DATEOFFRE, o.DESCRIPTIONOFFRE, o.montant1an, o.montant2an, o.idoffre, o.OBJECTIONOFFRE, o.statut, o.online
                FROM offre as o, commercial as c, prospect as p 
                WHERE o.IDCOM = c.IDCOM AND o.idpros = p.idpros AND o.online=1 AND o.statut = ?'
                        );
                        $data_offres->execute(array(0));
                    }
                    if ($q == 'rejetée') {
                        $data_offres = $bdd->prepare(
                            'SELECT o.IDCOM, o.idpros, c.NOMCOM, p.nompros, o.DATEOFFRE, o.DESCRIPTIONOFFRE, o.montant1an, o.montant2an, o.idoffre, o.OBJECTIONOFFRE, o.statut, o.online
                FROM offre as o, commercial as c, prospect as p 
                WHERE o.IDCOM = c.IDCOM AND o.idpros = p.idpros AND o.online=1 AND o.statut = ?'
                        );
                        $data_offres->execute(array(-1));
                    }
                    if ($q == 'validée') {
                        $data_offres = $bdd->prepare(
                            'SELECT o.IDCOM, o.idpros, c.NOMCOM, p.nompros, o.DATEOFFRE, o.DESCRIPTIONOFFRE, o.montant1an, o.montant2an, o.idoffre, o.OBJECTIONOFFRE, o.statut, o.online
                FROM offre as o, commercial as c, prospect as p 
                WHERE o.IDCOM = c.IDCOM AND o.idpros = p.idpros AND o.online=1 AND o.statut = ?'
                        );
                        $data_offres->execute(array(1));
                    }
                    if ($q == 'all') {
                        $data_offres = $bdd->prepare(
                            'SELECT o.IDCOM, o.idpros, c.NOMCOM, p.nompros, o.DATEOFFRE, o.DESCRIPTIONOFFRE, o.montant1an, o.montant2an, o.idoffre, o.OBJECTIONOFFRE, o.statut, o.online
                FROM offre as o, commercial as c, prospect as p 
                WHERE o.IDCOM = c.IDCOM AND o.idpros = p.idpros AND o.online=1'
                        );
                        $data_offres->execute();
                    }
                }
            } else {

                if ($_SESSION['type'] == 'admin') {
                    $data_offres = $bdd->prepare(
                        'SELECT o.IDCOM, o.idpros, c.NOMCOM, p.nompros, o.DATEOFFRE, o.DESCRIPTIONOFFRE, o.montant1an, o.montant2an, o.idoffre, o.OBJECTIONOFFRE, o.statut, o.online
                FROM offre as o, commercial as c, prospect as p 
                WHERE o.IDCOM = c.IDCOM AND o.idpros = p.idpros AND o.online=1'
                    );
                    $data_offres->execute();
                } elseif ($_SESSION['type'] == 'Commercial') {
                    $data_offres = $bdd->prepare(
                        'SELECT o.IDCOM, o.idpros, c.NOMCOM, p.nompros, o.DATEOFFRE, o.DESCRIPTIONOFFRE, o.montant1an, o.montant2an, o.idoffre, o.OBJECTIONOFFRE, o.statut, o.online
                FROM offre as o, commercial as c, prospect as p 
                WHERE o.IDCOM = c.IDCOM AND o.idpros = p.idpros AND o.online=1 AND o.IDCOM=?'
                    );
                    $data_offres->execute(array($_SESSION['id']));
                }
            }

            // redirect to view
            include 'listOffres.php';
        } else {
            include '401.php';
        }
    }

    // DELETE
    if ($action == 'del') {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $query = $bdd->prepare('UPDATE offre SET online = ? WHERE idoffre = ?');
            $query->execute(array(-1, $id));

            header('Location:offreController.php?action=list');
        }
    }

    // change status
    if ($action == 'changeStatus') {
        if (isset($_GET['saction'])) {
            $saction = $_GET['saction'];

            if (isset($_GET['id']) && !empty($_GET['id'])) {

                $id = $_GET['id'];
                $q = $bdd->prepare(
                    'SELECT statut
                FROM offre
                WHERE idoffre= ?'
                );
                $q->execute(array($id));
                $data = $q->fetch();

                if ($saction == 'denied') {
                    $query = $bdd->prepare('UPDATE offre SET statut = ? WHERE idoffre = ?');
                    $query->execute(array(-1, $id));
                }
            }
        }

        header('Location:offreController.php?action=list');
    }

    if ($action == 'detail') {
        $id = $_GET['id'];
        $query = $bdd->prepare("SELECT * FROM offre WHERE idoffre = ?");
        $query->execute(array($id));
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (isset($_SESSION) && !empty($_SESSION)) {
            $type = $_SESSION['type'];
            if ($type == 'Commercial' || $type == 'admin') {
                include 'detailOffre.php';
            } else {
                require '401.php';
            }
        } else {
            require '401.php';
        }
    }
}
