<?php
$tunggakan = $_GET['tunggakan'];
$bulan_ini = $_GET['bulan_ini'];

?>
<section class="content-header">
  <h1 class="">
    Data Piutang Di Bulan <strong><?php echo $bulan_indonesia[$bulan_ini]; ?></strong>
    <small>Per-User</small>
    <div class="tombol_tambah">
      <a href="?page=page_access_detail_piutang_perbulan" class="btn btn-primary">&nbsp;Kembali</a>
    </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data Tagihan</h3>
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
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_tagihan_bulan($tunggakan) as $data) {
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
              <td width="150" align="center">
                <a href="?page=page_access_input_pembayaran_bulanan&id_register=<?php echo $id_register; ?>" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Bayar</a>
                <a href="pdf_access_invoice_bulanan_baru.php?id_register=<?php echo $id_register; ?>" class="btn btn-info" target="_blank"><i class="fa fa-print"></i></a>
                <a href="pdf_access_invoice_bulanan.php?id_register=<?php echo $id_register; ?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i></a>
              </td>
            </tr>
          <?php
          $no++;
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

