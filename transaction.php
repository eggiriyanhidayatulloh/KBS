<?php 
    include 'connection.php';
    include "phpqrcode/qrlib.php";
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
                    $tempdir = "temp/"; 
                    if (!file_exists($tempdir))
                        mkdir($tempdir);            
                    $q = "SELECT * FROM transaction  LEFT JOIN part_information ON transaction.id_part = part_information.id_part order by id desc";
                    $no = 0; 
                    // $qr = "SELECT * FROM transaction LEFT JOIN part_information ON transaction.id_part = part_information.id_part";
                    $admin = mysqli_query($connect,$q); 
                    while($m = mysqli_fetch_array($admin)){ 
                    $no++; 
                        $qr_number = $m['part_number'];
                        $qr_quantity = $m['quantity'];
                    ?>
                        
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $m['transaction_code']; ?></td>
                            <td><?php echo $m['transaction_date']; ?></td>
                            <td><?php echo $m['part_number']; ?></td>
                            <td><?php echo $m['part_name']; ?></td>
                            <td><?php echo $m['quantity']; ?></td>
                            <td>
                            <?php   
                                    // isi qr scan
                                    $nmbr = $qr_number;
                                    // nama file qr_qode
                                    $namefile1 = $qr_number.".png";
                                    QRcode::png("$nmbr",$tempdir.$namefile1,"M", 3,3);
                                ?>
                                <img src="temp/<?php echo $namefile1 ?>" alt="barcode" >
                            </td>
                            <td>
                            <?php   
                                    // isi qr scan
                                    $qty = $qr_quantity;
                                    // nama file qr_qode
                                    $namefile2 = $qr_quantity.".png";
                                    QRcode::png("$qty",$tempdir.$namefile2,"M", 3,3);
                                ?>
                                <img src="temp/<?php echo $namefile2 ?>" alt="barcode" >
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
