<?php
require_once('include/connexion.php');
require('fpdf17/fpdf.php');
$con=mysqli_connect('localhost','c1642016c_syscrm_2','o_smD+L{wHOG');
    mysqli_select_db($con,'c1642016c_syscrm_2');

if (isset($_GET['IDCONT']))
    $IDCONT = $_GET['IDCONT'];
else
    $IDCONT = 0;



// $query=mysqli_query($con,"select * from contactprospect
	
// 	where
// 	IDCONT = '".$_GET['IDCONT']."'");
// $contactprospect=mysqli_fetch_array($query);
$data_prospect = $bdd->prepare('SELECT p.equipe_dirigeante, p.mission, p.activite_produit, p.concurent, p.capital, p.secteur, p.nompros, c.NOMCOM, c.PRENOMCOM, c.ADRESSECOM, c.TELCOM
FROM  commercial as c, prospect as p WHERE nompros=?  AND c.IDCOM = p.idcom');
$data_prospect->execute(array($_GET['nompros']));
$data = $data_prospect->fetch();
//recuperation de la date                                             


// $data_contactprospect = $bdd->prepare('SELECT * FROM contactprospect');
// $data_contactprospect->execute();
// $data = $data_contactprospect->fetch();

// $nom_contact = strtoupper($data['NOMCONT'] . " " . $data['PRENOMCONT']);
// $poste_contact = strtoupper($data['POSTECONT']);
// $emaill = strtoupper($data['ADRESSECONT'] );
// $tel = strtoupper($data['TELCONT']);

// $data_commerciaux = $bdd->prepare('SELECT * FROM commercial');
// $data_commerciaux->execute();
// $data = $data_commerciaux->fetch();


// $comercial = strtoupper($data['NOMCOM'] . " " . $data['PRENOMCOM']);
// $email = strtoupper($data['ADRESSECOM']);
// $tell = strtoupper($data['TELCOM']);
										  //A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

		


$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();
$pdf->SetFont('Times','',12);


$pdf->Image('logo.png', 30, 15,40,20, '','png', '', 'T', false, 300, '', false, false, false, 0, false, false, false, false) ;
// SET FONT
$pdf->Ln(7);
$pdf->SetFont('helvetica', 'B', 16);

// TITLE
$pdf->cell(210,0,'GLOBAL ASSET CAMEROON',0,1,'C');
$pdf->SetFont('helvetica', '', 8);
$pdf->Ln(5);
$h = 0;
$retrait = "                                                                                                     ";
$pdf->Write($h, $retrait .  "BP : 15032 Douala/Tel : 237 659 364 897",0,1,'C');

$pdf->SetFont('helvetica', '', 8);
$pdf->Ln(5);
$h = 0;
$retrait = "                                                                                                   ";
$pdf->Write($h, $retrait .  "RC/DLN/2021/B/379 NUI: M01218457563A",0,1,'C');

$pdf->SetFont('helvetica', '', 8);
$pdf->Ln(5);
$h = 0;
$retrait = "                                                                                                               ";
$pdf->Write($h, $retrait .  "Au capital de 100 000 000F CFA",0,1,'C');

$pdf->SetFont('helvetica', '', 8);
$pdf->Ln(5);
$h = 0; 
$retrait = "                                                                                                     ";
$pdf->Write($h, $retrait .  "E-mail : contact@globalassetcameroon.net",0,1,'C');


$pdf->SetFont('helvetica', '', 8);
$pdf->Ln(5);
$h = 0;
$retrait = "                                                                                                           ";
$pdf->Write($h, $retrait .  "site web: globalassetcameroon.com",0,1,'C');
// $pdf->Cell(45,3, $prospect['siteweb'],0,1, 'C');

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Ln(15);
$h = 3;
$retrait = "                                                 ";
$pdf->Cell(0, 10, 'FICH DE PROSPECTION', 'TB', 1, 'C');
$pdf->Ln(15);
$h = 3;
$retrait = "   ";
$pdf->Write($h, $retrait .  "CAS :  " .$data['nompros'] . '    Staut: Offre deposee. Le: 12/03/21' ,0,1,'C');

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(15);
$h = 3;
$retrait = "                                         ";
$pdf->Write($h, $retrait .  "INFORMATIONS SUR L'ENTREPRISE",0,1,'C');
$pdf->Ln(10);
$retrait = "           ";
$h = 1;
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write($h, $retrait .  "Capital actuel: ");
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(130	,3, $data['capital'],0,0);
$retrait = "                                                                           ";
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write( $h, $retrait .  " FCFA ");
$pdf->Ln(10);
$h = 3;
$retrait = "           ";
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write($h, $retrait .  "Secteur d'activite ");
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(130	,3, $data['secteur'],0,0);
$pdf->Ln(10);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write($h, $retrait .  "Equipe dirrigeante: ");
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(130	,3, $data['equipe_dirigeante'],0,0);
$pdf->Ln(10);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write($h, $retrait .  "Mission: ");
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(130	,3, $data['mission'],0,0);
$pdf->Ln(12);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write($h, $retrait .  "Produits/Activites: ");
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(130	,3, $data['activite_produit'],0,0);
$pdf->Ln(12);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write($h, $retrait .  "Concurent: ");
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(130	,3, $data['concurent'],0,0);

//informations sur le contact de l'entreprise 
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(12);
$h = 3;
$retrait = "                                     ";


$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(10);
$h = 3;
$retrait = "                          ";
$pdf->Write($h, $retrait .  "INFORMATIONS SUR LE COMMERCIAL EN CHARGE",0,1,'C');
$pdf->Ln(12);

$retrait = "           ";
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write($h, $retrait .  "Noms et Prenoms:");
$pdf->SetFont('helvetica', '', 12);
$pdf->Write($h, $data['NOMCOM'] ."\n" );
$pdf->Ln(7);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write($h, $retrait .  "Adresse mail: ");
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(130	,3, $data['ADRESSECOM'],0,0);
$pdf->Ln(10);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write($h, $retrait .  "Telephone: ");
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(130	,3, $data['TELCOM'],0,0);
$pdf->Ln(6);




$retrait = "                                                                                                                   ";
$pdf->Ln(20);
$pdf->Write($h, $retrait .  "Directeur General: ");

$retrait = "                                                                                                         ";
$pdf->Ln(5);
$pdf->Write($h, $retrait . 'Fait Douala Le :' . date('d/m/Y'));



//end of line



//Numbers are right-aligned so we give 'R' after new line parameter

//items
// $query=mysqli_query($con,"select * from item where invoiceID = '".$invoice['invoiceID']."'");
// $tax=0;
// $amount=0;
// while($item=mysqli_fetch_array($query)){
// 	$pdf->Cell(130	,5,$item['itemName'],1,0);
// 	$pdf->Cell(25	,5,number_format($item['tax']),1,0);
// 	$pdf->Cell(34	,5,number_format($item['amount']),1,1,'R');//end of line
// 	$tax+=$item['tax'];
// 	$amount+=$item['amount'];
// }

//summary
// $pdf->Cell(130	,5,'',0,0);
// $pdf->Cell(25	,5,'Subtotal',0,0);
// $pdf->Cell(4	,5,'$',1,0);
// $pdf->Cell(30	,5,number_format($amount),1,1,'R');//end of line

// $pdf->Cell(130	,5,'',0,0);
// $pdf->Cell(25	,5,'Taxable',0,0);
// $pdf->Cell(4	,5,'$',1,0);
// $pdf->Cell(30	,5,number_format($tax),1,1,'R');//end of line

// $pdf->Cell(130	,5,'',0,0);
// $pdf->Cell(25	,5,'Tax Rate',0,0);
// $pdf->Cell(4	,5,'$',1,0);
// $pdf->Cell(30	,5,'10%',1,1,'R');//end of line

// $pdf->Cell(130	,5,'',0,0);
// $pdf->Cell(25	,5,'Total Due',0,0);
// $pdf->Cell(4	,5,'$',1,0);
// $pdf->Cell(30	,5,number_format($amount + $tax),1,1,'R');//end of line





















$pdf->Output();
?>


