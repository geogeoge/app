<div class="modal fade" id="modal_kas_masuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>INPUT KAS MASUK</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Tanggal</label>
					<div class="col-sx-10">
						<input type="date" name="tanggal" id="inputEmail" class = "form-control" value="<?php echo date('Y-m-d');?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Keterangan</label>
					<div class="col-sx-10">
						<textarea class="form-control" name="keterangan" rows="3"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sx-12">
					    <input type="radio" name="tambahan" value="" checked> &nbsp;<label for="dewey">Kosongan</label>&nbsp;&nbsp;&nbsp;
						<input type="radio" name="tambahan" value="internet"> &nbsp;<label for="dewey">Internet</label>&nbsp;&nbsp;&nbsp;
						<input type="radio" name="tambahan" value="dialup"> &nbsp;<label for="dewey">Dial Up</label>&nbsp;&nbsp;&nbsp;
						<input type="radio" name="tambahan" value="userbaru"> &nbsp;<label for="dewey">User Baru</label>&nbsp;&nbsp;&nbsp;
						<input type="radio" name="tambahan" value="alat"> &nbsp;<label for="dewey">Alat</label>&nbsp;&nbsp;&nbsp;
						<input type="radio" name="tambahan" value="webhosting"> &nbsp;<label for="dewey">WEB & Hosting</label>&nbsp;&nbsp;&nbsp;
					</div>
				</div>
				<div class="form-group">
					<div class="col-sx-12">
						<input type="checkbox" name="penagih" value="eko"> &nbsp;<label for="dewey">Pak Eko</label>&nbsp;&nbsp;&nbsp;
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nominal</label>
					<div class="col-sx-10">
                		<input type="text" id="inputku" class="form-control" name="nominal" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php echo number_format($nominal_tunggakan,0,',','.');?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Via</label>
					<div class="col-sx-10">
						<select class="form-control" name="id_account" required="required">
		                  <option selected="selected" disabled="disabled"></option>
		                  <option value="1">TUNAI</option>
		                  <option value="2">BCA</option>
		                  <option value="3">BNI</option>
		                  <option value="4">BRI</option>
		                  <option value="5">MANDIRI</option>
		                  <option value="6">BPD</option>
		                </select>
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name="insert_daily_masuk" class="btn btn-info">SIMPAN</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                