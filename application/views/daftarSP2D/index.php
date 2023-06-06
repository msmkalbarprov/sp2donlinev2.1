
            
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- content -->
                            <?php $this->load->view('admin/includes/_messages.php') ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">Verifikasi SP2D </h4>
        
                                        <ul class="nav nav-tabs nav-bordered">
                                            <li class="nav-item">
                                                <a href="#home-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                    Daftar SP2D
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                    Terverifikasi
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#messages-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                    Tersalurkan
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="home-b1">
                                                <table id="na_datatable" class="table table-bordered dt-responsive table-responsive" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">No</th>  
                                                            <th class="text-center">No. SP2D</th>
                                                            <th class="text-center">Tanggal Terbit</th>
                                                            <th class="text-center">Keperluan</th>
                                                            <th class="text-center">Tujuan</th>
                                                            <th class="text-center">Nilai</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center"> Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                                    
                                               
                                            </div>
                                            <div class="tab-pane" id="profile-b1">
                                                <table id="na_datatable2" class="table table-bordered dt-responsive table-responsive" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">No</th>  
                                                            <th class="text-center">No. SP2D</th>
                                                            <th class="text-center">Tanggal Terbit</th>
                                                            <th class="text-center">Keperluan</th>
                                                            <th class="text-center">Tujuan</th>
                                                            <th class="text-center">Nilai</th>
                                                            <th class="text-center">Status/Verifikator</th>
                                                            <th class="text-center"> Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="messages-b1">
                                                <table id="na_datatable3" class="table table-bordered dt-responsive table-responsive" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">No</th>  
                                                            <th class="text-center">No. SP2D</th>
                                                            <th class="text-center">Tanggal Terbit</th>
                                                            <th class="text-center">Keperluan</th>
                                                            <th class="text-center">Tujuan</th>
                                                            <th class="text-center">Nilai</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center"> Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                        
                        <!-- content -->
                    </div> <!-- container -->

                </div> <!-- content -->
                <!-- start modal verifikasi -->
                    <div id="largeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full-width">
                            <div class="modal-content p-0">
                                <div id="accordion">
                                    <div class="card mb-0">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="m-0">
                                                <a href="#collapseOne" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                                    Berkas SP2D
                                                </a>
                                            </h5>
                                        </div>
                            
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                            <div class="card-body text-center">
                                                <input type="hidden" id="nosp2d" name="nosp2d" >
                                                <label id="cetak" width="100%"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-0">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="m-0">
                                                <a href="#collapseTwo" class="collapsed text-dark" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                                    Daftar Potongan
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
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
                                                    <p class="text-danger"> cek secara teliti data sp2d dan data potongan. Khusus PPH dan PPN selain Belanja Gaji Pokok dipastikan idbilling terisi.</p>
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
                                    <div class="card-footer">
                                        <div class="text-end">
                                            <button class="btn btn-primary waves-effect waves-light" name="btn_ok" id="btn_ok" type="submit">Verifikasi</button>
                                            <button type="reset" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                <!-- end modal verivikasi -->

                <!-- start modal batal verifikasi -->
                <div id="modalunverif" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full-width">
                            <div class="modal-content p-0">
                                <div id="accordion2">
                                    <div class="card mb-0">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="m-0">
                                                <a href="#collapseOne" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                                    Berkas SP2D
                                                </a>
                                            </h5>
                                        </div>
                            
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion2">
                                            <div class="card-body text-center">
                                                <input type="hidden" id="nosp2d2" name="nosp2d2" >
                                                <label id="cetak2" width="100%"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-0">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="m-0">
                                                <a href="#collapseTwo" class="collapsed text-dark" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                                    Daftar Potongan
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion2">
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
                                                    <p class="text-danger"> cek secara teliti data sp2d dan data potongan. Khusus PPH dan PPN selain Belanja Gaji Pokok dipastikan idbilling terisi.</p>
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
                                    <div class="card-footer">
                                        <div class="text-end">
                                            <button class="btn btn-primary waves-effect waves-light" name="btn_tolak" id="btn_tolak" type="submit">Batal Verifikasi</button>
                                            <button type="reset" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                <!-- end modal batal verivikasi -->

                <!-- start modal cair -->
                <div id="modal_cair" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full-width">
                            <div class="modal-content p-0">
                                <div id="accordion3">
                                    <div class="card mb-0">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="m-0">
                                                <a href="#collapseOne" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                                    Berkas SP2D
                                                </a>
                                            </h5>
                                        </div>
                            
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion3">
                                            <div class="card-body text-center">
                                                <label id="cetak3" width="100%"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-0">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="m-0">
                                                <a href="#collapseTwo" class="collapsed text-dark" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                                    Daftar Potongan
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion3">
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
                                                    <p class="text-danger"> cek secara teliti data sp2d dan data potongan. Khusus PPH dan PPN selain Belanja Gaji Pokok dipastikan idbilling terisi.</p>
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
                                    <div class="card-footer">
                                        <div class="text-end">
                                            <button type="reset" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                <!-- end modal batal cair -->
                
                <script src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
                <script src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script>

                




<script type="text/javascript">
$(document).ready(function(){

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
                        'SP2D '+no_sp2d+' berhasil diverifikasi.',
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
                        'SP2D '+no_sp2d+' berhasil dibatal verifikasi.',
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

});


</script>