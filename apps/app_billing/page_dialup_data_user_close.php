<section class="content-header">
  <h1 class="">
    Data Tagihan
    <small>Per-User</small>
    <div class="tombol_tambah">
      <a href="#tambah_pembayaran" role="button"  data-target = "#tambah_pembayaran" data-toggle="modal" class="btn btn-primary">&nbsp;Transaksi Tidak Teridentifikasi</a>
    </div>
  </h1>
</section>
<?php include "modal_access_tambah_pembayaran_tidak_terdeteksi.php"; ?>

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
              <th width="10">ID</th>
              <th>Nama Costumer</th>
              <th>Nama Company</th>
              <th>Monthly Fee</th>
              <th>Quota</th>
              <th>Tunggakan</th>
              <th>Saldo</th>
              <th>Biaya Tagihan</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($crud->select_tagihan_dialup_close() as $data) {
              $costumer_id = $data['costumer_id'];
              $costumer_name = $data['costumer_name'];
              $company_name = $data['company_name'];
              $user_id = $data['user_id'];
            ?>
            <tr>
              <td align="center" width="10"><?php echo $data['costumer_id']; ?></td>
              <td align="left"><?php echo $costumer_name; ?></td>
              <td align="left"><?php echo $company_name; ?></td>
              <td align="right"><a href="#modal_detail<?php echo $costumer_id; ?>" role="button"  data-target = "#modal_detail<?php echo $costumer_id; ?>" data-toggle="modal"><font color="black"><?php echo number_format($data['billing_monthly_fee'],0,',','.'); ?></font></a></td>
              <td align="right"><?php echo number_format($data['billing_email'],0,',','.'); ?></td>
              <td align="right"><?php echo number_format($tunggakan,0,',','.'); ?></td>
              <td align="right"><?php echo number_format($saldo,0,',','.'); ?></td>
              <td align="center" width="10"><a href="?page=page_dialup_tagihan_bulanan&update_biaya_penagihan=<?php echo $update_status_biaya; ?>&costumer_id=<?php echo $costumer_id; ?>" class="btn btn-default"><?php echo $simbol_biaya_penagihan; ?></a></td>
              <td align="right"><?php echo $data['status']; ?></td>
              <td width="150" align="center">
                <a href="?page=page_dialup_input_pembayaran_bulanan&costumer_id=<?php echo $costumer_id; ?>" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Bayar</a>
                <a href="pdf_dialup_invoice_bulanan_baru.php?costumer_id=<?php echo $costumer_id; ?>" class="btn btn-info" target="_blank"><i class="fa fa-print"></i></a>
                <a href="pdf_dialup_invoice_bulanan.php?id_register=<?php echo $id_register; ?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i></a>
              </td>
            </tr>
          <?php
          $no++;
            include "modal_dialup_detail_tagihan.php";
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th width="10">ID</th>
              <th>Nama Costumer</th>
              <th>Monthly Fee</th>
              <th>Quota</th>
              <th>Tunggakan</th>
              <th>Saldo</th>
              <th>Biaya Tagihan</th>
              <th>Biaya Tagihan</th>
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

