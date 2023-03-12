<?php 
include 'connection.php'
?>

<div class="card">
    <div class="card-header">
        Add Part
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
       
            <h5>Part Information</h5>
            <hr>
            <div class="form-group">
                <label for="part_number">Part Number</label>
                <input type="text" name="part_number" id="part_number" class="form-control" required>
            </div>  
            
            <div class="form-group">
                <label for="part_name">Part Name</label>
                <input type="text" name="part_name" id="part_name" class="form-control" required>
            </div>

            <a href="index.php?halaman=partinformation" class="btn btn-warning btn-sm" >Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" name="save" >Add Data</button>
        </form>
    </div>          
</div>

<?php  
if (isset($_POST['save'])) 
{
	$connect->query("INSERT INTO part_information 
		(part_number,part_name)
		VALUES('$_POST[part_number]','$_POST[part_name]')");

	echo "<script>alert('Data telah tersimpan')</script>";
	echo "<script>location='index.php?halaman=partinformation';</script>";
}
?>