<?php
include "../../koneksi/koneksi.php";

$id_lokasi = $_GET['id_lokasi'];

$isi_data="";
if(isset($_GET['isi_data'])){
  $isi_data = $_GET['isi_data'];
}

$via="nama_bts";

$limit="10";
if(isset($_GET['limit'])){
  $limit = $_GET['limit'];
}

$pagination="1";
if(isset($_GET['pagination'])){
  $pagination = $_GET['pagination'];
}

$limit_awal = $limit * $pagination - $limit;

$limit_akhir=$limit;

$sql="SELECT * FROM mon_databts WHERE lokasi='$id_lokasi'";
$query=mysqli_query($koneksi,$sql);



$total_kapasitas_bts = 0;
$total_user = 0;
$query_data_bts = mysqli_query($koneksi,"SELECT * FROM mon_databts WHERE lokasi='$id_lokasi'");
while($data_bts=mysqli_fetch_array($query_data_bts)){
  $id_bts = $data_bts['id_bts'];
  $kapasitas_bts = $data_bts['kapasitas_bts'];

  $query_sale_register = mysqli_query($koneksi,"SELECT * FROM sale_register WHERE id_bts='$id_bts'");
  $jumlah_sale_register = mysqli_num_rows($query_sale_register);

  $total_user = $total_user + $jumlah_sale_register;

  $total_kapasitas_bts = $total_kapasitas_bts + $kapasitas_bts;
}
?>
<section class="content-header">
  <h1>
    Data Persebaran BTS <b><?php $query_header=mysqli_query($koneksi,"SELECT * FROM mon_lokasibts WHERE id_lokasi_bts='$id_lokasi'"); $data_header=mysqli_fetch_array($query_header); echo $data_header['lokasi_bts']; ?></b> <br>
  </h1>
  <h4>
    <table border="0">
      <tr>
        <td width="250">Total Kapsitas BTS</td>
        <td>:</td>
        <td>&nbsp;<?php echo $total_kapasitas_bts; ?></td>
      </tr>
      <tr>
        <td>Total Jumlah User</td>
        <td>:</td>
        <td>&nbsp;<?php echo $total_user; ?></td>
      </tr>
      <tr>
        <td>Percentage Penggunaaan</td>
        <td>:</td>
        <td>&nbsp;<?php echo number_format($total_user / $total_kapasitas_bts * 100,2,',','.'); ?></td>
      </tr>
    </table>
    <a href="index.php?page=page_data_persebaran" class="btn btn-danger pull-right">Kembali</a>
  </h4>
</section>
<!-- Main content -->

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Radio BTS</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <div class="dataTables_wrapper dt-bootstrap">
            <!-- body table -->
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align: center;">Nama BTS</th>
                      <th colspan="2" style="text-align: center;">Kapasitas</th>
                      <th style="text-align: center;">Total Kapasitas</th>
                      <th style="text-align: center;">Jumlah User</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     $total_kapasitas_bts = 0;
                     $total_user = 0;
                     while($data=mysqli_fetch_array($query)){
                      
                      $id_bts = $data['id_bts'];
                      $kapasitas_bts = $data['kapasitas_bts'];

                      $query_sale_register = mysqli_query($koneksi,"SELECT * FROM sale_register WHERE id_bts='$id_bts'");
                      $jumlah_sale_register = mysqli_num_rows($query_sale_register);
                      
                      $rata_rata_progress = $jumlah_sale_register / $kapasitas_bts * 100;

                      if ($rata_rata_progress <= 30) {
                        $warna_progress_batang = 'success';
                        $warna_progress = 'green';
                      } else
                      if ($rata_rata_progress >= 31 AND $rata_rata_progress <= 60) {
                        $warna_progress_batang = 'primary';
                        $warna_progress = 'blue';
                        $warna_progress_batang = 'warning';
                        $warna_progress = 'yellow';
                      } else
                      if ($rata_rata_progress >= 61 AND $rata_rata_progress <= 90) {
                        $warna_progress_batang = 'warning';
                        $warna_progress = 'yellow';
                      } else
                      if ($rata_rata_progress >= 91) {
                        $warna_progress_batang = 'danger';
                        $warna_progress = 'red';
                      }
                    ?>
                    <tr>
                      <td width="200" align="left"><b><?php echo $data['nama_bts']; ?></b></td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-<?php echo $warna_progress_batang;?>" style="width: <?php echo $rata_rata_progress;?>%"></div>
                        </div>
                      </td>
                      <td align="center" width="50"><span class="badge bg-<?php echo $warna_progress;?>"><?php echo number_format($rata_rata_progress,2,',','.');?>%</span></td>
                      <td width="50" align="center"><b><?php echo $kapasitas_bts; ?></b></td>
                      <td width="50" align="center"><b><?php echo $jumlah_sale_register; ?></b></td>
                    </tr>
                    <?php
                    include "modal_edit_lokasi_bts.php";
                    }
                    //ini tampil jika masih blm ada transaksi
                    if(mysqli_num_rows($query)<=0) {
                      ?>
                      <tr class="odd">
                        <td align="center" valign="top" colspan="5" class="dataTables_empty">Maaf, Data yang kamu cari tidak ada gan !</td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>