<?= $this->extend('layout/main') ?>
<?= $this->section('title'); ?>
Student Management
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>
<h3>Start Exam</h3>

<section class="content">
    <div class="card">
        <div class="card-body">
            <form method="post">
                <button type="submit" name="start_exam" class="btn btn-primary">START EXAM</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['start_exam'])) {
                $command = 'python D:\\skripsi\\handgestureExam\\src\\main.py';
                $output = [];
                $returnVar = 0;

                exec($command, $output, $returnVar);

                if ($returnVar === 0) {
                    echo '<div class="alert alert-success mt-3">Exam started successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger mt-3">Failed to start the exam. Please check the script.</div>';
                }
            }
            ?>
        </div>
    </div>
</section>

<?= $this->endSection('content'); ?>
