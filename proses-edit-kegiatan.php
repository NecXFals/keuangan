<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_kegiatan'];
$tgl = $_GET['tgl_kegiatan'];
$kegiatan = $_GET['kegiatan'];
$total = $_GET['total'];

//query update
$query = mysqli_query($koneksi,"UPDATE kegiatan SET tgl_kegiatan='$tgl' , kegiatan='$kegiatan', total='$total' WHERE id_kegiatan='$id' ");

if ($query) {
 # credirect ke page index
 header("location:kegiatan.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>