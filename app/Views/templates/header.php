<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111111">
    <title><?= esc($title ?? 'CasaForma') ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=2') ?>">
    <link rel="stylesheet" href="<?= base_url('css/catalog.css?v=1') ?>">
</head>
<body class="app-body">

<div class="app-shell">
    <div class="sidebar-scrim" data-sidebar-close></div>

    <aside class="sidebar" id="appSidebar">
        <a class="brand" href="<?= base_url('/') ?>">
            <span class="brand-mark" aria-hidden="true"><i></i><i></i><i></i></span>
            <span><strong>CASAFORMA</strong><small>Furniture showroom</small></span>
        </a>

        <nav class="sidebar-nav" aria-label="Primary navigation">
            <p class="nav-label">Showroom</p>
            <a href="<?= base_url('/') ?>" class="<?= uri_string() === '' ? 'active' : '' ?>"><span class="nav-icon">◆</span><span>Overview</span></a>
            <a href="<?= base_url('sales/new') ?>" class="<?= uri_string() === 'sales/new' ? 'active' : '' ?>"><span class="nav-icon">＋</span><span>Record Sale</span></a>
            <a href="<?= base_url('products') ?>" class="<?= str_starts_with(uri_string(), 'products') ? 'active' : '' ?>"><span class="nav-icon">■</span><span>Furniture</span></a>

            <p class="nav-label">Operations</p>
            <a href="<?= base_url('customers') ?>" class="<?= str_starts_with(uri_string(), 'customers') ? 'active' : '' ?>"><span class="nav-icon">●</span><span>Clients</span></a>
            <a href="<?= base_url('users') ?>" class="<?= str_starts_with(uri_string(), 'users') ? 'active' : '' ?>"><span class="nav-icon">▲</span><span>Studio Team</span></a>
            <a href="<?= base_url('sales') ?>" class="<?= uri_string() === 'sales' || str_contains(uri_string(), 'receipt') ? 'active' : '' ?>"><span class="nav-icon">≡</span><span>Sales History</span></a>
            <a href="<?= base_url('about') ?>" class="<?= uri_string() === 'about' ? 'active' : '' ?>"><span class="nav-icon">?</span><span>About</span></a>
        </nav>

        <div class="sidebar-profile">
            <img src="<?= esc(media_url(session()->get('avatar'), 'avatars', 'images/avatar-placeholder.svg'), 'attr') ?>" alt="<?= esc(session()->get('full_name')) ?>">
            <div><strong><?= esc(session()->get('full_name')) ?></strong><span><?= esc(session()->get('role')) ?></span></div>
            <form action="<?= base_url('logout') ?>" method="post">
                <?= csrf_field() ?>
                <button class="icon-button" type="submit" aria-label="Sign out">↗</button>
            </form>
        </div>
    </aside>

    <div class="main-shell">
        <header class="topbar">
            <button class="menu-button" type="button" data-sidebar-open aria-label="Open menu"><span></span><span></span></button>
            <div><p><?= esc(date('l, F j')) ?></p><strong><?= esc($title ?? 'CasaForma') ?></strong></div>
            <a class="topbar-action" href="<?= base_url('sales/new') ?>"><span>＋</span> Record Sale</a>
        </header>

        <main class="content">
            <?php if ($message = session()->getFlashdata('success')): ?>
                <div class="alert alert-success" role="status"><strong>Success</strong><span><?= esc($message) ?></span></div>
            <?php endif; ?>

            <?php if ($message = session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" role="alert"><strong>Attention</strong><span><?= esc($message) ?></span></div>
            <?php endif; ?>