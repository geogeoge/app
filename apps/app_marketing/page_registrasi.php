<?php
$id_prospek=$_GET['id_prospek'];
foreach($crud->select_detail_user_prospek($id_prospek) as $data) {
  $pecah_alamat=explode("#", $data['alamat']);

    $query_sale_register=mysqli_query($koneksi,"select * from sale_register order by id_register DESC limit 1");
    $tampil_sale_register=mysqli_fetch_array($query_sale_register);
    $id_register=$tampil_sale_register['id_register'];
    if($id_register=="") {
      $id_register="U001";
    } else {
      $id_register++;
    }
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

            <div hidden="hidden">
              <input type="text" name="id_prospek" class="form-control" id="inputPassword3" value="<?php echo $data['id_prospek'];?>" readonly="readonly">
            </div>
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
                  <option selected="selected" value=""></option>
                  <option>LAKI-LAKI</option>
                  <option>PEREMPUAN</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tempat Lahir</label>
              <div class="col-sm-4">
                <input type="text" name="tempat_lahir" class="form-control" id="inputPassword3" placeholder="">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Lahir</label>
              <div class="col-sm-4">
                <input type="date" name="tanggal_lahir" class="form-control" id="inputPassword3" placeholder="">
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
                <select required="required" class="form-control" name="id_paket">
                  <option selected="selected" disabled></option>
                  <?php
                  foreach($crud->select_data_sale_paket() as $data) {
                    ?>
                    <option value="<?php echo $data['id_paket']; ?>"><?php echo "Nama Paket: ".$data['nama_paket']." || Harga : ".number_format($data['harga'],0,',','.'); ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">IP Publik</label>
              <div class="col-sm-2">
                <select class="form-control" name="ip_publik">
                  <option>TIDAK</option>
                  <option>IYA</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Biaya Registrasi</label>
              <div class="col-sm-1">
                <input type="text" name="biaya_registrasi" class="form-control" id="inputPassword3" value="200000">
              </div>
            </div>

            <!-- BTS -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">BTS</label>
              <div class="col-sm-10">
                <select class="form-control" name="id_bts">
                  <option selected="selected" value=""></option>
                  <?php
                  foreach($crud->select_data_label_gedung() as $data) {
                    ?>
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['nama_gedung']; ?></option>
                    <?php
                  }
                  ?>
                </select>
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
                <input type="text" name="jumlah_radio" class="form-control" id="inputPassword3">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select required="required" class="form-control" name="status_radio">
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
                <input type="text" name="jumlah_antena" class="form-control" id="inputPassword3">
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
                <input type="text" name="jumlah_wifi" class="form-control" id="inputPassword3">
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
                <input type="text" name="jumlah_tower" class="form-control" id="inputPassword3">
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

            <!-- Tambahan 1 -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tambahan 1</label>
              <div class="col-sm-5">
                <input type="text" name="tambahan_1" class="form-control" id="inputPassword3" value="">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Jumlah</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_tambahan_1" class="form-control" id="inputPassword3" value="0">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_tambahan_1">
                  <option>TIDAK PAKAI</option>
                  <option>BELI</option>
                  <option>DIPINJAMI</option>
                </select>
              </div>
            </div>

            <!-- Tambahan 2 -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tambahan 2</label>
              <div class="col-sm-5">
                <input type="text" name="tambahan_2" class="form-control" id="inputPassword3" value="">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Jumlah</label>
              <div class="col-sm-1">
                <input type="text" name="jumlah_tambahan_2" class="form-control" id="inputPassword3" value="0">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Status</label>
              <div class="col-sm-2">
                <select class="form-control" name="status_tambahan_2">
                  <option>TIDAK PAKAI</option>
                  <option>BELI</option>
                  <option>DIPINJAMI</option>
                </select>
              </div>
            </div>
            <?php
            include "modal_konfirmasi_registrasi.php";
            ?>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="?page=page_data_user_prospek" class="btn btn-default">Cancel</a>
            <a href="#konfirmasi_registrasi" role="button"  data-target = "#konfirmasi_registrasi" data-toggle="modal" class="btn btn-primary pull-right">Kirim</a>
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