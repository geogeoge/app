<section class="content-header">
  <h1>
    Data Jadwal Maintenance
    <small>SoloNet</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Jadwal Maintenance</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Jadwal</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Marketing</th>
              <th>Teknisi</th>
              <th width="150">Kerusakan</th>
              <th width="150">Solusi</th>
              <th align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($select->select_jadwal_maintenance() as $data) {
              $pecah_alamat = explode("#", $data['alamat']);
              $alamat = $pecah_alamat['0']." RT. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'].", ".$pecah_alamat['6'];

              $alat = '<i class="fa fa-close"></i>';
              if($data['status']=='Alat Siap') {
                $alat = '<i class="fa fa-check"></i>';
              }

              $id_maintenance=$data['id_maintenance'];
              $query_maintenance = mysqli_query($koneksi,"select * from teknisi_maintenance where id_maintenance='$id_maintenance'");
              $tampil_maintenance = mysqli_fetch_array($query_maintenance);


              $id_teknisi=$tampil_maintenance['id_teknisi'];
              $query_teknisi = mysqli_query($koneksi,"select * from master_login where id_user='$id_teknisi'");
              $data_teknisi = mysqli_fetch_array($query_teknisi);
              $nama_teknisi = $data_teknisi['nama_user'];
              $pecah_nama_teknisi = explode(" ", $nama_teknisi);

              $partner=$tampil_maintenance['partner'];
              $query_partner=mysqli_query($koneksi,"select * from master_login where id_user='$partner'");
              $jumlah_query_partner=mysqli_num_rows($query_partner);
              if($jumlah_query_partner>=1){
                $tampil_partner=mysqli_fetch_array($query_partner);
                $data_partner=$tampil_partner['nama_user'];
              } else {
                $data_partner=$data['partner'];
              }
              $pecah_data_partner = explode(" ", $data_partner);

              $teknisi = $pecah_nama_teknisi['0']." & ".$pecah_data_partner['0'];
              if(empty($data_partner)){
                $teknisi = $pecah_nama_teknisi['0'];
              }
            ?>
            <tr>
              <td width="100" align="center"><?php echo date('d-m-Y', strtotime($data['tanggal_penjadwalan_maintenance'])); ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td align="center"><?php echo $data['nama_marketing']; ?></td>
              <td width='100' align="center"><?php echo $teknisi; ?></td>
              <td align="left"><?php echo $data['kerusakan'];?></td>
              <td align="left"><?php echo $data['solusi'];?></td>
              <td width="150" align="center">
                <a href="#modal_edit_data_maintenance<?php echo $data['id_maintenance']; ?>" role="button"  data-target = "#modal_edit_data_maintenance<?php echo $data['id_maintenance']; ?>" data-toggle="modal" class="btn btn-warning">&nbsp;<i class="fa fa-hourglass-2"></i></a>
                <!-- <a href="#modal_konfirmasi_maintenance_selesai<?php //echo $data['id_maintenance']; ?>" role="button"  data-target = "#modal_konfirmasi_maintenance_selesai<?php //echo $data['id_maintenance']; ?>" data-toggle="modal" class="btn btn-success">&nbsp;<i class="fa fa-check"></i></a> -->
                <a href="#modal_konfirmasi_maintenance_batal<?php echo $data['id_maintenance']; ?>" role="button"  data-target = "#modal_konfirmasi_maintenance_batal<?php echo $data['id_maintenance']; ?>" data-toggle="modal" class="btn btn-danger">&nbsp;<i class="fa fa-close"></i></a>
              </td>
            </tr>
          <?php
          include "modal_konfirmasi_maintenance_batal.php";
          include "modal_edit_data_maintenance.php";
          include "modal_konfirmasi_maintenance_selesai.php";
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Jadwal</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Marketing</th>
              <th>Teknisi</th>
              <th>Kerusakan</th>
              <th>Solusi</th>
              <th align="center">Action</th>
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

<!-- Main content -->
<section class="content">
  <div class="row">

  <div class="col-md-3">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h4 class="box-title">Data Teknisi</h4>
        </div>
        <div class="box-body">
          <!-- the events -->
          <div id="external-events">
          <?php
          foreach($select->select_data_teknisi_untuk_kalender() as $data) {
          ?>
          <div class="external-event ui-draggable ui-draggable-handle" style="background-color: <?php echo $data['ekstra'];?>; border-color: rgb(0, 31, 63); color: rgb(255, 255, 255); position: relative;"><?php echo $data['nama_user'];?></div>
          <?php
          }
          ?>
          </div>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>

    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <!-- THE CALENDAR -->
          <div id="calendar"></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->