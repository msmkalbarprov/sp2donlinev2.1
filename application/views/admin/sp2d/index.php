<!-- datatable -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">   

<div class="content-wrapper">
  <?php $csrf = $this->security->get_csrf_hash() ?>
  <input id="csrf" type="hidden" value="<?= $csrf ?>">
 <section class="content">
 <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

        <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
  <div class="card">
    <div class="card-header bg-primary">
      Verifikasi SP2D
    </div>
 
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Belum Verifikasi</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Sudah Verifikasi</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Cair BUD</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
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
                                <th> Aksi</th>
                              </tr>
                          </thead>
                        </table>
                 </div>
    </div>

    <div id="menu1" class="container tab-pane fade"><br>
                  <div class="card-body table-responsive">
                      <?php $this->load->view('admin/includes/_messages.php') ?>
                  
                        <table id="na_datatable2" class="table table-bordered table-striped" width="100%">
                          <thead>
                            <tr>
                                <th>No</th>  
                                <th>No. SP2D</th>
                                <th>Tanggal Terbit</th>
                                <th>Keperluan</th>
                                <th>Tujuan</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th> Aksi</th>
                              </tr>
                          </thead>
                        </table>
                 </div>
    </div>

    <div id="menu2" class="container tab-pane fade"><br>
                  <div class="card-body table-responsive">
                      <?php $this->load->view('admin/includes/_messages.php') ?>
                  
                        <table id="na_datatable3" class="table table-bordered table-striped" width="100%">
                          <thead>
                            <tr>
                                <th>No</th>  
                                <th>No. SP2D</th>
                                <th>Tanggal Terbit</th>
                                <th>Keperluan</th>
                                <th>Tujuan</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th> Aksi</th>
                              </tr>
                          </thead>
                        </table>
                 </div>
    </div>

    <!-- END menu tab -->
  </div>

    
  </div>

  <!-- modal not verified -->
  <div class="modal fade" id="largeModal" tabindex="-1" role="dialog"  aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog modal-xl" >
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Rincian SP2D</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--  -->
            <div id="accordion">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      PREVIEW SP2D
                    </button>
                  </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  
                      <input type="hidden" id="nosp2d" name="nosp2d">
                      <label id="cetak"></label>
                  
                </div>
              </div>
              <div class="card">
                <div class="card-header bg-warning" id="headingTwo">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Potongan
                    </button>
                  </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                  <div class="card-body">
                        <table id="tabelpotongan" class="table table-bordered table-striped" width="100%">
                          <thead>
                            <tr>
                                <th>No</th>  
                                <th>Kode Rekening</th>
                                <th>Nama Rekening</th>
                                <th>Id Billing</th>
                                <th>Nilai</th>
                              </tr>
                          </thead>
                        </table>
                        <br />
                        <div class="row">
                          <div class="col-md-8">

                          </div>
                          <div class="col-md-4"><b>
                            Total Potongan
                            <span id="potonganunverif"></span>
                            </b>
                          </div>
                        </div>
                  </div>
                </div>
                
              </div>
            </div>
            <!--  -->
              
          <div class="modal-footer">
            
              Silahkan cek secara teliti data sp2d dan data potongan. Khusus PPH dan PPN selain Belanja Gaji Pokok dipastikan idbilling terisi.
            
            
              <button name="btn_ok" id="btn_ok"  class="btn btn-success btn-sm"> Verifikasi </button>
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            
            
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- modal verified -->
  <div class="modal fade" id="modalunverif"  role="dialog"  aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog modal-xl" >
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalunverif">Rincian SP2D</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div id="accordion1">
              <div class="card">
                <div class="card-header" id="headingOne1">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                      PREVIEW SP2D
                    </button>
                  </h5>
                </div>

                <div id="collapseOne1" class="collapse show" aria-labelledby="headingOne1" data-parent="#accordion">
                  
                      <input type="hidden" id="nosp2d2" name="nosp2d2">
                      <label id="cetak2"></label>
                  
                </div>
              </div>
              <div class="card">
                <div class="card-header bg-warning" id="headingTwo1">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                      Potongan
                    </button>
                  </h5>
                </div>
                <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo1" data-parent="#accordion">
                  <div class="card-body">
                        <table id="tabelpotongan2" class="table table-bordered table-striped" width="100%">
                          <thead>
                            <tr>
                                <th>No</th>  
                                <th>Kode Rekening</th>
                                <th>Nama Rekening</th>
                                <th>Id Billing</th>
                                <th>Nilai</th>
                              </tr>
                          </thead>
                        </table>
                        <br />
                        <div class="row">
                          <div class="col-md-8">

                          </div>
                          <div class="col-md-4"><b>
                            Total Potongan
                            <span id="potonganverif"></span>
                            </b>
                          </div>
                        </div>
                  </div>
                </div>
                
              </div>
              
            </div>
          <div class="modal-footer">
            <button name="btn_tolak" id="btn_tolak"  class="btn btn-danger btn-sm"> Batal Verifikasi </button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_cair"  role="dialog"  aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog modal-xl" >
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modal_cair">Rincian SP2D</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="row">
            <input type="hidden" id="nosp2d2" name="nosp2d2">
          <label id="cetak3"></label>
          </div>
          <div class="modal-footer">
            <!-- <button name="btn_ok" id="btn_ok"  class="btn btn-success btn-sm"> Verifikasi </button> -->
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>  
</div>


  <!-- Scripts for this page -->
  <!-- Scripts for this page -->
 <!--  <script type="text/javascript">
     $(document).ready(function(){
      $(".btn-delete").click(function(){
        if (!confirm("Do you want to delete")){
          return false;
        }
      });
    });
  </script> -->
 <!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
$("#sp2d> a").addClass('active');

    function activaTab(tab){
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    };


    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": true,
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

  var table2 = $('#na_datatable2').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?= base_url('admin/sp2d/datatable_json_verified') ?>",
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

  var table3 = $('#na_datatable3').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?= base_url('admin/sp2d/datatable_json_cair') ?>",
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
// var nosp2d = '';
  var tables = $('#tabelpotongan').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
          url: "<?=base_url('admin/sp2d/datatable_potongan/')?>",
          data: function(e) {
            e.nosp2ddet = document.getElementById('nosp2d').value
          }
        },
        "deferLoading": 0,
        "columnDefs": [
            { "targets": 0, "name": "", 'searchable':false, 'orderable':true},
            { "targets": 1, "name": "kd_rek6", 'searchable':true, 'orderable':true},
            { "targets": 2, "name": "nm_rek6", 'searchable':true, 'orderable':true},
            { "targets": 3, "name": "idbilling", 'searchable':true, 'orderable':false},
            { "targets": 4, "name": "nilai", 'searchable':true, 'orderable':false}
        ]
      });

      var tables2 = $('#tabelpotongan2').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
          url: "<?=base_url('admin/sp2d/datatable_potongan/')?>",
          data: function(e) {
            e.nosp2ddet = document.getElementById('nosp2d2').value
          }
        },
        "deferLoading": 0,
        "columnDefs": [
            { "targets": 0, "name": "", 'searchable':false, 'orderable':true},
            { "targets": 1, "name": "kd_rek6", 'searchable':true, 'orderable':true},
            { "targets": 2, "name": "nm_rek6", 'searchable':true, 'orderable':true},
            { "targets": 3, "name": "idbilling", 'searchable':true, 'orderable':false},
            { "targets": 4, "name": "nilai", 'searchable':true, 'orderable':false}
        ]
      });

      

  $('#na_datatable').on('click', '.detailsp2d', function() {
        $('#largeModal').modal('show');
        nosp2d = $(this).data('sp2d');
        $('#nosp2d').val(nosp2d);
        tables.ajax.reload();
        sp2d = nosp2d.split("/").join("okepunya");
        document.getElementById('cetak').innerHTML = "<embed src='<?php echo base_url(); ?>admin/sp2d/sp2d/" + sp2d + "' width='870px' height='500px'>";
        get_total_potongan(nosp2d);
      });

      $('#na_datatable2').on('click', '.detailsp2d', function() {
        $('#modalunverif').modal('show');
        nosp2d = $(this).data('sp2d');
        $('#nosp2d2').val(nosp2d);
        tables2.ajax.reload();
        sp2d = nosp2d.split("/").join("okepunya");
        document.getElementById('cetak2').innerHTML = "<embed src='<?php echo base_url(); ?>admin/sp2d/sp2d/" + sp2d + "' width='870px' height='500px'>";
        get_total_potongan2(nosp2d);
      });

      $('#na_datatable3').on('click', '.detailsp2d', function() {
        $('#modal_cair').modal('show');
        nosp2d = $(this).data('sp2d');
        sp2d = nosp2d.split("/").join("okepunya");
        document.getElementById('cetak3').innerHTML = "<embed src='<?php echo base_url(); ?>admin/sp2d/sp2d/" + sp2d + "' width='870px' height='500px'>";
      });



$('#btn_ok').on('click', function() {
  var no_sp2d        = $('#nosp2d').val();
      $.ajax({
            url: "<?php echo base_url("admin/sp2d/verifikasi/");?>",
            type: "POST",
            data: {
              '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
              verif:1,
              id:no_sp2d

            },
            cache: false,
            success: function(dataResult){
              var dataResult = JSON.parse(dataResult);
              if(dataResult.statusCode==200){
                Swal.fire(
                        'Success!',
                        'SP2D berhasil diverifikasi.',
                        'success'
                      )
                $('#largeModal').modal('hide');
                refresh_datatable();
              }
              else if(dataResult.statusCode==201){
                Swal.fire(
                        'Oops!',
                        'SP2D gagal diverifikasi.',
                        'error'
                      )
                $('#largeModal').modal('hide');
              }
            }
          });
            

});

$('#btn_tolak').on('click', function() {
  var no_sp2d        = $('#nosp2d2').val();
      $.ajax({
            url: "<?php echo base_url("admin/sp2d/verifikasi/");?>",
            type: "POST",
            data: {
              '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
              verif:0,
              id:no_sp2d

            },
            cache: false,
            success: function(dataResult){
              var dataResult = JSON.parse(dataResult);
              if(dataResult.statusCode==200){
                Swal.fire(
                        'Success!',
                        'SP2D berhasil dibatal verifikasi.',
                        'success'
                      )
                $('#modalunverif').modal('hide');
                refresh_datatable();
              }
              else if(dataResult.statusCode==201){
                Swal.fire(
                        'Oops!',
                        'SP2D gagal dibatal verifikasi.',
                        'error'
                      )
                      
                $('#modalunverif').modal('hide');
              }
            }
          });
            

});


function get_total_potongan(nosp2d) {


  $.ajax({    
        type: "POST",
        url: "<?php echo base_url("admin/sp2d/totalpotongan");?>",
        data:{
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          nosp2d:nosp2d
        },
        dataType: "json",                  
        success: function(data){
          $.each(data, function(key, value) {
            document.getElementById("potonganunverif").textContent=number_format(value.potongan,"2",",",".");
          })                    
            
           
        }
    });
}

function get_total_potongan2(nosp2d) {


$.ajax({    
      type: "POST",
      url: "<?php echo base_url("admin/sp2d/totalpotongan");?>",
      data:{
        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
        nosp2d:nosp2d
      },
      dataType: "json",                  
      success: function(data){
        $.each(data, function(key, value) {
          document.getElementById("potonganverif").textContent=number_format(value.potongan,"2",",",".");
        })                    
          
         
      }
  });
}

function refresh_datatable() {
        table.ajax.url("<?=base_url('admin/sp2d/datatable_json')?>");
        table.ajax.reload();

        table2.ajax.url("<?=base_url('admin/sp2d/datatable_json_verified')?>");
        table2.ajax.reload();

        table3.ajax.url("<?=base_url('admin/sp2d/datatable_json_cair')?>");
        table3.ajax.reload();
}
  </script>

