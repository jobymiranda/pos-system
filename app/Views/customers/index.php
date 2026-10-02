<section class="page-heading page-heading-with-action">
    <div>
        <p class="eyebrow">Account Management</p>
        <h1>Customer Accounts</h1>

        <p>
            Create and maintain customer records stored in MySQL.
        </p>
    </div>

    <a class="button button-solid" href="<?= site_url('customers/new') ?>">
        Add Customer
    </a>
</section>

<?php if ($message = session()->getFlashdata('success')): ?>
    <div class="alert alert-success" role="status">
        <?= esc($message) ?>
    </div>
<?php endif ?>

<section class="content-panel">
    <?php if ($customers !== []): ?>
        <div class="table-wrapper">
            <table>
                <caption>List of customer accounts</caption>

                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($customers as $index => $customer): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td><?= esc($customer['full_name']) ?></td>

                            <td>
                                <a
                                    href="mailto:<?= esc(
                                        $customer['email'],
                                        'attr'
                                    ) ?>"
                                >
                                    <?= esc($customer['email']) ?>
                                </a>
                            </td>

                            <td>
                                <?= esc($customer['phone'] ?? 'Not provided') ?>
                            </td>

                            <td>
                                <a
                                    class="table-action"
                                    href="<?= site_url(
                                        'customers/'
                                        . $customer['id']
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
            No customer accounts are available.
        </p>
    <?php endif ?>
</section>