
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script> -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
          <div class="card card-default">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#home">SP2D</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menu1">Verified</a>
                </li>
              </ul>
          <div class="tab-content">
              <div id="home" class="container tab-pane active"><br>
                  <h3>List SP2D</h3>
                  <div class="card-body table-responsive">
                    <?php $this->load->view('admin/includes/_messages.php') ?>
                  
                        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                          <thead>
                            <tr>
                                <th>No</th>  
                                <th>No. SP2D</th>
                                <th>Tanggal Terbit</th>
                                <th>Keperluan</th>
                                <th>Tujuan</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th style="width: 50px;text-align: center;" >Action</th>
                              </tr>
                          </thead>
                        </table>
                  </div>
              </div>
              <div id="menu1" class="container tab-pane active"><br>
                  <h3>List SP2D Terverifikasi</h3>
                  <div class="card-body table-responsive">
                      <?php $this->load->view('admin/includes/_messages.php') ?>
                  
                        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                          <thead>
                            <tr>
                                <th>No</th>  
                                <th>No. SP2D</th>
                                <th>Tanggal Terbit</th>
                                <th>Keperluan</th>
                                <th>Tujuan</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th style="width: 50px;text-align: center;" >Action</th>
                              </tr>
                          </thead>
                        </table>
                 </div>
              </div>
          </div>
      </div>
  </section> 
</div>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script>
  // $("#proyek").addClass('menu-open');
  $("#sp2d> a").addClass('active');
function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
</script>
<!-- <script type="text/javascript">

    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?= base_url('admin/sp2d/datatable_json') ?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "no_sp2d", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "tgl_sp2d", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "keperluan", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "tujuan", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "status", 'searchable':true, 'orderable':false},
    { "targets": 7, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
  </script> -->

  <script type="text/javascript">
    var table;
    $(document).ready(function() {
 
        //datatables
        table = $('#na_datatable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": 'admin/sp2d/datatable_json',
                "type": "POST"
            }
        });
 
    });
 
</script>