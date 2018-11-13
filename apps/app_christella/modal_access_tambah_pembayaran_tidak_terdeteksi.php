<div class="modal fade" id="tambah_pembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>TAMBAH TRANSAKSI TIDAK TERDETEKSI</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
						<label class="control-label" for="inputEmail">Tanggal</label>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
						<label class="control-label" for="inputEmail">Waktu</label>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
						<input class="form-control" name="tanggal" value="<?php echo date('Y-m-d');?>" type="date"  />
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
						<input class="form-control" name="waktu" value="<?php echo date('H:m:s');?>" type="text" />
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
						Bank
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
						<select class="form-control" name="bank" required="required">
		                  <option selected="selected" disabled></option>
		                  <option>BCA</option>
		                  <option>BNI</option>
		                  <option>BRI</option>
		                  <option>MANDIRI</option>
		                  <option>BPD</option>
		                </select>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 " style="padding-bottom: 10px;">
						<label class="control-label" for="inputEmail">Keterangan</label>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
						<textarea style="resize:vertical;" class="form-control" placeholder="Ketarangan..." rows="6" name="keterangan" required="required"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
						Nominal
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
						<input class="form-control" name="nominal" placeholder="Nominal" type="text"  required="required"/>
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "simpan_pembayaran_tidak_terdeteksi" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>