<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    public const CATEGORIES = [
        'Sofa & Seating',
        'Tables & Dining',
        'Bedroom',
        'Lighting',
        'Storage',
        'Decor & Accents',
    ];

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';
    protected $allowedFields = [
        'sku',
        'name',
        'category',
        'price',
        'stock_quantity',
        'image',
        'description',
        'created_at',
        'deleted_at',
    ];
    protected $useTimestamps = false;

    public function categoryCounts(): array
    {
        $counts = array_fill_keys(self::CATEGORIES, 0);
        $rows = $this->select('category, COUNT(*) AS total')
            ->groupBy('category')
            ->findAll();

        foreach ($rows as $row) {
            if (array_key_exists($row['category'], $counts)) {
                $counts[$row['category']] = (int) $row['total'];
            }
        }

        return $counts;
    }
}