<?php 
include 'connection.php'
?>
<style>
    .barcode {
        border: 1px solid black;
        width: 400px;
        padding-top: 5;
        padding-bottom: 5;
        padding-left: 5;
        padding-right: 5;
    }
</style>

<html>
    <body>
        <div class="" id="print-content">
            <table border="1" cellspacing="0" width="380px">
                    
                        <?php $admin = $connect->query("SELECT * FROM transaction LEFT JOIN part_information ON transaction.id_part = part_information.id_part WHERE id='$_GET[id]'"); ?>
                        <?php $m = $admin->fetch_assoc();?>
                 
                    <tr>
                        <th colspan="4"> &nbsp;</th>
                    </tr>
                    <tr>
                        <th width="110px" align="left">&nbsp; CUSTOMER</th>
                        <td colspan="3">&nbsp; PT. KASAI TECK SEE INDONESIA</td>
                    </tr>
                    <tr>
                        <th align="left">&nbsp; MODEL</th>
                        <td colspan="3">&nbsp; </td>
                    </tr>
                    <tr>
                        <th align="left">&nbsp; PART NAME</th>
                        <td colspan="3">&nbsp; <?php echo $m['part_name']; ?></td>
                    </tr>
                    <tr>
                        <th align="left">&nbsp; PART NO</th>
                        <td colspan="3">&nbsp; <?php echo $m['part_number']; ?></td>
                    </tr>
                    <tr>
                        <th align="left">&nbsp; QUANTITY</th>
                        <td colspan="3">&nbsp; <?php echo $m['quantity']; ?> PCS</td>
                    </tr>
                    <tr>
                        <th align="left">&nbsp; PACK DATE</th>
                        <td colspan="3">&nbsp; <?php echo $m['transaction_date']; ?></td>
                    </tr>
                    <tr>
                        <th align="left">&nbsp; PACKED BY</th>
                        <td colspan="3">&nbsp; PT. MULTI USAGE INDONESIA</td>
                    </tr>
                    <tr>
                        <th align="left">&nbsp; LOT NO.</th>
                        <td colspan="3">&nbsp; </td>
                    </tr>
                    <tr>
                        <th rowspan="3" colspan="2" width="250px">
                            PART NO :  <?php
                                    $kodenmbr= $m['part_number'].'';
                                    $path = 'image/';
                                    $qrcode1 = $kodenmbr.".png";
                                    require_once('assets/qrcode/qrlib.php');
                                    QRcode::png("$kodenmbr",$path.$qrcode1,"M", 3,3);
                                ?>
                            <img height="90px" width="85 px" src="image/<?php echo $kodenmbr ?>.png" style="float:right" alt="">
                        </th>
                        <th rowspan="3" colspan="2" width="250px">
                            QTY :  <?php
                                    $kodeqty= $m['quantity'].'';
                                    $path = 'image/';
                                    $qrcode2 = $kodeqty.".png";
                                    require_once('assets/qrcode/qrlib.php');
                                    QRcode::png("$kodeqty",$path.$qrcode2,"M", 3,3);
                                ?>
                            <img height="90px" width="85 px" src="image/<?php echo $kodeqty ?>.png" style="float:right" alt="">
                        </th>
                    </tr>

            </table>
        </div>  
            <div align="left">
                <input style="margin-top: 10;" type="button" class="btn btn-primary" onclick="printDiv('print-content')" value="PRINT">
                <a href="index.php?halaman=transaction"><button style="margin-top: 10;" type="button"  class="btn btn-primary" >BACK</button></a>
            </div>
    </body>
</html>

<script type="text/javascript">

    function printDiv(divname){
        var printContents = document.getElementById(divname).innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.print();
        w.close();
    }

</script>