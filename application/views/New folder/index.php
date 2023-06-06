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
                            <h4 class="header-title mb-4">CONFIG SP2D ONLINE </h4>
                                <?php $this->load->view('admin/includes/_messages.php') ?>
                                <?php echo form_open(base_url('admin/setting'), 'class="form-horizontal"' )?> 
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="no_sp2d_pot" class="form-label">NIP BUD<span class="text-danger">*</span></label>
                                                                <input type="text" name="nip" value="<?= $admin['nip']; ?>" class="form-control" id="nip" placeholder="" >
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="tgl_sp2d_pot" class="form-label">Nama KUASA BUD<span class="text-danger">*</span></label>
                                                                <input type="text" name="nama" value="<?= $admin['nama']; ?>" class="form-control" id="nama" placeholder="" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nilai_bruto" class="form-label">No. HP<span class="text-danger">*</span><small>(untuk menerima token)</small></label>
                                                                <input type="number" name="nohp" value="<?= $admin['nohp']; ?>" class="form-control" id="nohp" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="npwp_penerima" class="form-label">EMAIL<span class="text-danger">*</span></label>
                                                                <input type="email" name="email" value="<?= $admin['email']; ?>" class="form-control" id="email" placeholder="" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nama_skpd" class="form-label">CLIENT ID<span class="text-danger">*</span></label>
                                                                <input type="text" name="clientid"  class="form-control" id="clientid" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="penerima" class="form-label">CLIENT SECRET<span class="text-danger">*</span></label>
                                                                <input type="password" name="client_secret"  class="form-control" id="client_secret" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="norek_penerima" class="form-label">REFERENCE NO<span class="text-danger">*</span></label>
                                                                <input type="password" name="noreference"  class="form-control" id="noreference" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="emailAddress" class="form-label">PIN<span class="text-danger">*</span></label>
                                                                <input type="number" name="pin" value="" class="form-control" id="pin" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            CLIENT ID, CLIENT SECRET, REFERENCE NO DARI BANK KALBAR
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="text-end">
                                                            <input type="submit" name="submit" value="Simpan" class="btn btn-secondary waves-effect">
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
    