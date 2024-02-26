<?php
// memanggil library FPDF
require('../fpdf/fpdf.php');
include '../koneksi.php';
 
// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('P','mm','A4');
$pdf->AddPage();
 
$pdf->SetFont('Times','B',13);
$pdf->Cell(200,10,'Laporan Pendapatan',0,0,'C');
 
$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(50,7,'Tanggal',1,0,'C');
$pdf->Cell(75,7,'Jumlah' ,1,0,'C');
$pdf->Cell(55,7,'Sumber',1,0,'C');
 
 
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','',10);
$no=1;
$data = mysqli_query($koneksi,"SELECT  * FROM pemasukan");
while($d = mysqli_fetch_array($data)){
  $pdf->Cell(50,6, $d['tgl_pemasukan'],1,0);
  $pdf->Cell(75,6, number_format($d['jumlah'], 2, ',', '.'),1,0);  
  $pdf->Cell(55,6, $d['sumber'],1,1);
}
 
$pdf->Output();
 
?>