<section class="page-heading reveal"><div><p class="kicker">STUDIO TEAM</p><h1>The people who make it move</h1><p>Manage secure staff accounts, showroom roles, and profile images.</p></div><a class="button button-yellow" href="<?= base_url('users/new') ?>">＋ Add team member</a></section>
<section class="staff-grid">
    <?php foreach ($users as $index => $user): ?>
        <article class="staff-card reveal" style="--delay: <?= $index * 50 ?>ms">
            <div class="staff-art"><span class="staff-shape"></span><img src="<?= esc(media_url($user['avatar'], 'avatars', 'images/avatar-placeholder.svg'), 'attr') ?>" alt="<?= esc($user['full_name']) ?>"></div>
            <div class="staff-card-body"><p class="kicker"><?= esc($user['role']) ?></p><h2><?= esc($user['full_name']) ?></h2><span>@<?= esc($user['username']) ?></span><div class="card-actions"><a class="button button-small button-dark" href="<?= base_url('users/' . $user['id'] . '/edit') ?>">Edit</a><?php if ((int) session()->get('user_id') !== (int) $user['id'] && $user['username'] !== 'professor'): ?><form action="<?= base_url('users/' . $user['id'] . '/archive') ?>" method="post" data-confirm="Archive this staff account?"><?= csrf_field() ?><button class="button button-small button-ghost" type="submit">Archive</button></form><?php endif; ?></div></div>
        </article>
    <?php endforeach; ?>
</section>