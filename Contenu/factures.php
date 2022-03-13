<?php
// Template de facture créé de toute pièce et inspiré par un template vue sur internet

require('factureGen/fpdf.php');
require('factureGen/facture.php');

$pdf = new FPDF('P','mm','A4'); // Module FPDF utilisé

$fac = new Facture(); // Modele Facture utilisé

$idCommande = $_GET['id']; // Récupération de l'id de la commande grâce à l'url

$row = $fac->getRow($idCommande); // Propriétés de la facture
$row_client = $fac->getRow_client($idCommande); // Informations du client
$prods = $fac->getProducts($idCommande); // Liste des produits

$pdf->AddPage(); // Création de la page

$pdf->SetFont('Arial','B',20);

// Cell(width , height , text , border , end-line , [align] )
// utf8_decode() pour les accents

$pdf->Cell(75,10,'',0,0);
$pdf->Cell(59 ,5,'Facture',0,0);
$pdf->Cell(59 ,10,'',0,1);

$pdf->SetFont('Arial','B',20);
$pdf->Cell(59 ,20,'',0,1);

$pdf->Image('Images/logo-societe.png', 10, 15, 80, 20);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(71 ,5,'WEB4SHOP',0,0);
$pdf->Cell(59 ,5,'',0,0);
$pdf->Cell(59 ,5,utf8_decode('Détails'),0,1);

$pdf->SetFont('Arial','',10);

$pdf->Cell(130 ,5,'75000, Paris',0,0);
$pdf->Cell(25 ,5,'Client :',0,0);
$pdf->Cell(34 ,5,ucfirst(utf8_decode($row_client['firstname'])).' '.strtoupper(utf8_decode($row_client['lastname'])),0,1);

$pdf->Cell(130 ,5,'contact@web4shop.fr | 04 63 92 44 78',0,0);
$pdf->Cell(25 ,5,'Date:',0,0);
$pdf->Cell(34 ,5,$row['date'],0,1);
 
$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,utf8_decode('Commande N°:'),0,0);
$pdf->Cell(34 ,5,$row['id'],0,1);


$pdf->SetFont('Arial','B',15);
$pdf->Cell(130 ,5,'Informations',0,1);



$pdf->SetFont('Arial','',10);
$pdf->Cell(130 ,5,utf8_decode('Type de réglement : '.$row['reglement']),0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(130 ,5,utf8_decode("Nous vous prions, dans le cas où l'option de paiement par chèque est sélectionnée, de nous faire parvenir le"),0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(130 ,5,utf8_decode("chèque d'ordre WEB4SHOP à l'adresse indiquée ci-dessus."),0,0);

$pdf->Cell(50 ,10,'',0,1);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(10 ,6,'Ind.',1,0,'C');
$pdf->Cell(80 ,6,"Nom de l'article",1,0,'C');
$pdf->Cell(23 ,6,utf8_decode('Quantité'),1,0,'C');
$pdf->Cell(50 ,6,'Prix unitaire',1,0,'C');
$pdf->Cell(25 ,6,'Total',1,1,'C');/*end of line*/

$pdf->SetFont('Arial','',10);
$i=1;
foreach ($prods as $prod) {
    $pdf->Cell(10 ,6,$i,1,0);
    $pdf->Cell(80 ,6,utf8_decode($prod['name']),1,0);
    $pdf->Cell(23 ,6,$prod['quantity'],1,0,'R');
    $pdf->Cell(50 ,6,$prod['price'],1,0,'R');
    $pdf->Cell(25 ,6,$prod['quantity']*$prod['price'],1,1,'R');
    $i++;
}
		

$pdf->Cell(118 ,6,'',0,0);
$pdf->Cell(25 ,6,'Total (TTC)',0,0);
$pdf->Cell(45 ,6,$row['price'],1,1,'R');

$pdf->Output();

?>