<?= $this->extend('layout/main')?>
<?= $this->section('title'); ?>
SHOW USER
<?= $this->endSection('title'); ?>
<!-- Content Wrapper. Contains page content -->

    <?= $this->section('content'); ?>
    <h3> SHOW USER </h3>
    <?php if (session()->get('role') == "super_admin"): ?>
                    <div class="col-sm-6 text-right">
                        <a href="<?= site_url('CreateUser') ?>" class="btn btn-warning"><i class="far fa-plus-square"></i>
                            Create New User</a>
                    </div>
                <?php endif ?>
            </div>
   
    <!-- Main content -->
    <section class="content">
        <!-- Your content goes here -->
        <!-- Example content -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="margin: 5px;">
                    <table class="table table-striped table-bordered table-hover" id="table1">
                        <thead>
                            <tr>
                                <th class="col-md-1"></th>
                                <th class="col-md-2">Name</th>
                                <th class="col-md-2">Email</th>
                                <th class="col-md-3">Username</th>
                                <th class="col-md-2">Role</th>
                                <th class="col-md-2">Password Expiry</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <form role="form" action="<?= site_url('EditUser') ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>" />
                                        <td>
                                            <button type="submit" class="btn btn-primary" name="button" value="edit"
                                                onclick="loading();">
                                                <i class="far fa-edit"></i> Edit
                                            </button>
                                        </td>
                                        <td>
                                            <?= $user['name'] ?>
                                        </td>

                                        <td>
                                            <?= $user['email'] ?>
                                        </td>
                                        <td>
                                            <?= $user['username'] ?>
                                        </td>

                                        <td>
                                            <?= $user['role'] ?>
                                        </td>
                                        <td>
                                            <?= $user['password_expiry'] ?>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
  <script>
    $(function () {
      $("#table1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

<?= $this->endSection('script'); ?>