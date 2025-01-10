<?= $this->extend('layout/main') ?>
<?= $this->section('title'); ?>
Exam Management
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>
<h3>Exam Management</h3>

<?php if (session()->get('role') === "guru"): ?>
    <div class="col-sm-6 text-right">
        <input type="hidden" name="id" value="" />
        <a href="<?= site_url('EditExam') ?>" class="btn btn-warning"><i class="far fa-plus-square"></i> Create New Question</a>
    </div>
<?php endif; ?>

<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive" style="margin: 5px;">
                <table class="table table-striped table-bordered table-hover" id="table1">
                    <thead>
                        <tr>
                            <th class="col-md-1"></th>
                            <th class="col-md-6">Question</th>
                            <th class="col-md-2">Answer</th>
                            <th class="col-md-2">Correct Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exams as $exam): ?>
                            <tr>
                                <form role="form" action="<?= site_url('EditExam') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= esc($exam['id']) ?>" />
                                    <td>
                                        <button type="submit" class="btn btn-primary" name="button" value="edit" onclick="loading();">
                                            <i class="far fa-edit"></i> Edit
                                        </button>
                                    </td>
                                    <td><?= esc($exam['question']) ?></td>
                                    <td><?= esc($exam['answer']) ?></td>
                                    <td><?= esc($exam['correct']) ?></td>
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
