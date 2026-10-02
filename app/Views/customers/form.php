<?php
$errors = session()->getFlashdata('errors') ?? [];
?>

<section class="page-heading">
    <p class="eyebrow">Customer Management</p>
    <h1><?= esc($formHeading) ?></h1>

    <p>
        Complete the form below. Fields marked with an asterisk are
        required.
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

    <form method="post" action="<?= esc($formAction, 'attr') ?>">
        <?= csrf_field() ?>

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
                        $customer['full_name'] ?? ''
                    ),
                    'attr'
                ) ?>"
            >
        </div>

        <div class="form-group">
            <label for="email">
                Email Address <span aria-hidden="true">*</span>
            </label>

            <input
                type="email"
                id="email"
                name="email"
                maxlength="100"
                required
                value="<?= esc(
                    old(
                        'email',
                        $customer['email'] ?? ''
                    ),
                    'attr'
                ) ?>"
            >
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>

            <input
                type="tel"
                id="phone"
                name="phone"
                maxlength="20"
                value="<?= esc(
                    old(
                        'phone',
                        $customer['phone'] ?? ''
                    ),
                    'attr'
                ) ?>"
            >
        </div>

        <div class="form-actions">
            <button class="button button-solid" type="submit">
                <?= esc($submitLabel) ?>
            </button>

            <a class="button button-muted" href="<?= site_url('customers') ?>">
                Cancel
            </a>
        </div>
    </form>
</section>