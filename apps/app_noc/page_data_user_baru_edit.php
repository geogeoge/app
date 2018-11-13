<?php
 include "../../koneksi/koneksi.php";

 $id_register=$_GET['id_register'];
 $sql_mon="SELECT   sale_register.id_register,
                    sale_register.nama_user,
                    sale_register.nama_instansi,
                    sale_register.nik,
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
                    INNER JOIN sale_paket_internet ON sale_register.id_paket=sale_paket_internet.id_paket
                    WHERE sale_register.id_register='$id_register'";
 $query_mon=mysqli_query($koneksi,$sql_mon);
 $tampil_mon=mysqli_fetch_array($query_mon);
?>
<section class="content-header">
  <h1>
    Update Data User
    <small><?php echo $tampil_mon['nama_user'] ?></small>
    <a href="javascript:history.back()" class="btn btn-danger pull-right">Cancel</a>
  </h1>
</section>

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
        <form method="POST" class="form-horizontal" action="update_user_baru.php">
          <div class="box-body">

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama User</label>
              <div class="col-sm-10">
                <input type="text" name="nama_user" class="form-control" id="nama_user" readonly="readonly" value="<?php echo $tampil_mon['nama_user']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No Registrasi</label>
              <div class="col-sm-4">
                <input type="text" name="id_register" class="form-control" id="id_register" readonly="readonly" value="<?php echo $tampil_mon['id_register']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" name="nik" class="form-control" id="nik" readonly="readonly" value="<?php echo $tampil_mon['nik']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Instansi</label>
              <div class="col-sm-10">
                <input type="text" name="nama_instansi" class="form-control" id="nama_instansi" readonly="readonly" value="<?php echo $tampil_mon['nama_instansi']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-4">
                <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin" readonly="readonly" value="<?php echo $tampil_mon['jenis_kelamin']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tempat Lahir</label>
              <div class="col-sm-4">
                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" readonly="readonly" value="<?php echo $tampil_mon['tempat_lahir']; ?>">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Lahir</label>
              <div class="col-sm-4">
                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" readonly="readonly" value="<?php echo $tampil_mon['tanggal_lahir']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Alamat Lengkap</label>
              <div class="col-sm-10">
                <input type="text" name="alamat" class="form-control" id="alamat" readonly="readonly" value="<?php echo $tampil_mon['alamat']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Koordinat</label>
              <div class="col-sm-10">
                <input type="text" name="koordinat" class="form-control" id="koordinat" readonly="readonly" value="<?php echo $tampil_mon['koordinat']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No. Telp</label>
              <div class="col-sm-4">
                <input type="text" name="telp" class="form-control" id="telp" readonly="readonly" value="<?php echo $tampil_mon['telp']; ?>">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-4">
                <input type="text" name="email" class="form-control" id="email" readonly="readonly" value="<?php echo $tampil_mon['email']; ?>">
              </div>
            </div>

            <br>
            <hr>
            <br>
            
            <!-- ID Paket -->
            <div class="form-group">
              <div class="col-sm-4" hidden="hidden">
                <input type="text" name="id_paket" class="form-control" id="id_paket" value="<?php echo $tampil_mon['id_paket']; ?>">
              </div>   
              <label for="inputPassword3" class="col-sm-2 control-label">Paket Internet</label>
              <div class="col-sm-4">
                <input type="text" name="nama_paket" class="form-control" id="nama_paket" readonly="readonly" value="<?php echo $tampil_mon['nama_paket']; ?>">
              </div>              
              <label for="inputPassword3" class="col-sm-2 control-label">Harga Paket</label>
              <div class="col-sm-4">
                <input type="text" name="harga" class="form-control" id="harga" readonly="readonly" value="<?php echo $tampil_mon['harga']; ?>">
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
                    <option>Pilih BTS</option>
                    <?php
                      while($tampil_bts=mysqli_fetch_array($query_bts)){
                        $id_bts=$tampil_bts['id_bts'];
                    ?>
                    <option value="<?php echo $id_bts; ?>"><?php echo $tampil_bts['nama_bts']; ?></option>
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

          <!-- /.box-body -->
          <div class="box-footer">            
            <input type="submit" class="btn btn-primary pull-right" value="Update">
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>