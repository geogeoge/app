<?php
include "../../koneksi/koneksi.php";
    
    $id_register=$_GET['id_register'];

    $sql="SELECT * FROM sale_register WHERE id_register='$id_register'";
    $query=mysqli_query($koneksi,$sql);
    $data=mysqli_fetch_array($query);

$id_register=$data['id_register'];
?>
<section class="content-header">
  <h1>
    Detail Data User
    <small><?php echo $data['nama_user'];  ?></small>
    <a href="index.php?page=page_data_user_baru" class="btn btn-danger pull-right">Kembali</a>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Data User #<?php echo $id_register;  ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <td width="200">Nama User</td>
              <th width="5">:</th>
              <th style="text-align: left;"><?php echo $data['nama_user'];  ?></th>
            </tr>
            <tr>
              <td>Nama Instansi</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['nama_instansi'];  ?></th>
            </tr>
            <tr>
              <td>Jenis Kelamin</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['jenis_kelamin'];  ?></th>
            </tr>
            <tr>
              <td>Tempat, Tanggal Lahir</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['tempat_lahir'];  ?>, <?php echo $data['tanggal_lahir'];  ?></th>
            </tr>
            <tr>
              <td>Alamat</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['alamat'];  ?></th>
            </tr>
            <tr>
              <td>Koordinat</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['koordinat'];  ?></th>
            </tr>
            <tr>
              <td>Telepon</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['telp'];  ?></th>
            </tr>
            <tr>
              <td>Email</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['email'];  ?></th>
            </tr>
            <tr>
              <td>BTS</td>
              <th>:</th>
              <th style="text-align: left;"></th>
            </tr>
            <tr>
              <td>IP Public</td>
              <th>:</th>
              <th style="text-align: left;"></th>
            </tr>
            <tr>              
              <td>IP Radio</td>
              <th>:</th>
              <th style="text-align: left;"></th>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>