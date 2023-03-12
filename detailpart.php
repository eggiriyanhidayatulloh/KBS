<?php 
include 'connection.php'
?>

<div class="card">
    <div class="card-body">
        <a  style="float: right" href="index.php?halaman=partinformation" class="btn btn-warning btn-sm" >
            <i data-feather='arrow-left-circle'></i>   Cancel
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h6>Part Information</h6> 
            </div>
            <div class="card-body">
                <table class="table">
                    <?php 
                        $admin=$connect->query("SELECT * FROM part_information WHERE id_part='$_GET[id]'");
                        while($m= mysqli_fetch_array($admin)){                 
                    ?>
                    <tbody>
                      <tr>
                        <td>Part Number</td>
                        <td><?php echo $m['part_number'] ?></td>
                      </tr>
                      <tr>
                        <td>Part Name</td>
                        <td><?php echo $m['part_name'] ?></td>
                      </tr>
                    </tbody>
                    <?php } ?>
                  </table>
            </div>
        </div>
    </div>
</div>    
