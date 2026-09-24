<section class="hero">
    <p class="eyebrow">CodeIgniter 4 POS System</p>

    <h1>Welcome to SimplePOS</h1>

    <p>
        SimplePOS is a basic point-of-sale website built using
        CodeIgniter's Model-View-Controller architecture.
    </p>

    <div class="button-group">
        <a
            class="button button-primary"
            href="<?= site_url('customers') ?>"
        >
            View Customers
        </a>

        <a
            class="button button-secondary"
            href="<?= site_url('users') ?>"
        >
            View Users
        </a>
    </div>
</section>

<section class="feature-grid" aria-label="Application features">
    <article class="card">
        <h2>Customer Accounts</h2>

        <p>
            View customer names, email addresses, and phone numbers.
        </p>

        <a href="<?= site_url('customers') ?>">
            Open customer accounts
        </a>
    </article>

    <article class="card">
        <h2>User Accounts</h2>

        <p>
          View staff usernames, full names, and account creation dates.
        </p>

        <a href="<?= site_url('users') ?>">
            Open user accounts
        </a>
    </article>

    <article class="card">
        <h2>About the Project</h2>

        <p>
            Learn about the purpose and MVC structure of SimplePOS.
        </p>

        <a href="<?= site_url('about') ?>">
            Read about the project
        </a>
    </article>
</section>