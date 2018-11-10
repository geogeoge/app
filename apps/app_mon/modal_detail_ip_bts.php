<div class="modal fade" id="modal_detail_ip_bts<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-success"><strong><center>DATA DETAIL IP BTS</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">IP BTS</label>
					<div class="col-sx-10">
						<input type="text" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo $data['ip_bts']; ?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                