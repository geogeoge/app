<?php
include "../../koneksi/koneksi.php";
    
    $id_lokasi_bts=$_GET['id_lokasi_bts'];

    $sql="SELECT mon_lokasibts.lokasi_bts,
        mon_lokasibts.alamat_bts,
        mon_lokasibts.parent_bts,
        mon_peta_lokasi.longitude,
        mon_peta_lokasi.latitude
        FROM mon_lokasibts
        LEFT JOIN mon_peta_lokasi ON mon_lokasibts.id_lokasi_bts=mon_peta_lokasi.id_lokasi_peta
        WHERE mon_lokasibts.id_lokasi_bts='$id_lokasi_bts'";
    $query=mysqli_query($koneksi,$sql);
    $data=mysqli_fetch_array($query);
    
    $id_parent=$data['parent_bts'];
    $sql_parent="SELECT lokasi_bts FROM mon_lokasibts WHERE id_lokasi_bts='$id_parent'";
    $query_parent=mysqli_query($koneksi,$sql_parent);
    $data_parent=mysqli_fetch_array($query_parent);

?>
<section class="content-header">
  <h1>
    Detail Data Lokasi BTS
    <small><?php echo $data['lokasi_bts'];  ?></small>
    <a href="index.php?page=page_data_lokasi_bts" class="btn btn-danger pull-right">Kembali</a>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Data Lokasi BTS #<?php echo $data['lokasi_bts'];  ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <td width="200">Lokasi BTS</td>
              <th width="5">:</th>
              <th style="text-align: left;"><?php echo $data['lokasi_bts'];  ?></th>
            </tr>
            <tr>
              <td>Alamat BTS</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['alamat_bts'];  ?></th>
            </tr>
            <tr>
              <td>Parent Lokasi BTS</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data_parent['lokasi_bts'];  ?></th>
            </tr>
            <tr>
              <td>Koordinat</td>
              <th>:</th>
              <th style="text-align: left;"><?php echo $data['latitude'];  ?>, <?php echo $data['longitude'];  ?></th>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>