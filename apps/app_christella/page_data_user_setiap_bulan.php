<?php
$tahun = date('Y');
if(isset($_GET['tahun'])){
    $tahun = $_GET['tahun'];
}
?>
<section class="content-header">
  <h1 class="">
    Data User Baru
    <small>SoloNet</small>
    <div class="tombol_tambah">
      <a href="excel_data_user_setiap_bulan.php" class="btn btn-primary">&nbsp;Download Excel</a>
    </div>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Rekap User</h3>
        </div>
        <?php include "modal_ganti_tahun.php";?>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="10" rowspan="2">No</th>
              <th width="300" rowspan="2">Nama User</th>
              <th colspan="12">
                  <a href="#ganti_tahun" role="button"  data-target="#ganti_tahun" data-toggle="modal"><?php echo $tahun;?></a>
              </th>
            </tr>
            <tr>
              <th width="100">Januari</th>
              <th width="100">Februari</th>
              <th width="100">Maret</th>
              <th width="100">April</th>
              <th width="100">Mei</th>
              <th width="100">Juni</th>
              <th width="100">Juli</th>
              <th width="100">Agustus</th>
              <th width="100">September</th>
              <th width="100">Oktober</th>
              <th width="100">November</th>
              <th width="100">Desember</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi,"select * from sale_register");
            while($data = mysqli_fetch_array($query)){
              $id_register = $data['id_register'];

              echo "<tr>";
              echo "<td>$no</td>";
              echo "<td>".$data['nama_user']."</td>";

              for ($i= 1; $i <= 12; $i++)
              { 
                if($i<10){
                  $i = "0".$i;
                }
                $bulan = $tahun."-".$i;
                $query_log = mysqli_query($koneksi,"select * from billing_backup_log_user left join sale_paket_internet on billing_backup_log_user.id_paket=sale_paket_internet.id_paket where billing_backup_log_user.id_register='$id_register' and billing_backup_log_user.bulan like '%$bulan%'");
                $data_log = mysqli_fetch_array($query_log);
                echo "<td align='right'>".number_format($data_log['harga'],0,',','.')."</td>";
              }
              $no++;
              echo "<tr>";
            }
            ?>
            </tbody>
            <tfoot>
              <tr>
                <th></th>
                <th>TOTAL</th>
                <th><?php echo number_format($crud->cek_total_log("01",$tahun),0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("02",$tahun),0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("03",$tahun),0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("04",$tahun),0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("05",$tahun),0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("06",$tahun),0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("07",$tahun),0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("08",$tahun),0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("09",$tahun),0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("10",$tahun),0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("11",$tahun),0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("12",$tahun),0,',','.'); ?></th>
              </tr>
              <tr></tr>
                <th></th>
                <th>BHP</th>
                <th><?php echo number_format($crud->cek_total_log("01",$tahun)/50,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("02",$tahun)/50,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("03",$tahun)/50,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("04",$tahun)/50,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("05",$tahun)/50,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("06",$tahun)/50,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("07",$tahun)/50,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("08",$tahun)/50,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("09",$tahun)/50,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("10",$tahun)/50,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("11",$tahun)/50,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("12",$tahun)/50,0,',','.'); ?></th>
              </tr>
              <tr></tr>
                <th></th>
                <th>USO</th>
                <th><?php echo number_format($crud->cek_total_log("01",$tahun)/125,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("02",$tahun)/125,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("03",$tahun)/125,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("04",$tahun)/125,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("05",$tahun)/125,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("06",$tahun)/125,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("07",$tahun)/125,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("08",$tahun)/125,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("09",$tahun)/125,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("10",$tahun)/125,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("11",$tahun)/125,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("12",$tahun)/125,0,',','.'); ?></th>
              </tr>
              <tr></tr>
                <th></th>
                <th>PPN</th>
                <th><?php echo number_format($crud->cek_total_log("01",$tahun)/1.1/10,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("02",$tahun)/1.1/10,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("03",$tahun)/1.1/10,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("04",$tahun)/1.1/10,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("05",$tahun)/1.1/10,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("06",$tahun)/1.1/10,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("07",$tahun)/1.1/10,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("08",$tahun)/1.1/10,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("09",$tahun)/1.1/10,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("10",$tahun)/1.1/10,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("11",$tahun)/1.1/10,0,',','.'); ?></th>
                <th><?php echo number_format($crud->cek_total_log("12",$tahun)/1.1/10,0,',','.'); ?></th>
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

