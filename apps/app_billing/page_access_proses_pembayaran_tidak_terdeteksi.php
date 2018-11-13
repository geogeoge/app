<?php
$id_pembayaran=$_GET['id_pembayaran'];
?>
<section class="content-header">
  <h1 class="">
    Proses Transaksi Tidak Terdeteksi
    <small>Per-User</small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Transaksi Yang Tidak Terdeteksi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="100">Waktu</th>
              <th width="80">Bank</th>
              <th>Keterangan</th>
              <th>Nominal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_proses_pembayaran_tidak_terdeteksi($id_pembayaran) as $data) {
            ?>
            <tr>
              <td align="center" width="10"><?php echo date('d-m-Y H:m:s', strtotime($data['waktu_pembayaran'])); ?></td>
              <td align="center"><?php echo $data['bank']; ?></td>
              <td align="left"><?php echo $data['keterangan']; ?></td>
              <td align="right"><?php echo number_format($data['nominal'],0,',','.'); ?></td>
            </tr>
          <?php
          $no++;
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th width="50">Waktu</th>
              <th width="80">Bank</th>
              <th>Keterangan</th>
              <th>Nominal</th>
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

  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data User</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="10">No</th>
              <th>User</th>
              <th>Tunggakan</th>
              <th>Nominal</th>
              <th>Sisa Pembayaran</th>
              <th width="50">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_tagihan() as $data) {
            $id_register=$data['id_register'];
            $id_paket=$data['id_paket'];
            $ip_publik=$data['ip_publik'];
            $tunggakan=$data['(billing_bulan_berjalan-billing_bulan_terbayar)'];
            $query_paket=mysqli_query($koneksi,"select * from sale_paket_internet where id_paket='$id_paket'");
            $tampil_paket=mysqli_fetch_array($query_paket);
            $harga=$tampil_paket['harga'];
            if($ip_publik=="IYA"){
              $harga=$harga+100000;
            }
            $nominal_tunggakan=$harga*$tunggakan;
            ?>
            <tr>
              <td align="center" width="10"><?php echo $no; ?></td>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="center"><?php echo $tunggakan; ?></td>
              <td align="right"><?php echo number_format($nominal_tunggakan,0,',','.'); ?></td>
              <td align="right"><?php echo number_format($data['billing_saldo'],0,',','.'); ?></td>
              <td width="50" align="center">
                <a href="#modal_konfirmasi_pembayaran_tidak_terdeteksi<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_konfirmasi_pembayaran_tidak_terdeteksi<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-success">&nbsp;<i class="fa fa-check"></i></a>
              </td>
            </tr>
          <?php
          $no++;
          include "modal_access_konfirmasi_proses_pembayaran_tidak_terdeteksi.php";
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th width="10">No</th>
              <th>User</th>
              <th>Tunggakan</th>
              <th>Nominal</th>
              <th>Sisa Pembayaran</th>
              <th>Action</th>
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

