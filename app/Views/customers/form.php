<?php $errors = session()->getFlashdata('errors') ?? []; ?>
<section class="page-heading reveal"><div><p class="kicker">CLIENT EDITOR</p><h1><?= esc($heading) ?></h1><p>Keep contact details accurate for future showroom visits.</p></div><a class="button button-ghost" href="<?= base_url('customers') ?>">← Back</a></section>
<section class="form-card narrow reveal">
    <form action="<?= esc($formAction, 'attr') ?>" method="post" class="form-stack">
        <?= csrf_field() ?>
        <?php if ($errors !== []): ?><div class="alert alert-danger"><ul><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
        <label class="field"><span>Full name *</span><input type="text" name="full_name" maxlength="100" value="<?= esc(old('full_name', $customer['full_name'] ?? ''), 'attr') ?>" placeholder="Complete client name"></label>
        <div class="form-grid"><label class="field"><span>Email address *</span><input type="email" name="email" maxlength="100" value="<?= esc(old('email', $customer['email'] ?? ''), 'attr') ?>" placeholder="name@example.com"></label><label class="field"><span>Phone number</span><input type="text" name="phone" maxlength="20" value="<?= esc(old('phone', $customer['phone'] ?? ''), 'attr') ?>" placeholder="09XX-XXX-XXXX"></label></div>
        <div class="form-actions"><a class="button button-ghost" href="<?= base_url('customers') ?>">Cancel</a><button class="button button-blue" type="submit"><?= esc($submitLabel) ?> →</button></div>
    </form>
</section>