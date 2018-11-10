<?php
  $id_register=$_GET['id_register'];
  $data = $select->select_menyiapkan_alat($id_register);
  $pecah_alamat=explode("#", $data['alamat']);

  $data_radio = $data['id_radio'];
  $jumlah_radio = $data['jumlah_radio'];
  $status_radio = $data['status_radio'];
  $harga_radio = $data['harga_radio'];

  $data_antena = $data['id_antena'];
  $jumlah_antena = $data['jumlah_antena'];
  $status_antena = $data['status_antena'];
  $harga_antena = $data['harga_antena'];

  $data_wifi = $data['id_wifi'];
  $jumlah_wifi = $data['jumlah_wifi'];
  $status_wifi = $data['status_wifi'];
  $harga_wifi = $data['harga_wifi'];

  $data_tower = $data['id_tower'];
  $jumlah_tower = $data['jumlah_tower'];
  $status_tower = $data['status_tower'];
  $harga_tower = $data['harga_tower'];

  $data_kabel = $data['id_kabel'];
  $panjang_kabel = $data['panjang_kabel'];
  $status_kabel = $data['status_kabel'];
  $harga_kabel = $data['harga_kabel'];

  // --------------------------------------------------------------- \\

  $tambahan_1 = $data['tambahan_1'];
  $jumlah_tambahan_1 = $data['jumlah_tambahan_1'];
  $status_tambahan_1 = $data['status_tambahan_1'];
  $harga_tambahan_1 = $data['harga_tambahan_1'];

  $tambahan_2 = $data['tambahan_2'];
  $jumlah_tambahan_2 = $data['jumlah_tambahan_2'];
  $status_tambahan_2 = $data['status_tambahan_2'];
  $harga_tambahan_2 = $data['harga_tambahan_2'];

  $tambahan_3 = $data['tambahan_3'];
  $jumlah_tambahan_3 = $data['jumlah_tambahan_3'];
  $status_tambahan_3 = $data['status_tambahan_3'];
  $harga_tambahan_3 = $data['harga_tambahan_3'];

  // --------------------------------------------------------------- \\

  $id_marketing = $data['id_marketing'];
  $query_marketing = mysqli_query($koneksi,"select * from master_login where id_user='$id_marketing'");
  $data_marketing = mysqli_fetch_array($query_marketing);

  $id_teknisi = $data['id_teknisi'];
  $query_teknisi = mysqli_query($koneksi,"select * from master_login where id_user='$id_teknisi'");
  $data_teknisi = mysqli_fetch_array($query_teknisi);
?>
<section class="content-header">
  <h1>
  Persiapan Alat
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
          <h3 class="box-title">Form Menyiapkan Alat</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" class="form-horizontal">
          <div class="box-body">

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Marketing</label>
              <div class="col-sm-4">
                <input type="text" name="nama_user" class="form-control" id="inputPassword3" value="<?php echo $data_marketing['nama_user'];?>" readonly>
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Teknisi</label>
              <div class="col-sm-4">
                <input type="text" name="nama_instansi" class="form-control" id="inputPassword3" value="<?php echo $data_teknisi['nama_user'];?>" readonly>
              </div>
            </div>

            <br>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No Registrasi</label>
              <div class="col-sm-10">
                <input type="text" name="id_register" class="form-control" id="inputPassword3" value="<?php echo $id_register;?>" readonly="readonly">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama User</label>
              <div class="col-sm-3">
                <input type="text" name="nama_user" class="form-control" id="inputPassword3" value="<?php echo $data['nama_user'];?>" readonly>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Nama Instansi</label>
              <div class="col-sm-3">
                <input type="text" name="nama_instansi" class="form-control" id="inputPassword3" value="<?php echo $data['nama_instansi'];?>" readonly>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">No Telp</label>
              <div class="col-sm-2">
                <input type="text" name="telp" class="form-control" id="inputPassword3" value="<?php echo $data['telp'];?>" readonly>
              </div>
            </div>

            <br>
            <hr>
            <br>
            
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No Nota</label>
              <div class="col-sm-4">
                <input type="text" name="no_nota" class="form-control" id="inputPassword3" value="<?php echo $data['no_nota'];?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No Nota Investasi</label>
              <div class="col-sm-4">
                <input type="text" name="no_nota_investasi" class="form-control" id="inputPassword3" value="<?php echo $data['no_nota_investasi'];?>" required>
              </div>
            </div>

            <br>
            <hr>
            <br>

            <!-- Radio -->
              <?php 
                if($status_radio=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_radio=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_radio=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                  $atribut = "disabled";
                }
                ?>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Radio</label>
              <div class="col-sm-3">
                <select class="form-control" name="id_radio" <?php echo $atribut;?>>
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
                <input type="text" name="jumlah_radio" class="form-control" id="inputPassword3" value="<?php echo $jumlah_radio;?>" <?php echo $atribut;?>>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_radio" <?php echo $atribut;?>>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Harga Radio</label>
              <div class="col-sm-1">
                <input type="text" name="harga_radio" class="form-control" id="inputPassword3" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php if($harga_radio==0){echo "";} else { echo $harga_radio;};?>" <?php echo $atribut;?>>
              </div>
            </div>

            <!-- Antena -->
                <?php 
                if($status_antena=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_antena=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_antena=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                  $atribut = "disabled";
                }
                ?>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Antena</label>
              <div class="col-sm-3">
                <select class="form-control" name="id_antena" <?php echo $atribut;?>>
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
                <input type="text" name="jumlah_antena" class="form-control" id="inputPassword3" value="<?php echo $jumlah_antena;?>" <?php echo $atribut;?>>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_antena" <?php echo $atribut;?>>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Harga Antena</label>
              <div class="col-sm-1">
                <input type="text" name="harga_antena" class="form-control" id="inputPassword3" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php if($harga_antena==0){echo "";} else { echo $harga_antena;};?>" <?php echo $atribut;?>>
              </div>
            </div>

            <!-- Wifi -->
                <?php 
                if($status_wifi=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_wifi=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_wifi=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                  $atribut = "disabled";
                }
                ?>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Wifi</label>
              <div class="col-sm-3">
                <select class="form-control" name="id_wifi" <?php echo $atribut;?>>
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
                <input type="text" name="jumlah_wifi" class="form-control" id="inputPassword3" value="<?php echo $jumlah_wifi;?>" <?php echo $atribut;?>>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_wifi" <?php echo $atribut;?>>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Harga Wifi</label>
              <div class="col-sm-1">
                <input type="text" name="harga_wifi" class="form-control" id="inputPassword3" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php if($harga_wifi==0){echo "";} else { echo $harga_wifi;};?>" <?php echo $atribut;?>>
              </div>
            </div>

            <!-- Tower -->
                <?php 
                if($status_tower=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_tower=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_tower=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                  $atribut = "disabled";
                }
                ?>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tower</label>
              <div class="col-sm-3">
                <select class="form-control" name="id_tower" <?php echo $atribut;?>>
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
                <input type="text" name="jumlah_tower" class="form-control" id="inputPassword3" value="<?php echo $jumlah_tower;?>" <?php echo $atribut;?>>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_tower" <?php echo $atribut;?>>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Harga Tower</label>
              <div class="col-sm-1">
                <input type="text" name="harga_tower" class="form-control" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php if($harga_tower==0){echo "";} else { echo $harga_tower;};?>" <?php echo $atribut;?>>
              </div>
            </div>

            <!-- Kabel -->
                <?php 
                if($status_kabel=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_kabel=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_kabel=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                  $atribut = "disabled";
                }
                ?>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Kabel</label>
              <div class="col-sm-3">
                <select class="form-control" name="id_kabel" <?php echo $atribut;?>>
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
                <input type="text" name="panjang_kabel" class="form-control" id="inputPassword3" value="<?php echo $panjang_kabel;?>" <?php echo $atribut;?>>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_kabel" <?php echo $atribut;?>>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Harga Kabel</label>
              <div class="col-sm-1">
                <input type="text" name="harga_kabel" class="form-control" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php if($harga_kabel==0){echo "";} else { echo $harga_kabel;};?>" <?php echo $atribut;?>>
              </div>
            </div>

            <?php 
                if($status_tambahan_1=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_tambahan_1=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_tambahan_1=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                  $atribut = "disabled";
                }
                ?>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tambahan 1</label>
              <div class="col-sm-3">
                <input type="text" name="tambahan_1" class="form-control" id="inputPassword3" value="<?php echo $tambahan_1;?>" <?php echo $atribut;?>>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Panjang</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_tambahan_1" class="form-control" id="inputPassword3" value="<?php echo $jumlah_tambahan_1;?>" <?php echo $atribut;?>>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_tambahan_1" <?php echo $atribut;?>>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Harga Kabel</label>
              <div class="col-sm-1">
                <input type="text" name="harga_tambahan_1" class="form-control" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php if($harga_tambahan_1==0){echo "";} else { echo $harga_tambahan_1;};?>" <?php echo $atribut;?>>
              </div>
            </div>

            <?php 
                if($status_tambahan_2=="DIPINJAMI") {
                  $selected_dipinjami = 'selected="selected"';
                  $selected_beli = '';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_tambahan_2=="BELI") {
                  $selected_dipinjami = '';
                  $selected_beli = 'selected="selected"';
                  $selected_tidak_pakai = '';
                  $atribut = "requierd";
                } else
                if($status_tambahan_2=="TIDAK PAKAI") {
                  $selected_dipinjami = '';
                  $selected_beli = '';
                  $selected_tidak_pakai = 'selected="selected"';
                  $atribut = "disabled";
                }
                ?>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tambahan 2</label>
              <div class="col-sm-3">
                <input type="text" name="tambahan_2" class="form-control" id="inputPassword3" value="<?php echo $tambahan_2;?>" <?php echo $atribut;?>>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Panjang</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_tambahan_2" class="form-control" id="inputPassword3" value="<?php echo $jumlah_tambahan_2;?>" <?php echo $atribut;?>>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_tambahan_2" <?php echo $atribut;?>>
                  <option <?php echo $selected_dipinjami;?>>DIPINJAMI</option>
                  <option <?php echo $selected_beli;?>>BELI</option>
                  <option <?php echo $selected_tidak_pakai;?>>TIDAK PAKAI</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Harga Kabel</label>
              <div class="col-sm-1">
                <input type="text" name="harga_tambahan_2" class="form-control" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php if($harga_tambahan_2==0){echo "";} else { echo $harga_tambahan_2;};?>" <?php echo $atribut;?>>
              </div>
            </div>
            
          <!-- /.box-body -->
          <div class="box-footer">
          <?php
          include "modal_konfirmasi_menyiapkan_alat.php";
          ?>
            <a href="?page=page_pemasangan_baru" class="btn btn-default">Cancel</a>
            <a href="#konfirmasi_menyiapkan_alat" role="button"  data-target = "#konfirmasi_menyiapkan_alat" data-toggle="modal" class="btn btn-primary pull-right">Kirim</a>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>