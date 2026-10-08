<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title><?= esc($title) ?></title>

    <link
        rel="stylesheet"
        href="<?= base_url('css/style.css') ?>"
    >
</head>

<body class="auth-page">

<div class="auth-layout">
    <section class="auth-showcase">
        <div class="auth-showcase-content">
            <a href="<?= base_url('/') ?>" class="auth-logo">
                <span class="logo-symbol">S</span>
                <span>SimplePOS</span>
            </a>

            <p class="eyebrow">SECURE POS MANAGEMENT</p>

            <h1>Manage accounts with confidence.</h1>

            <p class="showcase-description">
                A secure and organized workspace for managing
                customer records, staff accounts, and profile
                information.
            </p>

            <div class="feature-list">
                <div class="feature-item">
                    <span>✓</span>
                    <div>
                        <strong>Protected records</strong>
                        <p>Private pages require a valid session.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <span>✓</span>
                    <div>
                        <strong>Secure passwords</strong>
                        <p>Passwords are stored using secure hashing.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <span>✓</span>
                    <div>
                        <strong>Professional workflow</strong>
                        <p>Clear navigation, validation, and feedback.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="auth-form-area">
        <div class="login-card">
            <p class="eyebrow blue">WELCOME BACK</p>

            <h2>Sign in to SimplePOS</h2>

            <p class="login-description">
                Enter your staff credentials to continue.
            </p>

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

            <?php
                $errors = session()->getFlashdata('errors') ?? [];
            ?>

            <form
                action="<?= base_url('login') ?>"
                method="post"
                class="professional-form"
            >
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="username">Username</label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?= esc(old('username')) ?>"
                        placeholder="Enter your username"
                        autocomplete="username"
                        autofocus
                    >

                    <?php if (isset($errors['username'])): ?>
                        <small class="field-error">
                            <?= esc($errors['username']) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <div class="password-field">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                        >

                        <button
                            type="button"
                            id="passwordToggle"
                            class="password-toggle"
                        >
                            Show
                        </button>
                    </div>

                    <?php if (isset($errors['password'])): ?>
                        <small class="field-error">
                            <?= esc($errors['password']) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <button
                    type="submit"
                    class="button button-primary button-full"
                >
                    Sign in securely
                </button>
            </form>

            <p class="security-note">
                🔒 Protected by secure password hashing,
                CSRF protection, and server-side sessions.
            </p>
        </div>
    </main>
</div>

<script>
    const toggle = document.getElementById('passwordToggle');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function () {
        const passwordIsHidden = password.type === 'password';

        password.type = passwordIsHidden ? 'text' : 'password';
        toggle.textContent = passwordIsHidden ? 'Hide' : 'Show';
    });
</script>

</body>
</html>