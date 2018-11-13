<div class="modal fade" id="edit_download<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
				<div class="modal-header">
					<div class="alert alert-info"><strong><center>EDIT ALAMAT DAN NOMOR HP</center></strong></div>
				</div>
				<div class="modal-body">
					<input hidden="hidden" name="id_register" type="text" value="<?php echo $data['id_register']; ?>" />
                    <div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
							<input class="form-control" name="nama_user" placeholder="Nama User" type="text" value="<?php echo $data['nama_user']; ?>"/>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
							<input class="form-control" name="nama_instansi" placeholder="Nama Instansi" type="text" value="<?php echo $data['nama_instansi']; ?>"/>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8" style="padding-bottom: 10px;">
							<input class="form-control" name="alamat_1" placeholder="Alamat Lengkap" type="text" value="<?php echo $pecah_alamat['0']; ?>" />
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2" style="padding-bottom: 10px;">
							<input class="form-control" name="alamat_2" placeholder="RT" type="text" value="<?php echo $pecah_alamat['1']; ?>"/>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2" style="padding-bottom: 10px;">
							<input class="form-control" name="alamat_3" placeholder="RW" type="text" value="<?php echo $pecah_alamat['2']; ?>"/>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
							<input class="form-control" name="alamat_4" placeholder="Desa/Kelurahan" type="text" value="<?php echo $pecah_alamat['3']; ?>"/>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
							<input class="form-control" name="alamat_5" placeholder="Kecamatan" type="text" value="<?php echo $pecah_alamat['4']; ?>"/>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
							<input class="form-control" name="alamat_6" placeholder="Kabupaten" type="text" value="<?php echo $pecah_alamat['5']; ?>"/>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
							<input class="form-control" name="telp" placeholder="No Telp" type="text" value="<?php echo $data['telp']; ?>"/>
						</div>
					</div>
				</div> 
				<div class="modal-footer">
					<button name = "update_data_user" class="btn btn-primary">Simpan</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i>&nbsp;Batal</button>
				</div>   
			</form>                         
		</div>
	</div>
</div>
