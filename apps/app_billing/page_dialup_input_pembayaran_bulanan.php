<?php
$costumer_id=$_GET['costumer_id'];
foreach($crud->select_tagihan_dialup_peruser($costumer_id) as $data) {
  $tunggakan=$data['billing_bulan_berjalan']-$data['billing_bulan_terbayar'];
  $billing_monthly_fee=$data['billing_monthly_fee'];
  $billing_email=$data['billing_email'];
  $billing_biaya_penagihan=$data['biaya_penagihan'];

  $biaya_semua=$billing_monthly_fee+$billing_email+$billing_biaya_penagihan;
  $total_tagihan=$tunggakan*$biaya_semua;
?>
<section class="content-header">
  <h1>
    Data Transaksi
    <small>Input</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">      
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Form Input Transaksi Pembayaran</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama User</label>
              <div class="col-sm-10">
                <input type="text" name="nama_user" class="form-control" id="inputPassword3" value="<?php echo $data['costumer_name'];?>" readonly="readonly">
                <input type="text" name="id_register" hidden="hidden" id="inputPassword3" value="<?php echo $data['costumer_id'];?>"  readonly="readonly">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Via</label>
              <div class="col-sm-10">
                <select class="form-control" name="via" required="required">
                  <option selected="selected" disabled="disabled"></option>
                  <option>TUNAI</option>
                  <option>BCA</option>
                  <option>BNI</option>
                  <option>BRI</option>
                  <option>MANDIRI</option>
                  <option>BPD</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nominal Bayar</label>
              <div class="col-sm-10">
                <input type="text" id="inputku" class="form-control" name="bayar" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php echo number_format($total_tagihan,0,',','.');?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Restitasi</label>
              <div class="col-sm-10">
                <input type="text" id="inputku" class="form-control" name="restitusi" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="0">
              </div>
            </div>
          </div>
          <?php include "modal_access_konfirmasi_pembayaran_tagihan_bulanan.php"; ?>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="?page=page_access_tagihan_bulanan" class="btn btn-default">Cancel</a>
            <a href="#konfirmasi_pembayaran" role="button"  data-target = "#konfirmasi_pembayaran" data-toggle="modal" class="btn btn-primary pull-right">Bayar</a>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<?php
}
?>