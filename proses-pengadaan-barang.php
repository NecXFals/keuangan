<?php
session_start();
require("koneksi.php");

if(isset($_SESSION['role']) && $_SESSION['role'] == "worker") {
    $nama = $_GET['nama_barang'];
    $hrga = $_GET['harga_Satuan'];
    $qtyy = $_GET['kuantitas'];
    $myid = $_SESSION['id'];
    
    $q = mysqli_query($koneksi, "INSERT INTO requests SET requester='$myid', title='$nama', qty='$qtyy', price='$hrga', status='0', admin_response='0'");
    header("Location: pengadaan.php");
}

?>