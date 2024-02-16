<?php 
date_default_timezone_set("Asia/Jakarta");
include 'function.php';
$id = $_GET['id_barang'];
mysqli_query($conn, "DELETE FROM dtl_transaksi WHERE id_barang=$id");
 
header("location:dtltransaksi.php?pesan=hapus");
?>