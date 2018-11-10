<?php
 include "../../koneksi/koneksi.php";

 $id_pelanggan=$_GET['id_pelanggan'];
 $sql_mon="SELECT   mon_pelanggan.id_pelanggan,
            mon_pelanggan.nama_user,
            mon_pelanggan.status,
            mon_databts.id_bts,
            mon_databts.nama_bts,
            mon_ipradio.ip_radio,
            mon_ippublik.ip_public
        FROM mon_pelanggan 
        INNER JOIN mon_databts ON mon_pelanggan.id_bts=mon_databts.id_bts
        INNER JOIN mon_ipradio ON mon_pelanggan.id_pelanggan=mon_ipradio.id_pelanggan
        INNER JOIN mon_ippublik ON mon_pelanggan.id_pelanggan=mon_ippublik.id_pelanggan
        where mon_pelanggan.id_pelanggan='$id_pelanggan'";
 $query_mon=mysqli_query($koneksi,$sql_mon);
 $tampil_mon=mysqli_fetch_array($query_mon);
 $bts=$tampil_mon['nama_bts'];
 $status=$tampil_mon['status'];
 

?>
<section class="content-header">
  <h1>
    Update Data User
    <small><?php echo $tampil_mon['nama_user'] ?></small>
    <a href="javascript:history.back()" class="btn btn-danger pull-right">Cancel</a>
  </h1>
</section>

<?php
 if ($status == 'BELUM'){
?>
<!-- Main content -->
<section class="content">
  <div class="row">      
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Form Update</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" class="form-horizontal" action="update_user.php">
          <div class="box-body">

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama User</label>
              <div class="col-sm-10">
                <?php
                $sql_reqister ="SELECT 
                                sale_register.id_register,
                                sale_register.nama_user,
                                sale_register.nik,
                                sale_register.nama_instansi,
                                sale_register.jenis_kelamin,
                                sale_register.tempat_lahir,
                                sale_register.tanggal_lahir,
                                sale_register.alamat,
                                sale_register.koordinat,
                                sale_register.telp,
                                sale_register.email,
                                sale_register.id_paket,
                                sale_paket_internet.nama_paket,
                                sale_paket_internet.harga
                                FROM sale_register 
                                INNER JOIN sale_paket_internet 
                                ON sale_register.id_paket=sale_paket_internet.id_paket
                                WHERE sale_register.status_mon != 'SUDAH'";
                $query_register=mysqli_query($koneksi,$sql_reqister);
                $jsArray  = "var prdName = new Array();\n";
                ?>
                <select class="form-control select2" style="width: 100%;" onchange="changeValue(this.value)" name="nama_user" required="required">
                  <option></option>
                  <?php
                    while($tampil_register=mysqli_fetch_array($query_register)){
                  echo '<option value="' . $tampil_register['nama_user'] . '">' . $tampil_register['nama_user'] . '</option>';
                    $jsArray .= "prdName['" . $tampil_register['nama_user'] . "'] = { 
                      id_register:'" . addslashes($tampil_register['id_register']) . "',
                      nik:'" . addslashes($tampil_register['nik']) . "',
                      nama_instansi:'" . addslashes($tampil_register['nama_instansi']) . "',
                      jenis_kelamin:'" . addslashes($tampil_register['jenis_kelamin']) . "',
                      tempat_lahir:'" . addslashes($tampil_register['tempat_lahir']) . "',
                      tanggal_lahir:'" . addslashes($tampil_register['tanggal_lahir']) . "',
                      alamat:'" . addslashes($tampil_register['alamat']) . "',
                      koordinat:'" . addslashes($tampil_register['koordinat']) . "',
                      telp:'" . addslashes($tampil_register['telp']) . "',
                      email:'" . addslashes($tampil_register['email']) . "',
                      id_paket:'" . addslashes($tampil_register['id_paket']) . "',
                      nama_paket:'" . addslashes($tampil_register['nama_paket']) . "',
                      harga:'" . addslashes($tampil_register['harga']) . "'
                      };\n";
                    }
                  ?>
                </select>
              </div>
            </div>

            <script type="text/javascript">
              <?php
                echo $jsArray;
              ?>
              function changeValue(id) {
                document.getElementById('id_register').value = prdName[id].id_register;
                document.getElementById('nik').value = prdName[id].nik;
                document.getElementById('nama_instansi').value = prdName[id].nama_instansi;
                document.getElementById('jenis_kelamin').value = prdName[id].jenis_kelamin;
                document.getElementById('tempat_lahir').value = prdName[id].tempat_lahir;
                document.getElementById('tanggal_lahir').value = prdName[id].tanggal_lahir;
                document.getElementById('alamat').value = prdName[id].alamat;
                document.getElementById('koordinat').value = prdName[id].koordinat;
                document.getElementById('telp').value = prdName[id].telp;
                document.getElementById('email').value = prdName[id].email;
                document.getElementById('id_paket').value = prdName[id].id_paket;
                document.getElementById('nama_paket').value = prdName[id].nama_paket;
                document.getElementById('harga').value = prdName[id].harga;
              };
            </script>  

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No Registrasi</label>
              <div class="col-sm-4">
                <input type="text" name="id_register" class="form-control" id="id_register" readonly="readonly">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">ID Pelanggan</label>
              <div class="col-sm-4">
                <input type="text" name="id_pelanggan" class="form-control" value="<?php echo $tampil_mon['id_pelanggan'];?>" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" name="nik" class="form-control" id="nik" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Instansi</label>
              <div class="col-sm-10">
                <input type="text" name="nama_instansi" class="form-control" id="nama_instansi" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-4">
                <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tempat Lahir</label>
              <div class="col-sm-4">
                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" readonly="readonly">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Lahir</label>
              <div class="col-sm-4">
                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Alamat Lengkap</label>
              <div class="col-sm-10">
                <input type="text" name="alamat" class="form-control" id="alamat" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Koordinat</label>
              <div class="col-sm-10">
                <input type="text" name="koordinat" class="form-control" id="koordinat" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No. Telp</label>
              <div class="col-sm-4">
                <input type="text" name="telp" class="form-control" id="telp" readonly="readonly">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-4">
                <input type="text" name="email" class="form-control" id="email" readonly="readonly">
              </div>
            </div>

            <br>
            <hr>
            <br>
            
            <!-- ID Paket -->
            <div class="form-group">
              <div class="col-sm-4" hidden="hidden">
                <input type="text" name="id_paket" class="form-control" id="id_paket">
              </div>   
              <label for="inputPassword3" class="col-sm-2 control-label">Paket Internet</label>
              <div class="col-sm-4">
                <input type="text" name="nama_paket" class="form-control" id="nama_paket" readonly="readonly">
              </div>              
              <label for="inputPassword3" class="col-sm-2 control-label">Harga Paket</label>
              <div class="col-sm-4">
                <input type="text" name="harga" class="form-control" id="harga" readonly="readonly">
              </div>
            </div>

            <!-- BTS -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">BTS</label>
              <div class="col-sm-10">                
                  <?php
                  $query_bts=mysqli_query($koneksi,"SELECT * FROM mon_databts WHERE nama_bts != '$bts'");                
                  ?>
                  <select class="form-control select2" style="width: 100%;" name="id_bts">
                    <option selected="selected" value="<?php echo $tampil_mon['id_bts'] ?>"><?php echo $tampil_mon['nama_bts'] ?></option>
                    <?php
                      while($tampil_bts=mysqli_fetch_array($query_bts)){
                    ?>
                    <option value="<?php echo $tampil_bts['id_bts']; ?>"><?php echo $tampil_bts['nama_bts']; ?></option>
                    <?php
                      }
                    ?>
                  </select>
              </div>
            </div>

            <!-- IP Public | IP Radio -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">IP Public</label>
              <div class="col-sm-4">
                <input type="text" name="ip_public" class="form-control" value="<?php echo $tampil_mon['ip_public'] ?>">
              </div>

              <label for="inputPassword3" class="col-sm-2 control-label">IP Radio</label>
              <div class="col-sm-4">
                <input type="text" name="ip_radio" class="form-control" value="<?php echo $tampil_mon['ip_radio'] ?>">
              </div>
            </div>

            <br>
            <br>

          <!-- /.box-body -->
          <div class="box-footer">            
            <input type="submit" name="update_user" class="btn btn-primary pull-right" value="Update">
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
 
 if ($status == 'SUDAH'){

  $sql_mon_fix = "SELECT mon_pelanggan.nama_user,
                         mon_pelanggan.id_register,
                         mon_pelanggan.id_pelanggan,
                         mon_pelanggan.nik,
                         mon_pelanggan.nama_instansi,
                         mon_pelanggan.jenis_kelamin,
                         mon_pelanggan.tempat_lahir,
                         mon_pelanggan.tgl_lahir,
                         mon_pelanggan.alamat,
                         mon_pelanggan.koordinat,
                         mon_pelanggan.telp_pelanggan,
                         mon_pelanggan.email_pelanggan,
                         mon_pelanggan.ip_radio,
                         mon_pelanggan.ip_public,
                         mon_databts.nama_bts,
                         sale_paket_internet.nama_paket,
                         sale_paket_internet.harga
                         FROM mon_pelanggan
                         INNER JOIN mon_databts ON mon_pelanggan.id_bts=mon_databts.id_bts
                         INNER JOIN sale_paket_internet ON mon_pelanggan.id_paket=sale_paket_internet.id_paket
                         where mon_pelanggan.id_pelanggan='$id_pelanggan'";

  $query_mon_fix=mysqli_query($koneksi,$sql_mon_fix);
  $data_mon=mysqli_fetch_array($query_mon_fix);

?>  

<!-- Main content -->
<section class="content">
  <div class="row">      
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Form Update</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" class="form-horizontal" action="update_user_bts.php?id=<?php echo $id_pelanggan; ?>">
          <div class="box-body">

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama User</label>
              <div class="col-sm-10">
                <input type="text" name="id_register" class="form-control" value="<?php echo $data_mon['nama_user']; ?>" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No Registrasi</label>
              <div class="col-sm-4">
                <input type="text" name="id_register" class="form-control" value="<?php echo $data_mon['id_register'];?>" readonly="readonly">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">ID Pelanggan</label>
              <div class="col-sm-4">
                <input type="text" name="id_pelanggan" class="form-control" value="<?php echo $data_mon['id_pelanggan'];?>" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" name="nik" class="form-control" id="nik" value="<?php echo $data_mon['nik'];?>" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Instansi</label>
              <div class="col-sm-10">
                <input type="text" name="nama_instansi" class="form-control" value="<?php echo $data_mon['nama_instansi'];?>" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-4">
                <input type="text" name="jenis_kelamin" class="form-control" value="<?php echo $data_mon['jenis_kelamin'];?>" id="jenis_kelamin" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tempat Lahir</label>
              <div class="col-sm-4">
                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $data_mon['tempat_lahir'];?>" id="tempat_lahir" readonly="readonly">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Lahir</label>
              <div class="col-sm-4">
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $data_mon['tgl_lahir'];?>" id="tanggal_lahir" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Alamat Lengkap</label>
              <div class="col-sm-10">
                <input type="text" name="alamat" class="form-control" id="alamat" value="<?php echo $data_mon['alamat'];?>" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Koordinat</label>
              <div class="col-sm-10">
                <input type="text" name="koordinat" class="form-control" value="<?php echo $data_mon['koordinat'];?>" id="koordinat" readonly="readonly">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No. Telp</label>
              <div class="col-sm-4">
                <input type="text" name="telp" class="form-control" id="telp" value="<?php echo $data_mon['telp_pelanggan'];?>" readonly="readonly">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-4">
                <input type="text" name="email" value="<?php echo $data_mon['email_pelanggan'];?>" class="form-control" id="email" readonly="readonly">
              </div>
            </div>

            <br>
            <hr>
            <br>
            
            <!-- ID Paket -->
            <div class="form-group">
              <div class="col-sm-4" hidden="hidden">
                <input type="text" name="id_paket" class="form-control" id="id_paket">
              </div>   
              <label for="inputPassword3" class="col-sm-2 control-label">Paket Internet</label>
              <div class="col-sm-4">
                <input type="text" name="nama_paket" class="form-control" id="nama_paket" value="<?php echo $data_mon['nama_paket'];?>" readonly="readonly">
              </div>              
              <label for="inputPassword3" class="col-sm-2 control-label">Harga Paket</label>
              <div class="col-sm-4">
                <input type="text" name="harga" class="form-control" value="<?php echo $data_mon['harga'];?>" id="harga" readonly="readonly">
              </div>
            </div>

            <!-- BTS -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">BTS</label>
              <div class="col-sm-10">                
                  <?php
                  $query_bts2=mysqli_query($koneksi,"SELECT * FROM mon_databts WHERE nama_bts != '$bts'");                
                  ?>
                  <select class="form-control select2" style="width: 100%;" name="id_bts">
                    <option selected="selected" value="<?php echo $tampil_mon['id_bts'] ?>"><?php echo $tampil_mon['nama_bts'] ?></option>
                    <?php
                      while($tampil_bts2=mysqli_fetch_array($query_bts2)){
                    ?>
                    <option value="<?php echo $tampil_bts2['id_bts']; ?>"><?php echo $tampil_bts2['nama_bts']; ?></option>
                    <?php
                      }
                    ?>
                  </select>
              </div>
            </div>

            <!-- IP Public | IP Radio -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">IP Public</label>
              <div class="col-sm-4">
                <input type="text" name="ip_public" class="form-control" value="<?php echo $data_mon['ip_public'];?>">
              </div>

              <label for="inputPassword3" class="col-sm-2 control-label">IP Radio</label>
              <div class="col-sm-4">
                <input type="text" name="ip_radio" class="form-control" value="<?php echo $data_mon['ip_radio'] ?>">
              </div>
            </div>

            <br>
            <br>

          <!-- /.box-body -->
          <div class="box-footer">            
            <input type="submit" name="update_user" class="btn btn-primary pull-right" value="Update">
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
