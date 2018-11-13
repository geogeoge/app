<div class="modal fade" id="modal_rubah_paket<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-warning"><strong><center>EDIT PAKET INTERNET</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_register" id="inputEmail" class = "form-control" value="<?php echo $data['id_register']; ?>">
					</div>
				</div>
				<h4 class="modal-title" id="myModalLabel"><center>Akan anda rubah ke paket berapa user <strong><?php echo $data['nama_user'];?></strong> ?</center></h4>
				<br>
				<div class="form-group">
					<div class="col-sx-10">
						<select class = "form-control" name="id_paket">
							<?php
							$query=mysqli_query($koneksi,"select * from sale_paket_internet");
							while($tampil=mysqli_fetch_array($query)) {
								$nama_paket=$tampil['nama_paket'];
								if($tampil['nama_paket']=="-"){
									$nama_paket="Paket Lama";
								}

								$selected="";
								if($tampil['id_paket']==$data['id_paket']) {
									$selected="selected='selected'";
								}
							?>
								<option value="<?php echo $tampil['id_paket']; ?>" <?php echo $selected; ?>><?php echo $nama_paket." || ".number_format($tampil['harga'],0,',','.'); ?></option>
							<?php
							}
							?>
						</select>  
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "tombol_rubah_paket" class="btn btn-warning">Iya</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                