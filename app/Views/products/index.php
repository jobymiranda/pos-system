<section class="page-heading reveal">
    <div><p class="kicker">CURATED INVENTORY</p><h1>Furniture collection</h1><p>Search and filter every CasaForma object by room, function, stock level, and product details.</p></div>
    <a class="button button-red" href="<?= base_url('products/new') ?>">＋ Add furniture</a>
</section>

<section class="catalog-controls reveal">
    <form action="<?= base_url('products') ?>" method="get" class="catalog-search">
        <?php if ($selectedCategory !== ''): ?><input type="hidden" name="category" value="<?= esc($selectedCategory) ?>"><?php endif; ?>
        <label class="search-box"><span>⌕</span><input type="search" name="q" value="<?= esc($search, 'attr') ?>" placeholder="Search name, SKU, or description"></label>
        <button class="button button-dark button-small" type="submit">Search</button>
    </form>
    <span><?= count($products) ?> shown · <?= esc($totalProducts) ?> active in total</span>
</section>

<nav class="filter-chips reveal" aria-label="Furniture categories">
    <a class="filter-chip <?= $selectedCategory === '' ? 'active' : '' ?>" href="<?= base_url('products') ?>">All <b><?= esc($totalProducts) ?></b></a>
    <?php foreach ($categories as $category): ?>
        <a class="filter-chip <?= $selectedCategory === $category ? 'active' : '' ?>" href="<?= base_url('products?category=' . rawurlencode($category)) ?>"><?= esc($category) ?> <b><?= esc($categoryCounts[$category]) ?></b></a>
    <?php endforeach; ?>
</nav>

<?php if ($products !== []): ?>
    <section class="product-grid catalog-grid">
        <?php foreach ($products as $index => $product): ?>
            <?php
            $stock = (int) $product['stock_quantity'];
            $stockClass = $stock === 0 ? 'out' : ($stock <= 5 ? 'low' : 'good');
            $stockText = $stock === 0 ? 'Out of stock' : ($stock <= 5 ? 'Low stock' : 'In stock');
            ?>
            <article class="product-card reveal" style="--delay: <?= $index * 45 ?>ms">
                <div class="product-image-wrap">
                    <img src="<?= esc(product_image_url($product), 'attr') ?>" alt="<?= esc($product['name']) ?>">
                    <span class="stock-badge <?= $stockClass ?>"><?= esc($stockText) ?></span>
                    <span class="product-index"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span>
                </div>
                <div class="product-card-body">
                    <div><p class="kicker"><?= esc($product['category']) ?></p><h2><?= esc($product['name']) ?></h2><?php if (! empty($product['sku'])): ?><small class="product-sku">SKU <?= esc($product['sku']) ?></small><?php endif; ?></div>
                    <p class="product-description"><?= esc($product['description'] ?: 'A CasaForma furniture object ready for its next home.') ?></p>
                    <div class="product-card-bottom"><p class="product-price"><?= peso($product['price']) ?></p><span><?= esc($stock) ?> unit(s)</span></div>
                    <div class="card-actions"><a class="button button-small button-dark" href="<?= base_url('products/' . $product['id'] . '/edit') ?>">Edit item</a><form action="<?= base_url('products/' . $product['id'] . '/archive') ?>" method="post" data-confirm="Archive <?= esc($product['name'], 'attr') ?>? Previous sales will remain in history."><?= csrf_field() ?><button class="button button-small button-ghost" type="submit">Archive</button></form></div>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
<?php else: ?>
    <section class="empty-state panel"><span>■</span><h2>No furniture found.</h2><p>Try a different search or category, or add a new showroom piece.</p><div class="button-row"><a class="button button-dark" href="<?= base_url('products') ?>">Clear filters</a><a class="button button-red" href="<?= base_url('products/new') ?>">Add furniture</a></div></section>
<?php endif; ?>