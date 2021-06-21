
<?php
session_start();
require_once 'include/connexion.php';
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'changeStatut') {
        // exit;
        // if($_GET['statut'] == 0) {
        $q = $bdd->prepare("SELECT status FROM prospect WHERE idpros=?");
        $q->execute(array($_GET['id']));
        $pros = $q->fetch(PDO::FETCH_ASSOC);

        if ($pros['status'] == 1) {
            $requete = $bdd->prepare("UPDATE prospect SET status=?, idcom=?
        where idpros=?");
            $status = $requete->execute(array(
                0, $_SESSION['id'], $_GET['id']
            ));
        }
        if ($pros['status'] == 0) {
            $requete = $bdd->prepare("UPDATE prospect SET status=?, nombre_fois=?, idcom=?
        where idpros=?");
            $status = $requete->execute(array(
                1, NULL, NULL, $_GET['id']
            ));
        }
        // }
        header("Location:listClients.php?msg=3");
    }
} else {


    extract($_POST);

    $idpros = (int) $idpros;

    $q = $bdd->prepare("SELECT * FROM prospect WHERE idpros = ?");
    $q->execute(array($idpros));
    $pros = $q->fetch(PDO::FETCH_ASSOC);

    $req = $bdd->prepare("SELECT * FROM commercial WHERE IDCOM = ?");
    $req->execute(array($pros['idcom']));
    $com = $req->fetch(PDO::FETCH_ASSOC);

    $date = explode(" ", $pros['create_at']);

    $now = explode(" ", date('Y-m-d'));
    $currentDate = $now[0];

    function updatePros()
    {
        extract($_POST);
        $bdd = dbConnect();
        $requete = $bdd->prepare("UPDATE prospect SET nompros=?,
        equipe_dirigeante=?,capital=?,vision=?,
        valeur=?,mission=?,conviction=?,activite_produit=?,
        concurent=?,secteur=?,siteweb=?, ville=?
        where idpros=?");
        $status = $requete->execute(array(
            $nom,
            $equipe_dirigeante, $capital, $vision,
            $valeur, $mission, $conviction,
            $activite_produit, $concurent, $secteur,
            $siteweb, $ville, $idpros
        ));

        return $status;
    }

    // if ($currentDate == $date[0]) {

    //     if ($currentTime <= '18:00') {
    // $commercial = $bdd->prepare('SELECT * FROM prospect WHERE idpros=?');
    // $commercial->execute(array($idpros));
    // $data = $commercial->fetch(PDO::FETCH_ASSOC);
    
    $nombrePoint = 0;

    if ($pros['nombre_fois'] == null) {
    //     var_dump($mission);
    // exit;
        extract($_POST);

        $requete = $bdd->prepare("UPDATE prospect SET create_at=?
        where idpros=?");
        $status = $requete->execute(array(
            date('Y-m-d'), $idpros
        ));

        $requete = $bdd->prepare("UPDATE prospect SET nombre_fois=? where idpros=?");
        $status = $requete->execute(array(
            1, $idpros
        ));

        if (!empty($pros['conviction'])) {
            $p2 = 0;
        } elseif(empty($pros['conviction'])) {
            if (!empty($conviction)) {
                $p2 = 0;
            } elseif(empty($conviction)) {
                // var_dump('o');
                // exit;
                $p2 = 5;
            }
        }
        if (!empty($pros['valeur'])) {
            $p3 = 0;
        } elseif(empty($pros['valeur'])) {
            if (!empty($valeur)) {
                $p3 = 0;
            } elseif(empty($valeur)) {
                $p3 = 5;
            }
        }

        if (!empty($pros['mission'])) {
            $p4 = 0;
        } elseif(empty($pros['mission'])) {
            if (!empty($mission)) {
                $p4 = 0;
            } elseif(empty($mission)) {
                $p4 = 5;
            }
        }

        if (!empty($pros['vision'])) {
            $p5 = 0;
        } elseif(empty($pros['vision'])) {
            if (!empty($vision)) {
                $p5 = 0;
            } elseif(empty($vision)) {
                $p5 = 5;
            }
        }

        if (!empty($pros['capital'])) {
            $p6 = 0;
        } elseif(empty($pros['capital'])) {
            if (!empty($capital)) {
                $p6 = 0;
            } elseif(empty($capital)) {
                $p6 = 3;
            }
        }

        if (!empty($pros['activite_produit'])) {
            $p7 = 0;
        } elseif(empty($pros['activite_produit'])) {
            if (!empty($activite_produit)) {
                $p7 = 0;
            } elseif(empty($activite_produit)) {
                $p7 = 3;
            }
        }
        if (!empty($pros['concurent'])) {
            $p8 = 0;
        } elseif(empty($pros['concurent'])) {
            if (!empty($concurent)) {
                $p8 = 0;
            } elseif(empty($concurent)) {
                $p8 = 3;
            }
        }
        if (!empty($pros['secteur'])) {
            $p9 = 0;
        } elseif(empty($pros['secteur'])) {
            if (!empty($secteur)) {
                $p9 = 0;
            } elseif(empty($secteur)) {
                $p9 = 3;
            }
        }

        if($com['nombrePoint'] == 0) $nombrePoint = 0;
        else $nombrePoint = $com['nombrePoint'] - $p2 - $p3 - $p4 - $p5 - $p6 - $p7 - $p8 - $p9;
    } elseif ($pros['nombre_fois'] == 1 || $pros['nombre_fois'] != 1|| $pros['nombre_fois'] != null) {
    //     var_dump('non');
    // exit;
        $requete = $bdd->prepare("UPDATE prospect SET nombre_fois=? where idpros=?");
        $status = $requete->execute(array(
            2, $idpros
        ));

        $day = explode("-", $date[0]);

        $currentDay = explode("-", $now[0]);

        if ($day[1] == $currentDay[1] && $day[2] == $currentDay[2]) {
            $diff = $currentDay[0] - $day[0];
            if ($diff <= 30) {
                if (!empty($pros['conviction'])) {
                    $p2 = 0;
                } elseif(empty($pros['conviction'])) {
                    if (!empty($conviction)) {
                        $p2 = 5;
                    } elseif(empty($conviction)) {
                        $p2 = 0;
                    }
                }
                if (!empty($pros['valeur'])) {
                    $p3 = 0;
                } elseif(empty($pros['valeur'])) {
                    if (!empty($valeur)) {
                        $p3 = 5;
                    } elseif(empty($valeur)) {
                        $p3 = 0;
                    }
                }

                if (!empty($pros['mission'])) {
                    $p4 = 0;
                } elseif(empty($pros['mission'])) {
                    if (!empty($mission)) {
                        $p4 = 5;
                    } elseif(empty($mission)) {
                        $p4 = 0;
                    }
                }

                if (!empty($pros['vision'])) {
                    $p5 = 0;
                } elseif(empty($pros['vision'])) {
                    if (!empty($vision)) {
                        $p5 = 5;
                    } elseif(empty($vision)) {
                        $p5 = 0;
                    }
                }

                if (!empty($pros['capital'])) {
                    $p6 = 0;
                } elseif(empty($pros['capital'])) {
                    if (!empty($capital)) {
                        $p6 = 3;
                    } elseif(empty($capital)) {
                        $p6 = 0;
                    }
                }

                if (!empty($pros['activite_produit'])) {
                    $p7 = 0;
                } elseif(empty($pros['activite_produit'])) {
                    if (!empty($activite_produit)) {
                        $p7 = 3;
                    } elseif(empty($activite_produit)) {
                        $p7 = 0;
                    }
                }
                if (!empty($pros['concurent'])) {
                    $p8 = 0;
                } elseif(empty($pros['concurent'])) {
                    if (!empty($concurent)) {
                        $p8 = 3;
                    } elseif(empty($concurent)) {
                        $p8 = 0;
                    }
                }
                if (!empty($pros['secteur'])) {
                    $p9 = 0;
                } elseif(empty($pros['secteur'])) {
                    if (!empty($secteur)) {
                        $p9 = 3;
                    } elseif(empty($secteur)) {
                        $p9 = 0;
                    }
                }

                if($com['nombrePoint'] == 100) $nombrePoint = 100;
                else $nombrePoint = $com['nombrePoint'] + $p2 + $p3 + $p4 + $p5 + $p6 + $p7 + $p8 + $p9;
            }
        }
    }

    $requete = $bdd->prepare("UPDATE commercial SET 
        nombrePoint=?
        where IDCOM=?");
    $requete->execute(array(
        $nombrePoint,
        $pros['idcom']
    ));

    $status = updatePros();
    // } else {
    //     $status = updatePros();
    // }
    // } else {
    //     $status = updatePros();
    // }


    // tester s'il y'a insertion
    if ($status) header("Location:EditProspectForm.php?id=" . $idpros . "&msg=1");
    else header("Location:EditProspectForm.php?id=" . $idpros . "&msg=0");
}
