<?php 
    include 'connection.php'
?>

<?php
$datakategori = array();
$mysqli = new mysqli("localhost","root","","kasai_barcode");
$part = $mysqli     ->query("SELECT * FROM part_information");
while($tiap = $part->fetch_assoc())
{
	$datakategori[] = $tiap;
}
?>
<?php 
    $connect     = mysqli_connect("localhost","root","","kasai_barcode");
    $query      = "SELECT max(id) as maxKode FROM transaction";
    $hasil      = mysqli_query($connect, $query);
    $data       = mysqli_fetch_array($hasil);

    $maxcode    = $data['maxKode']; 
    $nourut     = (int) substr($maxcode, 1, 3);
    $date       = date("ymd");
    $nourut++;
    $char       = 'TC';
    $code    = $char. $date. sprintf("%04s", $nourut);
    $tgl = date("Y-m-d");
?>

<div class="card">
    <div class="card-header">           
        Add Transaction
    </div>
    <div class="card-body"> 
        <form method="post">
            <h5>Transaction</h5>
             <hr>
            <div class="form-group">
                <label for="transaction_code">Transaction Code</label>
                <input type="text" name="transaction_code" id="transaction_code" class="form-control" value="<?php echo $code ?>" readonly>
            </div> 
            <div class="form-group">
                <label for="transaction_date">Transaction Date</label>
                <input type="text" name="transaction_date" id="transaction_date" class="form-control" value="<?php echo $tgl ?>" readonly>
            </div> 
            <div class="form-group">
                <label for="id_part">Part Name</label>
                <select name="id_part" id="id_part" class="form-control" required>
                    <option disabled value>--------------- Select Part Name -----------------</option>
                    <?php foreach($datakategori as $key => $value): ?>
			
                    <option value="<?php echo $value["id_part"]?>">
                    <?php echo $value['part_name']?>
                    </option>
                    <?php endforeach ?> 
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required value="" >
            </div>

            <a href="index.php?halaman=transaction" class="btn btn-warning btn-sm" >Cancel</a>

            <button type="submit" class="btn btn-primary btn-sm" name="save" >Save Data</button>
            
            </form>
    </div>
</div>



<?php 

if (isset($_POST['save'])) 
{
	$connect->query("INSERT INTO transaction 
		(transaction_code,transaction_date,id_part,quantity)
		VALUES('$_POST[transaction_code]','$_POST[transaction_date]','$_POST[id_part]','$_POST[quantity]')");
    
    
    echo "<script>alert('Data telah tersimpan')</script>"; 
    echo "<script>location='index.php?halaman=transaction'</script>";
 
    } 



?>