<?php

session_start();

include('koneksi.php');

$id =  $_GET['id'];
$title =  $_GET['title'];
$price =  $_GET['price'];
$qty =  $_GET['qty'];

//query update
$query = mysqli_query($koneksi,"UPDATE requests SET id='$id' , title='$title', price='$price', qty='$qty' WHERE id='$id'");

header("location:pengadaan.php")

//mysql_close($host);
?>