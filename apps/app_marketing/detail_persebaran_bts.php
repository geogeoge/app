<?php
include "../../koneksi/koneksi.php";
    $id_lokasi = $_GET['id_lokasi'];
    $sql="SELECT * FROM  mon_databts WHERE lokasi='$id_lokasi'";
    $query=mysqli_query($koneksi,$sql);   

    //HITUNG TOTAL KAPASITAS
    $total_kapasitas=0;
    $sql_kapasitas="SELECT * FROM  mon_databts WHERE lokasi='$id_lokasi'";
    $query_kapasitas=mysqli_query($koneksi,$sql_kapasitas);
    while($data_kapasitas=mysqli_fetch_array($query_kapasitas)){
        $total_kapasitas = $total_kapasitas + $data_kapasitas['kapasitas_bts'];
    }
    
    //HITUNG TOTAL USER
      $total_user=0;
      $sql_jml="SELECT * FROM  mon_databts WHERE lokasi='$id_lokasi'";
      $query_jml=mysqli_query($koneksi,$sql_jml);
      while($data_jml_user=mysqli_fetch_array($query_jml)){
        $id_bts2=$data_jml_user['id_bts'];
        $sql_jml2="SELECT count(id_pelanggan) as jml_user2 FROM mon_pelanggan WHERE id_bts='$id_bts2'";
        $query_jml2=mysqli_query($koneksi,$sql_jml2);
        $data_total_user=mysqli_fetch_array($query_jml2);
      
        $total_user=$total_user+$data_total_user['jml_user2'];
      }

      //AMBIL NAMA BTS
      $sql2="SELECT * FROM  mon_lokasibts WHERE id_lokasi_bts='$id_lokasi'";
      $query2=mysqli_query($koneksi,$sql2);
      $data2=mysqli_fetch_array($query2);
?>
<section class="content-header">
  <h1>
    Data Persebaran BTS <b><?php echo $data2['lokasi_bts']; ?></b>
    <br>
    <small>
      <b>Total Kapasitas User&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $total_kapasitas; ?></b>
    </small>
    <br>
    <small>  
      <b>Total Terpakai User&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  <?php echo $total_user; ?></b>
    </small>
    <br>
    <?php
        $sisa_kapasitas = $total_kapasitas - $total_user;
    ?>
    <small>
      <b>Total Belum Terpakai&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $sisa_kapasitas; ?></b>
    </small>
    <br>
    <?php
        $persentase = ($total_user / $total_kapasitas) * 100;
    ?>
    <small>  
      <b>Persentase Kapasitas Terpakai :  <?php echo $persentase; ?>%</b>
    </small>
    <a href="index.php?page=page_data_persebaran" class="btn btn-danger pull-right">Kembali</a>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">                
          
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th style="text-align: left;" hidden="hidden">ID BTS</th>
              <th style="text-align: left;">Nama BTS</th>
              <th style="text-align: left;">Kapasitas User</th>
              <th style="text-align: left;">Jumlah User</th>
              <th style="text-align: left;">Belum Terpakai</th>
              <!--<th style="text-align: center;">Detail</th>-->
            </tr>
            </thead>
            <tbody>
            <?php
             while($data=mysqli_fetch_array($query)){
                
                $id_bts=$data['id_bts'];
                $sql_jml_user="SELECT count(id_pelanggan) as jml_user FROM mon_pelanggan WHERE id_bts='$id_bts'";
                $query_jml_user=mysqli_query($koneksi,$sql_jml_user);
                $data_user=mysqli_fetch_array($query_jml_user);
                $belum_terpakai= $data['kapasitas_bts'] - $data_user['jml_user'];
            ?>
            <a href="#">
            <tr>
              <td align="left" hidden="hidden"><?php echo $data['id_bts']; ?></td>

              <td align="left"><?php echo $data['nama_bts']; ?></td>

              <td align="left"><?php echo $data['kapasitas_bts']; ?></td>

              <td align="left"><?php echo $data_user['jml_user']; ?></td>

              <td align="left"><?php echo $belum_terpakai; ?></td>
              <!--
              <td width="50" align="center">
                <center>
                    <div id="thanks">
                        <a class="btn btn-sm btn-primary" data-placement="bottom" data-toggle="tooltip" title="Detail" href="#">
                            <span class="glyphicon glyphicon-search"></span>
                        </a>
                        <a class="btn btn-sm btn-primary" data-placement="bottom" data-toggle="tooltip" title="Detail" href="index.php?page=page_data_bts_edit&id_bts=<?php echo $data['id_bts']; ?>">
                            <span class="glyphicon glyphicon-search"></span>
                        </a>
                    </div>
                </center>
              </td>
              -->
            </tr>
          </a>
          <?php
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th style="text-align: left;" hidden="hidden">ID BTS</th>
              <th style="text-align: left;">Nama BTS</th>
              <th style="text-align: left;">Kapasitas User</th>
              <th style="text-align: left;">Jumlah User</th>
              <th style="text-align: left;">Belum Terpakai</th>
              <!--<th style="text-align: center;">Detail</th>-->
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>