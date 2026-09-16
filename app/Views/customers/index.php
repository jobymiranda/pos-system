<section class="page-heading">
    <p class="eyebrow">Account Management</p>

    <h1>Customer Accounts</h1>

    <p>
        Customer records currently stored in a temporary PHP array.
    </p>
</section>

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
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($customers as $index => $customer): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td>
                                <?= esc($customer['full_name']) ?>
                            </td>

                            <td>
                                <a
                                    href="mailto:<?= esc($customer['email']) ?>"
                                >
                                    <?= esc($customer['email']) ?>
                                </a>
                            </td>

                            <td>
                                <?= esc($customer['phone']) ?>
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