<div class="modal fade" id="modal_edit_data_pelanggan<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>FROM EDIT DATA PELANGGAN</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_register" id="inputEmail" class = "form-control" value="<?php echo $data['id_register']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama User</label>
					<div class="col-sx-10">
						<input type="text" name="nama_user" id="inputEmail" class = "form-control" value="<?php echo $data['nama_user']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Telp</label>
					<div class="col-sx-10">
						<input type="text" name="telp" id="inputEmail" class = "form-control" value="<?php echo $data['telp']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">IP Radio</label>
					<div class="col-sx-10">
						<input type="text" name="ip" id="inputEmail" class = "form-control" value="<?php echo $data['ip']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">IP Public</label>
					<div class="col-sx-10">
						<input type="text" name="data_ip_publik" id="inputEmail" class = "form-control" value="<?php echo $data['data_ip_publik']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">BTS</label>
					<div class="col-sx-10">
						<select class = "form-control" name="id_bts" required="required">
                  			<option selected="selected" value=""></option>
							<?php
				            foreach($select->select_data_bts() as $data_bts) {
				            	$id_bts=$data['id_bts'];
				            	$selected="";
				            	if($id_bts==$data_bts['id_bts']){
				            		$selected="selected='selected'";
				            	}
				            ?>
							<option value="<?php echo $data_bts['id_bts'];?>" <?php echo $selected;?>><?php echo $data_bts['nama_bts'];?></option>
							<?php
							}
							?>
						</select>  
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_edit_sale_register" class="btn btn-info">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                