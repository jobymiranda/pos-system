<?php
$errors = session()->getFlashdata('errors') ?? [];

$currentAvatar = ! empty($user['avatar'])
    ? base_url(
        'uploads/avatars/'
        . rawurlencode(basename($user['avatar']))
    )
    : base_url('images/avatar-placeholder.svg');
?>

<section class="page-heading">
    <p class="eyebrow">User Management</p>
    <h1><?= esc($formHeading) ?></h1>

    <p>
        Complete the required account information below.
    </p>
</section>

<section class="form-card">
    <?php if ($errors !== []): ?>
        <div class="alert alert-error" role="alert">
            <strong>Please correct the following:</strong>

            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form
        method="post"
        action="<?= esc($formAction, 'attr') ?>"
        enctype="multipart/form-data"
    >
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="username">
                Username <span aria-hidden="true">*</span>
            </label>

            <input
                type="text"
                id="username"
                name="username"
                maxlength="50"
                required
                value="<?= esc(
                    old(
                        'username',
                        $user['username'] ?? ''
                    ),
                    'attr'
                ) ?>"
            >
        </div>

        <div class="form-group">
            <label for="full_name">
                Full Name <span aria-hidden="true">*</span>
            </label>

            <input
                type="text"
                id="full_name"
                name="full_name"
                maxlength="100"
                required
                value="<?= esc(
                    old(
                        'full_name',
                        $user['full_name'] ?? ''
                    ),
                    'attr'
                ) ?>"
            >
        </div>

        <?php if ($allowAvatar): ?>
            <div class="form-group">
                <label>Current Profile Picture</label>

                <img
                    class="avatar-preview"
                    src="<?= esc($currentAvatar, 'attr') ?>"
                    alt="Current profile picture"
                    width="120"
                    height="120"
                >
            </div>

            <div class="form-group">
                <label for="avatar">New Profile Picture</label>

                <input
                    type="file"
                    id="avatar"
                    name="avatar"
                    accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                >

                <p class="field-help">
                    Optional. Upload a JPG or PNG no larger than
                    2 MB. It will be prepared as a 300 × 300
                    thumbnail.
                </p>
            </div>
        <?php endif ?>

        <div class="form-actions">
            <button class="button button-solid" type="submit">
                <?= esc($submitLabel) ?>
            </button>

            <a class="button button-muted" href="<?= site_url('users') ?>">
                Cancel
            </a>
        </div>
    </form>
</section>