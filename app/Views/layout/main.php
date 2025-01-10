<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $this->renderSection('title') ?></title>
 
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('public/assets') ?>/plugins/daterangepicker/daterangepicker.css">
  
  <?= $this->renderSection('head_script') ?>

  <style>
    .select2-container {
      max-width: 400px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>
      
 <!-- Right navbar links -->
 <ul class="navbar-nav ml-auto">
  <li class="nav-item" style="margin-left: 20px;">
    <?php if (session()->has('username')) : ?>
      <b>Login User: <?= session()->get('username') ?></b>
    <?php endif; ?>
  </li>
  
  <li class="nav-item" style="margin-left: 20px;">
    <?php if (session()->has('username')) : ?>
      <a href="<?php echo base_url('login/getLogout'); ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
    <?php endif; ?>
  </li>
  
  <li class="nav-item" style="margin-left: 10px;">
    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
      <i class="fas fa-expand-arrows-alt"></i>
    </a>
  </li>
</ul>


  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-maroon bg-navy elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
     
      <span class="brand-text font-weight-heavy center">OnlineTest</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


      <?php if (session()->get('role') === "siswa"): ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i> 
              <p>
                Student Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"> 
              <li class="nav-item">
                <a href="<?= base_url('Student') ?>" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Start Exam</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview"> 
              <li class="nav-item">
                <a href="<?= base_url('UpdatePhoto') ?>" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Update Photo</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>

        <?php if (session()->get('role') === "guru"): ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i> <!-- Changed the icon here -->
              <p>
                Exam Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"> 
              <li class="nav-item">
                <a href="<?= base_url('Exam') ?>" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Exam</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview"> 
              <li class="nav-item">
                <a href="<?= base_url('Grade') ?>" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Grade</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>

        <?php if (session()->get('role') === "super_admin"): ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Admin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('ShowUser') ?>" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>

      </ul>
    </nav>


  </div>
  <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <?= $this->renderSection('title') ?>
            </h1>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
     
            
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       

            <?= $this->renderSection('content') ?>

         
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Developed by<a href=""> Faishal and Haldhira</a></strong> 
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('public/assets') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('public/assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('public/assets') ?>/dist/js/adminlte.min.js"></script>
<script src="<?= base_url('public/assets') ?>/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('public/assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url('public/assets') ?>/dist/js/adminlte.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url('public/assets') ?>/plugins/daterangepicker/daterangepicker.js"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2(),

    
    //Date range picker
     //Date range picker
    $('#reservation').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            separator: ":"
        }
    });

    $('#reservationSrtn').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            separator: ":"
        }
    });

    $('#reservationUpr').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            separator: ":"
        }
    });
    
    
  })
</script>
<?= $this->renderSection('script') ?>


</body>
</html>
