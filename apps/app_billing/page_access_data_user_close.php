<section class="content-header">
  <h1 class="">
    Proses Holding User
    <small>SoloNet</small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel User Close</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID User</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Telp</th>
              <th>Paket</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_data_user_close() as $data) {
            $id_register=$data['id_register'];
            $nama_paket=$data['nama_paket'];
            if($data['nama_paket']=="-") {
              $nama_paket="Paket Lama";
            }
            ?>
            <tr>
              <td align="center"><?php echo $id_register; ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $data['alamat']; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td align="center"><?php echo $nama_paket." <b>".number_format($data['harga'],0,',','.')."</b>"; ?></td>
              <td width="200" align="center">
                <a href="#modal_rubah_paket<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_rubah_paket<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-warning">&nbsp;Edit Paket</a>
                <a href="#modal_hold<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_hold<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-danger">&nbsp;Hold</a>
              </td>
            </tr>
          <?php
          $no++;
          include "modal_access_rubah_paket.php";
          include "modal_access_konfirmasi_hold.php";
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>User</th>
              <th>Tunggakan</th>
              <th>Nominal</th>
              <th>Sisa Pembayaran</th>
              <th>Action</th>
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

