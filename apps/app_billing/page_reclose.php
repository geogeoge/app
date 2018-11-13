<?php
$id_register=$_GET['id_register'];
foreach($select->select_data_reclose($id_register) as $data) {
  $pecah_alamat=explode("#", $data['alamat']);

  $id_paket = $data['id_paket'];
  $ip_publik = $data['ip_publik'];

  $data_radio = $data['id_radio'];
  $jumlah_radio = $data['jumlah_radio'];
  $status_radio = $data['status_radio'];

  $data_antena = $data['id_antena'];
  $jumlah_antena = $data['jumlah_antena'];
  $status_antena = $data['status_antena'];

  $data_wifi = $data['id_wifi'];
  $jumlah_wifi = $data['jumlah_wifi'];
  $status_wifi = $data['status_wifi'];

  $data_tower = $data['id_tower'];
  $jumlah_tower = $data['jumlah_tower'];
  $status_tower = $data['status_tower'];

  $data_kabel = $data['id_kabel'];
  $panjang_kabel = $data['panjang_kabel'];
  $status_kabel = $data['status_kabel'];
?>
<section class="content-header">
  <h1>
  Penjadwalan dan Order Alat
    <small>SoloNet</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">      
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Form ReClose</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No Registrasi</label>
              <div class="col-sm-10">
                <input type="text" name="id_register" class="form-control" id="inputPassword3" value="<?php echo $id_register;?>" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" name="nik" class="form-control" id="inputPassword3" value="<?php echo $data['nik'];?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama User</label>
              <div class="col-sm-4">
                <input type="text" name="nama_user" class="form-control" id="inputPassword3" value="<?php echo $data['nama_user'];?>" >
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Instansi</label>
              <div class="col-sm-4">
                <input type="text" name="nama_instansi" class="form-control" id="inputPassword3" value="<?php echo $data['nama_instansi'];?>" >
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Alamat Lengkap</label>
              <div class="col-sm-6">
                <input type="text" name="alamat_1" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['0'];?>" >
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">RT</label>
              <div class="col-sm-1">
                <input type="text" name="alamat_2" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['1'];?>" >
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">RW</label>
              <div class="col-sm-1">
                <input type="text" name="alamat_3" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['2'];?>" >
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Desa/Kelurahan</label>
              <div class="col-sm-2">
                <input type="text" name="alamat_4" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['3'];?>" />
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Kecamatan</label>
              <div class="col-sm-2">
                <input type="text" name="alamat_5" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['4'];?>" />
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Kabupaten/Kota</label>
              <div class="col-sm-3">
                <input type="text" name="alamat_6" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['5'];?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No Telp</label>
              <div class="col-sm-4">
                <input type="text" name="telp" class="form-control" id="inputPassword3" value="<?php echo $data['telp'];?>" />
              </div>
            </div>

            <br>
            <hr>
            <br>

            <!-- Radio -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Paket</label>
              <div class="col-sm-4">
                <select required="required" class="form-control" name="id_paket">
                  <option selected="selected" disabled></option>
                  <?php
                  foreach($crud->select_data_sale_paket() as $data) {
                      $selected="";
                    if($id_paket==$data['id_paket']) {
                      $selected="selected='selected'";
                    }
                    ?>
                    <option value="<?php echo $data['id_paket']; ?>" <?php echo $selected; ?>><?php echo "Nama Paket: ".$data['nama_paket']." || Harga : ".number_format($data['harga'],0,',','.'); ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">IP Publik</label>
              <div class="col-sm-2">
                <select required="required" class="form-control" name="ip_publik">
                <?php
                if($ip_publik=="TIDAK") {
                  $select_tidak = "selected='selected'";
                  $select_iya = "";
                } else {
                  $select_tidak = "";
                  $select_iya = "selected='selected'";
                }
                ?>
                  <option <?php echo $select_tidak;?>>TIDAK</option>
                  <option <?php echo $select_iya;?>>IYA</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Biaya Registrasi</label>
              <div class="col-sm-1">
                <input type="text" name="biaya_registrasi" class="form-control" id="inputPassword3" value="0">
              </div>
            </div>

            <!-- Radio -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Radio</label>
              <div class="col-sm-5">
                <select class="form-control" name="id_radio">
                  <option selected="selected" value=""></option>
                  <?php
                  foreach($crud->select_data_sale_radio() as $data) {
                    ?>
                    <option value="<?php echo $data['id_radio']; ?>"><?php echo $data['nama_radio']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Jumlah</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_radio" class="form-control" id="inputPassword3" required="required">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_radio">
                  <option selected="selected" disabled="disabled"></option>
                  <option>TIDAK PAKAI</option>
                  <option>BELI</option>
                  <option>DIPINJAMI</option>
                </select>
              </div>
            </div>

            <!-- Antena -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Antena</label>
              <div class="col-sm-5">
                <select class="form-control" name="id_antena">
                  <option selected="selected" value=""></option>
                  <?php
                  foreach($crud->select_data_sale_antena() as $data) {
                    ?>
                    <option value="<?php echo $data['id_antena']; ?>"><?php echo $data['nama_antena']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Jumlah</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_antena" class="form-control" id="inputPassword3" required="required">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select required="required" class="form-control" name="status_antena">
                  <option selected="selected" disabled="disabled"></option>
                  <option>TIDAK PAKAI</option>
                  <option>BELI</option>
                  <option>DIPINJAMI</option>
                </select>
              </div>
            </div>

            <!-- Wifi -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Wifi</label>
              <div class="col-sm-5">
                <select class="form-control" name="id_wifi">
                  <option selected="selected" value=""></option>
                  <?php
                  foreach($crud->select_data_sale_wifi() as $data) {
                    ?>
                    <option value="<?php echo $data['id_wifi']; ?>"><?php echo $data['nama_wifi']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Jumlah</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_wifi" class="form-control" id="inputPassword3" required="required">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select required="required" class="form-control" name="status_wifi">
                  <option selected="selected" disabled="disabled"></option>
                  <option>TIDAK PAKAI</option>
                  <option>BELI</option>
                  <option>DIPINJAMI</option>
                </select>
              </div>
            </div>

            <!-- Tower -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tower</label>
              <div class="col-sm-5">
                <select class="form-control" name="id_tower">
                  <option selected="selected" value=""></option>
                  <?php
                  foreach($crud->select_data_sale_tower() as $data) {
                    ?>
                    <option value="<?php echo $data['id_tower']; ?>"><?php echo $data['nama_tower']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Jumlah</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_tower" class="form-control" id="inputPassword3" required="required">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select required="required" class="form-control" name="status_tower">
                  <option selected="selected" disabled="disabled"></option>
                  <option>TIDAK PAKAI</option>
                  <option>BELI</option>
                  <option>DIPINJAMI</option>
                </select>
              </div>
            </div>

            <!-- Kabel -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Kabel</label>
              <div class="col-sm-5">
                <select class="form-control" name="id_kabel">
                  <option selected="selected" value=""></option>
                  <?php
                  foreach($crud->select_data_sale_kabel() as $data) {
                    ?>
                    <option value="<?php echo $data['id_kabel']; ?>"><?php echo $data['nama_kabel']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Panjang</label>
              <div class="col-sm-1">
                <input type="text" name="panjang_kabel" class="form-control" id="inputPassword3" value="0">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select required="required" class="form-control" name="status_kabel">
                  <option selected="selected" disabled="disabled"></option>
                  <option>TIDAK PAKAI</option>
                  <option>BELI</option>
                  <option>DIPINJAMI</option>
                </select>
              </div>
            </div>

          <!-- /.box-body -->
          <div class="box-footer">
          <?php
          include "modal_konfirmasi_reclose.php";
          ?>
            <a href="?page=page_data_user_hold" class="btn btn-default">Cancel</a>
            <a href="#konfirmasi_reclose" role="button"  data-target = "#konfirmasi_reclose" data-toggle="modal" class="btn btn-primary pull-right">Kirim</a>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<?php
}
?>