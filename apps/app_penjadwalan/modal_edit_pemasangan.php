<div class="modal fade" id="edit_data_pemasangan<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-success"><strong><center>EDIT DATA PEMASANGAN</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_register" id="inputEmail" class = "form-control" value="<?php echo $data['id_register']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">IP</label>
					<div class="col-sx-10">
						<input type="text" name="ip" id="inputEmail" class = "form-control" value="<?php echo $data['ip']; ?>" required="required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">BTS</label>
					<div class="col-sx-10">
						<select class = "form-control" name="id_bts" required="required">
                  			<option selected="selected" value=""></option>
                  			<option value="PKL">PKL</option>
							<?php
				            foreach($select->select_data_bts() as $data) {
				            	$selected="";
				            	if($nama_gedung==$data['nama_gedung']){
				            		$selected="selected='selected'";
				            	}
				            ?>
							<option value="<?php echo $data['id'];?>" <?php echo $selected;?><?php echo $data['id'];?>><?php echo $data['nama_gedung'];?></option>
							<?php
							}
							?>
						</select>  
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_edit_data_pemasangan" class="btn btn-success">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                