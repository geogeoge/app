<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>IMPORT MUTASI BANK</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="GET" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">File</label>
					<div class="col-sx-10">
						<input type="file" name="file" id="inputEmail" class = "form-control" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">BANK</label>
					<div class="col-sx-10">
						<select class="form-control" name="via" required="required">
		                  <option selected="selected" disabled="disabled"></option>
		                  <option>BCA ACCESS</option>
		                  <option>BCA 04</option>
		                  <option>BCA HW</option>
		                  <option>BNI</option>
		                  <option>BRI</option>
		                  <option>MANDIRI</option>
		                  <option>BPD</option>
		                </select>
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<input type="submit" name="tombol_import" class="btn btn-info" value="IMPORT"></input>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                