<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title><?= esc($title ?? 'SimplePOS') ?></title>

    <link
        rel="stylesheet"
        href="<?= base_url('css/style.css?v=10') ?>"
    >
</head>

<body>

<header class="site-header">
    <div class="navbar-container">
        <a class="site-brand" href="<?= base_url('/') ?>">
            <span class="brand-icon">S</span>

            <span class="brand-text">
                <strong>SimplePOS</strong>
                <small>Account Management</small>
            </span>
        </a>

        <nav class="main-navigation" aria-label="Main navigation">
            <?php if (session()->get('isLoggedIn')): ?>
                <a
                    href="<?= base_url('/') ?>"
                    class="<?= uri_string() === '' ? 'active' : '' ?>"
                >
                    Home
                </a>
            <?php endif; ?>

            <a
                href="<?= base_url('about') ?>"
                class="<?= uri_string() === 'about' ? 'active' : '' ?>"
            >
                About
            </a>

            <?php if (session()->get('isLoggedIn')): ?>
                <a
                    href="<?= base_url('customers') ?>"
                    class="<?= str_starts_with(
                        uri_string(),
                        'customers'
                    ) ? 'active' : '' ?>"
                >
                    Customers
                </a>

                <a
                    href="<?= base_url('users') ?>"
                    class="<?= str_starts_with(
                        uri_string(),
                        'users'
                    ) ? 'active' : '' ?>"
                >
                    Users
                </a>
            <?php endif; ?>
        </nav>

        <div class="navbar-account">
            <?php if (session()->get('isLoggedIn')): ?>
                <div class="signed-in-user">
                    <?php if (session()->get('avatar')): ?>
                        <img
                            class="navbar-avatar"
                            src="<?= base_url(
                                'uploads/avatars/'
                                . session()->get('avatar')
                            ) ?>"
                            alt="<?= esc(
                                session()->get('full_name')
                            ) ?>"
                        >
                    <?php else: ?>
                        <img
                            class="navbar-avatar"
                            src="<?= base_url(
                                'images/avatar-placeholder.svg'
                            ) ?>"
                            alt="Default profile picture"
                        >
                    <?php endif; ?>

                    <span class="signed-in-details">
                        <strong>
                            <?= esc(session()->get('full_name')) ?>
                        </strong>

                        <small>
                            <?= esc(session()->get('role')) ?>
                        </small>
                    </span>
                </div>

                <form
                    action="<?= base_url('logout') ?>"
                    method="post"
                    class="logout-form"
                >
                    <?= csrf_field() ?>

                    <button type="submit" class="logout-button">
                        Sign Out
                    </button>
                </form>
            <?php else: ?>
                <a
                    href="<?= base_url('login') ?>"
                    class="navbar-login"
                >
                    Sign In
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main class="page-container">
    <?php if ($message = session()->getFlashdata('success')): ?>
        <div class="alert alert-success" role="status">
            <span class="alert-icon">✓</span>
            <span><?= esc($message) ?></span>
        </div>
    <?php endif; ?>

    <?php if ($message = session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
            <span class="alert-icon">!</span>
            <span><?= esc($message) ?></span>
        </div>
    <?php endif; ?>