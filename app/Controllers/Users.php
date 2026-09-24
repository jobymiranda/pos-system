<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        $data = [
            'title' => 'User Accounts',
            'users' => $userModel
                ->orderBy('id', 'ASC')
                ->findAll(),
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('users/index', $data)
            . view('templates/footer');
    }
}