<section class="content-header">
  <h1>
    Data Pemasangan
    <small>SoloNet</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Pemasangan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Tanggal</th>
              <th>ID Register</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>IP</th>
              <th>BTS</th>
              <th>Teknisi</th>
              <th>Marketing</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($select->select_data_pemasangan($login_id_teknisi) as $data) {
              $id_register=$data['id_register'];
              $pecah_alamat = explode("#", $data['alamat']);
              $alamat = $pecah_alamat['0']." RT. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'].", ".$pecah_alamat['6'];

              $alat = '<i class="fa fa-close"></i>';
              if($data['status']=='Alat Siap') {
                $alat = '<i class="fa fa-check"></i>';
              }

              $id_teknisi=$data['id_teknisi'];
              $query_teknisi=mysqli_query($koneksi,"select * from master_login where id_user='$id_teknisi'");
              $tampil_teknisi=mysqli_fetch_array($query_teknisi);
              $data_teknisi=$tampil_teknisi['nama_user'];

              $partner=$data['partner'];
              $query_partner=mysqli_query($koneksi,"select * from master_login where id_user='$partner'");
              $jumlah_query_partner=mysqli_num_rows($query_partner);
              if($jumlah_query_partner>=1){
                $tampil_partner=mysqli_fetch_array($query_partner);
                $data_partner=$tampil_partner['nama_user'];
              } else {
                $data_partner=$data['partner'];
              }

              $teknisi = $data_teknisi." & ".$data_partner;
              if(empty($partner)){
                $teknisi = $data_teknisi;
              }

              $nama_gedung=$data['nama_gedung'];
            ?>
            <tr>
              <td width="80" align="center"><?php echo date('d-m-Y', strtotime($data['tanggal_penjadwalan'])); ?></td>
              <td width="10" align="center"><?php echo $data['id_register']; ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td align="center"><a href="#edit_data_pemasangan<?php echo $id_register; ?>" role="button"  data-target = "#edit_data_pemasangan<?php echo $id_register; ?>" data-toggle="modal" style="color:black;"><?php echo $data['ip']; ?></a></td>
              <td align="center"><a href="#edit_data_pemasangan<?php echo $id_register; ?>" role="button"  data-target = "#edit_data_pemasangan<?php echo $id_register; ?>" data-toggle="modal" style="color:black;"><?php echo $data['nama_gedung']; ?></a></td>
              <td width="100" align="center"><?php echo $teknisi; ?></td>
              <td align="center"><?php echo $data['nama_marketing']; ?></td>
              <td align="center"><?php echo $data['status']; ?></td>
            </tr>
          <?php
          include "modal_edit_pemasangan.php";
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Tanggal</th>
              <th>ID Register</th>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>IP</th>
              <th>BTS</th>
              <th>Teknisi</th>
              <th>Marketing</th>
              <th>Status</th>
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