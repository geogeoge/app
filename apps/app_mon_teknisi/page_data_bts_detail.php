<?php
include "../../koneksi/koneksi.php";
    
    $id_bts=$_GET['id_bts'];

    $sql="SELECT mon_databts.id_bts,
            mon_databts.nama_bts,
            mon_databts.kontak,
            mon_databts.telepon_bts,
            mon_databts.id_parent,
            mon_databts.kapasitas_bts,
            mon_ipbts.ip_bts,
            mon_lokasibts.lokasi_bts
        FROM mon_databts
        LEFT JOIN mon_ipbts ON mon_databts.id_bts=mon_ipbts.id_bts
        LEFT JOIN mon_lokasibts ON mon_databts.lokasi=mon_lokasibts.id_lokasi_bts
        WHERE mon_databts.id_bts='$id_bts'";
    $query=mysqli_query($koneksi,$sql);
    $data=mysqli_fetch_array($query);
    
    $id_parent=$data['id_parent'];
    $sql_parent="SELECT nama_bts FROM mon_databts WHERE id_bts='$id_parent'";
    $query_parent=mysqli_query($koneksi,$sql_parent);
    $data_parent=mysqli_fetch_array($query_parent);

?>
<section class="content-header">
  <h1>
    Detail Data BTS
    <small><?php echo $data['nama_bts'];  ?></small>
    <a href="index.php?page=page_data_bts" class="btn btn-danger pull-right">Kembali</a>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Data BTS #<?php echo $data['nama_bts'];  ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <td width="200">Nama BTS</td>
              <th width="5">:</th>
              <th style="text-align: left;"><?php echo $data['nama_bts'];  ?></th>
            </tr>
            <tr>
              <td>SSID</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['kontak'];  ?></th>
            </tr>
            <tr>
              <td>Telepon BTS</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['telepon_bts'];  ?></th>
            </tr>
            <tr>
              <td>IP BTS</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['ip_bts'];  ?></th>
            </tr>
            <tr>
              <td>Parent BTS</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data_parent['nama_bts'];  ?></th>
            </tr>
            <tr>
              <td>Lokasi BTS</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['lokasi_bts'];  ?></th>
            </tr>
            <tr>
              <td>Kapasitas BTS</td>
              <th>:</th>
              <form method="POST" action="update_kapasitas.php?id_bts=<?php echo $data['id_bts']; ?>">
                <th style="text-align: left;">
                    <input type="number" name="kapasitas" value="<?php echo $data['kapasitas_bts'];  ?>">
                    <input type="submit" value="Update Kapasitas" class="btn btn-md btn-primary">
                </th>
              </form>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>