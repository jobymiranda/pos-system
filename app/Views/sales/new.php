<?php $errors = session()->getFlashdata('errors') ?? []; ?>
<section class="page-heading reveal"><div><p class="kicker">SHOWROOM CHECKOUT</p><h1>Record a furniture sale</h1><p>Select a piece, connect a client if available, and confirm the quantity.</p></div><a class="button button-ghost" href="<?= base_url('sales') ?>">Sales history</a></section>

<section class="checkout-layout reveal">
    <form action="<?= base_url('sales') ?>" method="post" class="form-card form-stack" id="saleForm">
        <?= csrf_field() ?>
        <?php if ($errors !== []): ?><div class="alert alert-danger"><ul><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
        <label class="field"><span>Furniture piece *</span><select name="product_id" id="saleProduct"><option value="">Choose from available inventory</option><?php foreach ($products as $product): ?><option value="<?= esc($product['id']) ?>" data-name="<?= esc($product['name'], 'attr') ?>" data-price="<?= esc($product['price']) ?>" data-stock="<?= esc($product['stock_quantity']) ?>" data-image="<?= esc(media_url($product['image'], 'products', 'images/product-placeholder.svg'), 'attr') ?>" <?= old('product_id') == $product['id'] ? 'selected' : '' ?>><?= esc($product['name']) ?> — <?= peso($product['price']) ?> (<?= esc($product['stock_quantity']) ?> available)</option><?php endforeach; ?></select></label>
        <label class="field"><span>Client</span><select name="customer_id" id="saleCustomer"><option value="">Walk-in customer</option><?php foreach ($customers as $customer): ?><option value="<?= esc($customer['id']) ?>" <?= old('customer_id') == $customer['id'] ? 'selected' : '' ?>><?= esc($customer['full_name']) ?></option><?php endforeach; ?></select><small>Customer selection is optional.</small></label>
        <label class="field"><span>Quantity *</span><input type="number" id="saleQuantity" name="quantity" min="1" step="1" value="<?= esc(old('quantity', 1), 'attr') ?>"><small id="saleStockHint">Select a product to view available stock.</small></label>
        <button class="button button-red button-full" type="submit">Complete sale securely <span>→</span></button>
    </form>

    <aside class="order-summary">
        <p class="kicker light">ORDER SUMMARY</p>
        <img id="summaryImage" src="<?= base_url('images/product-placeholder.svg') ?>" alt="Selected furniture">
        <h2 id="summaryName">Select a furniture piece</h2>
        <div class="summary-row"><span>Unit price</span><strong id="summaryPrice">₱0.00</strong></div>
        <div class="summary-row"><span>Quantity</span><strong id="summaryQuantity">1</strong></div>
        <div class="summary-row"><span>Client</span><strong id="summaryCustomer">Walk-in customer</strong></div>
        <div class="summary-total"><span>Estimated total</span><strong id="summaryTotal">₱0.00</strong></div>
        <small>The server rechecks price and inventory before saving.</small>
    </aside>
</section>