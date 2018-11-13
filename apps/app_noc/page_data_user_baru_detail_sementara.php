<?php
include "../../koneksi/koneksi.php";
    
    $id_pelanggan=$_GET['id_register'];

    $sql="SELECT  mon_pelanggan.id_pelanggan,
            mon_pelanggan.id_register,
            mon_pelanggan.nama_user,
            mon_pelanggan.nama_instansi,
            mon_pelanggan.jenis_kelamin,
            mon_pelanggan.tempat_lahir,
            mon_pelanggan.tanggal_lahir,
            mon_pelanggan.alamat,
            mon_pelanggan.telp,
            mon_pelanggan.email,
            mon_pelanggan.koordinat,
            mon_pelanggan.tgl_lahir,
            mon_pelanggan.telp_pelanggan,
            mon_pelanggan.email_pelanggan,
            mon_pelanggan.ip_public,
            mon_pelanggan.ip_radio,
            mon_databts.nama_bts
        FROM mon_pelanggan 
        INNER JOIN mon_databts ON mon_pelanggan.id_bts=mon_databts.id_bts
        WHERE mon_pelanggan.id_register='$id_pelanggan'";
    $query=mysqli_query($koneksi,$sql);
    $data=mysqli_fetch_array($query);

$id_pelanggan=$data['id_register'];
?>
<section class="content-header">
  <h1>
    Detail Data User
    <small><?php echo $data['nama_user'];  ?></small>
    <a href="index.php?page=page_data_pelanggan" class="btn btn-danger pull-right">Kembali</a>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Data User #<?php echo $id_pelanggan;  ?></h3>
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
              <th style="text-align: left;"><?php echo $data['tempat_lahir'];  ?>, <?php echo $data['tanggal_lahir'];  ?> &nbsp; <?php echo $data['tgl_lahir'];  ?></th>
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
              <th style="text-align: left;"><?php echo $data['telp'];  ?> &nbsp; <?php echo $data['telp_pelanggan'];  ?></th>
            </tr>
            <tr>
              <td>Email</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['email'];  ?> &nbsp; <?php echo $data['email_pelanggan'];  ?></th>
            </tr>
            <tr>
              <td>BTS</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['nama_bts'];  ?></th>
            </tr>
<?php
  $sql2="SELECT *
        FROM mon_pelanggan         
        WHERE id_pelanggan='$id_pelanggan'";
  $query2=mysqli_query($koneksi,$sql2);
  $data2=mysqli_fetch_array($query2);
?>
            <tr>
              <td>IP Public</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['ip_public'];  ?><?php echo $data2['ip_public'];  ?></th>
            </tr>
            <tr>              
              <td>IP Radio</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['ip_radio'];  ?><?php echo $data2['ip_radio'];  ?></th>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>