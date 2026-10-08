<?= view('templates/header', ['title' => 'Dashboard | SimplePOS']) ?>

<section class="dashboard-hero">
    <div class="hero-content">
        <div class="hero-badge">
            <span class="live-dot"></span>
            Secure workspace
        </div>

        <p class="hero-eyebrow">
            CODEIGNITER 4 POS SYSTEM
        </p>

        <h1>
            Welcome back,
            <span>
                <?= esc(
                    session()->get('full_name') ?? 'Team Member'
                ) ?>
            </span>
        </h1>

        <p class="hero-description">
            Manage your customer records and staff accounts from one
            secure, organized, and professional workspace.
        </p>

        <div class="hero-actions">
            <a
                href="<?= base_url('customers') ?>"
                class="button button-white"
            >
                View Customers
                <span aria-hidden="true">→</span>
            </a>

            <a
                href="<?= base_url('users') ?>"
                class="button button-outline-white"
            >
                Manage Users
            </a>
        </div>
    </div>

    <div class="hero-visual" aria-hidden="true">
        <div class="visual-card visual-card-main">
            <div class="visual-card-header">
                <span class="visual-icon">S</span>

                <div>
                    <strong>SimplePOS</strong>
                    <small>System overview</small>
                </div>
            </div>

            <div class="visual-row">
                <span>Authentication</span>
                <strong class="status-online">Protected</strong>
            </div>

            <div class="visual-row">
                <span>Database</span>
                <strong class="status-online">Connected</strong>
            </div>

            <div class="visual-row">
                <span>Current role</span>
                <strong>
                    <?= esc(session()->get('role') ?? 'Staff') ?>
                </strong>
            </div>
        </div>

        <div class="floating-shape shape-one"></div>
        <div class="floating-shape shape-two"></div>
    </div>
</section>

<section class="dashboard-section">
    <div class="section-heading">
        <div>
            <p class="section-eyebrow">WORKSPACE</p>
            <h2>Everything you need in one place</h2>
        </div>

        <p>
            Select a module below to manage SimplePOS records.
        </p>
    </div>

    <div class="dashboard-grid">
        <article class="dashboard-card">
            <div class="card-icon customers-icon">
                C
            </div>

            <div class="card-content">
                <p class="card-label">CUSTOMER MANAGEMENT</p>

                <h3>Customer Accounts</h3>

                <p>
                    View and maintain customer names, email addresses,
                    and contact numbers.
                </p>

                <a href="<?= base_url('customers') ?>">
                    Open customer accounts
                    <span aria-hidden="true">→</span>
                </a>
            </div>
        </article>

        <article class="dashboard-card">
            <div class="card-icon users-icon">
                U
            </div>

            <div class="card-content">
                <p class="card-label">STAFF MANAGEMENT</p>

                <h3>User Accounts</h3>

                <p>
                    Create secure staff accounts, manage roles,
                    passwords, and profile pictures.
                </p>

                <a href="<?= base_url('users') ?>">
                    Open user accounts
                    <span aria-hidden="true">→</span>
                </a>
            </div>
        </article>

        <article class="dashboard-card">
            <div class="card-icon security-icon">
                ✓
            </div>

            <div class="card-content">
                <p class="card-label">SYSTEM INFORMATION</p>

                <h3>About SimplePOS</h3>

                <p>
                    Learn how routing, controllers, models, views,
                    sessions, and authentication work together.
                </p>

                <a href="<?= base_url('about') ?>">
                    Read about the project
                    <span aria-hidden="true">→</span>
                </a>
            </div>
        </article>
    </div>
</section>

<section class="security-panel">
    <div class="security-symbol">🔒</div>

    <div>
        <p class="section-eyebrow">SECURE SESSION</p>

        <h2>Your workspace is protected</h2>

        <p>
            You are authenticated as
            <strong><?= esc(session()->get('username')) ?></strong>.
            Protected pages require a valid server-side session.
        </p>
    </div>

    <span class="security-status">
        <span class="live-dot"></span>
        Session active
    </span>
</section>

<?= view('templates/footer') ?>