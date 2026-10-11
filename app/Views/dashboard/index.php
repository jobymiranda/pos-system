<?php
$categoryArt = [
    'Sofa & Seating' => 'seating.jpg',
    'Tables & Dining' => 'tables.jpg',
    'Bedroom' => 'bedroom.jpg',
    'Lighting' => 'lighting.jpg',
    'Storage' => 'storage.jpg',
    'Decor & Accents' => 'decor.jpg',
];
?>

<section class="hero-bauhaus reveal">
    <div class="hero-copy">
        <p class="kicker light">CASAFORMA SHOWROOM SYSTEM</p>
        <h1>Objects with character.<br><em>Sales with clarity.</em></h1>
        <p>Welcome back, <?= esc(session()->get('full_name')) ?>. Manage your collection, client relationships, staff, stock, and sales from one working showroom workspace.</p>
        <div class="button-row">
            <a class="button button-yellow" href="<?= base_url('sales/new') ?>">Record a sale <span>→</span></a>
            <a class="button button-outline-light" href="<?= base_url('products') ?>">Browse collection</a>
        </div>
    </div>
    <div class="hero-sculpture" aria-hidden="true"><div class="sculpture-disc"></div><div class="sculpture-seat"></div><div class="sculpture-leg leg-one"></div><div class="sculpture-leg leg-two"></div><div class="sculpture-orbit"></div></div>
</section>

<section class="metric-grid reveal">
    <article class="metric-card metric-red"><span class="metric-number"><?= peso($todayRevenue) ?></span><div><strong>Revenue today</strong><small>Live transaction total</small></div><span class="metric-symbol">●</span></article>
    <article class="metric-card metric-blue"><span class="metric-number"><?= esc($todaySales) ?></span><div><strong>Sales today</strong><small>Completed transactions</small></div><span class="metric-symbol">■</span></article>
    <article class="metric-card metric-yellow"><span class="metric-number"><?= esc($productCount) ?></span><div><strong>Furniture pieces</strong><small>Active collection</small></div><span class="metric-symbol">▲</span></article>
    <article class="metric-card metric-green"><span class="metric-number"><?= esc($lowStockCount) ?></span><div><strong>Low stock</strong><small>Needs attention</small></div><span class="metric-symbol">◆</span></article>
</section>

<section class="section-heading reveal">
    <div><p class="kicker">SHOP THE SHOWROOM</p><h2>Explore by room and function.</h2></div>
    <a class="text-link" href="<?= base_url('products') ?>">Open full catalog →</a>
</section>

<section class="category-gallery reveal">
    <?php foreach ($categoryCounts as $category => $count): ?>
        <a class="category-tile" href="<?= base_url('products?category=' . rawurlencode($category)) ?>">
            <img src="<?= base_url('images/categories/' . $categoryArt[$category]) ?>" alt="<?= esc($category) ?> collection">
            <span><small><?= esc($count) ?> piece(s)</small><strong><?= esc($category) ?></strong><b>Explore →</b></span>
        </a>
    <?php endforeach; ?>
</section>

<section class="section-heading reveal"><div><p class="kicker">NEWEST ARRIVALS</p><h2>Featured furniture objects.</h2></div><a class="text-link" href="<?= base_url('products/new') ?>">Add furniture →</a></section>

<?php if ($featuredProducts !== []): ?>
    <section class="featured-products reveal">
        <?php foreach ($featuredProducts as $product): ?>
            <a href="<?= base_url('products/' . $product['id'] . '/edit') ?>" class="featured-product">
                <img src="<?= esc(product_image_url($product), 'attr') ?>" alt="<?= esc($product['name']) ?>">
                <span><small><?= esc($product['category']) ?></small><strong><?= esc($product['name']) ?></strong><b><?= peso($product['price']) ?></b></span>
            </a>
        <?php endforeach; ?>
    </section>
<?php endif; ?>

<section class="dashboard-columns">
    <article class="panel reveal">
        <div class="panel-heading"><div><p class="kicker">RECENT ACTIVITY</p><h2>Latest sales</h2></div><a class="text-link" href="<?= base_url('sales') ?>">View history →</a></div>
        <?php if ($recentSales !== []): ?>
            <div class="activity-list">
                <?php foreach ($recentSales as $sale): ?>
                    <a href="<?= base_url('sales/' . $sale['id'] . '/receipt') ?>" class="activity-item">
                        <img src="<?= esc(product_image_url(['image' => $sale['product_image'], 'category' => 'Decor & Accents']), 'attr') ?>" alt="">
                        <div><strong><?= esc($sale['product_name']) ?></strong><span><?= esc($sale['customer_name'] ?? 'Walk-in customer') ?> · <?= esc($sale['quantity']) ?> unit(s)</span></div>
                        <b><?= peso($sale['total_price']) ?></b>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state"><span>＋</span><h3>No sales yet</h3><p>Record the first showroom transaction.</p></div>
        <?php endif; ?>
    </article>

    <article class="panel panel-dark reveal">
        <div class="panel-heading"><div><p class="kicker light">INVENTORY PULSE</p><h2>Stock watch</h2></div><span class="live-pill"><i></i> Live</span></div>
        <div class="stock-watch">
            <?php if ($lowStockProducts !== []): ?>
                <?php foreach ($lowStockProducts as $product): ?>
                    <div><span class="stock-shape"></span><p><strong><?= esc($product['name']) ?></strong><small><?= esc($product['stock_quantity']) ?> unit(s) remaining</small></p><span class="stock-level <?= (int) $product['stock_quantity'] === 0 ? 'out' : '' ?>"><?= (int) $product['stock_quantity'] === 0 ? 'Out' : 'Low' ?></span></div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="dark-empty">Every item has healthy stock.</p>
            <?php endif; ?>
        </div>
        <a class="button button-outline-light" href="<?= base_url('products') ?>">Manage inventory</a>
    </article>
</section>

<section class="quick-strip reveal"><div><p class="kicker">QUICK ACTIONS</p><h2>Keep the showroom moving.</h2></div><div class="quick-links"><a href="<?= base_url('products/new') ?>">Add furniture <span>↗</span></a><a href="<?= base_url('customers/new') ?>">Add client <span>↗</span></a><a href="<?= base_url('users/new') ?>">Add staff <span>↗</span></a></div></section>