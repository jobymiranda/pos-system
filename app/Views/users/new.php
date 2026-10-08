<?= view('templates/header', ['title' => $title]) ?>

<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<section class="page-heading">
    <div>
        <p class="eyebrow blue">USER MANAGEMENT</p>
        <h1>Add New User</h1>
        <p>Create a secure staff account for SimplePOS.</p>
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
        action="<?= base_url('users') ?>"
        method="post"
        class="professional-form"
    >
        <?= csrf_field() ?>

        <div class="form-grid">
            <div class="form-group">
                <label for="username">Username</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= esc(old('username')) ?>"
                    placeholder="Example: jmiranda"
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
                    value="<?= esc(old('full_name')) ?>"
                    placeholder="Enter the complete name"
                >

                <?php if (isset($errors['full_name'])): ?>
                    <small class="field-error">
                        <?= esc($errors['full_name']) ?>
                    </small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="role">Role</label>

                <select id="role" name="role">
                    <option value="">Select a role</option>

                    <option
                        value="Administrator"
                        <?= old('role') === 'Administrator'
                            ? 'selected'
                            : '' ?>
                    >
                        Administrator
                    </option>

                    <option
                        value="Manager"
                        <?= old('role') === 'Manager'
                            ? 'selected'
                            : '' ?>
                    >
                        Manager
                    </option>

                    <option
                        value="Cashier"
                        <?= old('role') === 'Cashier'
                            ? 'selected'
                            : '' ?>
                    >
                        Cashier
                    </option>

                    <option
                        value="Staff"
                        <?= old('role') === 'Staff'
                            ? 'selected'
                            : '' ?>
                    >
                        Staff
                    </option>
                </select>

                <?php if (isset($errors['role'])): ?>
                    <small class="field-error">
                        <?= esc($errors['role']) ?>
                    </small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum of 8 characters"
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
                    Confirm Password
                </label>

                <input
                    type="password"
                    id="password_confirm"
                    name="password_confirm"
                    placeholder="Enter the password again"
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
                Create User Account
            </button>
        </div>
    </form>
</div>

<?= view('templates/footer') ?>