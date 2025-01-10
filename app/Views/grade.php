<?= $this->extend('layout/main') ?>
<?= $this->section('title'); ?>
Exam Management
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>
<h3>Grade</h3>



<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive" style="margin: 5px;">
                <table class="table table-striped table-bordered table-hover" id="table1">
                    <thead>
                        <tr>
                           
                            <th class="col-md-6">Student Name</th>
                            <th class="col-md-2">Total Correct</th>
                            <th class="col-md-2">Total Question</th>
                            <th class="col-md-2">Total Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($grades as $grade): ?>
                            <tr>
                                <form role="form" action="<?= site_url('EditExam') ?>" method="post">
                                    
                                    <!-- <td>
                                        <button type="submit" class="btn btn-primary" name="button" value="edit" onclick="loading();">
                                            <i class="far fa-edit"></i> Detail
                                        </button>
                                    </td> -->
                                    <td><?= esc($grade['user']) ?></td>
                                    <td><?= esc($grade['score']) ?></td>
                                    <td><?= esc($grade['total_question']) ?></td>
                                    <td><?= esc($grade['score']/$grade['total_question'] * 100) ?></td>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    $(function () {
        $("#table1").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
    });
</script>
<?= $this->endSection('script'); ?>
