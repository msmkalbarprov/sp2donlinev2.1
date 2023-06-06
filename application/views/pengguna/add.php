  <!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <!-- content -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-4">TAMBAH PENGGUNA </h4>
                                <?php $this->load->view('admin/includes/_messages.php') ?>
                                <?php echo form_open(base_url('admin/admin/add'), 'class="form-horizontal"');  ?> 
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="no_sp2d_pot" class="form-label">USERNAME<span class="text-danger">*</span></label>
                                                                <input type="text" name="username" class="form-control" id="username" placeholder="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="tgl_sp2d_pot" class="form-label">FIRST NAME<span class="text-danger">*</span></label>
                                                                <input type="text" name="firstname" class="form-control" id="firstname" placeholder="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nama_skpd" class="form-label">PASSWORD<span class="text-danger">*</span></label>
                                                                <input type="password" name="password" class="form-control" id="password" placeholder="" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="npwp_penerima" class="form-label">LAST NAME<span class="text-danger">*</span></label>
                                                                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nilai_bruto" class="form-label">STATUS<span class="text-danger">*</span></label>
                                                                <select name="status" class="form-control">
                                                                  <option value=""><?= trans('select_status') ?></option>
                                                                  <option value="1" ><?= trans('active') ?></option>
                                                                  <option value="0"><?= trans('inactive') ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="penerima" class="form-label">PERAN/ROLE<span class="text-danger">*</span></label>
                                                                <select name="role" class="form-control">
                                                                    <option value=""><?= trans('select_role') ?></option>
                                                                    <?php foreach($admin_roles as $role): ?>
                                                                    <option value="<?= $role['admin_role_id']; ?>"><?= $role['admin_role_title']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="mobile_no" class="form-control" id="mobile_no" placeholder="">
                                                    <input type="hidden" name="email"  class="form-control" id="email" placeholder="">
                                                    <div class="row">
                                                        <div class="text-end">
                                                            <input type="submit" name="submit" value="Simpan" class="btn btn-primary btn-sm waves-effect">
                                                            <a href="<?= base_url('admin/admin'); ?>" class="btn btn-secondary btn-sm ">Kembali</a>
                                                        </div>
                                                    </div>
    
                                                    <!-- end row -->
                                                    
                                                </div> <!-- end card-body -->
                                            </div> <!-- end card -->
                                        </div> <!-- end col -->
                                    </div>
                                <?php echo form_close(); ?>
                        </div>
                    </div> <!-- end card-->
            
            <!-- content -->
        </div> <!-- container -->

    </div> <!-- content -->
    
    


  