<?php
session_start();

include 'include/connexion.php';

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'edit') {
        if (isset($_SESSION) && !empty($_SESSION)) {
            $type = $_SESSION['type'];
            if ($type == 'Commercial') {
                require 'editRepport.php';
            } else {
                require '401.php';
            }
        } else {
            require 'index.php';
        }
    }
    if ($action == 'all') {
        if (isset($_SESSION) && !empty($_SESSION)) {
            $type = $_SESSION['type'];
            if ($type == 'admin' || $type == 'Commercial') {
                if ($type == 'admin') {
                    if (isset($_GET['q']) && !empty($_GET['q'])) {
                        $repports = $bdd->prepare("SELECT * FROM repport as r, commercial as c WHERE r.idcom=c.IDCOM AND r.online = 1 AND r.date=?");
                        $repports->execute(array($_GET['q']));
                    } else {
                        $repports = $bdd->prepare("SELECT * FROM repport as r, commercial as c WHERE r.idcom=c.IDCOM AND r.online = 1");
                        $repports->execute();
                    }
                } else {
                    if (isset($_GET['q']) && !empty($_GET['q'])) {
                        $repports = $bdd->prepare("SELECT * FROM repport as r, commercial as c WHERE r.idcom=c.IDCOM AND r.idcom=? AND r.online = 1 AND r.date=?");
                        $repports->execute(array($_SESSION['id'], $_GET['q']));
                    } else {
                        $repports = $bdd->prepare("SELECT * FROM repport as r, commercial as c WHERE r.idcom=c.IDCOM AND r.idcom=? AND r.online = 1");
                        $repports->execute(array($_SESSION['id']));
                    }
                }

                require 'allRepport.php';
            } else {
                require '401.php';
            }
        } else {
            require 'index.php';
        }
    }
    if ($action == 'view') {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            if (isset($_SESSION) && !empty($_SESSION)) {
                $type = $_SESSION['type'];
                if ($type == 'admin' || $type == 'Commercial') {
                    $repport = $bdd->prepare("SELECT * FROM repport as r WHERE r.id = ?");
                    $repport->execute(array($id));
                    $data = $repport->fetch(PDO::FETCH_ASSOC);
                    require 'viewRepport.php';
                } else {
                    require '401.php';
                }
            } else {
                require 'index.php';
            }
        }
    }
    if ($action == 'delete') {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $param = [];
            $param[0]['col'] = 'online';
            $param[0]['val'] = -1;
            $status = UpdateById('repport', $id, $param);

            if ($status) header("Location: repportController.php?action=all&msg=1");
            else header("Location: repportController.php?action=all");
        }
    }
}

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'save') {

        $local = explode(" ", date('Y-m-d H:i:s', time()));

        $query = $bdd->prepare("INSERT INTO repport(idcom, contenu, date, heure) VALUES(:idcom,:contenu,:date, :heure)");
        $status = $query->execute(array(
            "idcom" => $_SESSION['id'],
            "contenu" => $_POST['content'],
            "date" => $local[0],
            "heure" => $local[1]
        ));
        if ($status) {
            $tab = ['statut' => 'ok'];
            echo json_encode($tab);
        } else {
            $tab = ['statut' => 'error'];
            echo json_encode($tab);
        }
    }
}
