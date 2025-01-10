<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>eDBN | Verify TOTP</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page bg-gray-dark">
<div class="login-box">
  <div class="login-logo">
  <b>eDBN</b><br>Debit Note Portal
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <?php if(isset($secret_key)) : ?>
        <p class="login-box-msg">
          Please scan using Google Authenticator 
        </p>
        <form action="Verify_totp/submit_totp" method="post">
        <?= csrf_field(); ?>
          <div class="row justify-content-center mb-4">
            <div class="col-md-6 text-center">
              <p><img src="<?= $link ?>" alt="QR Code" class="img-fluid"></p>
            </div>
          </div>
          <p class="login-box-msg">
            or 
          </p>
          <p class="login-box-msg">
            You can add the entry manually, provide
            the following details to Google Authenticator on your phone.
            <br>
            Account : <?= $web_app ?>: <?= $email_address ?>
            <br>
            Code : <?= $secret_key ?>
          </p>
          <div class="input-group mb-3">
            <input type="number" class="form-control" placeholder="totp" name="totp" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
        
          <div class="row">
            <div class="col-8">            
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      <?php else : ?>
        <p class="login-box-msg">
          Please input your TOTP
        </p>
        <form action="Verify_totp/submit_totp" method="post">
          <div class="input-group mb-3">
            <input type="number" class="form-control" placeholder="totp" name="totp" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
        
          <div class="row">
            <div class="col-8">            
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      <?php endif ?>
    </div>
    <?php 
      $alert = session()->getFlashdata('alert');
      if ($alert !== NULL) :
    ?>
    <div class="alert alert-warning">     
      <h4><i class="icon fa fa-warning"></i> Alert!</h4>
      <?php echo $alert ?>
    </div>
    <?php endif ?>
    <!-- /.login-card-body -->
  </div>
  <?php
    // echo $message;
    ?>

</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('public/assets') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('public/assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('public/assets') ?>/dist/js/adminlte.min.js"></script>
</body>
</html>
