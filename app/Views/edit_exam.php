<?= $this->extend('layout/main') ?>
<?= $this->section('title'); ?>
Edit Exam
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>
<h3>Edit Exam</h3>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<form action="<?= site_url('EditExam/save') ?>" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= esc($exam['id']) ?>">

   
    <div class="form-group">
        <label for="question">Question</label>
        <textarea name="question" id="question" class="form-control" rows="3" required><?= esc($exam['question']) ?></textarea>
    </div>

    <div class="form-group">
    <label for="option_a">Option A</label>
    <input type="text" name="answers[]" id="option_a" class="form-control" 
           value="<?= isset($exam['answers'][0]) ? esc($exam['answers'][0]) : '' ?>" required>
</div>
<div class="form-group">
    <label for="option_b">Option B</label>
    <input type="text" name="answers[]" id="option_b" class="form-control" 
           value="<?= isset($exam['answers'][1]) ? esc($exam['answers'][1]) : '' ?>" required>
</div>
<div class="form-group">
    <label for="option_c">Option C</label>
    <input type="text" name="answers[]" id="option_c" class="form-control" 
           value="<?= isset($exam['answers'][2]) ? esc($exam['answers'][2]) : '' ?>" required>
</div>
<div class="form-group">
    <label for="option_d">Option D</label>
    <input type="text" name="answers[]" id="option_d" class="form-control" 
           value="<?= isset($exam['answers'][3]) ? esc($exam['answers'][3]) : '' ?>" required>
</div>


 
    <div class="form-group">
        <label for="correct">Correct Answer (Choose Option Index: 0 = A, 1 = B, 2 = C, 3 = D)</label>
        <select name="correct" id="correct" class="form-control" required>
            <option value="0" <?= ($exam['correct'] == 0) ? 'selected' : '' ?>>Option A</option>
            <option value="1" <?= ($exam['correct'] == 1) ? 'selected' : '' ?>>Option B</option>
            <option value="2" <?= ($exam['correct'] == 2) ? 'selected' : '' ?>>Option C</option>
            <option value="3" <?= ($exam['correct'] == 3) ? 'selected' : '' ?>>Option D</option>
        </select>
    </div>

  
    <button type="submit" class="btn btn-primary">Save Changes</button>
    <a href="<?= site_url('exam') ?>" class="btn btn-secondary">Cancel</a>
</form>
<?= $this->endSection('content'); ?>
