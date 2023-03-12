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
            <table border="0" cellspacing="0">
                    
                        <?php $admin = $connect->query("SELECT * FROM transaction LEFT JOIN part_information ON transaction.id_part = part_information.id_part WHERE id='$_GET[id]'"); ?>
                        <?php $m = $admin->fetch_assoc();?>
                 
                    <tr>
                        
                        <td rowspan="4" colspan="4" class="text-left" style="border : 1px solid; height : 2.6cm; width :5cm; font-size:7px; "  >
                        <div class="">
                            <?php
                            $kode = $m['part_name'] . $m['part_number'] . '';
                            require_once('assets/qrcode/qrlib.php');
                            QRcode::png("$kode", $kode . ".png", "M", 2, 2);
                            ?>
                            <div style="text-align:justify; font-family:Arial, Helvetica, sans-serif;"><img height="90px" width="85 px" src="kode<?php $no ?>.png" style="float:right" alt="">
                                <div style="padding-top :5.5px;  padding-left : 3px;">
                                <b><p>Part No :</p>
                                    <p><?php echo $m['part_number']; ?></p></b>
                                <b><p>Part Name : </p>
                                    <p><?php echo $m['part_name']; ?></p></b>
                                <b><p>Qty : <?php echo $m['quantity']; ?> Pcs</p></b>
                                </div>
                            </div>
                            </div>
                        </td>
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