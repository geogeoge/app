<div class="modal fade" id="lokasi_bts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>FORM TAMBAH LOKASI BTS</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_lokasi_bts" id="inputEmail" class = "form-control" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Lokasi BTS</label>
					<div class="col-sx-10">
						<input type="text" name="lokasi_bts" id="inputEmail" class = "form-control" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Alamat</label>
					<div class="col-sx-10">
						<TEXTAREA name="alamat_bts" id="inputEmail" class = "form-control" rows="5"></TEXTAREA> 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Telp</label>
					<div class="col-sx-10">
						<input type="text" name="telp" id="inputEmail" class = "form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Koordinat</label>
					<div class="col-sx-10">
						<input type="text" name="koordinat" id="inputEmail" class = "form-control">
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Parent</label>
					<div class="col-sx-10">
						<select class="form-control" style="width: 100%;" name="parent_bts" id="parent_bts">
	                        <option selected="selected" disabled="disabled"> </option>
	                        <?php
                        		                        
	                          //foreach($select->select_data_lokasi_bts() as $data_bts) {
	                            ?>
	                            <option value="<?php //echo $data_bts['id_lokasi_bts']; ?>" <?php //echo $selected;?>><?php //echo $data_bts['lokasi_bts']; ?></option>
	                        <?php
	                         // }
	                        ?>
						</select>
					</div>
				</div> -->
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_tambah_lokasi_bts" class="btn btn-primary">SIMPAN</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                