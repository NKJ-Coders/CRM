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

if(isset($_GET['id']) &&!empty($_GET['id'])){                                     
	$idcontrat = (int) $_GET['id'];   

	$data_contrat = $bdd->prepare('SELECT * FROM contrat, prospect WHERE contrat.id=? and  contrat.idpros = prospect.idpros');
	$data_contrat->execute(array($idcontrat));
	$data = $data_contrat->fetch();
      
}
// var_dump($data['nompros']);
// 	  exit;
$proposition = ($data['proposition']);
$validite = ($data['validite']);
$ecart =($data['ecart'] );

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


// $pdf->Image('./images/'.$prospect['photo'], 20, 10,30, '','png', '', 'T', false, 300, '', false, false, false, 0, false, false, false, false) ;
// $pdf->Image('logo.png', 160, 18,30, '','png', '', 'T', false, 300, '', false, false, false, 0, false, false, false, false) ;
$pdf->Image('logo.png', 30, 10,40,20, '','png', '', 'T', false, 300, '', false, false, false, 0, false, false, false, false) ;

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

// SET FONT
$pdf->Ln(12);
$pdf->SetFont('helvetica', 'B', 16);

// TITLE

$pdf->cell(189,5, $data['nompros'],0,1,'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Ln(2);
$h = 3;
$retrait = "                                                                  ";

// $pdf->Write($h, $retrait .  "site web:",0,1,'C');
// $pdf->Cell(45,3,'globalassetcameroon.com',0,1, 'C');


//set font to arial, bold, 14pt
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Ln(2);
$h = 3;
$retrait = "                                                 ";
$pdf->Cell(0, 10, 'CONTRATUALISATION', 'TB', 1, 'C');
$pdf->Cell(0, 10, '', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 12);

// $h = 3;
// $retrait = "                                                 ";
// $pdf->Cell(0, 10, 'Tableau de l offre financiere', '', 1, 'C');
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Ln(6);
$pdf->SetFillColor(224, 235,255);
$pdf->Cell(70, 10, 'Propositions ', 1, 0, 'C', 1);
$pdf->Cell(60, 10, 'Vaidite  ', 1, 0, 'C', 1);
$pdf->Cell(60, 10, 'Ecart ', 1, 0, 'C', 1);
$pdf->SetFont('helvetica', '', 10);
$pdf->Ln(10);
$pdf->Cell(70, 60,  $proposition, 1, 0, 100, 4);
$pdf->Cell(60, 60, $validite, 1, 0, 'C', 1);
$pdf->Cell(60, 60, $ecart, 1, 0, 'C', 1);





// Décalage de 20 mm à droite

$pdf->SetFont('helvetica', 'B', 10);


$pdf->Ln(140);
$h = 5;
$retrait = "                                                                                                                                               ";
$pdf->Write($h, $retrait ."Global Asset Cameroon");
$retrait = "                                                                                                                                                              ";
$pdf->Write($h, $retrait .  "Directeur General ");
$pdf->Ln(1);
$h = 5;
$retrait = "                  ";
$pdf->Write($h, $retrait . $data['nompros']);
$pdf->Ln(5);
$h = 3;
$retrait = "                          ";
$pdf->Write($h, $retrait .  "Directeur ");
$h = 3;
$retrait = "                                                                                                                                                 ";
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


