<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              &nbsp; Pengaturan</h3>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/setting'), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">NIP Kuasa BUD</label>

                <div class="col-md-12">
                  <input type="text" name="nip" value="<?= $admin['nip']; ?>" class="form-control" id="nip" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">Nama Kuasa BUD</label>

                <div class="col-md-12">
                  <input type="text" name="nama" value="<?= $admin['nama']; ?>" class="form-control" id="nama" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="mobile_no" class="col-sm-2 control-label">No. HP <small>(untuk verifikasi token)</label>

                <div class="col-md-12">
                  <input type="number" name="nohp" value="<?= $admin['nohp']; ?>" class="form-control" id="nohp" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="mobile_no" class="col-sm-2 control-label">Email</label>

                <div class="col-md-12">
                  <input type="email" name="email" value="<?= $admin['email']; ?>" class="form-control" id="email" placeholder="">
                </div>
              </div>

              <!-- <div class="form-group">
                <label for="mobile_no" class="col-sm-2 control-label">Username Maker</label>

                <div class="col-md-12">
                  <input type="text" name="username"  class="form-control" id="username" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password Maker</label>

                <div class="col-md-12">
                  <input type="password" name="password"  class="form-control" id="password" placeholder="">
                </div>
              </div> -->

              <div class="form-group">
                <label for="mobile_no" class="col-sm-2 control-label">Client ID</label>

                <div class="col-md-12">
                  <input type="text" name="clientid"  class="form-control" id="clientid" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Client Secret</label>

                <div class="col-md-12">
                  <input type="password" name="client_secret"  class="form-control" id="client_secret" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Reference No</label>

                <div class="col-md-12">
                  <input type="password" name="noreference"  class="form-control" id="noreference" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="mobile_no" class="col-sm-2 control-label">PIN</label>

                <div class="col-md-12">
                  <input type="number" name="pin" value="" class="form-control" id="pin" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Simpan" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box-body -->
      </div>
    </section>
  </div> 