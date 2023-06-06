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
                            <h4 class="header-title mb-4">TAMBAH MODULE </h4>
                            <div class="text-end">
                              <a href="<?= base_url('admin/admin_roles/module'); ?>" class="btn btn-success btn-sm text-end"><i class="fa fa-list"></i>  <?= trans('module_list') ?></a>
                            </div>
                                <?php $this->load->view('admin/includes/_messages.php') ?>
                                <?php echo form_open(base_url('admin/admin_roles/module_add'), 'class="form-horizontal"');  ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="no_sp2d_pot" class="form-label">Module Name<span class="text-danger">*</span></label>
                                                                <input type="text" name="module_name" class="form-control" id="module_name" placeholder="">
                                                                <small><?= trans('lang_index_message') ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="tgl_sp2d_pot" class="form-label">Controller name<span class="text-danger">*</span></label>
                                                                <input type="text" name="controller_name" class="form-control" id="controller_name" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nama_skpd" class="form-label">Fa Icon<span class="text-danger">*</span></label>
                                                                <input type="text" name="fa_icon" class="form-control" id="fa_icon" placeholder="">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nilai_bruto" class="form-label">Sort Order<span class="text-danger">*</span></label>
                                                                <input type="number" name="sort_order" class="form-control" id="sort_order" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="npwp_penerima" class="form-label">Operation Name<span class="text-danger">*</span></label>
                                                                <textarea type="text" name="operation" class="form-control" id="operation" placeholder="eg. add|edit|delete"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="text-end">
                                                            <input type="submit" name="submit" value="Simpan" class="btn btn-primary btn-sm waves-effect">
                                                            <a href="<?= base_url('admin/admin_roles/module'); ?>" class="btn btn-secondary btn-sm ">Kembali</a>
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
    
    


  