<section class="content-header">
  <h1>
    Data Permintaan Pemasangan
    <small>SoloNet</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Permintaan Pemasangan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Registrasi</th>
              <th>ID User</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Marketing</th>
              <th width="50" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($select->salect_permintaan_pemasangan() as $data) {
              $pecah_alamat = explode("#", $data['alamat']);
              $alamat = $pecah_alamat['0']." RT. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'].", ".$pecah_alamat['6'];
            ?>
            <tr>
              <td align="center"><?php echo date('d-m-Y', strtotime($data['tanggal_register'])); ?></td>
              <td width="10" align="center"><?php echo $data['id_register']; ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td align="center"><?php echo $data['nama_marketing']; ?></td>
              <td width="50" align="center">
                <a href="?page=page_penjadwalan&id_register=<?php echo $data['id_register']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
              </td>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Registrasi</th>
              <th>ID User</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Marketing</th>
              <th width="50" align="center">Action</th>
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