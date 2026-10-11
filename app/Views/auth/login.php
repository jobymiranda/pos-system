<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111111">
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=1') ?>">
</head>
<body class="login-page">
<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<main class="login-layout">
    <section class="login-art" aria-label="CasaForma introduction">
        <div class="art-grid"></div>
        <div class="art-circle art-circle-red"></div>
        <div class="art-circle art-circle-blue"></div>
        <div class="art-square"></div>
        <div class="art-line"></div>

        <div class="login-brand">
            <span class="brand-mark"><i></i><i></i><i></i></span>
            <span><strong>CASAFORMA</strong><small>Furniture showroom</small></span>
        </div>

        <div class="login-statement">
            <p class="kicker light">FORM · COLOR · FUNCTION</p>
            <h1>Design the room.<br><em>Direct the sale.</em></h1>
            <p>A vivid workspace for sculptural furniture, thoughtful clients, and every showroom transaction.</p>
        </div>

        <div class="login-art-footer">
            <span>BAUHAUS / 2026</span>
            <span>MANILA</span>
        </div>
    </section>

    <section class="login-panel">
        <div class="login-card reveal visible">
            <p class="kicker">PRIVATE SHOWROOM ACCESS</p>
            <h2>Welcome back.</h2>
            <p class="muted">Sign in with your CasaForma staff credentials.</p>

            <?php if ($message = session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><span><?= esc($message) ?></span></div>
            <?php endif; ?>
            <?php if ($message = session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><span><?= esc($message) ?></span></div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="post" class="form-stack">
                <?= csrf_field() ?>
                <label class="field">
                    <span>Username</span>
                    <input type="text" name="username" value="<?= esc(old('username'), 'attr') ?>"
                           autocomplete="username" placeholder="Enter username" autofocus>
                    <?php if (isset($errors['username'])): ?><small class="field-error"><?= esc($errors['username']) ?></small><?php endif; ?>
                </label>

                <label class="field">
                    <span>Password</span>
                    <span class="password-wrap">
                        <input id="loginPassword" type="password" name="password"
                               autocomplete="current-password" placeholder="Enter password">
                        <button type="button" data-password-toggle="loginPassword">Show</button>
                    </span>
                    <?php if (isset($errors['password'])): ?><small class="field-error"><?= esc($errors['password']) ?></small><?php endif; ?>
                </label>

                <button class="button button-dark button-full" type="submit">
                    Enter the showroom <span>→</span>
                </button>
            </form>

            <p class="login-security">Protected by hashed passwords, CSRF validation, and database sessions.</p>
        </div>
    </section>
</main>

<script src="<?= base_url('js/app.js?v=1') ?>"></script>
</body>
</html>