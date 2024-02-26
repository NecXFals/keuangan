<?php
//include('dbconnected.php');
include('koneksi.php');

$nama = $_GET['nama'];
$posisi = $_GET['posisi'];
$alamat = $_GET['alamat'];
$umur = $_GET['umur'];
$kontak = $_GET['kontak'];
$email = $_GET['email'];
$password = $_GET['pass'];

//query update
$query = mysqli_query($koneksi,"INSERT INTO `karyawan` (`id_karyawan`, `nama`, `posisi`, `alamat`, `umur`, `kontak`) VALUES (null, '$nama', '$posisi', '$alamat', '$umur', '$kontak')");

if ($query) {
 # redirect ke page index
 mysqli_query($koneksi, "INSERT INTO users SET nama='$nama', email='$email', pass='$password', role='worker'");
 header("");
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>