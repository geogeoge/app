<div class="modal fade" id="edit<?php echo $data['id_temp']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-success"><strong><center>EDIT DATA TRANSAKSI</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_temp" id="inputEmail" class = "form-control" value="<?php echo $data['id_temp']; ?>">
					</div>
				</div>
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="no_log_pembayaran" id="inputEmail" class = "form-control" value="<?php echo $data['no_log_pembayaran']; ?>">
					</div>
				</div>
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">in_out</label>
					<div class="col-sx-10">
						<input type="text" name="in_out" id="inputEmail" class = "form-control" value="<?php echo $data['in_out']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Tanggal</label>
					<div class="col-sx-10">
						<input type="date" name="tanggal" id="inputEmail" class = "form-control" value="<?php echo date('Y-m-d', strtotime($data['tanggal']));?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Keterangan</label>
					<div class="col-sx-10">
						<textarea class="form-control" name="keterangan" rows="3"><?php echo $inti_keterangan;?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sx-12">
					    <input type="radio" name="tambahan" value="" <?php echo $checked_kosongan;?>> &nbsp;<label for="dewey">Kosongan</label>&nbsp;&nbsp;&nbsp;
						<input type="radio" name="tambahan" value="nota" <?php echo $checked_nota;?>> &nbsp;<label for="dewey">Pembayaran No Nota</label>&nbsp;&nbsp;&nbsp;
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nominal</label>
					<div class="col-sx-10">
                		<input type="text" id="inputku" class="form-control" name="nominal" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?php echo number_format($data['nominal'],0,',','.');?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Via</label>
					<div class="col-sx-10">
						<select class="form-control" name="id_account" required="required">
		                  <option selected="selected" disabled="disabled"></option>
		                  <option value="1" <?php echo $selected_1;?>>TUNAI</option>
		                  <option value="2" <?php echo $selected_2;?>>BCA</option>
		                  <option value="3" <?php echo $selected_3;?>>BNI</option>
		                  <option value="4" <?php echo $selected_4;?>>BRI</option>
		                  <option value="5" <?php echo $selected_5;?>>MANDIRI</option>
		                  <option value="6" <?php echo $selected_6;?>>BPD</option>
		                </select>
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "edit_log_pembyaran" class="btn btn-success">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                