<?php 
    include 'connection.php'
?>
<!-- <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/> -->
<div class="card">
    <div class="card-header">
        Transaction List
    </div>
    <div class="card-body">   
  
        <div style="float: right" >
            <a href="index.php?halaman=addtransaction" class="btn btn-primary btn-sm"> Add Data </a>
        </div>

        <div class="table-responsive mt-10">
            <table class="table table-striped" id="myTable">
                <thead> 
                    <tr>
                        <th>No</th>
                        <th>Transaction Code</th>
                        <th>Transaction Date</th>
                        <th>Part Number</th>
                        <th>Part Name</th>
                        <th>Quantity</th>  
                        <th>Part No Barcode </th>
                        <th>Quantity Barcode </th>     
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                             $q = "SELECT * FROM transaction  LEFT JOIN part_information ON transaction.id_part = part_information.id_part order by id desc";
                    ?>
                    <?php $no = 0; ?>
                    <?php 
                    // $qr = "SELECT * FROM transaction LEFT JOIN part_information ON transaction.id_part = part_information.id_part";
                    $admin = mysqli_query($connect,$q); 
                    while($m = mysqli_fetch_array($admin)){ 
                    ?>
                    <?php  ?>
                    <?php $no++; ?>
                        
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $m['transaction_code']; ?></td>
                            <td><?php echo $m['transaction_date']; ?></td>
                            <td><?php echo $m['part_number']; ?></td>
                            <td><?php echo $m['part_name']; ?></td>
                            <td><?php echo $m['quantity']; ?></td>
                            <td>
                            <?php
                                    $kodenmbr= $m['part_number'].'';
                                    $path = "/image";
                                    $qrcode1 = $kodenmbr.".png";
                                    require_once('assets/qrcode/qrlib.php');
                                    QRcode::png("$kodenmbr",$path.$qrcode1,"M", 3,3);
                                ?>
                                <img src="image/<?php echo $kodenmbr ?>.png" alt="barcode" >
                            </td>
                            <td>
                            <?php
                                    $kodeqty= $m['quantity'].'';
                                    $path = '/image';
                                    $qrcode2 = $kodeqty.".png";
                                    require_once('assets/qrcode/qrlib.php');
                                    QRcode::png("$kodeqty",$path.$qrcode2,"M", 3,3);
                                ?>
                                
                                <img src="image/<?php echo $kodeqty ?>.png" alt="barcode" >
                            </td>  
                            
                            <td>
                                <a style="margin-right : 8px" href="index.php?halaman=detailtransaction&id=<?php echo $m['id']; ?>" >
                                    <i data-feather='file-minus'></i>
                                </a>
                                <a style="margin-right : 8px" href="index.php?halaman=edittransaction&id=<?php echo $m['id']; ?>" >
                                    <i data-feather='edit'></i>
                                </a>
                                <a href="index.php?halaman=deletetransaction&id=<?php echo $m['id']; ?>">
                                    <i data-feather='trash-2'></i>
                                </a>
                                <a style="margin-top: 5px; width : 70px;" href="cetaktransaction2.php?id=<?php echo $m['id']; ?>" class="btn btn-danger btn-sm"> Print </a>
                                <!-- <a href="cetaktransaction.php?id=<?php echo $m['id']; ?>" target="_blank">
                                    <i data-feather='printer'></i>
                                </a> -->
                            </td>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
