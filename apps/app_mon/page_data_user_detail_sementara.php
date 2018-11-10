<?php
include "../../koneksi/koneksi.php";
    
    $id_pelanggan=$_GET['id_pelanggan'];
    $id_register=$_GET['id_pelanggan'];

    $sql="SELECT  *
        FROM sale_register 
        LEFT JOIN mon_databts ON sale_register.id_bts=mon_databts.id_bts
        WHERE sale_register.id_register='$id_pelanggan'";
    $query=mysqli_query($koneksi,$sql);
    $data=mysqli_fetch_array($query);
?>
<section class="content-header">
  <h1>
    Detail Data User
    <small><?php echo $data['nama_user'];  ?></small>
      <div class="tombol_tambah">
        <a href="#modal_input_komplen<?php echo $id_register; ?>" role="button"  data-target = "#modal_input_komplen<?php echo $id_register; ?>" data-toggle="modal" class="btn btn-warning">Input Komplen</a>&nbsp; &nbsp;
        <a href="index.php?page=page_data_pelanggan" class="btn btn-danger ">Kembali</a>
      </div>
  </h1>
</section>
<?php 
    include "modal_input_komplain.php";
?>
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
              <th style="text-align: left;"><?php echo $data['tempat_lahir'];  ?>, &nbsp; <?php echo $data['tgl_lahir'];  ?></th>
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
              <th style="text-align: left;"> <?php echo $data['telp_pelanggan'];  ?></th>
            </tr>
            <tr>
              <td>Email</td>
              <th>:</th>
              <th style="text-align: left;"> <?php echo $data['email_pelanggan'];  ?></th>
            </tr>
            <tr>
              <td>BTS</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['nama_bts'];  ?></th>
            </tr>
            <tr>
              <td>IP Public</td>
              <th>:</th>
              <th style="text-align: left;"> <?php echo $data['ip'];  ?></th>
            </tr>
            <tr>              
              <td>IP Radio</td>
              <th>:</th>
              <th style="text-align: left;"> <?php echo $data['data_ip_publik'];  ?></th>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>History Trouble</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          
          <?php
          $query_2=mysqli_query($koneksi,"SELECT teknisi_maintenance.tanggal_komplen, teknisi_maintenance.kerusakan, teknisi_maintenance.solusi, teknisi_maintenance.id_teknisi, teknisi_maintenance.partner, teknisi_maintenance.status_kunjungan, teknisi_maintenance.penerima_komplen FROM teknisi_maintenance LEFT JOIN sale_register ON teknisi_maintenance.id_register=sale_register.id_register WHERE teknisi_maintenance.id_register='$id_pelanggan'");
          while($data_2=mysqli_fetch_array($query_2)){
            $id_teknisi = $data_2['id_teknisi'];
            $partner = $data_2['partner'];
            $penerima_komplen = $data_2['penerima_komplen'];
            $query_penerima_komplen = mysqli_query($koneksi,"select * from master_login where id_user='$penerima_komplen'");
            $data_penerima_komplen = mysqli_fetch_array($query_penerima_komplen);
            $nama_penerima_komplen = $data_penerima_komplen['nama_user'];

            $id_teknisi=$data_2['id_teknisi'];
            $query_teknisi = mysqli_query($koneksi,"select * from master_login where id_user='$id_teknisi'");
            $data_teknisi = mysqli_fetch_array($query_teknisi);
            $nama_teknisi = $data_teknisi['nama_user'];
            $pecah_nama_teknisi = explode(" ", $nama_teknisi);

            $partner=$data_2['partner'];
            $query_partner=mysqli_query($koneksi,"select * from master_login where id_user='$partner'");
            $jumlah_query_partner=mysqli_num_rows($query_partner);
            if($jumlah_query_partner>=1){
              $tampil_partner=mysqli_fetch_array($query_partner);
              $data_partner=$tampil_partner['nama_user'];
            } else {
              $data_partner=$data_2['partner'];
            }
            $pecah_data_partner = explode(" ", $data_partner);

            $teknisi = $pecah_nama_teknisi['0']." & ".$pecah_data_partner['0'];
            if(empty($data_partner)){
              $teknisi = $pecah_nama_teknisi['0'];
            }
          ?>
          <br>
          ~> Tanggal : <b><?php echo $data_2['tanggal_komplen']; ?></b><br>
          &nbsp; &nbsp; &nbsp; CS : <b><?php echo $nama_penerima_komplen;?></b><br>
          &nbsp; &nbsp; &nbsp; Kerusakan : <b><?php echo $data_2['kerusakan'];?></b><br>
          &nbsp; &nbsp; &nbsp; Penanganan : <b><?php echo $data_2['status_kunjungan'];?></b><br>
          &nbsp; &nbsp; &nbsp; Solusi : <b><?php echo $data_2['solusi'];?></b><br>
          &nbsp; &nbsp; &nbsp; Teknisi : <b><?php echo $teknisi;?></b><br></a><br>
          <?php
          }
          ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>