<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $users = [
            [
                'username'  => 'admin01',
                'full_name' => 'Maria Dela Cruz',
                'role'      => 'Administrator',
            ],
            [
                'username'  => 'cashier01',
                'full_name' => 'John Bautista',
                'role'      => 'Cashier',
            ],
            [
                'username'  => 'cashier02',
                'full_name' => 'Nicole Ramos',
                'role'      => 'Cashier',
            ],
            [
                'username'  => 'manager01',
                'full_name' => 'Carlo Villanueva',
                'role'      => 'Store Manager',
            ],
            [
                'username'  => 'inventory01',
                'full_name' => 'Patricia Lim',
                'role'      => 'Inventory Staff',
            ],
        ];

        $data = [
            'title' => 'User Accounts',
            'users' => $users,
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('users/index', $data)
            . view('templates/footer');
    }
}