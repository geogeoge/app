<div class="modal fade" id="modal_opsi_buku_besar<?php echo $id_account; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>PERIODE</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="GET" enctype="multipart/form-data">
				<div class="form-group" hidden="hidden">
					<label class="col-sx-2 control-label" for="inputEmail">Tanggal Awal</label>
					<div class="col-sx-10">
						<input type="text" name="id_account" id="inputEmail" class = "form-control" value="<?php echo $data['id_account']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Tanggal Awal</label>
					<div class="col-sx-10">
						<input type="date" name="tanggal_awal" id="inputEmail" class = "form-control" value="<?php echo date('Y-m-')."01";?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Tanggal Akhir</label>
					<div class="col-sx-10">
						<input type="date" name="tanggal_akhir" id="inputEmail" class = "form-control" value="<?php echo date('Y-m-d');?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "page" value="page_detail_buku_besar" class="btn btn-info">GO !</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                