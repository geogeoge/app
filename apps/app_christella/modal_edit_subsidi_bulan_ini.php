<div class="modal fade" id="edit_subsidi<?php echo $id_marketing;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-success"><strong><center>INPUTAN SUBSIDI MARKETING</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_marketing" id="inputEmail" class = "form-control" value="<?php echo $data['id_marketing']; ?>">
					</div>
				</div>
				<h4 class="modal-title" id="myModalLabel"><center>Marketing <strong><?php echo $data['nama_marketing'];?></strong> mau di beri SUBSIDI berapa mbak ?</center></h4>
				<h5 class="modal-title" id="myModalLabel"><center>Saldo Subsidinya masih Rp. <strong><?php echo number_format($select->select_saldo_subsidi_marketing($id_marketing),0,',','.');?></strong> </center></h5>
				<br>
				<div class="form-group">
					<div class="col-sx-10">
						<input type="text" id="inputku" class="form-control" name="nominal_subsidi" value="<?php echo $subsidi;?>"> 
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "tombol_rubah_subisidi_marketing" class="btn btn-success">Iya</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                