<section class="content-header">
  <h1>
    D A S H B O A R D
    <small>Teknisi SoloNET</small>
  </h1>
</section>
<section class="content">

  <div class="row">
    <?php
    $jumlah_tugas = $dashboard->jumlah_tugas_pemasangan_hari_ini($login_id_teknisi) + $dashboard->jumlah_tugas_maintenance_hari_ini($login_id_teknisi);
    if($jumlah_tugas>'0') {
    ?>
    <div class="col-md-12">
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Ada <?php echo $jumlah_tugas;?> tugas hari ini !!!</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php
          foreach($dashboard->select_tugas_pemasangan_hari_ini($login_id_teknisi) as $data) {  
            $pecah_alamat = explode("#", $data['alamat']);
            $alamat = $pecah_alamat['0']." RT. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'].", ".$pecah_alamat['6'];

            $id_teknisi=$data['id_teknisi'];
            $query_teknisi = mysqli_query($koneksi,"select * from master_login where id_user='$id_teknisi'");
            $data_teknisi = mysqli_fetch_array($query_teknisi);
            $nama_teknisi = $data_teknisi['nama_user'];
            $pecah_nama_teknisi = explode(" ", $nama_teknisi);

            $partner=$data['partner'];
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
          <br>
          <a href="?page=page_jadwal_pemasangan" style="color: black;">
          ~> User : <?php echo "<b>".$data['nama_user']."</b>"; ?><br>
          &nbsp; &nbsp; &nbsp; Alamat : <b><?php echo $alamat;?></b><br>
          &nbsp; &nbsp; &nbsp; No. Telp : <b><?php echo $data['telp'];?></b><br>
          &nbsp; &nbsp; &nbsp; Marketing : <b><?php echo $data['nama_marketing'];?></b><br>
          &nbsp; &nbsp; &nbsp; Tugas : <b>PEMASANGAN (<?php echo $data['nama_paket'];?>)</b><br>
          &nbsp; &nbsp; &nbsp; Teknisi : <b><?php echo $teknisi;?></b><br></a><br>
          <?php
          }

          foreach($dashboard->select_tugas_maintenance_hari_ini($login_id_teknisi) as $data) {  
            
            $id_register = $data['id_register'];
            $query_register = mysqli_query($koneksi,"Select * from sale_register where id_register='$id_register'");
            $data_register = mysqli_fetch_array($query_register);

            $pecah_alamat = explode("#", $data_register['alamat']);
            $alamat = $pecah_alamat['0']." RT. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'].", ".$pecah_alamat['6'];

            $id_marketing = $data_register['id_marketing'];
            $query_marketing = mysqli_query($koneksi,"Select * from sale_marketing where id_marketing='$id_marketing'");
            $data_marketing = mysqli_fetch_array($query_marketing);

            $id_teknisi=$data['id_teknisi'];
            $query_teknisi = mysqli_query($koneksi,"select * from master_login where id_user='$id_teknisi'");
            $data_teknisi = mysqli_fetch_array($query_teknisi);
            $nama_teknisi = $data_teknisi['nama_user'];
            $pecah_nama_teknisi = explode(" ", $nama_teknisi);

            $partner=$data['partner'];
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
          <br>
          <a href="?page=page_jadwal_maintenance&data=pribadi" style="color: black;">
          ~> User : <?php echo "<b>".$data_register['nama_user']."</b>"; ?><br>
          &nbsp; &nbsp; &nbsp; Alamat : <b><?php echo $alamat;?></b><br>
          &nbsp; &nbsp; &nbsp; No. Telp : <b><?php echo $data_register['telp'];?></b><br>
          &nbsp; &nbsp; &nbsp; Marketing : <b><?php echo $data_marketing['nama_marketing'];?></b><br>
          &nbsp; &nbsp; &nbsp; Tugas : <b><?php echo $data['solusi'];?></b><br>
          &nbsp; &nbsp; &nbsp; Teknisi : <b><?php echo $teknisi;?></b><br></a><br>
          <?php
          }           
          ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <?php
    }
    ?>
  </div>
</section>