<section class="page-heading reveal">
    <div><p class="kicker">CLIENT DIRECTORY</p><h1>People behind the spaces</h1><p>Maintain the customer records connected to CasaForma transactions.</p></div>
    <a class="button button-blue" href="<?= base_url('customers/new') ?>">＋ Add client</a>
</section>

<section class="toolbar reveal"><label class="search-box"><span>⌕</span><input type="search" placeholder="Search clients" data-search-input="customerTable"></label><span><?= count($customers) ?> active client(s)</span></section>

<section class="panel table-panel reveal">
    <?php if ($customers !== []): ?>
        <div class="table-wrap"><table id="customerTable"><thead><tr><th>Client</th><th>Email</th><th>Phone</th><th>Joined</th><th>Actions</th></tr></thead><tbody>
        <?php foreach ($customers as $customer): ?>
            <tr data-search-item="<?= esc(strtolower($customer['full_name'] . ' ' . $customer['email']), 'attr') ?>">
                <td><div class="identity"><span class="initial-avatar"><?= esc(strtoupper(substr($customer['full_name'], 0, 1))) ?></span><strong><?= esc($customer['full_name']) ?></strong></div></td>
                <td><?= esc($customer['email']) ?></td><td><?= esc($customer['phone'] ?? '—') ?></td><td><?= esc(date('M j, Y', strtotime($customer['created_at']))) ?></td>
                <td><div class="table-actions"><a href="<?= base_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a><form action="<?= base_url('customers/' . $customer['id'] . '/delete') ?>" method="post" data-confirm="Remove this client from active accounts?"><?= csrf_field() ?><button type="submit">Remove</button></form></div></td>
            </tr>
        <?php endforeach; ?>
        </tbody></table></div>
    <?php else: ?><div class="empty-state"><span>●</span><h2>No clients yet.</h2><p>Create the first client account.</p></div><?php endif; ?>
</section>