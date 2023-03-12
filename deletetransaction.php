<?php 
include 'connection.php'
?>
<?php 
$connect = new mysqli("localhost","root","","kasai_barcode");
$connect->query("DELETE FROM transaction WHERE id='$_GET[id]'");
echo "<script>alert('Data Berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=transaction';</script>";
?>
