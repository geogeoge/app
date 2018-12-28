        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                    <h2 class="box-title" style="vertical-align: middle;">Data Pemasangan Alat</h2>
                    <?php 
                            echo anchor(base_url('data_pemasangan_alat/create'), 'Tambah', 'class="btn btn-xs btn-flat btn-default pull-right"'); 
                    ?>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th>No</th>
                            <!-- <th>Nota</th> -->
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Nama User</th>
                            <th>Alat</th>
                            <th>Harga</th>
                            <!-- <th>Umur Alat</th> -->
                            <th width="150px">Sisa Umur</th>
                            <th width="170px">Action</th>
                                </tr>
                            </thead>
                        
                        </table>
                        <table class="table" style="margin-top: 20px">
                            <tr>
                                <td><b>Total Harga</b></td>
                                <td class="text-right"><?php echo 'Rp. '.number_format($total_harga,0,',','.'); ?></td>
                            </tr><tr>
                                <td><b>Total Penyusutan</b></td>
                                <td class="text-right"><?php echo 'Rp. '.number_format($total_penyusutan,0,',','.'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <?php 
        $this->dts='<script type="text/javascript">
            function hapus(id){
                $.ajax({
                    type : "POST",
                    url : "'.base_url('data_pemasangan_alat/get_pemasangan').'",
                    data :  {"id_pemasangan_alat" : id},
                    success: function (data) {
                            json = JSON.parse(data);
                            $("#id_pemasangan_alat").val(json.id_pemasangan_alat);

                    },
                    error: function(data){
                            console.log(data);
                    }
                })
            };

            $(document).ready(function() {
                
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").DataTable({
                    initComplete: function() {
                        var api = this.api();
                        $(\'#mytable_filter input\')
                                .off(\'.DT\')
                                .on(\'keyup.DT\', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "Memuat..."
                    },
                    processing: false,
                    serverSide: true,
                    ajax: {"url": "'.base_url('data_pemasangan_alat/json').'", "type": "POST"},
                    columns: [
                        {
                            "data": "id_pemasangan_alat",
                            "orderable": false
                        },
                        // {"data": "nota"},
                        {
                            "data": "tanggal_pemasangan",
                            render: function(data, type, row){
                                moment.locale(\'id\');
                                return moment(data).format("DD MMMM YYYY");
                            }
                        },
                        {"data": "type_user"},
                        {"data": "id_user"},
                        {"data": "nama"},
                        {
                            "data": "harga",
                            "render" : $.fn.dataTable.render.number( \'.\', \',\', 0, \'Rp. \' )
                        },
                        // {
                        //     "data": "umur_alat",
                        //     "render": function (data, type, row){
                        //                         return data+" Bulan";
                        //                     },
                        // },
                        {
                            "data": "tanggal_pemasangan",
                            "render": function (data, type, row){
                                var jml = parseInt(moment(new Date(new Date())).diff(new Date(data), \'months\', true));
                                if(jml>row.umur_alat){
                                    return \'<div class="progress-group"><div class="progress progress-md progress-striped active"><div class="progress-bar progress-bar-red" style="width: 100%">100%</div></div></div>\';            
                                }else{
                                    var average = (jml/row.umur_alat)*100;
                                    return \'<div class="progress-group"><div class="progress progress-md progress-striped active"><div class="progress-bar progress-bar-success" style="width: \'+ average + \'%">\'+ parseInt(average) + \'%</div></div></div>\';            
                                }
                            },
                        },
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, \'desc\']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $(\'td:eq(0)\', row).html(index);
                    }
                });

            });
        </script>';
        ?>

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Alat</h4>
              </div>
              <form action="<?=$action?>" method="POST">
                  <div class="modal-body">
                    <input type="hidden" name="id_pemasangan_alat" id="id_pemasangan_alat">
                    <textarea class="form-control" name="keterangan" required></textarea>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-right" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-flat pull-right" style="margin-right: 10px;">Hapus</button>
                  </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->