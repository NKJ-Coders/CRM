<?php
session_start();
require_once 'include/connexion.php';

extract($_POST);

$reponses = htmlspecialchars($reponses);
// var_dump($_POST);
// exit;
$idcont = (int) $idcont;
$query = $bdd->prepare('SELECT * FROM objection WHERE IDCONT = ' . $idcont);
$query->execute();
$test = $query->fetch();
// var_dump($test);
// exit;

if (!empty($prix) || !empty($reponses) || !empty($pas_interesser) || !empty($pas_besoin_innov) || !empty($on_verra) || !empty($nous_aider) || !empty($manque_de_tmps)) {
    if ($test) {

        // $param = [];
        // $param[0]['col'] = 'prix';
        // $param[0]['val'] = $prix;
        // $param[1]['col'] = 'reponses';
        // $param[1]['val'] = $reponses;
        // $param[2]['col'] = 'pas_interesser';
        // $param[2]['val'] = $pas_interesser;
        // $param[3]['col'] = 'pas_besoin_innov';
        // $param[3]['val'] = $pas_besoin_innov;
        // $param[4]['col'] = 'on_verra';
        // $param[4]['val'] = $on_verra;
        // $param[5]['col'] = 'nous_aider';
        // $param[5]['val'] = $nous_aider;
        // $param[6]['col'] = 'manque_de_tmps';
        // $param[6]['val'] = $manque_de_tmps;
        // $status = UpdateById('objection', $test['id'], $param);

  
    $requete = $bdd->prepare("UPDATE objection SET reponses =?, prix =?, pas_interesser =?, pas_besoin_innov =?, on_verra =?,nous_aider=?,manque_de_tmps=? where id=?");
        $status = $requete->execute(array(
            $reponses, $prix, $pas_interesser, $pas_besoin_innov, $on_verra, $nous_aider, $manque_de_tmps, $test['id']

        ));

    } else {

        // $param = [];
        // $param[0]['col'] = 'prix';
        // $param[0]['val'] = $prix;
        // $param[1]['col'] = 'reponses';
        // $param[1]['val'] = $reponses;
        // $param[2]['col'] = 'pas_interesser';
        // $param[2]['val'] = $pas_interesser;
        // $param[3]['col'] = 'pas_besoin_innov';
        // $param[3]['val'] = $pas_besoin_innov;
        // $param[4]['col'] = 'on_verra';
        // $param[4]['val'] = $on_verra;
        // $param[5]['col'] = 'nous_aider';
        // $param[5]['val'] = $nous_aider;
        // $param[6]['col'] = 'manque_de_tmps';
        // $param[6]['val'] = $manque_de_tmps;
        // $param[7]['col'] = 'IDCONT';
        // $param[7]['val'] = $idcont;
        // $status = add('objection', $param);

        $requete = $bdd->prepare("INSERT INTO objection (idcont, reponses, prix, pas_interesser, pas_besoin_innov, on_verra, nous_aider, manque_de_tmps) 
        VALUES(?,?,?,?,?,?,?,?)");
        $status = $requete->execute(array(
             $idcont, $reponses, $prix, $pas_interesser, $pas_besoin_innov, $on_verra, $nous_aider, $manque_de_tmps
        ));
    }
} else {
    header("Location:objectionForm.php?id=" . $idcont . "&msg=0");
}

// tester s'il y'a insertion
if ($status) header("Location:objectionForm.php?id=" . $idcont . "&msg=1");
else header("Location:objectionForm.php?id=" . $idcont . "&msg=0");
