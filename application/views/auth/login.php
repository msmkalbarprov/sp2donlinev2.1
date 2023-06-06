<script src="<?= base_url('/assets/dist/js/jsencrypt.js') ?>"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="form-background">
  <div class="login-box">
    <div class="login-logo">
    <img src="<?= base_url('assets/img/logopemda.png'); ?>" alt="Logo" width="300px">
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"> <img src="<?= base_url($this->general_settings['favicon']); ?>" alt="Logo" width="150px"></p>
        <!-- <p class="login-box-msg"><b>BADAN KEUANGAN DAN ASET DAERAH<br />PROVINSI KALIMANTAN BARAT</b></p> -->
        <?php $this->load->view('admin/includes/_messages.php') ?>


        <div class="form-group has-feedback">
          <input type="text" name="username" id="username" class="form-control" placeholder="<?= trans('username') ?>">
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" id="password" class="form-control" placeholder="<?= trans('password') ?>">
        </div>
        <input id="public-key" type="hidden" value="<?= $public_key ?>">
        
        <?php echo form_open(base_url('admin/auth/login'), 'class="login-form" id="login-form"'); ?>
          <?=  $captcha; ?>
          <br>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
              <label>
                <!-- <input type="checkbox"> <?= trans('remember_me') ?> -->
              </label>
            </div>
          </div>
          <!-- /.col -->
          
          <div class="col-4">
            
            
            <input type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat" value="<?= trans('signin') ?>">
            
          </div>
          
          <!-- /.col -->
        </div>
        <?php echo form_close(); ?>


      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
</div>
<script>
  $(document).ready(function() {
    $('#login-form').submit(function(e) {
      // e.preventDefault()
      var publicKey = $('#public-key').val()
      var encrypt = new JSEncrypt()
      encrypt.setPublicKey(publicKey)

      var data = {
        username: $('#username').val(),
        password: $('#password').val()
      }
      var jsonData = JSON.stringify(data)
      var encryptedData = encrypt.encrypt(jsonData)
      $(this).append(`<input type="hidden" name="data" value="${encryptedData}"/>`)
    })
    $('#username, #password').keypress(function(e) {
      if (e.which == 13) $('#submit').click()
    })
  })
</script>