<?php
//include('dbconnected.php');
include('koneksi.php');

$tgl_kegiatan = $_GET['tgl_kegiatan'];
$kegiatan = $_GET['kegiatan'];
$total = $_GET['total'];

//query update
$query = mysqli_query($koneksi,"INSERT INTO `kegiatan` (`id_kegiatan`, `tgl_kegiatan`, `kegiatan`, `total`) VALUES (null, '$tgl_kegiatan', '$kegiatan', '$total')");

header("location:kegiatan.php")

//mysql_close($host);
?>