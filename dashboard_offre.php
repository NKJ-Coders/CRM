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

$data_contrat = $bdd->prepare('SELECT * FROM offre, prospect, commercial WHERE offre.idoffre=? and  offre.idpros = prospect.idpros and commercial.IDCOM = offre.idcom');
$data_contrat->execute(array($_GET['id']));
$data = $data_contrat->fetch();

											  
                                          
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
// 										  //A4 width : 219mm
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
$pdf->Cell(0, 10, 'CONTRATUALISATION', 'TB', 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 12);
// $h = 2;
// $retrait = "                                                 ";
$pdf->Cell(0, 10, 'Tableau de l\'offre Financiere', '', 1, 'C');
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Ln(2);
$pdf->SetFillColor(210, 230,255);
$pdf->Cell(50, 10, 'Clients ', 1, 0, 'C', 1);
$pdf->Cell(32, 10, 'Capital ', 1, 0, 'C', 1);
$pdf->Cell(32, 10, 'Montant An 1 ' , 1, 0, 'C', 1);
$pdf->Cell(32, 10, 'Montant An 2,3,4 ', 1, 0, 'C', 1);
$pdf->Cell(32, 10, 'Date de depot ', 1, 0, 'C', 1);

$pdf->SetFont('helvetica', '',8);
$pdf->SetFillColor(255, 255,255);
//LIGNE1
$pdf->Ln(10);
$pdf->Cell(50, 10, $data['nompros'], 1, 0, 'C', 1);
$pdf->Cell(32, 10, number_format($data['capital'] , 0, ".", " ") . '  FCFA', 1, 0, 'C', 1);
$pdf->Cell(32, 10, number_format($data['montant1an'] , 0, ".", " "). '  FCFA', 1, 0, 'C', 1);
$pdf->Cell(32, 10, number_format($data['montant2an'], 0, ".", " "). '  FCFA', 1, 0, 'C', 1);
$pdf->Cell(32, 10, $data['DATEOFFRE'], 1, 0, 'C', 1);


//LIGNE 2



// $pdf->SetFont('helvetica', 'B', 10);
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


$pdf->Ln(60);
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


