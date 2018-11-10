<?php
$id_register=$_GET['id_register'];
$query_register = mysqli_query($koneksi,"SELECT * FROM sale_register WHERE id_register='$id_register'");
$data = mysqli_fetch_array($query_register);

$pecah_alamat=explode("#", $data['alamat']);
$id_paket=$data['id_paket'];
$id_bts=$data['id_bts'];
$ip_publik=$data['ip_publik'];
$biaya_registrasi=$data['biaya_registrasi'];
$id_radio=$data['id_radio'];
$status_radio=$data['status_radio'];
$jumlah_radio=$data['jumlah_radio'];
$harga_radio=$data['harga_radio'];
$id_antena=$data['id_antena'];
$jumlah_antena=$data['jumlah_antena'];
$status_antena=$data['status_antena'];
$harga_antena=$data['harga_antena'];
$id_wifi=$data['id_wifi'];
$jumlah_wifi=$data['jumlah_wifi'];
$status_wifi=$data['status_wifi'];
$harga_wifi=$data['harga_wifi'];
$id_tower=$data['id_tower'];
$jumlah_tower=$data['jumlah_tower'];
$status_tower=$data['status_tower'];
$harga_tower=$data['harga_tower'];
$id_kabel=$data['id_kabel'];
$panjang_kabel=$data['panjang_kabel'];
$status_kabel=$data['status_kabel'];
$harga_kabel=$data['harga_kabel'];
?>
<section class="content-header">
  <h1>
    Registrasi User
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
          <h3 class="box-title">Form Registrasi</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" class="form-horizontal">
          <div class="box-body">

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No Registrasi</label>
              <div class="col-sm-10">
                <input type="text" name="id_register" class="form-control" id="inputPassword3" value="<?php echo $data['id_register'];?>" readonly="readonly">
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
                <input type="text" name="nama_user" class="form-control" id="inputPassword3" value="<?php echo $data['nama_user'];?>">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Instansi</label>
              <div class="col-sm-4">
                <input type="text" name="nama_instansi" class="form-control" id="inputPassword3" value="<?php echo $data['nama_instansi'];?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-4">
                <select class="form-control" name="jenis_kelamin">
                  <?php
                  if($data['jenis_kelamin']=="LAKI-LAKI") {
                    $laki_laki="selected='selected'";
                    $perempuan="";
                  } else {
                    $laki_laki="";
                    $perempuan="selected='selected'";
                  }
                  ?>
                  <option <?php echo $laki_laki; ?>>LAKI-LAKI</option>
                  <option <?php echo $perempuan; ?>>PEREMPUAN</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tempat Lahir</label>
              <div class="col-sm-4">
                <input type="text" name="tempat_lahir" class="form-control" id="inputPassword3" value="<?php echo $data['tempat_lahir'];?>">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Lahir</label>
              <div class="col-sm-4">
                <input type="date" name="tanggal_lahir" class="form-control" id="inputPassword3" value="<?php echo $data['tanggal_lahir'];?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Alamat Lengkap</label>
              <div class="col-sm-6">
                <input type="text" name="alamat_1" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['0'];?>">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">RT</label>
              <div class="col-sm-1">
                <input type="text" name="alamat_2" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['1'];?>">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">RW</label>
              <div class="col-sm-1">
                <input type="text" name="alamat_3" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['2'];?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Desa/Kelurahan</label>
              <div class="col-sm-2">
                <input type="text" name="alamat_4" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['3'];?>">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Kecamatan</label>
              <div class="col-sm-2">
                <input type="text" name="alamat_5" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['4'];?>">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Kabupaten/Kota</label>
              <div class="col-sm-3">
                <input type="text" name="alamat_6" class="form-control" id="inputPassword3" value="<?php echo $pecah_alamat['5'];?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Koordinat</label>
              <div class="col-sm-10">
                <input type="text" name="koordinat" class="form-control" id="inputPassword3" value="<?php echo htmlentities($data['koordinat'],ENT_QUOTES);?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No Telp</label>
              <div class="col-sm-4">
                <input type="text" name="telp" class="form-control" id="inputPassword3" value="<?php echo $data['telp'];?>">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-4">
                <input type="text" name="email" class="form-control" id="inputPassword3" value="<?php echo $data['email'];?>">
              </div>
            </div>

            <br>
            <hr>
            <br>
            
            <!-- ID Paket -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Paket</label>
              <div class="col-sm-4">
                <select class="form-control" name="id_paket">
                  <option selected="selected" disabled></option>
                  <?php
                  foreach($crud->select_data_sale_paket() as $data) {
                    $selected="";
                    if($data['id_paket']==$id_paket) {
                      $selected='selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id_paket']; ?>" <?php echo $selected; ?>><?php echo "Nama Paket: ".$data['nama_paket']." || Harga : ".$data['harga']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">IP Publik</label>
              <div class="col-sm-2">
                <select class="form-control" name="ip_publik">
                  <?php
                  if($ip_publik=="IYA") {
                    $iya="selected='selected'";
                    $tidak="";
                  } else {
                    $iya="";
                    $tidak="selected='selected'";
                  }
                  ?>
                  <option <?php echo $tidak; ?>>TIDAK</option>
                  <option <?php echo $iya; ?>>IYA</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Biaya Registrasi</label>
              <div class="col-sm-1">
                <input type="text" name="biaya_registrasi" class="form-control" id="inputPassword3" value="<?php echo $biaya_registrasi; ?>">
              </div>
            </div>

            <!-- BTS -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">BTS</label>
              <div class="col-sm-10">
                <select class="form-control" name="id_bts">
                    <option selected="selected" disabled></option>
                  <?php
                  foreach($crud->select_data_label_gedung() as $data) {
                    $selected="";
                    if($data['id']==$id_bts) {
                      $selected='selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id']; ?>" <?php echo $selected; ?>><?php echo $data['nama_gedung']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- Radio -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Radio</label>
              <div class="col-sm-3">
                <select class="form-control" name="id_radio">
                    <option selected="selected" disabled></option>
                  <?php
                  foreach($crud->select_data_sale_radio() as $data) {
                    $selected="";
                    if($data['id_radio']==$id_radio) {
                      $selected='selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id_radio']; ?>" <?php echo $selected; ?>><?php echo $data['nama_radio']; ?></option>
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
              <label for="inputPassword3" class="col-sm-1 control-label">Harga Radio</label>
              <div class="col-sm-1">
                <input type="text" name="harga_radio" class="form-control" id="inputPassword3" value="<?php echo $harga_radio;?>">
              </div>
            </div>

            <!-- Antena -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Antena</label>
              <div class="col-sm-3">
                <select class="form-control" name="id_antena">
                    <option selected="selected" disabled></option>
                  <?php
                  foreach($crud->select_data_sale_antena() as $data) {
                    $selected="";
                    if($data['id_antena']==$id_antena) {
                      $selected='selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id_antena']; ?>" <?php echo $selected; ?>><?php echo $data['nama_antena']; ?></option>
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
              <label for="inputPassword3" class="col-sm-1 control-label">Harga Antena</label>
              <div class="col-sm-1">
                <input type="text" name="harga_antena" class="form-control" id="inputPassword3" value="<?php echo $harga_antena;?>">
              </div>
            </div>

            <!-- Wifi -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Wifi</label>
              <div class="col-sm-3">
                <select class="form-control" name="id_wifi">
                    <option selected="selected" disabled></option>
                  <?php
                  foreach($crud->select_data_sale_wifi() as $data) {
                    $selected="";
                    if($data['id_wifi']==$id_wifi) {
                      $selected='selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id_wifi']; ?>" <?php echo $selected; ?>><?php echo $data['nama_wifi']; ?></option>
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
              <label for="inputPassword3" class="col-sm-1 control-label">Harga Wifi</label>
              <div class="col-sm-1">
                <input type="text" name="harga_wifi" class="form-control" id="inputPassword3" value="<?php echo $harga_wifi;?>">
              </div>
            </div>

            <!-- Tower -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tower</label>
              <div class="col-sm-3">
                <select class="form-control" name="id_tower">
                    <option selected="selected" disabled></option>
                  <?php
                  foreach($crud->select_data_sale_tower() as $data) {
                    $selected="";
                    if($data['id_tower']==$id_tower) {
                      $selected='selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id_tower']; ?>" <?php echo $selected; ?>><?php echo $data['nama_tower']; ?></option>
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
              <label for="inputPassword3" class="col-sm-1 control-label">Harga</label>
              <div class="col-sm-1">
                <input type="text" name="harga_tower" class="form-control" id="inputPassword3" value="<?php echo $harga_tower;?>">
              </div>
            </div>

            <!-- Kabel -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Kabel</label>
              <div class="col-sm-3">
                <select class="form-control" name="id_kabel">
                    <option selected="selected" disabled></option>
                  <?php
                  foreach($crud->select_data_sale_kabel() as $data) {
                    $selected="";
                    if($data['id_kabel']==$id_kabel) {
                      $selected='selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $data['id_kabel']; ?>" <?php echo $selected; ?>><?php echo $data['nama_kabel']; ?></option>
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
              <label for="inputPassword3" class="col-sm-1 control-label">Harga</label>
              <div class="col-sm-1">
                <input type="text" name="harga_kabel" class="form-control" id="inputPassword3" value="<?php echo $harga_kabel;?>">
              </div>
            </div>

            <br>
            <hr>
            <br>

          <!-- /.box-body -->
          <div class="box-footer">
            <a href="?page=page_data_user_trial" class="btn btn-default">Cancel</a>
            <button name="edit_sale_register" type="submit" class="btn btn-primary pull-right">Update</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>