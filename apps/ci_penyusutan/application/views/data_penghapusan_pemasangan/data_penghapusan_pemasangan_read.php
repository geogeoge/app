        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h2 class="box-title" style="vertical-align: middle;">Detail Data Penghapusan Pemasangan</h2>
                    </div>
                    <div class="box-body">
                         <table class="table">
                            <tr><td>Tanggal Penghapusan</td><td><?php echo $tanggal_penghapusan; ?></td></tr>
                            <tr><td>Id Pemasangan Alat</td><td><?php echo $id_pemasangan_alat; ?></td></tr>
                            <tr><td>Nominal Sisa</td><td><?php echo $nominal_sisa; ?></td></tr>
                            <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
                        </table>
                        
                    </div>
                    <div class="box-footer text-right">
                        <a href="<?php echo base_url('data_penghapusan_pemasangan') ?>" class="btn btn-flat btn-default">Kembali</a></td></tr>
                    </div>
                </div>
            </div>
        </div>

       
        </body>
</html>