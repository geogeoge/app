        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                    <h2 class="box-title" style="vertical-align: middle;">Data Penghapusan Pemasangan</h2>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                     <th width="80px">No</th>
                                    <th>Tanggal Penghapusan</th>
                                    <th>Tipe</th>
                                    <th>Nama User</th>
                                    <th>Nama Alat</th>
                                    <th>Nominal Sisa</th>
                                    <th>Keterangan</th>
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                        
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <?php 
        $this->dts='<script type="text/javascript">
            function keterangan(id){
                $.ajax({
                    type : "POST",
                    url : "'.base_url('data_penghapusan_pemasangan/get_penghapusan').'",
                    data :  {"id_penghapusan" : id},
                    success: function (data) {
                            json = JSON.parse(data);
                            document.getElementById("keterangan").innerHTML = json.keterangan;

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

                var t = $("#mytable").dataTable({
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
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "'.base_url('data_penghapusan_pemasangan/json').'", "type": "POST"},
                    columns: [
                        {
                            "data": "id_penghapusan",
                            "orderable": false
                        },
                        {
                            "data": "tanggal_penghapusan",
                            render: function(data, type, row){
                                moment.locale(\'id\');
                                return moment(data).format("DD MMMM YYYY");
                            }
                        },
                        {"data": "type_user"},
                        {"data": "id_user"},
                        {"data": "nama"},
                        {
                            "data": "nominal_sisa",
                            "render" : $.fn.dataTable.render.number( \'.\', \',\', 0, \'Rp. \' )
                            },
                        {"data": "keterangan"},
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
                <h4 class="modal-title">Keterangan Pemasangan</h4>
              </div>
                  <div class="modal-body">
                    <p id="keterangan"></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-right" data-dismiss="modal">Tutup</button>
                  </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->