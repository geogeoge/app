<form method="POST">
<section class="content-header">
  <h1 class="">
    Tambah Daftar Download Invoice
    <small>Per-User</small>
    <div class="tombol_tambah">
      <button name="tambah_daftar_download" class="btn btn-primary"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Tambah Ke Daftar</button>
    </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data User</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="10">No</th>
              <th>User</th>
              <th>Alamat</th>
              <th>Marketing</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_register_tambah_daftar_menu_download_invoice() as $data) {
              $pecah_alamat=explode("#",$data['alamat']);
              $alamat = $pecah_alamat['0']." Rt. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];

            ?>
            <tr>
              <td align="center" width="10"><input type="checkbox" class="minimal" name="checked_id[]" value="<?php echo $data['id_register']; ?>"></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['nama_marketing']; ?></td>
            </tr>
          <?php
          include "modal_access_konfirmasi_hapus_menu_cetak_invoice.php";
          $no++;
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th width="10">No</th>
              <th>User</th>
              <th>Alamat</th>
              <th>Marketing</th>
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
</form>
