<?php
$id_po=$_GET['id_po'];
foreach($crud->select_tagihan_user_baru($id_po) as $data) {
	$id_register = $data['id_register'];
	$query_billing_tagihan = mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
	$tampil_billing_tagihan = mysqli_fetch_array($query_billing_tagihan);
	$sisa_pembayaran = $tampil_billing_tagihan['billing_saldo'];

  $query_register = mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
  $tampil_register = mysqli_fetch_array($query_register);

	$nominal_po = $data['biaya_registrasi'] + $data['money_fee'] + $data['biaya_ip_publik'] + $data['harga_radio'] + $data['harga_antena'] + $data['harga_wifi'] + $data['harga_kabel'] + $data['harga_tower'] ;
	$ppn = $nominal_po / 10;
  
  $status_ppn = $data['ppn'];
  if($status_ppn=="TIDAK") {
    $ppn = 0;
    $tampil_status_ppn = '<i class="fa fa-close"></i>';
    $update_status_ppn = "IYA";
  }
	$total_po = $nominal_po + $ppn;
	$total_po = $total_po - $sisa_pembayaran;
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
          <h3 class="box-title">Form Input Transaksi Registasi</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama User</label>
              <div class="col-sm-10">
                <input type="text" name="nana_user" class="form-control" id="inputPassword3" value="<?php echo $tampil_register['nama_user'];?>" readonly="readonly">
                <input type="text" name="id_po" hidden="hidden" id="inputPassword3" value="<?php echo $data['id_po'];?>"  readonly="readonly">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Via</label>
              <div class="col-sm-10">
                <select class="form-control" name="via">
                  <option selected="selected" disabled></option>
                  <option>TUNAI</option>
                  <option>BCA</option>
                  <option>BNI</option>
                  <option>BRI</option>
                  <option>MANDIRI</option>
                  <option>BPD</option>
                  <option>MANDIRI</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nominal Bayar</label>
              <div class="col-sm-10">
                <input type="text" id="inputku" class="form-control" name="bayar" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php echo number_format($total_po,0,',','.');?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Restitusi</label>
              <div class="col-sm-10">
                <input type="text" id="inputku" class="form-control" name="restitusi" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="0">
              </div>
            </div>
          </div>
		  <?php
		  if($sisa_pembayaran>=1) {
		  ?>
		  <div class="form-group">
              <label for="inputPassword3" class="col-sm-12">*) Sebelumnya sudah membayar Rp. <?php echo number_format($sisa_pembayaran,0,',','.'); ?><label for="inputPassword3" class="col-sm-2 control-label">
		  </div>
		  <?php
		  }
		  ?>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="?page=page_access_invoice_user_baru" class="btn btn-default">Cancel</a>
            <button name="proses_transaksi_user_baru" type="submit" class="btn btn-info pull-right">Bayar</button>
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