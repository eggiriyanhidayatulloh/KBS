<?php 
include 'connection.php'
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<div class="card">
    <div class="card-header">
       Part Information
    </div>
    <div class="card-body">
    
        <div class="alert alert-primary" role="alert">
         
        </div>
    
        <div style="float: right" >
            <a href="index.php?halaman=addpart" class="btn btn-primary btn-sm"> Add Data </a>
        </div>
        <div style="float: left">
            <form class="d-flex" role="search" method="POST" >
                    <input class="form-control me-2" type="text" placeholder="Search" name="cari" aria-label="Search">
                    <button style="height: 38px; width: 120px" name="bcari" class="btn btn-outline-primary ml-1 mb-2" type="submit">Search</button>
            </form>
        </div>

        <div class=" mt-5">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Part Number</th>
                        <th>Part Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        if (isset($_POST['bcari'])){
                            // tampilkan data yang dicari
                            $keyword = $_POST["cari"];
                            $q = "SELECT * FROM part_information WHERE part_number like '%$keyword%' or part_name like '%$keyword%' order by id_part desc ";
                        }else {
                            $q = "SELECT * FROM part_information order by id_part desc";
                        }

                        $admin = mysqli_query($connect, $q);
                        while ($m = mysqli_fetch_array($admin)){

                        
                    ?>
                        <tr>
                            <td><?php echo $m['part_number']; ?></td>
                            <td><?php echo $m['part_name']; ?></td>
                            <td>
                                <a href="index.php?halaman=detailpart&id=<?php echo $m['id_part']; ?>" >
                                    <i data-feather='file-minus'></i>
                                </a>
                                <a href="index.php?halaman=editpart&id=<?php echo $m['id_part']; ?>" >
                                    <i data-feather='edit'></i>
                                </a>
                                <a href="index.php?halaman=deletepart&id=<?php echo $m['id_part']; ?>" >
                                    <i data-feather='trash-2'></i>
                                </a>
                            </td>
                        </tr>
                   <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
