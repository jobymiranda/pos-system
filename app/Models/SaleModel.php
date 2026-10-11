<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'product_id',
        'customer_id',
        'sold_by',
        'quantity',
        'total_price',
        'created_at',
    ];
    protected $useTimestamps = false;

    public function getHistory(?int $limit = null): array
    {
        $builder = $this->select(
            'sales.*, products.name AS product_name, '
            . 'products.image AS product_image, '
            . 'customers.full_name AS customer_name, '
            . 'users.full_name AS staff_name'
        )
            ->join('products', 'products.id = sales.product_id')
            ->join(
                'customers',
                'customers.id = sales.customer_id',
                'left'
            )
            ->join('users', 'users.id = sales.sold_by')
            ->orderBy('sales.created_at', 'DESC');

        return $limit === null
            ? $builder->findAll()
            : $builder->findAll($limit);
    }

    public function getReceipt(int $id): ?array
    {
        return $this->select(
            'sales.*, products.name AS product_name, '
            . 'products.price AS unit_price, '
            . 'products.image AS product_image, '
            . 'customers.full_name AS customer_name, '
            . 'users.full_name AS staff_name'
        )
            ->join('products', 'products.id = sales.product_id')
            ->join(
                'customers',
                'customers.id = sales.customer_id',
                'left'
            )
            ->join('users', 'users.id = sales.sold_by')
            ->where('sales.id', $id)
            ->first();
    }

    public function todayRevenue(): float
    {
        $row = $this->selectSum('total_price', 'revenue')
            ->where('DATE(created_at)', date('Y-m-d'))
            ->first();

        return (float) ($row['revenue'] ?? 0);
    }

    public function todayCount(): int
    {
        return $this
            ->where('DATE(created_at)', date('Y-m-d'))
            ->countAllResults();
    }
}