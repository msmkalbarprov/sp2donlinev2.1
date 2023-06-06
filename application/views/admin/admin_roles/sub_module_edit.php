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
                            <h4 class="header-title mb-4">Edit Sub Module </h4>
                                <?php $this->load->view('admin/includes/_messages.php') ?>
                                <?php echo form_open(base_url('admin/admin_roles/sub_module_edit/'.$module['id']), 'class="form-horizontal"');  ?> 
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="no_sp2d_pot" class="form-label">Sub Module Name<span class="text-danger">*</span></label>
                                                                <?php 
                                                                  $menu = get_sidebar_menu();
                                                                  $others = array('class' => 'form-control select2', 'id' => 'module_name');
                                                                  $options =  array_column($menu, 'module_name','module_id');
                                                                  echo form_dropdown('module_name',$options,$module['parent'],$others);
                                                                ?>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="tgl_sp2d_pot" class="form-label">Link<span class="text-danger">*</span></label>
                                                                <input type="text" value="<?= $module['link']; ?>" name="operation" class="form-control" id="operation" placeholder="eg. about_us">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nama_skpd" class="form-label">Sub Module Name<span class="text-danger">*</span></label>
                                                                <input type="text" name="module_name" class="form-control" value="<?= $module['name']; ?>" id="module_name" placeholder="">
                                                                <small>Language index as per your languge file</small>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nilai_bruto" class="form-label">Sort Order<span class="text-danger">*</span></label>
                                                                <input type="number" value="<?= $module['sort_order']; ?>" name="sort_order" class="form-control" id="sort_order" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="text-end">
                                                            <input type="submit" name="submit" value="Simpan" class="btn btn-primary btn-sm waves-effect">
                                                            <a href="<?= base_url('admin/admin_roles/sub_module/').$module['parent']; ?>" class="btn btn-secondary btn-sm ">Kembali</a>
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
    
    


  