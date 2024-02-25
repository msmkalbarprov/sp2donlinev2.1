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
                            <h4 class="header-title mb-4">Config SP2D Online </h4>
                                <?php $this->load->view('admin/includes/_messages.php') ?>
                                <?php echo form_open(base_url('admin/setting'), 'class="form-horizontal"' )?> 
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="no_sp2d_pot" class="form-label">NIP BUD/Kuasa BUD<span class="text-danger">*</span></label>
                                                                <input type="text" name="nip" value="<?= $admin['nip']; ?>" class="form-control" id="nip" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="tgl_sp2d_pot" class="form-label">Nama Kuasa BUD<span class="text-danger">*</span></label>
                                                                <input type="text" name="nama" value="<?= $admin['nama']; ?>" class="form-control" id="nama" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                            <label for="tgl_sp2d_pot" class="form-label">Jabatan<span class="text-danger">*</span></label>
                                                                <input type="text" name="jabatan" value="<?= $admin['jabatan']; ?>" class="form-control" id="jabatan" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="tgl_sp2d_pot" class="form-label">CLIENT ID<span class="text-danger">*</span></label>
                                                                <input type="password" name="clientid"  class="form-control" id="clientid" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                            <label for="no_sp2d_pot" class="form-label">No. HP <small>(untuk verifikasi token)</small><span class="text-danger">*</span></label>
                                                                <input type="number" name="nohp" value="<?= $admin['nohp']; ?>" class="form-control" id="nohp" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="tgl_sp2d_pot" class="form-label">CLIENT SECRET KEY<span class="text-danger">*</span></label>
                                                                <input type="password" name="client_secret"  class="form-control" id="client_secret" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                            <label for="no_sp2d_pot" class="form-label">Email<span class="text-danger">*</span></label>
                                                                <input type="email" name="email" value="<?= $admin['email']; ?>" class="form-control" id="email" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="mb-3">
                                                            <label for="no_sp2d_pot" class="form-label">Reference No<span class="text-danger">*</span></label>
                                                                <input type="password" name="noreference"  class="form-control" id="noreference" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="mb-3">
                                                            <label for="no_sp2d_pot" class="form-label">Tahun Anggaran<span class="text-danger">*</span></label>
                                                                <input type="number" name="tahun_anggaran"  class="form-control" id="tahun_anggaran" value="<?= $admin['tahun_anggaran']; ?>" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="no_sp2d_pot" class="form-label">RKUD<span class="text-danger">*</span></label>
                                                                <input type="rek_rkud" name="rek_rkud" value="<?= $admin['rek_rkud']; ?>" class="form-control" id="email" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="tgl_sp2d_pot" class="form-label">BANK RKUD<span class="text-danger">*</span></label>
                                                                <input type="text" name="nm_bank_rkud"  class="form-control" id="nm_bank_rkud" value="<?= $admin['nm_bank_rkud']; ?>" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                            <label for="tgl_sp2d_pot" class="form-label">Nama RKUD<span class="text-danger">*</span></label>
                                                                <input type="text" name="nm_rek_rkud"  class="form-control" id="nm_rek_rkud" value="<?= $admin['nm_rek_rkud']; ?>" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="tgl_sp2d_pot" class="form-label">PIN<span class="text-danger">*</span></label>
                                                                <input type="number" name="pin" value="" class="form-control" id="pin" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="row">
                                                        <div class="text-end">
                                                            <input type="submit" name="submit" value="Simpan" class="btn btn-primary btn-sm waves-effect">
                                                            <a href="<?= base_url('admin/admin_roles'); ?>" class="btn btn-secondary btn-sm ">Kembali</a>
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
    

