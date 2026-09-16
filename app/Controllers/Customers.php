<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index(): string
    {
        $customers = [
            [
                'full_name' => 'Angela Santos',
                'email'     => 'angela.santos@example.com',
                'phone'     => '0917-123-4567',
            ],
            [
                'full_name' => 'Miguel Reyes',
                'email'     => 'miguel.reyes@example.com',
                'phone'     => '0918-234-5678',
            ],
            [
                'full_name' => 'Sofia Garcia',
                'email'     => 'sofia.garcia@example.com',
                'phone'     => '0919-345-6789',
            ],
            [
                'full_name' => 'Daniel Cruz',
                'email'     => 'daniel.cruz@example.com',
                'phone'     => '0920-456-7890',
            ],
            [
                'full_name' => 'Isabella Mendoza',
                'email'     => 'isabella.mendoza@example.com',
                'phone'     => '0921-567-8901',
            ],
        ];

        $data = [
            'title'     => 'Customer Accounts',
            'customers' => $customers,
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('customers/index', $data)
            . view('templates/footer');
    }
}