<?php
$id_register=$_GET['id_register'];
foreach($crud->select_tagihan_user_baru($id_register) as $data) {
	$id_register = $data['id_register'];
	$query_billing_tagihan = mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
	$tampil_billing_tagihan = mysqli_fetch_array($query_billing_tagihan);
	$sisa_pembayaran = $tampil_billing_tagihan['billing_saldo'];

  $query_register = mysqli_query($koneksi,"select * from sale_register where id_register='$id_register'");
  $tampil_register = mysqli_fetch_array($query_register);

	$nominal_po = $data['biaya_registrasi'] + $data['monthly_fee'];

  if($data['status_radio']=="BELI") {
    $nominal_po = $nominal_po + $data['harga_radio'];
  }
  if($data['status_antena']=="BELI") {
    $nominal_po = $nominal_po + $data['harga_antena'];
  }
  if($data['status_wifi']=="BELI") {
    $nominal_po = $nominal_po + $data['harga_wifi'];
  }
  if($data['status_kabel']=="BELI") {
    $nominal_po = $nominal_po + $data['harga_kabel'];
  }
  if($data['status_tower']=="BELI") {
    $nominal_po = $nominal_po + $data['harga_tower'];
  }
  if($data['status_tambahan_1']=="BELI") {
    $nominal_po = $nominal_po + $data['harga_tambahan_1'];
  }
  if($data['status_tambahan_2']=="BELI") {
    $nominal_po = $nominal_po + $data['harga_tambahan_2'];
  }

  $ppn = 0;
  $tampil_status_ppn = '<i class="fa fa-close"></i>';
  $update_status_ppn = "IYA";

  $status_ppn = $data['ppn'];
  if($status_ppn=="IYA") {
    $ppn = $nominal_po / 10;
    $tampil_status_ppn = '<i class="fa fa-check"></i>';
    $update_status_ppn = "TIDAK";
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
                <input type="text" name="id_register" hidden="hidden" id="inputPassword3" value="<?php echo $data['id_register'];?>"  readonly="readonly">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Via</label>
              <div class="col-sm-6">
                <select class="form-control" name="via" required="required">
                  <option selected="selected" disabled></option>
                  <option value="1">TUNAI</option>
                  <option value="2">BCA</option>
                  <option value="3">BNI</option>
                  <option value="4">BRI</option>
                  <option value="5">MANDIRI</option>
                  <option value="6">BPD</option>
                </select>
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-2">
                <input type="date" id="inputku" class="form-control" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
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
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Catatan</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="catatan" rows="3"></textarea>  
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">&nbsp;</label>
              <div class="col-sm-10">
                <input type="checkbox" name="penagih" value="eko"> &nbsp;<label for="dewey">Pak Eko</label>&nbsp;&nbsp;&nbsp;  
              </div>
		    </div>
          </div>
		  <?php
            include "modal_access_konfirmasi_pembayaran_register.php";
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