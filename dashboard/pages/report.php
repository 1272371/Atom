<?php
include('../../api/config/Database.php');
$database = new Database('localhost','risk','root','');
$link = mysqli_connect("localhost","root","", "risk");

$query = ("SELECT DISTINCT user_name, user_surname, user_id,faculty_id FROM user");
$result = mysqli_query($link, $query);


require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Helvetica','I',30);


// Insert a logo in the top-left corner at 300 dpi
$pdf->Image('../wits-logo1.jpg',70,10,-1200);

// Title
$pdf->SetXY(53,60);
$pdf->Write(5,'Risk Assessor Report');

$pdf->SetXY(10,70);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(45,12,'Name',1);
$pdf->Cell(45,12,'Surname',1);
$pdf->Cell(45,12,'Student No.',1);
$pdf->Cell(45,12,'Prediction',1);

$pdf->SetXY(10,74);

$countSafe=0;
$countRisk=0;

foreach($result as $row) {
	$countCol=0;
	$pdf->Ln();
	foreach($row as $column){

		$query2 = "SELECT ROUND(AVG(mark_total)) as avg FROM mark WHERE user_id=".$row['user_id'];
		$result2 = mysqli_query($link, $query2);
		$row2=mysqli_fetch_array($result2); 
		$avg = $row2['avg'];

		if($countCol<3){
			$pdf->Cell(45,12,$column,1);
		} else {
			if ($avg < 50){
				$pdf->Cell(45,12,'At Risk',1);
				$countRisk++;
			} else {
				$pdf->Cell(45,12,'Safe',1);
				$countSafe++;
			}
		}
		$countCol++;
	}
}

$pdf->Ln();
$pdf->Cell(45,12,'Total Safe',1);
$pdf->Cell(45,12,'',1);
$pdf->Cell(45,12,'',1);
$pdf->Cell(45,12,$countSafe,1);

$pdf->Ln();
$pdf->Cell(45,12,'Total At Risk',1);
$pdf->Cell(45,12,'',1);
$pdf->Cell(45,12,'',1);
$pdf->Cell(45,12,$countRisk,1);


$pdf->Output();
?>
