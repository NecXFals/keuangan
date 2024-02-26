<?php
//include('dbconnected.php');
include('koneksi.php');

$nama = $_GET['nama'];
$email = $_GET['email'];
$pass = $_GET['pass'];
$role = $_GET['role'];


//query update
$query = mysqli_query($koneksi,"INSERT INTO `users` (`nama`, `email`, `pass`, `role`) VALUES ('$nama', '$email', '$pass', 'admin')");

if ($query) {
 # credirect ke page index
 header("location:profile.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>