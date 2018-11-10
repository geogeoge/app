<div class="modal fade" id="edit_transaksi_harian<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>EDIT DATA TRANSAKSI</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="no" id="inputEmail" class = "form-control" value="<?php echo $data['no']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama User</label>
					<div class="col-sx-10">
						<input type="text" name="nama_user" id="inputEmail" class = "form-control" value="<?php echo $data['nama_user']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kode Room</label>
					<div class="col-sx-10">
					<select class="form-control" name="via">
					  <?php
					  $via = $data['via']; 
					  if($via=="TUNAI") {
					  	$selected_tunai="selected";
					  	$selected_bca="";
					  	$selected_bni="";
					  	$selected_mandiri="";
					  } else
					  if($via=="BCA") {
					  	$selected_tunai="";
					  	$selected_bca="selected";
					  	$selected_bni="";
					  	$selected_mandiri="";
					  } else
					  if($via=="BNI") {
					  	$selected_tunai="";
					  	$selected_bca="";
					  	$selected_bni="selected";
					  	$selected_mandiri="";
					  } else
					  if($via=="MANDIRI") {
					  	$selected_tunai="";
					  	$selected_bca="";
					  	$selected_bni="";
					  	$selected_mandiri="selected";
					  }
					  ?>
	                  <option disabled></option>
	                  <option <?php echo $selected_tunai; ?>>TUNAI</option>
	                  <option <?php echo $selected_bca; ?>>BCA</option>
	                  <option <?php echo $selected_bni; ?>>BNI</option>
	                  <option <?php echo $selected_mandiri; ?>>MANDIRI</option>
	                </select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nominal Bayar</label>
					<div class="col-sx-10">
						<input type="text" name="bayar" id="inputEmail" class = "form-control" value="<?php echo $data['bayar']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Restitasi</label>
					<div class="col-sx-10">
						<input type="text" name="restitasi" id="inputEmail" class = "form-control" value="<?php echo $data['restitasi']; ?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "update_data_ruang" class="btn btn-primary">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>