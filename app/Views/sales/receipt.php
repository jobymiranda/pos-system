<section class="receipt-page reveal">
    <div class="receipt-actions no-print"><a class="button button-ghost" href="<?= base_url('sales') ?>">← History</a><div><button class="button button-dark" type="button" onclick="window.print()">Print receipt</button><a class="button button-red" href="<?= base_url('sales/new') ?>">Record another</a></div></div>
    <article class="receipt">
        <header><div class="brand-mark"><i></i><i></i><i></i></div><div><strong>CASAFORMA</strong><span>Furniture showroom</span></div><b>SALE #<?= str_pad((string) $sale['id'], 5, '0', STR_PAD_LEFT) ?></b></header>
        <div class="receipt-title"><p class="kicker">TRANSACTION COMPLETE</p><h1>Thank you for choosing bold living.</h1><span><?= esc(date('F j, Y · g:i A', strtotime($sale['created_at']))) ?></span></div>
        <div class="receipt-product"><img src="<?= esc(media_url($sale['product_image'], 'products', 'images/product-placeholder.svg'), 'attr') ?>" alt="<?= esc($sale['product_name']) ?>"><div><small>FURNITURE PIECE</small><h2><?= esc($sale['product_name']) ?></h2><p><?= esc($sale['quantity']) ?> × <?= peso($sale['unit_price']) ?></p></div></div>
        <dl><div><dt>Customer</dt><dd><?= esc($sale['customer_name'] ?? 'Walk-in customer') ?></dd></div><div><dt>Processed by</dt><dd><?= esc($sale['staff_name']) ?></dd></div><div><dt>Quantity</dt><dd><?= esc($sale['quantity']) ?></dd></div></dl>
        <div class="receipt-total"><span>Total paid</span><strong><?= peso($sale['total_price']) ?></strong></div>
        <footer><span>Form follows function.</span><span>casafoma / point of sale</span></footer>
    </article>
</section>