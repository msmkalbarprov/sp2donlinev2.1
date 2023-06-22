
            
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                   
                    <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body widget-user">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-lg me-3 flex-shrink-0">
                                                <img src="<?= base_url() ?>assets/adminto/images/dashboard/penguji-offline.png" class="img-fluid rounded-circle" alt="user">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="mt-0 mb-1">Penguji (Offline) </h5>
                                                <h3 class="fw-normal mb-1"> <?= $all_advices_offline; ?> </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body widget-user">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-lg me-3 flex-shrink-0">
                                                <img src="<?= base_url() ?>assets/adminto/images/dashboard/sp2d-success.png" class="img-fluid rounded-circle" alt="user">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="mt-0 mb-1">SP2D Cair/Terbit </h5>
                                                <h3 class="fw-normal mb-1"> <?= $sent_sp2d.'/'.$sp2d_advices; ?> </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body widget-user">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-lg me-3 flex-shrink-0">
                                                <img src="<?= base_url() ?>assets/adminto/images/dashboard/sp2d-pending.png" class="img-fluid rounded-circle" alt="user">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="mt-0 mb-1">SP2D pending</h5>
                                                <h3 class="fw-normal mb-1"> <?= $sp2d_pending; ?> </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body widget-user">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-lg me-3 flex-shrink-0">
                                                <img src="<?= base_url() ?>assets/adminto/images/dashboard/sp2d-gagal.png" class="img-fluid rounded-circle" alt="user">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="mt-0 mb-1">SP2D Gagal</h5>
                                                <h3 class="fw-normal mb-1"> <?= $sp2d_gagal; ?> </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                    </div>

                    <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body widget-user">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-lg me-3 flex-shrink-0">
                                                <img src="<?= base_url() ?>assets/adminto/images/dashboard/penguji-online.png" class="img-fluid rounded-circle" alt="user">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="mt-0 mb-1">Penguji (Online) </h5>
                                                <h3 class="fw-normal mb-1"> <?= $all_advices_online; ?> </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body widget-user">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-lg me-3 flex-shrink-0">
                                                <img src="<?= base_url() ?>assets/adminto/images/dashboard/pajak-success.png" class="img-fluid rounded-circle" alt="user">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="mt-0 mb-1">Pajak terbayar</h5>
                                                <h3 class="fw-normal mb-1"> <?= $pajak_sukses; ?> </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body widget-user">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-lg me-3 flex-shrink-0">
                                                <img src="<?= base_url() ?>assets/adminto/images/dashboard/pajak-pending.png" class="img-fluid rounded-circle" alt="user">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="mt-0 mb-1">Pajak pending</h5>
                                                <h3 class="fw-normal mb-1"> <?= $pajak_pending; ?> </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body widget-user">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-lg me-3 flex-shrink-0">
                                                <img src="<?= base_url() ?>assets/adminto/images/dashboard/pajak-gagal.png" class="img-fluid rounded-circle" alt="user">
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="mt-0 mb-1">Pajak Gagal</h5>
                                                <h3 class="fw-normal mb-1"> <?= $pajak_gagal; ?> </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                    </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                                    <table id="listsp2d" class="table table-bordered dt-responsive table-responsive" style="width:100%">
                                                    <thead class="bg-success text-white">
                                                        <tr>
                                                            <th rowspan="3" class="text-center" style="vertical-align:middle">No.SP2D</th>
                                                            <th rowspan="3" class="text-center" style="vertical-align:middle">SKPD</th>
                                                            <th colspan="6" class="text-center">Penerima</th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="6"class="text-center">Keperluan</th>
                                                        </tr>
                                                        <tr>
                                                        
                                                            <th class="text-center">Jenis</th>
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center">Potongan</th>
                                                            <th class="text-center">Netto</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center">Tgl. transfer</th>
                                                        </tr>
                                                    </thead>
                                                    </table>
    
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div><!-- end row -->
                    
                    </div> <!-- container -->

                </div> <!-- content -->
                
                
                
                <script src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
                <script src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script>

                




<script type="text/javascript">
$(document).ready(function(){

  // Apply chart themes
  var table = $('#listsp2d').DataTable( {
    'rowsGroup': [0,1],
    "processing": true,
    "serverSide": true,
    "ajax": "<?= base_url('admin/Dashboard/datatable_json') ?>",
    "order": [[0,1,'asc']],
    "lengthMenu":[12, 30, 90],
    "columnDefs": [
    { "targets": 0, "name": "no_sp2d", 'searchable':true, 'orderable':false},
    { "targets": 1, "name": "nm_skpd", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "keperluan", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "tujuan", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "status", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "netto", 'searchable':false, 'orderable':false,'width':'100px'},
    { "targets": 7, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ],
    "createdRow": function(row, data, dataIndex){
        
         if(data[3] === '<div class="text-right"><span align="right"><font size="2px">0,00</font></span></div></td>'){
            // Add COLSPAN attribute
            $('td:eq(2)', row).attr('colspan', 6);
            // Hide required number of columns
            // next to the cell with COLSPAN attribute
            $('td:eq(3)', row).css('display', 'none');
            $('td:eq(4)', row).css('display', 'none');
            $('td:eq(5)', row).css('display', 'none');
            $('td:eq(6)', row).css('display', 'none');
            $('td:eq(7)', row).css('display', 'none');
            // $('td:eq(8)', row).css('display', 'none');
         }
    }
  });
});


</script>