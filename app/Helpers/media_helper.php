<?php

if (! function_exists('media_url')) {
    function media_url(?string $value, string $folder, string $placeholder): string
    {
        if ($value === null || trim($value) === '') {
            return base_url($placeholder);
        }

        if (preg_match('#^https?://#i', $value) === 1) {
            return $value;
        }

        return base_url(
            'uploads/' . trim($folder, '/') . '/' . rawurlencode(basename($value))
        );
    }
}

if (! function_exists('product_image_url')) {
    function product_image_url(array $product): string
    {
        if (! empty($product['image'])) {
            return media_url(
                $product['image'],
                'products',
                'images/product-placeholder.svg'
            );
        }

        $art = [
            'Sofa & Seating' => 'seating.svg',
            'Tables & Dining' => 'tables.svg',
            'Bedroom' => 'bedroom.svg',
            'Lighting' => 'lighting.svg',
            'Storage' => 'storage.svg',
            'Decor & Accents' => 'decor.svg',
        ];

        $category = $product['category'] ?? '';

        return base_url(
            'images/categories/' . ($art[$category] ?? 'decor.svg')
        );
    }
}

if (! function_exists('peso')) {
    function peso(float|int|string $amount): string
    {
        return '₱' . number_format((float) $amount, 2);
    }
}