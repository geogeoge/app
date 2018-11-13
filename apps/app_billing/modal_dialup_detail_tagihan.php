<div class="modal fade" id="modal_detail<?php echo $costumer_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>EDIT DATA ROOM </center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="costumer_id" id="inputEmail" class = "form-control" value="<?php echo $data['costumer_id']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Mounthly Fee</label>
					<div class="col-sx-10">
						<input type="text" name="billing_monthly_fee" id="inputEmail" class = "form-control" value="<?php echo $data['billing_monthly_fee']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Quota Email</label>
					<div class="col-sx-10">
						<input type="text" name="billing_email" id="inputEmail" class = "form-control" value="<?php echo $data['billing_email']; ?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "update_tagihan_dialup" class="btn btn-primary">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>