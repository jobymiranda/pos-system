<section class="page-heading">
    <p class="eyebrow">Staff Management</p>

    <h1>User Accounts</h1>

    <p>
        Staff records retrieved from the MySQL database.
    </p>
</section>

<section class="content-panel">
    <?php if ($users !== []): ?>
        <div class="table-wrapper">
            <table>
                <caption>List of user and staff accounts</caption>

                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Username</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Created At</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $index => $user): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td>
                                <?= esc($user['username']) ?>
                            </td>

                            <td>
                                <?= esc($user['full_name']) ?>
                            </td>

                            <td>
                                <?= esc($user['created_at']) ?>
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