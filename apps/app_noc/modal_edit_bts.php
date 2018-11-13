<div class="modal fade" id="modal_edit_bts<?php echo $data['id_bts']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>FORM EDIT DATA BTS</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_bts" id="inputEmail" class = "form-control" value="<?php echo $data['id_bts']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama BTS</label>
					<div class="col-sx-10">
						<input type="text" name="nama_bts" id="inputEmail" class = "form-control" value="<?php echo $data['nama_bts']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">SSID</label>
					<div class="col-sx-10">
						<input type="text" name="kontak" id="inputEmail" class = "form-control" value="<?php echo $data['kontak']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">IP BTS <a href="<?php $data['ip_bts']; ?>">Akses IP</a></a></label>
					<div class="col-sx-10">
						<input type="text" name="ip_bts" id="inputEmail" class = "form-control" value="<?php echo $data['ip_bts']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Lokasi</label>
					<div class="col-sx-10">
						<select class="form-control" style="width: 100%;" name="lokasi" id="lokasi">
	                        <option value="0"> </option>
	                        <?php
                        		                        
	                          foreach($select->select_data_lokasi_bts() as $data_bts) {
	                          	$parent_bts=$data['lokasi'];
				            	$selected="";
				            	if($parent_bts==$data_bts['id_lokasi_bts']){
				            		$selected="selected='selected'";
				            	}
	                            ?>
	                            <option value="<?php echo $data_bts['id_lokasi_bts']; ?>" <?php echo $selected;?>><?php echo $data_bts['lokasi_bts']; ?></option>
	                        <?php
	                          }
	                        ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Parent</label>
					<div class="col-sx-10">
						<select class="form-control" style="width: 100%;" name="id_parent" id="id_parent">
	                        <option value="0"> </option>
	                        <?php
                        		                        
	                          foreach($select->select_data_bts() as $data_bts) {
	                          	$parent_bts=$data['id_parent'];
				            	$selected="";
				            	if($parent_bts==$data_bts['id_bts']){
				            		$selected="selected='selected'";
				            	}
	                            ?>
	                            <option value="<?php echo $data_bts['id_bts']; ?>" <?php echo $selected;?>><?php echo $data_bts['nama_bts']; ?></option>
	                        <?php
	                          }
	                        ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kapasitas BTS</label>
					<div class="col-sx-10">
						<input type="number" name="kapasitas_bts" id="inputEmail" class = "form-control" value="<?php echo $data['kapasitas_bts']; ?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_edit_bts" class="btn btn-info">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                