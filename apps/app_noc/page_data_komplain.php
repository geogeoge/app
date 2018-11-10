<section class="content-header">
  <h1>
    Menu Data Komplain Pelanggan
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="?page=page_data_pelanggan" class="btn btn-primary">&nbsp;Input Komplain</a>
    </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Table Data Komplain</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="100">Tanggal Komplen</th>
              <th width="250">Nama User</th>
              <th>Kerusakan</th>
              <th width="150" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($select->select_teknisi_maintenance_where_status_kunjungan_belum() as $data) {
              $pecah_alamat = explode("#", $data['alamat']);
              $alamat = $pecah_alamat['0']." RT. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'].", ".$pecah_alamat['6'];

              $id_marketing = $data['id_marketing'];
              $query_marketing = mysqli_query($koneksi,"select * from master_login where id_user='$id_marketing'");
              $data_marketing = mysqli_fetch_array($query_marketing);
              $nama_marketing = $data_marketing['nama_user'];

              $penerima_komplen = $data['penerima_komplen'];
              $query_penerima_komplen = mysqli_query($koneksi,"select * from master_login where id_user='$penerima_komplen'");
              $data_penerima_komplen = mysqli_fetch_array($query_penerima_komplen);
              $nama_penerima_komplen = $data_penerima_komplen['nama_user'];

            ?>
            <tr>
              <td width="100" align="center"><?php echo date('d-m-Y', strtotime($data['tanggal_komplen'])); ?></td>
              <td align="left"><a href="#modal_edit_komplain<?php echo $data['id_maintenance']; ?>" role="button"  data-target = "#modal_edit_komplain<?php echo $data['id_maintenance']; ?>" data-toggle="modal" style="color: black;"><?php echo $data['nama_user']; ?></a></td>
              <td align="left"><?php echo $data['kerusakan'];?></td>
              <td width="80" align="center">
                <a href="#modal_konfirmasi_komplain_selesai<?php echo $data['id_maintenance']; ?>" role="button"  data-target = "#modal_konfirmasi_komplain_selesai<?php echo $data['id_maintenance']; ?>" data-toggle="modal" class="btn btn-success">&nbsp;<i class="fa fa-check"></i></a>
                <a href="#modal_konfirmasi_ajukan_kunjungan<?php echo $data['id_maintenance']; ?>" role="button"  data-target = "#modal_konfirmasi_ajukan_kunjungan<?php echo $data['id_maintenance']; ?>" data-toggle="modal" class="btn btn-warning">&nbsp;<i class="fa fa-edit"></i></a>
                <a href="#modal_konfirmasi_hapus_komplain<?php echo $data['id_maintenance']; ?>" role="button"  data-target = "#modal_konfirmasi_hapus_komplain<?php echo $data['id_maintenance']; ?>" data-toggle="modal" class="btn btn-danger">&nbsp;<i class="fa fa-trash"></i></a>
              </td>
            </tr>
          <?php
          include "modal_konfirmasi_komplain_selesai.php";
          include "modal_konfirmasi_ajukan_kunjungan.php";
          include "modal_konfirmasi_hapus_komplain.php";
          include "modal_edit_komplain.php";
          
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th width="100">Tanggal Komplen</th>
              <th width="250">Nama User</th>
              <th>Kerusakan</th>
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