<?php $this->load->view('layout/header'); ?>

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">
    <h3>My Tasks</h3>
    <a href="<?= site_url('tasks/create') ?>" class="btn btn-success">Add Task</a>
</div>

<form class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search Task Title" value="<?= isset($search) ? htmlspecialchars($search) : '' ?>">
    </div>
    <div class="col-md-3">
        <select name="status" class="form-control">
            <option value="">All Status</option>
            <option value="pending" <?= (isset($status_filter) && $status_filter=='pending') ? 'selected' : '' ?>>Pending</option>
            <option value="in_progress" <?= (isset($status_filter) && $status_filter=='in_progress') ? 'selected' : '' ?>>In Progress</option>
            <option value="completed" <?= (isset($status_filter) && $status_filter=='completed') ? 'selected' : '' ?>>Completed</option>
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary">Filter</button>
    </div>
</form>

<table class="table table-bordered">
    <tr>
        <th>Title</th>
        <th>Status</th>
        <th>Priority</th>
        <th>Due Date</th>
        <th>Actions</th>
    </tr>

    <?php if (!empty($tasks)): ?>
    <?php foreach($tasks as $task): ?>
        <tr>
            <td><?= $task->title ?></td>
            <td><?= ucfirst($task->status) ?></td>
            <td class="<?= $task->priority=='high'?'text-danger':($task->priority=='medium'?'text-warning':'text-success') ?>">
                <?= ucfirst($task->priority) ?>
            </td>
            <td><?= $task->due_date ?></td>
            <td>
                <a href="<?= site_url('tasks/edit/'.$task->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="<?= site_url('tasks/delete/'.$task->id) ?>" class="btn btn-sm btn-danger"
                onclick="return confirm('Delete task?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" class="text-center text-muted">
                No records found
            </td>
        </tr>
    <?php endif; ?>

</table>

</div>

<?php $this->load->view('layout/footer'); ?>






