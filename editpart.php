<?php 
include 'connection.php'
?>
<?php 
$connect = new mysqli("localhost","root","","kasai_barcode");
$ambil=$connect->query("SELECT * FROM part_information WHERE id_part='$_GET[id]'");
$value=$ambil->fetch_assoc();

?>
<div class="card">
    <div class="card-header">
        Edit Part Information
    </div>
    <div class="card-body">
        <form  method="post" enctype="multipart/form-data">
 
            <h5>Part Information</h5>
            <hr>
            <div class="form-group">
                <label for="part_number">Part Number</label>
                <input type="text" name="part_number" id="part_number" class="form-control" required value="<?php echo $value['part_number']; ?>" >
            </div>
            <div class="form-group">
                <label for="part_name">Part Name</label>
                <input type="text" name="part_name" id="part_name" class="form-control" required value="<?php echo $value['part_name']; ?>" >
            </div>
           
            <a href="index.php?halaman=partinformation" class="btn btn-warning btn-sm" >Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" name="update" >Edit Data</button>
        </form>
    </div>
</div>

<?php  
if (isset($_POST['update'])) 
{
	$connect->query("UPDATE part_information SET part_name='$_POST[part_name]',
			part_number='$_POST[part_number]' WHERE id_part='$_GET[id]'");

	echo "<script>alert('Data telah tersimpan')</script>";
	echo "<script>location='index.php?halaman=partinformation';</script>";
}
?>
