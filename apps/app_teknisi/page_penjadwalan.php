<?php
$id_register=$_GET['id_register'];
foreach($select->select_page_penjadwalan($id_register) as $data) {
  $pecah_alamat=explode("#", $data['alamat']);

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
          <h3 class="box-title">Form Penjadwalan dan Order Alat</h3>
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
              <label for="inputPassword3" class="col-sm-2 control-label">Nama User</label>
              <div class="col-sm-4">
                <input type="text" name="nama_user" class="form-control" id="inputPassword3" value="<?php echo $data['nama_user'];?>" readonly>
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Instansi</label>
              <div class="col-sm-4">
                <input type="text" name="nama_instansi" class="form-control" id="inputPassword3" value="<?php echo $data['nama_instansi'];?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Alamat Lengkap</label>
              <div class="col-sm-6">
                <input type="text" name="alamat_1" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['0'];?>" readonly>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">RT</label>
              <div class="col-sm-1">
                <input type="text" name="alamat_2" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['1'];?>" readonly>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">RW</label>
              <div class="col-sm-1">
                <input type="text" name="alamat_3" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['2'];?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Desa/Kelurahan</label>
              <div class="col-sm-2">
                <input type="text" name="alamat_4" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['3'];?>" readonly>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Kecamatan</label>
              <div class="col-sm-2">
                <input type="text" name="alamat_5" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['4'];?>" readonly>
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Kabupaten/Kota</label>
              <div class="col-sm-3">
                <input type="text" name="alamat_6" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['5'];?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No Telp</label>
              <div class="col-sm-4">
                <input type="text" name="telp" class="form-control" id="inputPassword3" value="<?php echo $data['telp'];?>" readonly>
              </div>
            </div>

            <br>
            <hr>
            <br>
            
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Pemasangan</label>
              <div class="col-sm-2">
                <input type="date" name="tanggal_penjadwalan" class="form-control" id="inputPassword3" value="<?php echo $id_register;?>" required>
              </div>
            </div>

            <br>
            <hr>
            <br>

            <!-- Radio -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Radio</label>
              <div class="col-sm-5">
                <select class="form-control" name="id_radio">
                  <option selected="selected" value=""></option>
                  <?php
                  foreach($select->select_data_sale_radio() as $data) {
                    $selected = "";
                    if($data_radio==$data['id_radio']) {
                      $selected = 'selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id_radio']; ?>" <?php echo $selected;?>><?php echo $data['nama_radio']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Jumlah</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_radio" class="form-control" id="inputPassword3" value="<?php echo $jumlah_radio;?>">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_radio">
                <?php 
                if($status_radio=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                } else
                if($status_radio=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                } else
                if($status_radio=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                }
                ?>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
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
                  foreach($select->select_data_sale_antena() as $data) {
                    $selected = "";
                    if($data_antena==$data['id_antena']) {
                      $selected = 'selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id_antena']; ?>" <?php echo $selected;?>><?php echo $data['nama_antena']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Jumlah</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_antena" class="form-control" id="inputPassword3" value="<?php echo $jumlah_antena;?>">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_antena">
                <?php 
                if($status_antena=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                } else
                if($status_antena=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                } else
                if($status_antena=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                }
                ?>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
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
                  foreach($select->select_data_sale_wifi() as $data) {
                    $selected = "";
                    if($data_wifi==$data['id_wifi']) {
                      $selected = 'selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id_wifi']; ?>" <?php echo $selected;?>><?php echo $data['nama_wifi']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Jumlah</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_wifi" class="form-control" id="inputPassword3" value="<?php echo $jumlah_wifi;?>">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_wifi">
                <?php 
                if($status_wifi=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                } else
                if($status_wifi=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                } else
                if($status_wifi=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                }
                ?>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
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
                  foreach($select->select_data_sale_tower() as $data) {
                    $selected = "";
                    if($data_tower==$data['id_tower']) {
                      $selected = 'selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id_tower']; ?>" <?php echo $selected;?>><?php echo $data['nama_tower']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Jumlah</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_tower" class="form-control" id="inputPassword3" value="<?php echo $jumlah_tower;?>">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_tower">
                <?php 
                if($status_tower=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                } else
                if($status_tower=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                } else
                if($status_tower=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                }
                ?>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
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
                  foreach($select->select_data_sale_kabel() as $data) {
                    $selected = "";
                    if($data_kabel==$data['id_kabel']) {
                      $selected = 'selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id_kabel']; ?>" <?php echo $selected;?>><?php echo $data['nama_kabel']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Panjang</label>
              <div class="col-sm-1">
                <input type="text" name="panjang_kabel" class="form-control" id="inputPassword3" value="<?php echo $panjang_kabel;?>">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_kabel">
                <?php 
                if($status_kabel=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                } else
                if($status_kabel=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                } else
                if($status_kabel=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                }
                ?>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
                </select>
              </div>
            </div>

          <!-- /.box-body -->
          <div class="box-footer">
          <?php
          include "modal_konfirmasi_penjadwalan.php";
          ?>
            <a href="?page=page_permintaan_pemasangan" class="btn btn-default">Cancel</a>
            <a href="#konfirmasi_order" role="button"  data-target = "#konfirmasi_order" data-toggle="modal" class="btn btn-primary pull-right">Order</a>
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