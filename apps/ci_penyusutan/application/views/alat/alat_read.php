        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h2 class="box-title" style="vertical-align: middle;">Detail Alat</h2>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <tr><td>Mac Address</td><td><?php echo $mac; ?></td></tr>
                            <tr><td>Serial Number</td><td><?php echo $sn; ?></td></tr>
                            <tr><td>BTS</td><td><?php echo $id_bts; ?></td></tr>
                            <tr><td>Nota</td><td><?php echo $nota; ?></td></tr>
                        </table>
                    </div>
                    <div class="box-footer text-right">
                        <a href="<?php echo base_url('alat') ?>" class="btn btn-flat btn-default">Kembali</a></td></tr>
                    </div>
                </div>
            </div>
        </div>
