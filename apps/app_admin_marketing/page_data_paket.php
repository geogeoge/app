<section class="content-header">
  <h1>
    Data Paket Internet
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="#tambah_paket" role="button"  data-target = "#tambah_paket" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah Paket</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_paket.php"; ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Paket Internet</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Paket</th>
              <th>Nama Paket</th>
              <th>Harga</th>
              <th>Status</th>
              <th width="80" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no="1";
            foreach($paket_internet->select_data_paket_internet() as $data) {
            $id_paket=$data['id_paket'];
            $nama_paket=$data['nama_paket'];
            $harga=$data['harga'];
            
            $pecah_id_paket=explode(" ", $id_paket);
            $id_paket=implode("_", $pecah_id_paket);
            
            $pecah_id_paket=explode("/", $id_paket);
            $id_paket=implode("", $pecah_id_paket);

            $tampil_status_paket = '<i class="fa fa-check"></i>';
            $update_status_paket = "TUTUP";

            $status_paket = $data['status_paket'];
            if($status_paket=="TUTUP") {
              $tampil_status_paket = '<i class="fa fa-close"></i>';
              $update_status_paket = "BUKA";
            }
            include "modal_hapus_paket.php";
            include "modal_edit_paket.php";
            ?>
            <tr>
              <td width="100" align="center"><?php echo $data['id_paket']; ?></td>
              <td align="center"><?php echo $nama_paket; ?></td>
              <td align="center"><?php echo $harga; ?></td>
              <td align="center"><a href="?page=page_data_paket&update_status_paket=<?php echo $update_status_paket; ?>&id_paket=<?php echo $id_paket; ?>" class="btn btn-default">&nbsp;<?php echo $tampil_status_paket; ?></a></td>
              <td width="150" align="center">
                <a href="#edit_data_paket<?php echo $id_paket; ?>" role="button"  data-target = "#edit_data_paket<?php echo $id_paket;?>"data-toggle="modal" class="btn btn-info"><i class="icon-trash icon-large"></i>&nbsp;Edit</a>
              </td>
              <?php
              
              $no++;
              ?>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Username</th>
              <th width="80" align="center">Action</th>
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