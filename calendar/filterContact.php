<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=c1642016c_syscrm_2;charset=utf8', 'c1642016c_syscrm_2', 'o_smD+L{wHOG');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$idpros = (int) $_GET['idpros'];
$query = $bdd->prepare("SELECT * FROM contactprospect WHERE IDPROS=?");
$query->execute(array($idpros));
$taleau = [];
// for ($key=0; $key<count($contacts); $key++) {
//     $taleau[$key][0] = $item['NOMCONT'];
//     $taleau[$key][1] = $item['IDCONT'];
// }
$i = 0;
while ($contact = $query->fetch(PDO::FETCH_ASSOC)) {
    $taleau[$i][0] = $contact['IDCONT'];
    $taleau[$i][1] = $contact['NOMCONT'];
    $i++;
}
echo json_encode($taleau);
