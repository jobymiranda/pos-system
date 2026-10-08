<?= view('templates/header', ['title' => $title]) ?>

<section class="page-heading">
    <div>
        <p class="eyebrow blue">ACCOUNT DIRECTORY</p>
        <h1>User Accounts</h1>
        <p>
            Manage staff access, account roles, and profile pictures.
        </p>
    </div>

    <a href="<?= base_url('users/new') ?>"
       class="button button-primary">
        + Add New User
    </a>
</section>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif; ?>

<div class="table-card">
    <div class="table-toolbar">
        <div>
            <strong><?= count($users) ?> user accounts</strong>
            <p>Authorized SimplePOS team members</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="professional-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Account Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($users === []): ?>
                    <tr>
                        <td colspan="5" class="empty-state">
                            No user accounts were found.
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <div class="table-user">
                                <?php if (! empty($user['avatar'])): ?>
                                    <img
                                        src="<?= base_url(
                                            'uploads/avatars/'
                                            . $user['avatar']
                                        ) ?>"
                                        alt="<?= esc($user['full_name']) ?>"
                                    >
                                <?php else: ?>
                                    <img
                                        src="<?= base_url(
                                            'images/avatar-placeholder.svg'
                                        ) ?>"
                                        alt="Default profile picture"
                                    >
                                <?php endif; ?>

                                <div>
                                    <strong>
                                        <?= esc($user['full_name']) ?>
                                    </strong>

                                    <small>
                                        User ID #<?= esc($user['id']) ?>
                                    </small>
                                </div>
                            </div>
                        </td>

                        <td><?= esc($user['username']) ?></td>

                        <td>
                            <span class="role-badge">
                                <?= esc($user['role'] ?? 'Staff') ?>
                            </span>
                        </td>

                        <td>
                            <span class="status-badge">
                                <span class="status-dot"></span>
                                Active
                            </span>
                        </td>

                        <td>
                            <a
                                href="<?= base_url(
                                    'users/' . $user['id'] . '/edit'
                                ) ?>"
                                class="button button-small button-light"
                            >
                                Edit Account
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('templates/footer') ?>