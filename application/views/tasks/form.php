<?php $this->load->view('layout/header'); ?>

<div class="container mt-4 col-md-6">
    <form method="post">
        <!-- CSRF Token -->
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
               value="<?= $this->security->get_csrf_hash(); ?>" />

        <!-- Title -->
        <div class="mb-3">
            <input type="text" name="title" class="form-control"
                   placeholder="Title"
                   value="<?= set_value('title', isset($task) ? $task->title : '') ?>" required>
            <?= form_error('title', '<small class="text-danger">', '</small>') ?>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <textarea name="description" class="form-control"
                      placeholder="Description"><?= set_value('description', isset($task) ? $task->description : '') ?></textarea>
            <?= form_error('description', '<small class="text-danger">', '</small>') ?>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <select name="status" class="form-control">
                <option value="">Select Status</option>
                <option value="pending" <?= set_select('status', 'pending', isset($task) && $task->status=='pending') ?>>Pending</option>
                <option value="in_progress" <?= set_select('status', 'in_progress', isset($task) && $task->status=='in_progress') ?>>In Progress</option>
                <option value="completed" <?= set_select('status', 'completed', isset($task) && $task->status=='completed') ?>>Completed</option>
            </select>
            <?= form_error('status', '<small class="text-danger">', '</small>') ?>
        </div>

        <!-- Priority -->
        <div class="mb-3">
            <select name="priority" class="form-control">
                <option value="">Select Priority</option>
                <option value="low" <?= set_select('priority', 'low', isset($task) && $task->priority=='low') ?>>Low</option>
                <option value="medium" <?= set_select('priority', 'medium', isset($task) && $task->priority=='medium') ?>>Medium</option>
                <option value="high" <?= set_select('priority', 'high', isset($task) && $task->priority=='high') ?>>High</option>
            </select>
            <?= form_error('priority', '<small class="text-danger">', '</small>') ?>
        </div>

        <!-- Due Date -->
        <div class="mb-3">
            <input type="date" name="due_date" class="form-control"
                   value="<?= set_value('due_date', isset($task) ? $task->due_date : '') ?>">
            <?= form_error('due_date', '<small class="text-danger">', '</small>') ?>
        </div>

        <!-- Buttons -->
        <button class="btn btn-primary">Save</button>
        <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">Cancel</a>
    </form>

</div>

<?php $this->load->view('layout/footer'); ?>
