<div class="modal fade" id="modal_penjadwalan<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>BUAT JADWAL PEMASANGAN</center></strong></div>
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
					<label class="col-sx-2 control-label" for="inputEmail">PENJADWALAN</label>
					<div class="col-sx-10">
						<input type="date" name="tanggal_penjadwalan" id="inputEmail" class = "form-control" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">TEKNISI I</label>
					<div class="col-sx-10">
						<select class = "form-control" name="teknisi" required="required">
                  			<option selected="selected" value=""></option>
							<?php
				            foreach($select->select_data_teknisi() as $data) {
				            ?>
							<option value="<?php echo $data['id_user'];?>"><?php echo $data['nama_user'];?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">TEKNISI II</label>
					<div class="col-sx-10">
						<select class = "form-control" name="partner">
                  			<option selected="selected" value=""></option>
                  			<option value="PKL">PKL</option>
							<?php
				            foreach($select->select_data_teknisi() as $data) {
				            ?>
							<option value="<?php echo $data['id_user'];?>"><?php echo $data['nama_user'];?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_buat_jadwal_pemasangan" class="btn btn-primary">JADWALKAN</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                