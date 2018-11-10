<section class="content-header">
  <h1>
    User Trial
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs pull-right">
      <li class="active"><a href="?page=page_data_user_trial_semua">SEMUA DATA</a></li>
      <li><a href="?page=page_data_user_trial">HANYA TRIAL</a></li>
      <li class="pull-left header">Data User Trial</li>
    </ul>
    <div class="tab-content no-padding">
      <!-- Morris chart - Sales -->
      <div class="tab-pane active" style="position: relative; ">
        <div class="box-body scroll">
          <table id="" class="table table-bordered">
            <thead>
            <tr>
              <th width="100">Registrasi</th>
              <th>Nama</th>
              <th>Instansi</th>
              <th>Alamat</th>
              <th>No Telp</th>
              <th>Jadwal Pemasangan</th>
              <th>Batas Trial</th>
              <th>Teknisi</th>
              <th align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no="1";
            foreach($crud->select_data_user_pasca_trial($login_id_marketing) as $data) {
            $pecah_alamat=explode("#", $data['alamat']);
            $alamat=$pecah_alamat['0']." RT ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];
            if(empty($pecah_alamat['1'])) {
              $alamat=$data['alamat'];
            }

            $color="";
            if($data['tanggal_trial']<=date('Y-m-d') and $data['status']=="Trial") {
              $color="bgcolor='#FFFF66'";
            }

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
            <tr <?php echo $color;?>>
              <td align="center"><?php echo date('d-m-Y',strtotime($data['tanggal_register'])); ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $data['nama_instansi']; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td width="100" align="center"><?php echo date('d-m-Y', strtotime($data['tanggal_penjadwalan']));?></td>
              <td width="100" align="center"><?php echo date('d-m-Y', strtotime($data['tanggal_trial']));?></td>
              <td align="center"><?php echo $teknisi; ?></td>
              <td width="200" align="center">Tagihan Awal</td>
              <?php
              $no++;
              ?>
            </tr>
          <?php
          }
          ?>
          <?php
            $no="1";
            foreach($crud->select_data_user_trial_semua($login_id_marketing) as $data) {
            $pecah_alamat=explode("#", $data['alamat']);
            $alamat=$pecah_alamat['0']." RT ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];
            if(empty($pecah_alamat['1'])) {
              $alamat=$data['alamat'];
            }

            $color="";
            if($data['tanggal_trial']<=date('Y-m-d') and $data['status']=="Trial") {
              $color="bgcolor='#FFD700'";
            }

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
            <tr <?php echo $color;?>>
              <td align="center"><?php echo date('d-m-Y',strtotime($data['tanggal_register'])); ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $data['nama_instansi']; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td width="100" align="center"><?php if($data['tanggal_penjadwalan']=="0000-00-00") { echo "-";} else { echo date('d-m-Y', strtotime($data['tanggal_penjadwalan'])); }?></td>
              <td width="100" align="center"><?php if($data['status']=="Trial") { echo date('d-m-Y', strtotime($data['tanggal_trial'])); } else { echo "-"; }?></td>
              <td align="center"><?php echo $teknisi; ?></td>
              <td width="200" align="center">
                <?php
                if($data['status']=="Trial") {
                ?>
                <a href="?page=page_registrasi_edit&id_register=<?php echo $data['id_register']; ?>" class="btn btn-info"><i class="icon-trash icon-large"></i>&nbsp;<i class="fa fa-file"></i></a>
                <a href="#modal_trial_perpanjang<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_trial_perpanjang<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-warning">&nbsp;<i class="fa fa-hourglass-2"></i></a>
                <a href="#modal_trial_closing<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_trial_closing<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-success">&nbsp;<i class="fa fa-check"></i></a>
                <a href="#modal_trial_cancel<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_trial_cancel<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-danger">&nbsp;<i class="fa fa-close"></i></a>
                <?php
                } else {
                  echo "PEMASANGAN";
                }
                ?>
              </td>
              <?php
              $no++;
              include "modal_trial_perpanjang.php";
              include "modal_trial_closing.php";
              include "modal_trial_cancel.php";
              ?>
            </tr>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th width="100">Registrasi</th>
              <th>Nama</th>
              <th>Instansi</th>
              <th>Alamat</th>
              <th>No Telp</th>
              <th>Jadwal Pemasangan</th>
              <th>Batas Trial</th>
              <th>Teknisi</th>
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
