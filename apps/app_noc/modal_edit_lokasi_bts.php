<div class="modal fade" id="modal_edit_lokasi_bts<?php echo $data['id_lokasi_bts']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>FORM EDIT LOKASI BTS</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_lokasi_bts" id="inputEmail" class = "form-control" value="<?php echo $data['id_lokasi_bts']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Lokasi BTS</label>
					<div class="col-sx-10">
						<input type="text" name="lokasi_bts" id="inputEmail" class = "form-control" value="<?php echo $data['lokasi_bts']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Alamat</label>
					<div class="col-sx-10">
						<TEXTAREA name="alamat_bts" id="inputEmail" class = "form-control" rows="5"><?php echo $data['alamat_bts']; ?></TEXTAREA> 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Telp</label>
					<div class="col-sx-10">
						<input type="text" name="telp" id="inputEmail" class = "form-control" value="<?php echo $data['telp']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Koordinat</label>
					<div class="col-sx-10">
						<input type="text" name="koordinat" id="inputEmail" class = "form-control" value="<?php echo htmlentities($data['koordinat'],ENT_QUOTES); ?>">
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Parent</label>
					<div class="col-sx-10">
						<select class="form-control" style="width: 100%;" name="parent_bts" id="parent_bts">
	                        <option value="0"> </option>
	                        <?php
                        		                        
	                //           foreach($select->select_data_lokasi_bts() as $data_bts) {
	                //           	$parent_bts=$data['parent_bts'];
				            	// $selected="";
				            	// if($parent_bts==$data_bts['id_lokasi_bts']){
				            	// 	$selected="selected='selected'";
				            	// }
	                            ?>
	                            <option value="<?php //echo $data_bts['id_lokasi_bts']; ?>" <?php //echo $selected;?>><?php //echo $data_bts['lokasi_bts']; ?></option>
	                        <?php
	                        //  }
	                        ?>
						</select>
					</div>
				</div> -->
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_edit_lokasi_bts" class="btn btn-info">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                