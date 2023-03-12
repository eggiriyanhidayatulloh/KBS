<?php 
include 'connection.php'
?>
<?php
$part = array();
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
    <div class="card-body">
        <a style="float: right" href="index.php?halaman=transaction" class="btn btn-warning btn-sm">
            <i data-feather='arrow-left-circle'></i> Cancel
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6>Detail Transaction</h6>
            </div>
            <div class="card-body">
                <table class="table">

                        <?php $admin = $connect->query("SELECT * FROM transaction LEFT JOIN part_information ON transaction.id_part = part_information.id_part WHERE id='$_GET[id]'"); ?>
                        <?php $detail = $admin->fetch_assoc();?>
                        <tr>
                            <td>Transaction Code</td>
                            <td><?php echo $detail['transaction_code']; ?></td>
                        </tr>
                        <tr>
                            <td>Transaction Date</td>
                            <td><?php echo $detail['transaction_date']; ?></td>
                        </tr>
                        <tr>
                            <td>Part Number</td>
                            <td><?php echo $detail['part_number']; ?></td>
                        </tr>
                        <tr >
                            <td>Part Name</td>
                            <td><?php echo $detail['part_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td><?php echo $detail['quantity']; ?></td>
                        </tr>
                        <tr>
                            <td>Part No Barcode</td>
                            <td>
                            <?php
                                    $kodenmbr= $detail['part_number'].'';
                                    $path = 'image/';
                                    $qrcode1 = $kodenmbr.".png";
                                    require_once('assets/qrcode/qrlib.php');
                                    QRcode::png("$kodenmbr",$path.$qrcode1,"M", 3,3);
                                ?>
                                <img src="image/<?php echo $kodenmbr ?>.png" alt="barcode" >
                            </td>
                        </tr>
                        <tr>
                            <td>Quantity Barcode</td>
                            <td>
                            <?php
                                    $kodeqty= $detail['quantity'].'';
                                    $path = 'image/';
                                    $qrcode2 = $kodeqty.".png";
                                    require_once('assets/qrcode/qrlib.php');
                                    QRcode::png("$kodeqty",$path.$qrcode2,"M", 3,3);
                                ?>
                                
                                <img src="image/<?php echo $kodeqty ?>.png" alt="barcode" >
                            </td> 
                        </tr>
                
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>