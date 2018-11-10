<section class="content-header">
  <h1>
    User Hold
    <small>
      SoloNet
    </small>
  </h1>
</section>
<?php include "modal_tambah_data_user_prospek.php"; ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel User Hold</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Instansi</th>
              <th>Alamat</th>
              <th>No Telp</th>
              <th>Catatan</th>
              <th width="80" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no="1";
            foreach($crud->select_data_user_hold($login_id_marketing) as $data) {
            $tunggakan=$data['bulan_berjalan']-$data['bulan_terbayar'];
            $pecah_alamat=explode("#", $data['alamat']);
            $alamat=$pecah_alamat['0']." RT ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];
            if(empty($pecah_alamat['1'])) {
              $alamat=$data['alamat'];
            }
            ?>
            <tr>
              <td width="10" align="center"><?php echo $no; ?></td>
              <td align="center"><?php echo $data['nik']; ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $data['nama_instansi']; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td align="left"><?php echo $data['catatan']; ?></td>
              <td width="80" align="center">
                <a href="?page=page_reclose&id_register=<?php echo $data['id_register']; ?>" class="btn btn-info"><i class="icon-trash icon-large"></i>&nbsp;Re-Close</a>
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
              <th>NIK</th>
              <th>Nama</th>
              <th>Instansi</th>
              <th>Alamat</th>
              <th>No Telp</th>
              <th>Koordinat</th>
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