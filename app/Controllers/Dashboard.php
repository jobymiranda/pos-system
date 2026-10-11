<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $productModel = new ProductModel();
        $saleModel = new SaleModel();

        return $this->render('dashboard/index', [
            'title' => 'Showroom Dashboard | CasaForma',
            'productCount' => $productModel->countAllResults(),
            'customerCount' => (new CustomerModel())->countAllResults(),
            'staffCount' => (new UserModel())->countAllResults(),
            'lowStockCount' => $productModel->where('stock_quantity >', 0)->where('stock_quantity <=', 5)->countAllResults(),
            'todayRevenue' => $saleModel->todayRevenue(),
            'todaySales' => $saleModel->todayCount(),
            'recentSales' => $saleModel->getHistory(5),
            'lowStockProducts' => (new ProductModel())->where('stock_quantity <=', 5)->orderBy('stock_quantity', 'ASC')->findAll(5),
            'featuredProducts' => (new ProductModel())->orderBy('created_at', 'DESC')->findAll(4),
            'categoryCounts' => $productModel->categoryCounts(),
        ]);
    }
}