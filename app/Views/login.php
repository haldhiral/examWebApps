<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>OnlineTest</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('public/assets/dist/css/adminlte.min.css') ?>">


</head>

<body class="hold-transition login-page bg-gray-dark">
  <div class="login-box ">

    <div class="login-logo">

      <b>OnlineTest</b><br>Interactive Exam with Hand Gesture
    </div>
    <!-- /.login-logo -->
    <div class="card">

      <div class="card-body login-card-body">
        <p class="login-box-msg">Log in</p>

        <form action="login" method="POST">
          <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger">
              <?php echo session()->getFlashdata('error') ?>
            </div>

          <?php } ?>
          <?= csrf_field(); ?>
          <div class="input-group mb-3">
            <input type="username" class="form-control" placeholder="Username" name="username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="passwordInput" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div class="input-group-append">
            <div class="input-group-text">
              <input type="checkbox" onclick="togglePasswordVisibility()"> Show Password
            </div>
          </div>
        </div>

        <script>
          function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwordInput");
            if (passwordInput.type === "password") {
              passwordInput.type = "text";
            } else {
              passwordInput.type = "password";
            }
          }
        </script>
          <div class="row">
            <div class="col-8">

            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Log In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>



      </div>
      <!-- /.login-card-body -->
    </div>



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