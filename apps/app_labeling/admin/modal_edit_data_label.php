<div class="modal fade" id="edit_data_label<?php echo $id_label; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form method="POST">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>EDIT DATA LABEL </center></strong></div>
			</div>
			<div class="modal-body">
				<div class="row">
			        <div class="col-md-6">
			          <div class="box-header with-border">
			            <h3 class="box-title"><b>Asal</b></h3>
			          </div>
			          <!-- Hidden -->
			          <div hidden="true">
			            <input type="text" name="id" class="form-control" id="inputPassword3" value="<?php echo $data_label['id']; ?>">
			          </div>
			          <!-- /.Hidden -->
			          <div class="form-group">
			            <label>Nama BTS</label>
			            <select name="nama_gedung_a" class="form-control select2" style="width: 100%;">
			              <?php
			              foreach($crud->select_bts() as $data) {
			              $selected="";
			              if($data_label['nama_gedung_a']==$data['nama_gedung']) {
			              	$selected="selected";
			              }
			              ?>
			              <option <?php echo $selected; ?>><?php echo $data['nama_gedung']; ?></option>
			              <?php
			              }
			              ?>
			            </select>
			          </div>
			          <!-- /.form-group -->
			          <div class="form-group">
			            <label>No Lantai</label>
			            <input type="text" name="no_lantai_a" class="form-control" id="inputPassword3" value="<?php echo $data_label['no_lantai_a']; ?>">
			          </div>
			          <div class="form-group">
			            <label>Nama Ruang</label>
			            <select name="nama_ruang_a" class="form-control select2" style="width: 100%;">
			              <?php
			              foreach($crud->select_ruang() as $data) {
			              $selected="";
			              if($data_label['nama_ruang_a']==$data['nama_ruang']) {
			              	$selected="selected";
			              }
			              ?>
			              <option <?php echo $selected; ?>><?php echo $data['nama_ruang']; ?></option>
			              <?php
			              }
			              ?>
			            </select>
			          </div>
			          <div class="form-group">
			            <label>Nama Rak</label>
			            <select name="nama_rak_a" class="form-control select2" style="width: 100%;">
			              <?php
			              foreach($crud->select_rak() as $data) {
			              $selected="";
							if($data_label['nama_rak_a']==$data['nama_rak']) {
			              	$selected="selected";
			              }
			              ?>
			              <option <?php echo $selected; ?>><?php echo $data['nama_rak']; ?></option>
			              <?php
			              }
			              ?>
			            </select>
			          </div>
			          <div class="form-group">
			            <label>No Rak</label>
			            <input type="text" name="no_rak_a" class="form-control" id="inputPassword3" value="<?php echo $data_label['no_rak_a']; ?>">
			          </div>
			          <div class="form-group">
			            <label>Nama Device</label>
			            <select name="nama_device_a" class="form-control select2" style="width: 100%;">
			              <option selected="selected" disabled="true"> </option>
			              <?php
			              foreach($crud->select_device() as $data) {
			              	$selected="";
			              	if($data_label['nama_device_a']==$data['nama_device']) {
			              		$selected="selected";
			              	}
			              ?>
			              <option <?php echo $selected; ?>><?php echo $data['nama_device']; ?></option>
			              <?php
			              }
			              ?>
			            </select>
			          </div>
			          <div class="form-group">
			            <label>No Port</label>
			            <input type="text" name="no_port_a" class="form-control" id="inputPassword3" value="<?php echo $data_label['no_port_a']; ?>">
			          </div>
			          <!-- /.form-group -->
			        </div>
			        <!-- /.col -->



			        <div class="col-md-6">
			          <div class="box-header with-border">
			            <h3 class="box-title"><b>Tujuan</b></h3>
			          </div>
			          <div class="form-group">
			            <label>Nama BTS</label>
			            <select name="nama_gedung_t" class="form-control select2" style="width: 100%;">
			              <?php
			              foreach($crud->select_bts() as $data) {
			              $selected="";
			              if($data_label['nama_gedung_t']==$data['nama_gedung']) {
			              	$selected="selected";
			              }
			              ?>
			              <option <?php echo $selected; ?>><?php echo $data['nama_gedung']; ?></option>
			              <?php
			              }
			              ?>
			            </select>
			          </div>
			          <!-- /.form-group -->
			          <div class="form-group">
			            <label>No Lantai</label>
			            <input type="text" name="no_lantai_t" class="form-control" id="inputPassword3" value="<?php echo $data_label['no_lantai_t']; ?>">
			          </div>
			          <div class="form-group">
			            <label>Nama Ruang</label>
			            <select name="nama_ruang_t" class="form-control select2" style="width: 100%;">
			              <?php
			              foreach($crud->select_ruang() as $data) {
			              $selected="";
			              if($data_label['nama_ruang_t']==$data['nama_ruang']) {
			              	$selected="selected";
			              }
			              ?>
			              <option <?php echo $selected; ?>><?php echo $data['nama_ruang']; ?></option>
			              <?php
			              }
			              ?>
			            </select>
			          </div>
			          <div class="form-group">
			            <label>Nama Rak</label>
			            <select name="nama_rak_t" class="form-control select2" style="width: 100%;">
			              <?php
			              foreach($crud->select_rak() as $data) {
			              $selected="";
							if($data_label['nama_rak_t']==$data['nama_rak']) {
			              	$selected="selected";
			              }
			              ?>
			              <option <?php echo $selected; ?>><?php echo $data['nama_rak']; ?></option>
			              <?php
			              }
			              ?>
			            </select>
			          </div>
			          <div class="form-group">
			            <label>No Rak</label>
			            <input type="text" name="no_rak_t" class="form-control" id="inputPassword3" value="<?php echo $data_label['no_rak_t']; ?>">
			          </div>
			          <div class="form-group">
			            <label>Nama Device</label>
			            <select name="nama_device_t" class="form-control select2" style="width: 100%;">
			              <?php
			              foreach($crud->select_device() as $data) {
			              	$selected="";
			              	if($data_label['nama_device_t']==$data['nama_device']) {
			              		$selected="selected";
			              	}
			              ?>
			              <option <?php echo $selected; ?>><?php echo $data['nama_device']; ?></option>
			              <?php
			              }
			              ?>
			            </select>
			          </div>
			          <div class="form-group">
			            <label>No Port</label>
			            <input type="text" name="no_port_t" class="form-control" id="inputPassword3" value="<?php echo $data_label['no_port_t']; ?>">
			          </div>
			          <!-- /.form-group -->
			        </div>
			        <!-- /.col -->
			      </div>
			</div>
			<div class = "modal-footer">
				<button name = "update_data_label" class="btn btn-primary">Update</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>                             
		</div>
	</div>
</form>
</div>