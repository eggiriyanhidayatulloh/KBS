<?php 
include 'connection.php'
?>
<?php 

$connect->query("DELETE FROM part_information WHERE id_part='$_GET[id]'");

echo "<script>alert('Data Berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=partinformation';</script>";
?>
