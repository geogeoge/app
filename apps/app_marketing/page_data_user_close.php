<section class="content-header">
  <h1>
    User Close
    <small>
      SoloNet
    </small>
    <div class="tombol_tambah">
      <a href="export_data_user_close.php" class="btn btn-primary"><i class="fa fa-download"></i>&nbsp;&nbsp;<span>Excel</span></a>
    </div>
  </h1>
</section>
<?php include "modal_tambah_data_user_prospek.php"; ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel User Close</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>No Telp</th>
              <th>Harga Paket</th>
              <th>Tunggakan</th>
              <th>Clossing</th>
              <th width="80" align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no="1";
            foreach($crud->select_data_user_close($login_id_marketing) as $data) {
            $tunggakan=$data['billing_bulan_berjalan']-$data['billing_bulan_terbayar'];
            $pecah_alamat=explode("#", $data['alamat']);
            $alamat=$pecah_alamat['0']." RT ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];

            $nama_user = $data['nama_user'];
            $nama_instansi = $data['nama_instansi'];

            $nama = $nama_user;
            if(!($nama_instansi=="")){
                $nama = $nama_instansi." <b>(".$nama_user.")</b>";
                
            }

            $tanggal_close = date("d-m-Y", strtotime($data['tanggal_close']));
            if($data['tanggal_close']==0000-00-00){
              $tanggal_close = "?";
            }
            ?>
            <a href="#"><tr>
              <td width="10" align="center"><?php echo $no; ?></td>
              <td align="left"><?php echo $nama; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td align="center"><?php echo $data['harga']; ?></td>
              <td align="center"><?php echo $tunggakan; ?></td>
              <td align="center"><a href="#modal_edit_tanggal_clossing<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_edit_tanggal_clossing<?php echo $data['id_register']; ?>" data-toggle="modal" style="color: black;"><?php echo $tanggal_close; ?></a></td>
              <td width="50" align="center">
                <a href="?page=page_user_close_edit&id_register=<?php echo $data['id_register']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="#modal_input_komplen<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_input_komplen<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-warning"><i class="fa fa-warning"></i></a>
              </td>
              <?php
              $no++;
              ?>
            </tr></a>
          <?php
          include "modal_edit_tanggal_clossing.php";
          include "modal_input_komplen.php";
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>No Telp</th>
              <th>Harga Paket</th>
              <th>Tunggakan</th>
              <th>Clossing</th>
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