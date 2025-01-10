
<?= $this->extend('layout/main')?>
<?= $this->section('title'); ?>
CREATE USER
<?= $this->endSection('title'); ?>
<!-- Content Wrapper. Contains page content -->
<?= $this->section('content'); ?>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create User</h3>
                </div>
                <div class="card-body">
                    <!-- Create the user form -->
                    <form action="<?= site_url('CreateUser') ?>" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" name="role" required>
                                <?php if (session("role") === 'roc'): ?>
                                    <option value="engineer">engineer</option>
                                <?php else: ?>
                                    <option value="" disabled <?= !isset($user['role']) ? 'selected' : ''; ?>>Select a Role</option>
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?= htmlspecialchars($role['role']); ?>" 
                                            <?= isset($user['role']) && $user['role'] === $role['role'] ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($role['role']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>


                        <input type="hidden" class="form-control" name="remarks" value="<?= session('remarks') ?>">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- /.content-wrapper -->
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
<!-- /.content-wrapper -->