
<?= $this->extend('layout/main')?>
<?= $this->section('title'); ?>
EDIT USER
<?= $this->endSection('title'); ?>
<!-- Content Wrapper. Contains page content -->
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->



        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit User</h3>
                </div>
                <div class="card">
        <div class="card-header">
        <?php if (isset($message))
        {  ?>  
          <div class="alert alert-success">  
          <?= $message?>
          </div>
          <?php
        } ?>

          
        </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="<?= base_url('EditUser/edit') ?>" method="post" autocomplete="off">
                                <?= csrf_field(); ?>
                                <tr>
                                    <td>no</td>
                                    <td><input type="number" class="form-control" name="id" value="<?= $user["id"] ?>"
                                            readonly></td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td><input type="text" class="form-control" name="name"
                                            value="<?php echo $user["name"]; ?>" required></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" class="form-control" name="email"
                                            value="<?php echo $user["email"]; ?>" required></td>
                                </tr>
                                <tr>
                                    <td>Role </td>
                                    <td>
                                    <select class="form-control" name="role" required>
                                     
                                        <?php if (session("role") === 'roc') : ?>
                                            <option value="engineer">engineer</option>
                                        <?php elseif (session("role") === 'finance_super_admin') : ?>
                                                <option value="finance">finance</option>
                                        <?php else : ?>
                                            <?php foreach ($roles as $role): ?>
                                                <option value="<?= htmlspecialchars($role['role']); ?>"
                                                    <?= isset($user['role']) && $user['role'] === $role['role'] ? 'selected' : ''; ?>>
                                                    <?= htmlspecialchars($role['role']); ?>
                                                </option>
                                            <?php endforeach; ?>

                                        <?php endif; ?>
                                    </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><input type="text" class="form-control" name="username"
                                            value="<?php echo $user["username"]; ?>" required></td>
                                </tr>

                                <input type="hidden" class="form-control" name="password" value="Default_1">
                                <input type="hidden" class="form-control" name="telegram_id" value="">
                                <tr>
                                    <td>Password Expire Date</td>
                                    <td><input type="text" class="form-control" name="password_expiry"
                                            value="<?= $user["password_expiry"] ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>Failed Attempt Login</td>
                                    <td><input type="number" class="form-control" name="failed_attempt"
                                            value="<?= $user["failed_attempt"] ?>" readonly></td>
                                </tr>
								

                                <tr>
                                    <td>Secret key</td>	
                                     <td><button type="submit" class="btn btn-danger" name="reset" value="true">Reset</button></td>				  
                                </tr>	
                                <tr>

                                    <td><button type="submit" class="btn btn-primary" name="update"
                                            value="true">Update/Reset Password</button>
                                        <button type="submit" class="btn btn-success" name="insert" value="true">Add
                                            New</button>
                                    </td>
                                    <td><button type="submit" class="btn btn-danger" name="delete"
                                            value="true">Delete</button></td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>

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