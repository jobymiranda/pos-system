<section class="page-heading page-heading-with-action">
    <div>
        <p class="eyebrow">Staff Management</p>
        <h1>User Accounts</h1>

        <p>
            Create and maintain staff accounts and profile pictures.
        </p>
    </div>

    <a class="button button-solid" href="<?= site_url('users/new') ?>">
        Add User
    </a>
</section>

<?php if ($message = session()->getFlashdata('success')): ?>
    <div class="alert alert-success" role="status">
        <?= esc($message) ?>
    </div>
<?php endif ?>

<section class="content-panel">
    <?php if ($users !== []): ?>
        <div class="table-wrapper">
            <table>
                <caption>List of user and staff accounts</caption>

                <thead>
                    <tr>
                        <th scope="col">Avatar</th>
                        <th scope="col">Username</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user): ?>
                        <?php
                        $avatarFile = ! empty($user['avatar'])
                            ? basename($user['avatar'])
                            : null;

                        $avatarUrl = $avatarFile !== null
                            ? base_url(
                                'uploads/avatars/'
                                . rawurlencode($avatarFile)
                            )
                            : base_url(
                                'images/avatar-placeholder.svg'
                            );
                        ?>

                        <tr>
                            <td>
                                <img
                                    class="user-avatar"
                                    src="<?= esc($avatarUrl, 'attr') ?>"
                                    alt="<?= esc(
                                        $user['full_name']
                                        . ' profile picture',
                                        'attr'
                                    ) ?>"
                                    width="56"
                                    height="56"
                                >
                            </td>

                            <td><?= esc($user['username']) ?></td>

                            <td><?= esc($user['full_name']) ?></td>

                            <td><?= esc($user['created_at']) ?></td>

                            <td>
                                <a
                                    class="table-action"
                                    href="<?= site_url(
                                        'users/'
                                        . $user['id']
                                        . '/edit'
                                    ) ?>"
                                >
                                    Edit
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="empty-message">
            No user accounts are available.
        </p>
    <?php endif ?>
</section>