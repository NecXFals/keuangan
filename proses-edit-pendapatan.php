<?php

session_start();

include('koneksi.php');

$id =  $_GET['id_pemasukan'];
$tgl =  $_GET['tgl_pemasukan'];
$jumlah =  $_GET['jumlah'];
$sumber =  $_GET['sumber'];

//query update
$query = mysqli_query($koneksi,"UPDATE pemasukan SET tgl_pemasukan='$tgl' , jumlah='$jumlah', sumber='$sumber' WHERE id_pemasukan='$id' ");

if ($query) {
    # credirect ke page index
    header("location:pendapatan.php"); 
   }
   else{
    echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
   }

//mysql_close($host);
?>