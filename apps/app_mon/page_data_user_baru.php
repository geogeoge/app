<?php
include "../../koneksi/koneksi.php";

    $sql="SELECT * FROM sale_register WHERE status_mon='BARU' ORDER BY id_register ASC";
    $query=mysqli_query($koneksi,$sql);   
?>
<section class="content-header">
  <h1>
    Data User Baru
    <small>
      SoloNet
    </small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel User Baru Solonet</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th style="text-align: left;" hidden="hidden">ID Register</th>
              <th style="text-align: left;">Nama Pelangan</th>
              <th style="text-align: left;">Telepon</th>
              <th style="text-align: center;">Status</th>
              <th style="text-align: center;">Edit</th>
              <!-- <th style="text-align: center;">Detail</th> -->
            </tr>
            </thead>
            <tbody>
            <?php
             while($data=mysqli_fetch_array($query)){              
            ?>
            <a href="#">
            <tr>
              <td align="left" hidden="hidden"><?php echo $data['id_register']; ?></td>

              <td align="left"><a href="index.php?page=page_data_user_baru_detail&id_register=<?php echo $data['id_register']; ?>" style="color: black;"><?php echo $data['nama_user']; ?></a></td>

              <td align="left"><a href="index.php?page=page_data_user_baru_detail&id_register=<?php echo $data['id_register']; ?>" style="color: black;"><?php echo $data['telp']; ?></a></td>

              <th align="center"><i class="fa fa-close red"></i></th>
              <td width="50" align="center">
                <a href="index.php?page=page_data_user_baru_edit&id_register=<?php echo $data['id_register']; ?>" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Edit</a>
              </td>
              <!-- <td width="50" align="center">
                <a href="index.php?page=page_data_user_detail&id_pelanggan=<?php echo $data['id_pelanggan']; ?>" class="btn btn-warning"><i class="icon-trash icon-large"></i>&nbsp;Detail</a>
              </td> -->
            </tr>
          </a>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th style="text-align: left;" hidden="hidden">ID Register</th>
              <th style="text-align: left;">Nama Pelangan</th>
              <th style="text-align: left;">Telepon</th>
              <th style="text-align: center;">Status</th>
              <th style="text-align: center;">Edit</th>
              <!-- <th style="text-align: center;">Detail</th> -->
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>