<!-- datatable -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">   

<div class="content-wrapper">
  <?php $csrf = $this->security->get_csrf_hash() ?>
  <input id="csrf" type="hidden" value="<?= $csrf ?>">
 <section class="content">
  <div class="card">
    
 
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Daftar Penguji</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Detail Daftar Penguji</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu3">Detail SP2d</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Kirim Daftar Penguji</a>
    </li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <h3>Daftar Penguji</h3>
      <div class="card-body table-responsive">
      <table id="AdvicesDatatable" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Nomor Penguji</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th style="width: 50px;text-align: center;" >Action</th>
        </tr>
        </thead>
        <tbody>
          <?php 
            $count=0; foreach($all_advices as $row):
              if ($row['status_bank']== null || $row['status_bank']== 0){
                $status='<span class="badge badge-danger">Belum verifikasi</span>';
              }else if ($row['status_bank']=='1'){
                $status='<span class="badge badge-info">Sudah Verifikasi</span>';
              }else if ($row['status_bank']=='2'){
                $status='<span class="badge badge-warning">Proses</span>';
              }else if ($row['status_bank']=='3'){
                $status='<span class="badge badge-danger">Batal</span>';
              }else if ($row['status_bank']=='4'){
                $status='<span class="badge badge-success">Selesai</span>';
              }else if ($row['status_bank']=='5'){
                $status='<span class="badge badge-dark">Pending Bank (Rek. Penampung)</span>';
              }else{
                $status='<span class="badge badge-danger">batal</span>';
              }
          ?>
          <tr>
            <td><?= htmlspecialchars($row['no_uji']); ?></td>
            <td><?= htmlspecialchars($row['tgl_uji']); ?></td>
            <td><?= $this->security->xss_clean($status); ?></td>
            <td>
              <a title="Detail"  class="update btn btn-sm btn-warning detail" data-tgl_uji="<?= htmlspecialchars($row['tgl_uji']); ?>" data-no_uji='<?= htmlspecialchars($row['no_uji']); ?>' data-status_bank='<?= htmlspecialchars($row['status_bank']); ?>' > <i class="fa fa-list"></i></a>
              
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    </div>

    <div id="menu1" class="container tab-pane fade"><br>
      <h3>SP2D List</h3>
      <div class="row">
          <div class="col-12 col-sm-6">
            <div class="card card-primary card-tabs">
              
              <div class="card-body">
                <div class="form-group">
                  <label>No. Penguji</label>
                  <input type="text" name="noadvices" class="form-control" id="noadvices" readonly="true" />
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="card card-primary card-tabs">
              
              <div class="card-body">
                <div class="form-group">
                  <label>Tanggal Penguji</label>
                  <input type="date" name="tgluji" id="tgluji" class="form-control" readonly="true"/>  
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <div class="col-12" align="center">
            <button class="btn btn-success btn-sm" onclick="javascript:validasisp2d();"><i class="fa fa-check-square-o"></i> Validasi SP2D</button>&nbsp;
            <button class="btn btn-danger btn-sm" onclick="javascript:batalsp2d();"><i class="fa fa-window-close"></i> Batal Validasi SP2D</button>&nbsp;
            <button class="btn btn-primary btn-sm" onclick="javascript:kirimsp2d();"><i class="fa fa-send"></i> Kirim Penguji</button>
            <button class="btn btn-warning btn-sm" onclick="javascript:kembali1();"><i class="fa fa-undo"></i> Kembali</button>
          </div>
        </div>
        
        <div class="card-body table-responsive">
      <table id="SP2DDatatable" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Nomor.SP2D</th>
          <th>Tanggal</th>
          <th>Nilai</th>
          <th>Penerima</th>
          <th>Nomor.Rekening</th>
          <th>NPWP</th>
          <th>Status</th>
          <th style="width: 100px;text-align: center;" >Action</th>
        </tr>
        </thead>
        
      </table>
    </div>
      </div>
    <div id="menu2" class="container tab-pane fade"><br>
      
      <div class="row">
        <div class="col-12 col-sm-4">
          &nbsp;
        </div>
        <div class="col-12 col-sm-4">
            <div class="card card-primary card-tabs">
              <div class="card-header">
                <h4>Verifikasi Kode OTP</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>No. Penguji</label>
                  <input type="text" name="noadvices_kirim" class="form-control" id="noadvices_kirim" readonly="true"/>
                </div>
                <div class="form-group">
                  <label>Kode OTP</label>
                  <input type="number" pattern="/^-?\d+\.?\d*$/" name="otp" class="form-control" id="otp" onKeyPress="if(this.value.length==6) return false;" />
                  <!-- <input type="text" pattern="\d*" name="otp" class="form-control" id="otp" maxlength="6" /> -->
                </div>
              </div>
              <div class="card-footer" align="center">
                <button class="btn btn-success" onclick="javascript:kirimotp();"><i class="fa fa-send"></i> Kirim</button>
                <button class="btn btn-warning" onclick="javascript:kembali2();"><i class="fa fa-undo"></i> Kembali</button>
              </div>
              <!-- /.card -->
            </div>
        </div>
        <div class="col-12 col-sm-4">
          &nbsp;
        </div>
      </div>
    </div>

    <div id="menu3" class="container tab-pane fade"><br>
      <h4>Rincian SP2D</h4>
      <div class="row">
        <div class="col-12 col-sm-6">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>No. SP2D</label>
                <input type="text" name="no_sp2d_pot" class="form-control" id="no_sp2d_pot" readonly/>
              </div>
              <div class="form-group">
                <label>Tanggal</label>
                <input type="text" name="tgl_sp2d_pot" class="form-control" id="tgl_sp2d_pot" readonly/>
              </div>
              <div class="form-group">
                <label>Nilai Bruto</label>
                <input type="text" name="nilai_bruto" class="form-control" id="nilai_bruto" readonly/>
              </div>
              <div class="form-group">
                  <label>Keperluan</label>
                  <textarea name="keterangan" class="form-control" id="keterangan" style="height: 125px;" readonly="true"></textarea>
                </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="card card-primary card-tabs">
              <div class="card-body">
                <div class="form-group">
                  <label>Penerima</label>
                  <input type="text" name="penerima" class="form-control" id="penerima" readonly/>
                </div>
                <div class="form-group">
                  <label>Rekening</label>
                  <input type="text" name="norek_penerima" class="form-control" id="norek_penerima" readonly/>
                </div>
                <div class="form-group">
                  <label>NPWP</label>
                  <input type="text" name="npwp_penerima" class="form-control sm-input" id="npwp_penerima" readonly/>
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea name="statussp2d" class="form-control" id="statussp2d" style="height: 125px;" readonly="true"></textarea>
                </div>
              </div>
              <!-- /.card -->
            </div>
        </div>
        <!-- tabel potongan/pajak -->
        <div class="col-12" align="center">
          <button class="btn btn-warning pull-right" onclick="javascript:kembali2();"><i class="fa fa-undo"></i> Kembali</button>
        </div>
            <div class="card-body table-responsive">
              <table id="PotonganDatatable" class="table table-bordered table-striped" width="100%">
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
            <!-- end tabel potongan/pajak -->
      </div>
    </div>

    <!-- END menu tab -->
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


function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};


    $(function () {
      
    });

    $(document).ready(function () {
      let noadvices = null
      let nosp2d = null
      let nosp2ddet = null
      
      $("#AdvicesDatatable").DataTable({
        "ordering":false
      });

      var table = $('#SP2DDatatable').DataTable( {
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
            { "targets": 1, "name": "no_sp2d", 'searchable':true, 'orderable':true},
            { "targets": 2, "name": "tgl_sp2d", 'searchable':true, 'orderable':true},
            { "targets": 3, "name": "nilai", 'searchable':true, 'orderable':false},
            { "targets": 4, "name": "nmrekan", 'searchable':true, 'orderable':false},
            { "targets": 5, "name": "no_rek", 'searchable':true, 'orderable':false},
            { "targets": 6, "name": "npwp", 'searchable':true, 'orderable':false},
            { "targets": 7, "name": "status", 'searchable':false, 'orderable':false},
            { "targets": 8, "name": "aksi", 'searchable':false, 'orderable':false}
        ]
      });

      $('#AdvicesDatatable').on('click', '.detail', function() {
        noadvices     = $(this).data('no_uji')
        tgl_uji       = $(this).data('tgl_uji')
        status_bank   = $(this).data('status_bank')
        
        table.ajax.reload()
        activaTab('menu1')
        document.getElementById("noadvices").value = noadvices;
        document.getElementById("noadvices_kirim").value = noadvices;
        document.getElementById("tgluji").value = tgl_uji;
      });

// validasi sp2d
  $('#SP2DDatatable').on('click', '.validatesp2d', function() {
        nosp2d = $(this).data('sp2dval')
        $(document).ready(function(){
              $.ajax({
                type: "POST",       
                dataType : 'json',         
                url      : "<?php echo base_url(); ?>admin/TukdBank/validasi/ ",
                data     : {nosp2d:nosp2d, csrf_token: $('#csrf').val()},
                
                success:function(data){
                status = data.status;
                  if (status=='0' || status==0){
                     $("#loading").dialog('close');
                     Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'SP2D gagal divalidasi!!'
                      });
                  }else if (status=='2' || status==2){
                     $("#loading").dialog('close');
                     Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'SP2D Sudah cair!!'
                      });
                  } else { 
                    $("#loading").dialog('close');
                    Swal.fire(
                        'Berhasil!',
                        'SP2D berhasil divalidasi.',
                        'success'
                      )
                  } 

                }
              });
          });


        table.ajax.reload()
      })
// batal validasi sp2d
$('#SP2DDatatable').on('click', '.batalsp2d', function() {
        nosp2dbat = $(this).data('sp2dbat')
        $(document).ready(function(){
              $.ajax({
                type: "POST",       
                dataType : 'json',         
                url      : "<?php echo base_url(); ?>admin/TukdBank/batal/ ",
                data     : {nosp2d:nosp2dbat, csrf_token: $('#csrf').val()},
                
                success:function(data){
                status = data.status;
                  if (status=='0' || status==0){
                     // $("#loading").dialog('close');
                     refreshtable();
                     Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'SP2D gagal batal validasi.'
                      });
                  } else if (status=='2' || status==2){
                     // $("#loading").dialog('close');
                     refreshtable();
                     Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'SP2D sudah cair.'
                      });
                  }  else { 
                    // $("#loading").dialog('close');
                    refreshtable();
                    Swal.fire(
                        'Berhasil!',
                        'SP2D berhasil dibatalkan.',
                        'success'
                      )
                  } 
                  
                }
              });
          });
        
      })

// datatablepotongan

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

        nosp2ddet = $(this).data('sp2det')
        keperluan = $(this).data('sp2ket')
        statussp2d = $(this).data('sp2stat')
        tables.ajax.reload()
        
        var data = table.row( $(this).parents('tr') ).data();
        document.getElementById("no_sp2d_pot").value = data[1];
        document.getElementById("tgl_sp2d_pot").value = data[2];
        document.getElementById("nilai_bruto").value = data[3];
        document.getElementById("penerima").value = data[4];
        document.getElementById("norek_penerima").value = data[5];
        document.getElementById("npwp_penerima").value = data[6];
        document.getElementById("keterangan").value = keperluan;
        document.getElementById("statussp2d").value = statussp2d;


        activaTab('menu3')
        
      });

    });


function kirimsp2d(){
      var nouji = document.getElementById('noadvices').value;
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
                        data     : {no_uji:nouji, csrf_token: $('#csrf').val()},
                        
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
                            activaTab('menu2')
                          } else { 
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


  function validasisp2d(){
      var nouji = document.getElementById('noadvices').value;
      Swal.fire({
                title: 'Yakin untuk validasi semua SP2D?',
                text: "No Penguji :  "+nouji,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Validasi!'
              }).then((result) => {
                if (result.value) {
                  $(document).ready(function(){
                      $.ajax({
                        type: "POST",       
                        dataType : 'json',         
                        url      : "<?php echo base_url(); ?>admin/TukdBank/validasisp2d/ ",
                        data     : {no_uji:nouji, csrf_token: $('#csrf').val()},
                        success:function(data){
                        status = data.status;
                          if (status==false){
                             Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Semua SP2D gagal divalidasi!!'
                              });
                          } else { 
                            Swal.fire(
                              'Berhasil!',
                              'Semua SP2D berhasil divalidasi.',
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


function refreshtable(){
  $('#SP2DDatatable').DataTable().ajax.reload();
}
  function batalsp2d(){
      var nouji = document.getElementById('noadvices').value;
      Swal.fire({
                title: 'Yakin untuk batal validasi semua SP2D?',
                text: "No Penguji :  "+nouji,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Validasi!'
              }).then((result) => {
                if (result.value) {
                  $(document).ready(function(){
                      $.ajax({
                        type: "POST",       
                        dataType : 'json',         
                        url      : "<?php echo base_url(); ?>admin/TukdBank/batalsp2d/ ",
                        data     : {no_uji:nouji, csrf_token: $('#csrf').val()},
                        
                        success:function(data){
                        status = data.status;
                          if (status==false){
                             Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Semua SP2D gagal dibatalkan'
                              });
                          } else { 
                            Swal.fire(
                              'Berhasil!',
                              'Semua SP2D berhasil divalidasi',
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

  function kembali1() {
    activaTab('home')
  }
  
  function kembali2() {
    activaTab('menu1')
    refreshtable();
  }

  function kembali3() {
    activaTab('menu2')
  }

  function kirimotp() {
    var nouji = document.getElementById('noadvices').value;
    var kode_otp = document.getElementById('otp').value;

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
                text: "etelah kode otp terkirim, maka pencairan sp2d terproses secara otomatis dan tidak bisa dibatalkan!",
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
                              url      : "<?php echo base_url(); ?>admin/TukdBank/kirimotp/ ",
                              data     : {advice:nouji,otp:kode_otp, csrf_token: $('#csrf').val()},
                              success:function(data){
                              var status = data.status;
                              
                                  if (status == true || status == 'true'){
                                      swal.close()
                                      Swal.fire(
                                            'Verifikasi OTP Berhasil!',
                                            'SP2D Berhasil: '+data.sukses+'<br>SP2D Pending: '+data.pending+'<br>SP2D Gagal: '+data.gagal+'<br>Pajak Berhasil: '+data.suksesp+'<br>Pajak Pending: '+data.pendingp+'<br>Pajak Gagal: '+data.gagalp ,
                                            'success'
                                          )

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
                                      text: 'OTP Numeric Only'
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

  <script>
    $("#language").addClass('active');
  </script>

