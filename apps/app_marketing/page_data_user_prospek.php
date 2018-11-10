<section class="content-header">
  <h1>
    User Prospek
    <div class="tombol_tambah">
      <a href="#tambah_user" role="button"  data-target = "#tambah_user_prospek" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah User</a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_user_prospek.php"; ?>


<section class="content">
  <div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs pull-right">
      <li><a href="?page=page_data_user_prospek_old">OLD PROSPEK</a></li>
      <li class="active"><a href="?page=page_data_user_prospek">PROSPEK</a></li>
      <li class="pull-left header">Data User Prospek</li>
    </ul>
    <div class="tab-content no-padding">
      <!-- Morris chart - Sales -->
      <div class="tab-pane active" style="position: relative; ">
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Instansi</th>
              <th width="80">No Telp</th>
              <th>Catatan</th>
              <th width="80" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no="1";
            foreach($select->select_data_user_prospek($login_id_marketing) as $data) {
            $pecah_alamat=explode("#", $data['alamat']);
            $alamat=$pecah_alamat['0']." RT: ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];
            if(empty($pecah_alamat['1'])) {
              $alamat=$data['alamat'];
            }
            ?>
            <tr>
              <td width="10" align="center"><?php echo $no; ?></td>
              <td align="left"><a href="#modal_detail_user_prospek<?php echo $data['id_prospek'];?>" role="button"  data-target = "#modal_detail_user_prospek<?php echo $data['id_prospek'];?>" data-toggle="modal"><font style="color: black;"><?php echo $data['nama_user']; ?></font></a></td>
              <td align="left"><?php echo $data['nama_instansi']; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td align="left"><?php echo $data['catatan']; ?></td>
              <td width="80" align="center">
                <a href="?page=page_registrasi&id_prospek=<?php echo $data['id_prospek']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="#modal_hapus_user_prospek<?php echo $data['id_prospek'];?>" role="button"  data-target = "#modal_hapus_user_prospek<?php echo $data['id_prospek'];?>" data-toggle="modal" class="btn btn-danger"><i class="fa fa-close"></i></a>
              </td>
              <?php
              $no++;
              ?>
            </tr>
          <?php
          include "modal_detail_user_prospek.php";
          include "modal_hapus_user_prospek.php";
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Instansi</th>
              <th>No Telp</th>
              <th>Catatan</th>
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
