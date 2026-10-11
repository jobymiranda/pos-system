<section class="page-heading reveal"><div><p class="kicker">PRODUCT WORKSHOP</p><h1><?= esc($heading) ?></h1><p>Build a complete, sale-ready product record. Add an original image now or use the category artwork until a photo is available.</p></div><a class="button button-ghost" href="<?= base_url('products') ?>">← Back to collection</a></section>

<section class="form-layout reveal">
    <form class="form-card form-stack" action="<?= esc($formAction, 'attr') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <?php $errors = session()->getFlashdata('errors') ?? []; ?>

        <div class="form-grid">
            <label class="field"><span>Furniture name *</span><input type="text" name="name" maxlength="100" value="<?= esc(old('name', $product['name'] ?? ''), 'attr') ?>" placeholder="Example: Arden Three-Seat Sofa" required><?php if (isset($errors['name'])): ?><small class="field-error"><?= esc($errors['name']) ?></small><?php endif; ?></label>
            <label class="field"><span>Internal SKU</span><input type="text" name="sku" maxlength="30" value="<?= esc(old('sku', $product['sku'] ?? ''), 'attr') ?>" placeholder="Example: CF-SOF-013"><?php if (isset($errors['sku'])): ?><small class="field-error"><?= esc($errors['sku']) ?></small><?php endif; ?></label>
        </div>

        <div class="form-grid">
            <label class="field"><span>Collection category *</span><select name="category" required><?php $selected = old('category', $product['category'] ?? 'Sofa & Seating'); ?><?php foreach ($categories as $category): ?><option value="<?= esc($category) ?>" <?= $selected === $category ? 'selected' : '' ?>><?= esc($category) ?></option><?php endforeach; ?></select><?php if (isset($errors['category'])): ?><small class="field-error"><?= esc($errors['category']) ?></small><?php endif; ?></label>
            <label class="field"><span>Product image</span><input type="file" name="image" accept="image/png,image/jpeg" data-image-input="productPreview"><small>Optional JPG or PNG, maximum 2 MB. The system prepares it for display.</small><?php if (isset($errors['image'])): ?><small class="field-error"><?= esc($errors['image']) ?></small><?php endif; ?></label>
        </div>

        <div class="form-grid">
            <label class="field"><span>Price in Philippine pesos *</span><input type="number" name="price" min="0.01" step="0.01" value="<?= esc(old('price', $product['price'] ?? ''), 'attr') ?>" placeholder="0.00" required><?php if (isset($errors['price'])): ?><small class="field-error"><?= esc($errors['price']) ?></small><?php endif; ?></label>
            <label class="field"><span>Available units *</span><input type="number" name="stock_quantity" min="0" step="1" value="<?= esc(old('stock_quantity', $product['stock_quantity'] ?? 0), 'attr') ?>" required><?php if (isset($errors['stock_quantity'])): ?><small class="field-error"><?= esc($errors['stock_quantity']) ?></small><?php endif; ?></label>
        </div>

        <label class="field"><span>Showroom description</span><textarea name="description" maxlength="1000" rows="5" placeholder="Describe the material, scale, color, or mood of the piece."><?= esc(old('description', $product['description'] ?? '')) ?></textarea><small>Used on the collection card and helps staff identify the item quickly.</small><?php if (isset($errors['description'])): ?><small class="field-error"><?= esc($errors['description']) ?></small><?php endif; ?></label>

        <div class="form-actions"><a class="button button-ghost" href="<?= base_url('products') ?>">Cancel</a><button class="button button-red" type="submit"><?= esc($submitLabel) ?> →</button></div>
    </form>

    <aside class="preview-card"><p class="kicker light">CATALOG PREVIEW</p><img id="productPreview" src="<?= esc(product_image_url($product), 'attr') ?>" alt="Product preview"><div><span><?= esc($product['category'] ?? 'Sofa & Seating') ?></span><strong><?= esc($product['name'] ?? 'New furniture object') ?></strong><small><?= ! empty($product['price']) ? peso($product['price']) : 'Set a price to complete the record' ?></small></div></aside>
</section>
```