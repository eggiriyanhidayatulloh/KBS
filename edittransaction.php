<?php 
include 'connection.php'
?>
<?php 
$connect = new mysqli("localhost","root","","kasai_barcode");
$ambil=$connect->query("SELECT * FROM transaction WHERE id='$_GET[id]'");
$nilai=$ambil->fetch_assoc();

?>

<?php
$part = array();
$connect = new mysqli("localhost","root","","kasai_barcode");
$ambil = $connect->query("SELECT * FROM part_information");
while($tiap = $ambil->fetch_assoc())
{
	$datakategori[] = $tiap;    
}

//echo"<pre>";
//print_r($datakategori);
//echo"</pre>";
?>
<div class="card">
    <div class="card-header">
        Edit Transaction
    </div>
    <div class="card-body">
        <form method="post">
 
            <h5>Transaction</h5>
            <hr>
            <div class="form-group">
                <label for="transaction_code">Transaction Code</label>
                <input type="text" name="transaction_code" id="transaction_date" class="form-control" readonly value="<?php echo $nilai['transaction_code']; ?>">
            </div> 
            <div class="form-group">
                <label for="transaction_date">Transaction Date</label>
                <input type="date" name="transaction_date" id="transaction_date" class="form-control" readonly value="<?php echo $nilai['transaction_date']; ?>">
            </div> 
            <div class="form-group">
                <label for="id_part">Part Name</label>
                <select name="id_part" id="id_part" class="form-control" required>
                    <option disabled value>--------------- Select Part Name -----------------</option>
                    <?php foreach($datakategori as $key => $value): ?>
			
                    <option value="<?php echo $value["id_part"]?>" <?php if($nilai["id_part"]==$value["id_part"]){echo "selected";} ?> >
                    <?php echo $value["part_name"]?>
                    </option>
                    <?php endforeach ?>

                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required value="<?php echo $nilai['quantity']; ?>" >
            </div>

            <a href="index.php?halaman=transaction" class="btn btn-warning btn-sm" >Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" name="update">Edit Data</button>
        </form>
    </div>
</div>

<?php  
if (isset($_POST['update'])) 
{
	$connect->query("UPDATE transaction SET transaction_code='$_POST[transaction_code]',
			transaction_date='$_POST[transaction_date]',id_part='$_POST[id_part]',quantity='$_POST[quantity]' WHERE id='$_GET[id]'");

	echo "<script>alert('Data telah tersimpan')</script>";
	echo "<script>location='index.php?halaman=transaction';</script>";
}
?>