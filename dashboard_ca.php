<?php
require_once('include/connexion.php');
require('fpdf17/fpdf.php');
$con=mysqli_connect('localhost','c1642016c_syscrm_2','o_smD+L{wHOG');
mysqli_select_db($con,'c1642016c_syscrm_2');

if (isset($_GET['IDCONT']))
    $IDCONT = $_GET['IDCONT'];
else
    $IDCONT = 0;

$query=mysqli_query($con,"select * from prospect, contactprospect
	
	where
	prospect.idpros  = contactprospect.IDPROS and
	nompros = '".$_GET['nompros']."'");
$prospect=mysqli_fetch_array($query);

// $query=mysqli_query($con,"select * from contactprospect
	
// 	where
// 	IDCONT = '".$_GET['IDCONT']."'");
// $contactprospect=mysqli_fetch_array($query);

                                             
                                          
$data_contactprospect = $bdd->prepare('SELECT * FROM contactprospect');
$data_contactprospect->execute();
$data = $data_contactprospect->fetch();

$nom_contact = strtoupper($data['NOMCONT'] . " " . $data['PRENOMCONT']);
$poste_contact = strtoupper($data['POSTECONT']);
$emaill = strtoupper($data['ADRESSECONT'] );
$tel = strtoupper($data['TELCONT']);

$data_commerciaux = $bdd->prepare('SELECT * FROM commercial');
$data_commerciaux->execute();
$data = $data_commerciaux->fetch();


$comercial = strtoupper($data['NOMCOM'] . " " . $data['PRENOMCOM']);
$email = strtoupper($data['ADRESSECOM']);
$tell = strtoupper($data['TELCOM']);
										  //A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

		


$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();
$pdf->SetFont('Times','',12);


// $pdf->Image('./images/'.$prospect['photo'], 20, 10,30, '','png', '', 'T', false, 300, '', false, false, false, 0, false, false, false, false) ;
// $pdf->Image('logo.png', 160, 18,30, '','png', '', 'T', false, 300, '', false, false, false, 0, false, false, false, false) ;

// SET FONT
$pdf->SetFont('helvetica', 'B', 16);

// TITLE
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


//set font to arial, bold, 14pt
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Ln(8);
$h = 3;
$retrait = "                                                 ";
$pdf->Cell(0, 10, 'CHIFFRE D AFFAIRE', 'TB', 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 12);
// $h = 2;
// $retrait = "                                                 ";
$pdf->Cell(0, 10, 'Tableau du Chiffre d affaire', '', 1, 'C');
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Ln(2);
$pdf->SetFillColor(224, 235,255);
$pdf->Cell(25, 10, 'Contrat ', 1, 0, 'C', 1);
$pdf->Cell(35, 10, 'Client ', 1, 0, 'C', 1);
$pdf->Cell(35, 10, 'Montant Global ', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'M 1er annee ', 1, 0, 'C', 1);
$pdf->Cell(35, 10, 'M 2e,3e, 4e annee ', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Mode de paymennt ', 1, 0, 'C', 1);
$pdf->SetFont('helvetica', '',6);
$pdf->SetFillColor(255, 255,255);
//LIGNE1
$pdf->Ln(10);
$pdf->Cell(25, 5, '1 ', 1, 0, 'C', 1);
$pdf->Cell(35, 5, $prospect['nompros'], 1, 0, 'C', 1);
$pdf->Cell(35, 5, $prospect['capital'] . '  FCFA', 1, 0, 'C', 1);
$pdf->Cell(30, 5, '10.000.000 FCFA ', 1, 0, 'C', 1);
$pdf->Cell(35, 5, '5.000.000 FCFA ', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'CASH ', 1, 0, 'C', 1);
//LIGNE 2
$pdf->Ln(5);
$pdf->Cell(25, 5, '2 ', 1, 0, 'C', 1);
$pdf->Cell(35, 5, 'UBA CAMEROON', 1, 0, 'C', 1);
$pdf->Cell(35, 5, $prospect['capital'] . '  FCFA', 1, 0, 'C', 1);
$pdf->Cell(30, 5, '10.000.000 FCFA ', 1, 0, 'C', 1);
$pdf->Cell(35, 5, '5.000.000 FCFA ', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'CARTE BANCAIRE ', 1, 0, 'C', 1);

//LIGNE 2
$pdf->Ln(5);
$pdf->Cell(25, 5, '3 ', 1, 0, 'C', 1);
$pdf->Cell(35, 5, 'NESTLE CAMEROON', 1, 0, 'C', 1);
$pdf->Cell(35, 5, $prospect['capital'] . '  FCFA', 1, 0, 'C', 1);
$pdf->Cell(30, 5, '15.000.000 FCFA ', 1, 0, 'C', 1);
$pdf->Cell(35, 5, '5.000.000 FCFA ', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'PAYPAL ', 1, 0, 'C', 1);





















// $pdf->Ln(10);
// $retrait = "           ";
// $pdf->Write($h, $retrait .  "Poste: ");
// $pdf->SetFont('helvetica', '', 10);
// $pdf->Cell(130	,3, $poste_contact,0,0);
// $retrait = "                                                                                                                                                  ";
// $pdf->SetFont('helvetica', 'B', 10);
// $pdf->Write($h, $retrait .  "Adresse mail: ");
// $pdf->SetFont('helvetica', '', 10);
// $pdf->Cell(130	,3, $data['ADRESSECOM'],0,0);
// $pdf->Ln(10);
// $retrait = "           ";
// $pdf->SetFont('helvetica', 'B', 10);
// $pdf->Write($h, $retrait .  "Adresse: ");
// $pdf->SetFont('helvetica', '', 10);
// $pdf->Cell(130	,3, $prospect['ADRESSECONT'],0,0);
// $retrait = "                                                                                                                                             ";
// $pdf->SetFont('helvetica', 'B', 10);
// $pdf->Write($h, $retrait .  "Telephone: ");
// $pdf->SetFont('helvetica', '', 10);
// $pdf->Cell(130	,3, $tell,0,0);
// $pdf->Ln(10);
// $retrait = "           ";
$pdf->SetFont('helvetica', 'B', 10);


$pdf->Ln(120);
$h = 5;
$retrait = "                                                                                                                                            ";
$pdf->Write($h, $retrait ."Global Asset Cameroon");
$retrait = "                                                                                                                                                             ";
$pdf->Write($h, $retrait .  "Directeur General ");
// $pdf->Ln(1);
// $h = 5;
// $retrait = "                  ";
// $pdf->Write($h, $retrait . $prospect['nompros']);
// $pdf->Ln(5);
// $h = 3;
// $retrait = "                          ";
// $pdf->Write($h, $retrait .  "Directeur ");
// $h = 3;
$retrait = "                                                                                                                                            ";
$pdf->Ln(20);
$pdf->Write($h, $retrait . 'Fait Douala Le :' . date('d/m/Y'));



//make a dummy empty cell as a vertical spacer


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


