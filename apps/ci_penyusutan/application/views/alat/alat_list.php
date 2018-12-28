        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                    <h2 class="box-title" style="vertical-align: middle;">Daftar Alat</h2>
                    <?php 
                            echo anchor(base_url('alat/create'), 'Tambah', 'class="btn btn-sm btn-flat btn-default pull-right"'); 
                    ?>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Mac</th>
                                <th>Serial Number</th>
                                <th>BTS</th>
                                <th>Nota</th>
                                <th width="200px">Action</th>
                            </tr>
                        </thead>
                        </table>
                        <?php 
                        $this->dts='<script type="text/javascript">
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
                                    processing: false,
                                    serverSide: true,
                                    ajax: {"url": "'.base_url('alat/json').'", "type": "POST"},
                                    columns: [
                                        {
                                            "data": "id_alat",
                                            "orderable": false
                                        },{"data": "mac"},{"data": "sn"},{"data": "nama_bts"},{"data": "nota"},
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
                    </div>
                </div>
            </div>
            
        </div>
