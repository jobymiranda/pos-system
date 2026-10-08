<?= view('templates/header', ['title' => $title]) ?>

<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<section class="page-heading">
    <div>
        <p class="eyebrow blue">USER MANAGEMENT</p>
        <h1>Edit User Account</h1>
        <p>Update account information and profile picture.</p>
    </div>

    <a href="<?= base_url('users') ?>" class="button button-light">
        Back to Users
    </a>
</section>

<div class="form-card">
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <form
        action="<?= base_url('users/' . $user['id']) ?>"
        method="post"
        enctype="multipart/form-data"
        class="professional-form"
    >
        <?= csrf_field() ?>

        <div class="profile-preview">
            <?php if (! empty($user['avatar'])): ?>
                <img
                    src="<?= base_url(
                        'uploads/avatars/' . $user['avatar']
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
                <strong><?= esc($user['full_name']) ?></strong>
                <p><?= esc($user['role']) ?></p>
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="username">Username</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= esc(
                        old('username', $user['username'])
                    ) ?>"
                >

                <?php if (isset($errors['username'])): ?>
                    <small class="field-error">
                        <?= esc($errors['username']) ?>
                    </small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="full_name">Full Name</label>

                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    value="<?= esc(
                        old('full_name', $user['full_name'])
                    ) ?>"
                >

                <?php if (isset($errors['full_name'])): ?>
                    <small class="field-error">
                        <?= esc($errors['full_name']) ?>
                    </small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="role">Role</label>

                <?php
                    $selectedRole = old(
                        'role',
                        $user['role'] ?? 'Staff'
                    );
                ?>

                <select id="role" name="role">
                    <?php foreach (
                        ['Administrator', 'Manager', 'Cashier', 'Staff']
                        as $role
                    ): ?>
                        <option
                            value="<?= esc($role) ?>"
                            <?= $selectedRole === $role
                                ? 'selected'
                                : '' ?>
                        >
                            <?= esc($role) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <?php if (isset($errors['role'])): ?>
                    <small class="field-error">
                        <?= esc($errors['role']) ?>
                    </small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="avatar">Profile Picture</label>

                <input
                    type="file"
                    id="avatar"
                    name="avatar"
                    accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                >

                <small>
                    JPG or PNG only. Maximum file size: 2 MB.
                </small>

                <?php if (isset($errors['avatar'])): ?>
                    <small class="field-error">
                        <?= esc($errors['avatar']) ?>
                    </small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">New Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Leave blank to keep current password"
                    autocomplete="new-password"
                >

                <?php if (isset($errors['password'])): ?>
                    <small class="field-error">
                        <?= esc($errors['password']) ?>
                    </small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password_confirm">
                    Confirm New Password
                </label>

                <input
                    type="password"
                    id="password_confirm"
                    name="password_confirm"
                    placeholder="Enter the new password again"
                    autocomplete="new-password"
                >

                <?php if (isset($errors['password_confirm'])): ?>
                    <small class="field-error">
                        <?= esc($errors['password_confirm']) ?>
                    </small>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= base_url('users') ?>" class="button button-light">
                Cancel
            </a>

            <button type="submit" class="button button-primary">
                Save Changes
            </button>
        </div>
    </form>
</div>

<?= view('templates/footer') ?>