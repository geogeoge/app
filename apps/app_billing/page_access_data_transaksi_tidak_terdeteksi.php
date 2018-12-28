<?php
$bank=$_GET['bank'];
if(empty($_GET['bank'])) {
  $bank="BCA";
}
?>
<section class="content-header">
  <h1>
    <a href="?page=page_access_data_transaksi_tidak_terdeteksi&bank=BCA" class="btn btn-info">BCA</a>&nbsp;<a href="?page=page_access_data_transaksi_tidak_terdeteksi&bank=BNI" class="btn btn-info">BNI</a>&nbsp;<a href="?page=page_access_data_transaksi_tidak_terdeteksi&bank=BRI" class="btn btn-info">BRI</a>&nbsp;<a href="?page=page_access_data_transaksi_tidak_terdeteksi&bank=MANDIRI" class="btn btn-info">MANDIRI</a>&nbsp;<a href="?page=page_access_data_transaksi_tidak_terdeteksi&bank=BPD" class="btn btn-info">BPD</a>
    <small>Bank</small>
    <div class="tombol_tambah">
      <a href="#import" role="button"  data-target = "#import" data-toggle="modal" class="btn btn-primary">&nbsp;Import Axcel</a>
      <a href="#tambah_pembayaran" role="button"  data-target = "#tambah_pembayaran" data-toggle="modal" class="btn btn-primary">&nbsp;Tambah</a>
    </div>
  </h1>
</section>
<?php include "modal_access_import.php"; ?>
<?php include "modal_access_tambah_pembayaran_tidak_terdeteksi.php"; ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Transaksi Yang Tidak Terdeteksi Di Bank <strong><?php echo $bank; ?></strong></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th width="50">Waktu</th>
              <th>Keterangan</th>
              <th>Nominal</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_pembayaran_tidak_terdeteksi($bank) as $data) {
            
            ?>
            <tr>
              <td align="center" width="10"><?php echo date('d-m-Y H:m:s', strtotime($data['waktu_pembayaran'])); ?></td>
              <td align="left"><?php echo $data['keterangan']; ?></td>
              <td align="right"><?php echo number_format($data['nominal'],0,',','.'); ?></td>
              <td width="150" align="center">
                <a href="?page=page_access_proses_pembayaran_tidak_terdeteksi&id_pembayaran=<?php echo $data['id_pembayaran_tidak_terdeteksi']; ?>" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Proses</a>
                <a href="#modal_konfirmasi<?php echo $data['id_pembayaran_tidak_terdeteksi']; ?>" role="button"  data-target = "#modal_konfirmasi<?php echo $data['id_pembayaran_tidak_terdeteksi']; ?>" data-toggle="modal" class="btn btn-danger">&nbsp;Delete</a>
              </td>
            </tr>
          <?php
          include "modal_access_konfirmasi_hapus_pembayaran_tidak_teridentifikasi.php";
          $no++;
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th width="50">Waktu</th>
              <th>Keterangan</th>
              <th>Nominal</th>
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

