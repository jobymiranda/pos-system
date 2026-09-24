<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index(): string
    {
        $customerModel = new CustomerModel();

        $data = [
            'title'     => 'Customer Accounts',
            'customers' => $customerModel
                ->orderBy('id', 'ASC')
                ->findAll(),
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('customers/index', $data)
            . view('templates/footer');
    }
}