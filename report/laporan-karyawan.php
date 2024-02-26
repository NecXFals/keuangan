<?php
// memanggil library FPDF
require('../fpdf/fpdf.php');
include '../koneksi.php';
 
// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('P','mm','A4');
$pdf->AddPage();
 
$pdf->SetFont('Times','B',13);
$pdf->Cell(200,10,'Data Karyawan',0,0,'C');
 
$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(50,7,'Nama',1,0,'C');
$pdf->Cell(40,7,'Posisi' ,1,0,'C');
$pdf->Cell(55,7,'Alamat',1,0,'C');
$pdf->Cell(35,7,'Kontak',1,0,'C');
 
 
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','',10);
$no=1;
$data = mysqli_query($koneksi,"SELECT  * FROM karyawan");
while($d = mysqli_fetch_array($data)){
  $pdf->Cell(50,6, $d['nama'],1,0);
  $pdf->Cell(40,6, $d['posisi'],1,0);  
  $pdf->Cell(55,6, $d['alamat'],1,0);
  $pdf->Cell(35,6, $d['kontak'],1,1);
}
 
$pdf->Output();
 
?>