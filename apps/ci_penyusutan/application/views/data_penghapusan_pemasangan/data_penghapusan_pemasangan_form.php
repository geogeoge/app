<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Data_penghapusan_pemasangan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="date">Tanggal Penghapusan <?php echo form_error('tanggal_penghapusan') ?></label>
            <input type="text" class="form-control" name="tanggal_penghapusan" id="tanggal_penghapusan" placeholder="Tanggal Penghapusan" value="<?php echo $tanggal_penghapusan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Pemasangan Alat <?php echo form_error('id_pemasangan_alat') ?></label>
            <input type="text" class="form-control" name="id_pemasangan_alat" id="id_pemasangan_alat" placeholder="Id Pemasangan Alat" value="<?php echo $id_pemasangan_alat; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Nominal Sisa <?php echo form_error('nominal_sisa') ?></label>
            <input type="text" class="form-control" name="nominal_sisa" id="nominal_sisa" placeholder="Nominal Sisa" value="<?php echo $nominal_sisa; ?>" />
        </div>
	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
	    <input type="hidden" name="id_penghapusan" value="<?php echo $id_penghapusan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_penghapusan_pemasangan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>