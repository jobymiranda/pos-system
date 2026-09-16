<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Home',
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('pages/home', $data)
            . view('templates/footer');
    }

    public function about(): string
    {
        $data = [
            'title' => 'About',
        ];

        return view('templates/header', $data)
            . view('templates/navigation')
            . view('pages/about', $data)
            . view('templates/footer');
    }
}