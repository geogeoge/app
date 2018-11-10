<section class="content-header">
  <h1>
    Permintaan Maintenance
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="?page=page_input_komplen" class="btn btn-primary">&nbsp;Input Komplen</a>
    </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Permintaan Maintenance</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Tanggal Komplen</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Marketing</th>
              <th width="250">Kerusakan</th>
              <th width="50" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($select->select_data_permintaan_maintenance() as $data) {
              $pecah_alamat = explode("#", $data['alamat']);
              $alamat = $pecah_alamat['0']." RT. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'].", ".$pecah_alamat['6'];

              $alat = '<i class="fa fa-close"></i>';
              if($data['status']=='Alat Siap') {
                $alat = '<i class="fa fa-check"></i>';
              }
            ?>
            <tr>
              <td width="100" align="center"><?php echo date('d-m-Y', strtotime($data['tanggal_komplen'])); ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td align="center"><?php echo $data['nama_marketing']; ?></td>
              <td align="left"><?php echo $data['kerusakan'];?></td>
              <td width="50" align="center">
                <a href="#modal_buat_jadwal_maintenance<?php echo $data['id_maintenance']; ?>" role="button"  data-target = "#modal_buat_jadwal_maintenance<?php echo $data['id_maintenance']; ?>" data-toggle="modal" class="btn btn-primary">&nbsp;<i class="fa fa-edit"></i></a></td>
            </tr>
          <?php
          include "modal_buat_jadwal_maintenance.php";
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Tanggal Komplen</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Marketing</th>
              <th width="250">Kerusakan</th>
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