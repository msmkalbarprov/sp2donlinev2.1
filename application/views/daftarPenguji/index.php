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
                                        <h4 class="header-title mb-4">Kirim Daftar Penguji </h4>
                                        <input type="hidden" name="sumbertab" id="sumbertab">
                                        <ul class="nav nav-tabs nav-bordered">
                                            <!-- <li class="nav-item">
                                                <a href="#daftarpenguji-p1" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                    Detail penguji
                                                </a>
                                            </li> -->
                                            <li class="nav-item show active">
                                                <a href="#daftarpenguji" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                    Daftar penguji
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#detail-p1" data-bs-toggle="tab" aria-expanded="false" class="nav-link disabled ">
                                                    Detail penguji
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#detail-s1" data-bs-toggle="tab" aria-expanded="false" class="nav-link disabled">
                                                    Detail SP2D
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#kirim-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link disabled">
                                                    Verifikasi
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#sukses-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                    Sukses
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="daftarpenguji">
                                                <table id="datatablepenguji" class="table table-bordered dt-responsive table-responsive" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%" style="text-align:center">Nomor</th>
                                                            <th width="40%" style="text-align:center">Nomor Penguji</th>
                                                            <th width="20%" style="text-align:center">Tanggal</th>
                                                            <th width="25%" style="text-align:center">Status</th>
                                                            <th width="10%" style="width: 50px;text-align: center;" >Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="detail-p1">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="userName" class="form-label">Nomor Penguji<span class="text-danger">*</span></label>
                                                                            <input type="text" name="no_uji" parsley-trigger="change" required placeholder="Nomor penguji" class="form-control" id="no_uji" readonly/>
                                                                            <input type="hidden" name="no_uji_kirim" parsley-trigger="change" required placeholder="Nomor penguji" class="form-control" id="no_uji_kirim" readonly/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="emailAddress" class="form-label">Tanggal Penguji<span class="text-danger">*</span></label>
                                                                            <input type="text" name="tgl_uji" parsley-trigger="change" required placeholder="Tanggal penguji" class="form-control" id="tgl_uji" readonly/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="userName" class="form-label">Nilai<span class="text-danger">*</span></label>
                                                                            <input type="text" name="nilai_uji" parsley-trigger="change" required placeholder="nilai penguji" class="form-control" id="nilai_uji" readonly/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="emailAddress" class="form-label">Keterangan<span class="text-danger">*</span></label>
                                                                            <input type="text" name="status_bank" parsley-trigger="change" required placeholder="Keterangan" class="form-control" id="status_bank" readonly/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="text-end">
                                                                    <button class="btn btn-success waves-effect" onclick="javascript:validasisp2d();">Validasi</button>
                                                                    <button class="btn btn-danger waves-effect" onclick="javascript:batalsp2d();">Batal</button>
                                                                        <button class="btn btn-primary waves-effect" onclick="javascript:kirimsp2d();">Kirim</button>
                                                                        <button type="reset" class="btn btn-secondary waves-effect" onclick="javascript:kembali1();">Kembali</button>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <table id="SP2DDatatable" class="table table-bordered dt-responsive table-responsive" width="100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center">No</th>
                                                                                    <th class="text-center"><small>No.SP2D<br>tanggal</small></th>
                                                                                    <th class="text-center">SKPD</th>
                                                                                    <th class="text-center"><small>Penerima<br>Rekening<br>NPWP</small></th>
                                                                                    <th class="text-center">Nilai</th>
                                                                                    <th style="width: 30px;" class="text-center">Status</th>
                                                                                    <th style="width: 30px;text-align: center;" >Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- end row -->
                                                                
                                                            </div> <!-- end card-body -->
                                                        </div> <!-- end card -->
                                                    </div> <!-- end col -->
                                                </div>
                                                <!-- end row -->
                                            </div>
                                            <div class="tab-pane" id="detail-s1">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="no_sp2d_pot" class="form-label">Nomor SP2D<span class="text-danger">*</span></label>
                                                                            <input type="text" name="no_sp2d_pot" parsley-trigger="change" required placeholder="Nomor SP2D" class="form-control" id="no_sp2d_pot" readonly/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="tgl_sp2d_pot" class="form-label">Tanggal SP2D<span class="text-danger">*</span></label>
                                                                            <input type="text" name="tgl_sp2d_pot" parsley-trigger="change" required placeholder="Tanggal penguji" class="form-control" id="tgl_sp2d_pot" readonly/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nilai_bruto" class="form-label">Nilai Bruto<span class="text-danger">*</span></label>
                                                                            <input type="text" name="nilai_bruto" parsley-trigger="change" required placeholder="nilai penguji" class="form-control" id="nilai_bruto" readonly/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="npwp_penerima" class="form-label">NPWP<span class="text-danger">*</span></label>
                                                                            <input type="text" name="npwp_penerima" parsley-trigger="change" required placeholder="nilai penguji" class="form-control" id="npwp_penerima" readonly/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nama_skpd" class="form-label">SKPD<span class="text-danger">*</span></label>
                                                                            <input type="text" name="nama_skpd" parsley-trigger="change" required placeholder="nama SKPD" class="form-control" id="nama_skpd" readonly/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="penerima" class="form-label">Penerima<span class="text-danger">*</span></label>
                                                                            <input type="text" name="penerima" parsley-trigger="change" required placeholder="Keterangan" class="form-control" id="penerima" readonly/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="norek_penerima" class="form-label">Rekening<span class="text-danger">*</span></label>
                                                                            <input type="text" name="norek_penerima" parsley-trigger="change" required placeholder="nilai penguji" class="form-control" id="norek_penerima" readonly/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="emailAddress" class="form-label">Bank<span class="text-danger">*</span></label>
                                                                            <input type="text" name="nama_bank" parsley-trigger="change" required placeholder="Keterangan" class="form-control" id="nama_bank" readonly/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="keterangan" class="form-label">Keperluan<span class="text-danger">*</span></label>
                                                                            <textarea name="keterangan" parsley-trigger="change" required placeholder="Keterangan" class="form-control" id="keterangan" readonly></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="statussp2d" class="form-label">Status/Keterangan<span class="text-danger">*</span></label>
                                                                            <textarea name="statussp2d" parsley-trigger="change" required placeholder="Keterangan" class="form-control" id="statussp2d" readonly></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="text-end">
                                                                        <button type="reset" class="btn btn-secondary waves-effect" onclick="javascript:kembali2();">Kembali</button>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <table id="PotonganDatatable" class="table table-bordered dt-responsive table-responsive" width="100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="2%">No</th>
                                                                                <th width="4%">Kode Akun</th>
                                                                                <th width="30%">Nama Akun</th>
                                                                                <th width="10%">Nilai Potongan</th>
                                                                                <th width="7%">ID Billing</th>
                                                                                <th width="7%">NTPN</th>
                                                                                <th width="40%">Keterangan</th>
                                                                            </tr>
                                                                        </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- end row -->
                                                                
                                                            </div> <!-- end card-body -->
                                                        </div> <!-- end card -->
                                                    </div> <!-- end col -->
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="kirim-b1">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                <div class="col-lg-4">
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="mb-3">
                                                                            <label for="userName" class="form-label">Nomor Penguji<span class="text-danger">*</span></label>
                                                                            <input type="text" name="noadvicesotp" class="form-control" id="noadvicesotp" readonly="true"/>
                                                                            <input type="hidden" name="noadvicesotp1" class="form-control" id="noadvicesotp1" readonly="true"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-lg-4">
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="mb-3">
                                                                            <label for="userName" class="form-label">Kode OTP<span class="text-danger">*</span></label>
                                                                            <input type="number" pattern="/^-?\d+\.?\d*$/" name="otp" class="form-control" id="otp" onKeyPress="if(this.value.length==6) return false;" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <small>Pastikan kode OTP diinput 6 digit dan berdasarkan sms terakhir</small>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="text-center">
                                                                        <button class="btn btn-primary waves-effect" onclick="javascript:kirimotp();">Validasi OTP</button>
                                                                        <button type="reset" class="btn btn-secondary waves-effect" onclick="javascript:kembali1();">Batal</button>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- end row -->
                                                                
                                                            </div> <!-- end card-body -->
                                                        </div> <!-- end card -->
                                                    </div> <!-- end col -->
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="sukses-b1">
                                            <table id="datatablepengujisukses" class="table table-bordered dt-responsive table-responsive" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%" style="text-align:center">Nomor</th>
                                                            <th width="40%" style="text-align:center">Nomor Penguji</th>
                                                            <th width="20%" style="text-align:center">Tanggal</th>
                                                            <th width="25%" style="text-align:center">Status</th>
                                                            <th width="10%" style="width: 50px;text-align: center;" >Action</th>
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
                
                
                <script src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
                <script src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    let noadvices = null
    let nosp2d = null
    let nosp2ddet = null

var table = $('#datatablepenguji').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?= base_url('admin/TukdBank/datatable_json') ?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "no_uji", 'searchable':true, 'orderable':false},
    { "targets": 1, "name": "tgl_uji", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "status", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });

  var table2 = $('#datatablepengujisukses').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?= base_url('admin/TukdBank/datatable_json_sukses') ?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "no_uji", 'searchable':true, 'orderable':false},
    { "targets": 1, "name": "tgl_uji", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "status", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });

  var table3 = $('#SP2DDatatable').DataTable( {
        // "processing": true,
        // "serverSide": true,
        "ordering":false,
        "ajax": {
          url: "<?=base_url('admin/TukdBank/datatable_sp2d/')?>",
          data: function(d) {
            d.noadvices = noadvices
          }
        },
        "deferLoading": 0,
        "columnDefs": [
            { "targets": 0, "name": "", 'searchable':false, 'orderable':true},
            { "targets": 1, "name": "sp2d", 'searchable':true, 'orderable':true},
            { "targets": 2, "name": "skpd", 'searchable':true, 'orderable':false},
            { "targets": 3, "name": "penerima", 'searchable':true, 'orderable':false},
            { "targets": 4, "name": "nilai", 'searchable':true, 'orderable':false},
            { "targets": 5, "name": "status", 'searchable':false, 'orderable':false},
            { "targets": 6, "name": "aksi", 'searchable':false, 'orderable':false}
        ]
      });

  $('#datatablepenguji').on('click', '.detail', function() {
        noadvices       = $(this).data('no_uji')
        tgl_uji         = $(this).data('tgl_uji')
        status_bank     = $(this).data('status_bank')
        nilai_uji       = $(this).data('nilai_uji')
        table3.ajax.reload()
        activaTab('detail-p1')
        document.getElementById("sumbertab").value = '1';
        document.getElementById("no_uji").value = noadvices;
        document.getElementById("no_uji_kirim").value = noadvices;
        document.getElementById("noadvicesotp").value = noadvices;
        document.getElementById("noadvicesotp1").value = noadvices;
        document.getElementById("tgl_uji").value = tgl_uji;
        document.getElementById("nilai_uji").value = number_format(nilai_uji,"2",",",".");;
        
        document.getElementById("status_bank").value = status_bank;
      });


      $('#datatablepengujisukses').on('click', '.detail', function() {
        noadvices       = $(this).data('no_uji')
        tgl_uji         = $(this).data('tgl_uji')
        status_bank     = $(this).data('status_bank')
        nilai_uji       = $(this).data('nilai_uji')
        table3.ajax.reload()
        activaTab('detail-p1')
        document.getElementById("sumbertab").value = '2';
        document.getElementById("no_uji").value = noadvices;
        document.getElementById("no_uji_kirim").value = noadvices;
        document.getElementById("tgl_uji").value = tgl_uji;
        document.getElementById("nilai_uji").value = number_format(nilai_uji,"2",",",".");;
        
        document.getElementById("status_bank").value = status_bank;
      });
    
    var tables = $('#PotonganDatatable').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
          url: "<?=base_url('admin/TukdBank/datatable_potongan/')?>",
          data: function(e) {
            e.nosp2ddet = nosp2ddet
          }
        },
        "deferLoading": 0,
        "columnDefs": [
            { "targets": 0, "name": "", 'searchable':false, 'orderable':true},
            { "targets": 1, "name": "kd_rek6", 'searchable':true, 'orderable':true},
            { "targets": 2, "name": "nm_rek6", 'searchable':true, 'orderable':true},
            { "targets": 3, "name": "nilai", 'searchable':true, 'orderable':false},
            { "targets": 4, "name": "idbilling", 'searchable':true, 'orderable':false},
            { "targets": 5, "name": "status", 'searchable':true, 'orderable':false}
        ]
    });
    
    $('#SP2DDatatable').on('click', '.detailsp2d', function() {

        nosp2ddet       = $(this).data('sp2det')
        keperluan       = $(this).data('sp2ket')
        statussp2d      = $(this).data('sp2stat')
        tgl_sp2d        = $(this).data('tgl_sp2d')
        nilai_bruto     = $(this).data('nilai_bruto')
        tgl_sp2d        = $(this).data('tgl_sp2d')
        nm_skpd         = $(this).data('nm_skpd')
        penerima        = $(this).data('penerima')
        norek_penerima  = $(this).data('norek_penerima')
        npwp            = $(this).data('npwp')
        nm_bank_penerima= $(this).data('nm_bank_penerima')
        
        
        
        tables.ajax.reload()
        var data = table.row( $(this).parents('tr') ).data();
        document.getElementById("no_sp2d_pot").value    = nosp2ddet;
        document.getElementById("tgl_sp2d_pot").value   = tgl_sp2d;
        document.getElementById("nilai_bruto").value    = nilai_bruto;
        document.getElementById("penerima").value       = penerima;
        document.getElementById("norek_penerima").value = norek_penerima;
        document.getElementById("npwp_penerima").value  = npwp;
        document.getElementById("keterangan").value     = keperluan;
        document.getElementById("statussp2d").value     = statussp2d;
        document.getElementById("nama_skpd").value      = nm_skpd;
        document.getElementById("nama_bank").value      = nm_bank_penerima;
        activaTab('detail-s1')

    });

});
function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};

    function kembali1() {
        var tab = document.getElementById("sumbertab").value;
        if(tab==2){
            activaTab('sukses-b1')
        }else{
            activaTab('daftarpenguji')
        }
        
        
    }
    function kembali2() {
        activaTab('detail-p1')
    }

    

  function refreshtable(){
        $('#SP2DDatatable').DataTable().ajax.reload();
    }

    function validasisp2d(){
        var nouji = document.getElementById('no_uji_kirim').value;
        if(nouji==''){
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Nomor Penguji Kosong!!'
            });
            return;
        }
        Swal.fire({
                title: 'Yakin untuk validasi semua SP2D?',
                text: "No Penguji :  "+nouji,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
              }).then((result) => {
                if (result.value) {

                    swal({  
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                            title: 'Proses Validasi',
                            text: 'Silahkan tunggu sampai proses selesai!',
                            onOpen: function () {
                              swal.showLoading()
                            }
                        })


                    $(document).ready(function(){
                        $.ajax({
                        type: "POST",       
                        dataType : 'json',         
                        url      : "<?php echo base_url(); ?>admin/TukdBank/validasisp2d/ ",
                        data     : {
                                    no_uji:nouji,
                                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                                    },
                            success:function(data){
                                status = data.status;
                                if (status==0){
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Oops...',
                                        text: 'SP2D gagal divalidasi!!'
                                    });
                                }else if (status==2){
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Gagal Validasi',
                                        text: 'SP2D sedang dalam proses bank'
                                    });
                                }else if (status==1 || status==true){ 
                                    Swal.fire(
                                    'Berhasil!',
                                    'SP2D berhasil divalidasi.',
                                    'success'
                                    )
                                    $('#SP2DDatatable').DataTable().ajax.reload();
                                } 

                            }
                        });
                    });
                }
            })
    }
    
    function batalsp2d(){
      var nouji = document.getElementById('no_uji_kirim').value;
      Swal.fire({
                title: 'Yakin untuk batal validasi semua SP2D?',
                text: "No Penguji :  "+nouji,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
              }).then((result) => {
                if (result.value) {

                    swal({  
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                            title: 'Proses Validasi',
                            text: 'Silahkan tunggu sampai proses selesai!',
                            onOpen: function () {
                              swal.showLoading()
                            }
                        })


                  $(document).ready(function(){
                      $.ajax({
                        type: "POST",       
                        dataType : 'json',         
                        url      : "<?php echo base_url(); ?>admin/TukdBank/batalsp2d/ ",
                        data     : {no_uji:nouji, 
                                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                                },
                        
                        success:function(data){
                        status = data.status;
                          if (status==false){
                             Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'SP2D gagal batal validasi'
                              });
                          } else { 
                            Swal.fire(
                              'Berhasil!',
                              'SP2D berhasil batal validasi',
                              'success'
                            )
                            // table.ajax.reload();
                            $('#SP2DDatatable').DataTable().ajax.reload();
                          } 

                        }
                      });
                  });                  
                }
              })
    }
    
    function kirimsp2d(){
        var nouji       = document.getElementById('no_uji_kirim').value;
        var statusbank  = document.getElementById('status_bank').value;
        if(statusbank=='SUKSES'){
            swal.close()
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Daftar Penguji sudah cair!!'
                });
            return
        }

        var advis = nouji.split("/").join("abcdefghij");  
        Swal.fire({
                title: 'Yakin Untuk Proses ke Bank?',
                text: "No Penguji :  "+nouji,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim!'
            }).then((result) => {
                if (result.value) {
                  
                    swal({  
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                            title: 'Proses Kirim Penguji',
                            text: 'Silahkan tunggu sampai proses selesai!',
                            onOpen: function () {
                              swal.showLoading()
                            }
                        })


                    $(document).ready(function(){
                        $.ajax({
                            type: "POST",       
                            dataType : 'json',         
                            url      : "<?php echo base_url(); ?>admin/TukdBank/proses_kebank/ ",
                            data     : {no_uji:nouji, 
                                        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                                    },
                        
                            success:function(data){
                                status = data.status;
                                if (status==true || status=='true'){
                                    swal.close()
                                    Swal.fire(
                                        'Penguji berhasil dikirim!!',
                                        'Silahkan masukan kode OTP',
                                        'success'
                                    )
                                    document.getElementById("otp").value = "";
                                    
                                    activaTab('kirim-b1')
                                }else{ 
                                    message = data.message;
                                    swal.close()
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Oops...Penguji gagal dikirim!!',
                                        text: message
                                    });
                                } 

                            }
                        });
                    });


                  
                }
            })
    }

    function kirimotp() {
    var nouji = document.getElementById('noadvicesotp').value;
    var kode_otp = document.getElementById('otp').value;

    if (kode_otp.length<6){
        Swal.fire({
            type: 'error',
            title: 'Oops...!!',
            text: 'Silahkan masukkan 6 digit kode OTP '
          });
        return;
      }

    if (nouji==''){
        Swal.fire({
            type: 'error',
            title: 'Oops...!!',
            text: 'Nomor Penguji belum dipilih!'
          });
        return;
      }

  // var numbers = /^[0-9]+$/;
  //     if(kode_otp.match(numbers))
  //     {
       Swal.fire({
                title: 'Yakin untuk proses pencairan No Penguji :  '+nouji+' ?',
                text: "Setelah kode otp terkirim, maka pencairan sp2d terproses secara otomatis dan tidak bisa dibatalkan!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim!'
              }).then((result) => {
                if (result.value) {

                  swal({
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        title: 'verifikasi OTP',
                        text: 'Silahkan tunggu sampai proses selesai!',
                        onOpen: function () {
                          swal.showLoading()
                        }
                      })

                    $(document).ready(function(){
                          $.ajax({
                              type: "POST",       
                              dataType : 'json',         
                              url      : "<?php echo base_url(); ?>admin/TukdBank/kirimotp/ ",
                              data     : {advice:nouji,otp:kode_otp, 
                                        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                                    },
                              success:function(data){
                              var status = data.status;
                              
                                if (status == true || status == 'true'){
                                      swal.close()
                                      var swal_html = '<div class="row"><div class="col-lg-12"><div class="row"><div class="col-lg-3">Jenis</div><div class="col-lg-3">Berhasil</div><div class="col-lg-3">Pending</div><div class="col-lg-3">Gagal</div></div><div class="row"><div class="col-lg-3">SP2D</div><div class="col-lg-3">'+data.sukses+'</div><div class="col-lg-3">'+data.pending+'</div><div class="col-lg-3">'+data.gagal+'</div></div><div class="row"><div class="col-lg-3">Pajak</div><div class="col-lg-3">'+data.suksesp+'</div><div class="col-lg-3">'+data.pendingp+'</div><div class="col-lg-3">'+data.gagalp+'</div></div></div></div>';

                                    Swal.fire({
                                                type: 'success',
                                                title: 'OTP BERHASIL',
                                                html: swal_html
                                            });
                                    //   Swal.fire(
                                    //         'Verifikasi OTP Berhasil!',
                                    //         'SP2D Berhasil: '+data.sukses+'<br>SP2D Pending: '+data.pending+'<br>SP2D Gagal: '+data.gagal+'<br>Pajak Berhasil: '+data.suksesp+'<br>Pajak Pending: '+data.pendingp+'<br>Pajak Gagal: '+data.gagalp ,
                                    //         'success'
                                    //       )
                                    document.getElementById('noadvicesotp').value='';
                                        document.getElementById('noadvicesotp1').value='';
                                        document.getElementById('otp').value='';
                                        table.ajax.reload()
                                        table3.ajax.reload() 
                                          kembali2();
                                        

                                } else if(status == false || status == 'false'){ 
                                     Swal.fire({
                                      type: 'error',
                                      title: 'Oops...',
                                      text: 'Verifikasi OTP gagal'
                                    });
                                }else{
                                    Swal.fire({
                                      type: 'error',
                                      title: 'Oops...',
                                      text: 'Kode OTP Harus Berupa angka 6 digit'
                                    });
                                }   
                      
                              }
                          });
                      });
                  }
              })
      // }
      // else
      // {
      // alert('Please input numeric characters only');
      // document.form1.text1.focus();
      // return false;
      // }

   
  }

</script>