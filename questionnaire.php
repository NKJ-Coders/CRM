<?php
session_start();
require_once 'include/connexion.php';

extract($_POST);

$question1 = htmlspecialchars($question1);
$question2 = htmlspecialchars($question2);
$question3 = htmlspecialchars($question3);
$question4 = htmlspecialchars($question4);
$question5 = htmlspecialchars($question5);
$question6 = htmlspecialchars($question6);
$question7 = htmlspecialchars($question7);
// var_dump($_POST);
// exit;
$idcont = (int) $idcont;
$query = $bdd->prepare('SELECT * FROM questionnaire WHERE IDCONT = ' . $idcont);
$query->execute();
$test = $query->fetch();
// var_dump($test);
// exit;

if (!empty($question1) || !empty($question2) || !empty($question3) || !empty($question4) || !empty($question5) || !empty($question6) || !empty($question7)) {
    if ($test) {

        $requete = $bdd->prepare("UPDATE questionnaire SET IDCONT=:idcont , question1=:question1, question2=:question2, question3=:question3, question4=:question4, question5=:question5, question6=:question6, question7=:question7 WHERE IDCONT = :idcont");
        $status = $requete->execute(array(
            "idcont" => $_POST["idcont"],
            "question1" => $question1,
            "question2" => $question2,
            "question3" => $question3,
            "question4" => $question4,
            "question5" => $question5,
            "question6" => $question6,
            "question7" => $question7,
        ));
    } else {

        $requete = $bdd->prepare("INSERT INTO questionnaire(IDCONT, question1, question2, question3, question4, question5, question6, question7) values(:idcont,:question1,:question2,:question3, :question4, :question5, :question6, :question7)");
        $status = $requete->execute(array(
            "idcont" => $_POST["idcont"],
            "question1" => $question1,
            "question2" => $question2,
            "question3" => $question3,
            "question4" => $question4,
            "question5" => $question5,
            "question6" => $question6,
            "question7" => $question7,
        ));
    }
} else {
    header("Location:questionnaireForm.php?id=" . $idcont . "&msg=0");
}

// tester s'il y'a insertion
if ($status) header("Location:questionnaireForm.php?id=" . $idcont . "&msg=1");
else header("Location:questionnaireForm.php?id=" . $idcont . "&msg=0");
