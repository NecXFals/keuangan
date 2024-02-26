<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_kegiatan'];

//query update
$query = mysqli_query($koneksi,"DELETE FROM `kegiatan` WHERE id_kegiatan = '$id'");

if ($query) {
 # credirect ke page index
 header("location:kegiatan.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>