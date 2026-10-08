<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(): string
    {
        /*
         * pages/home.php already loads the shared header and footer,
         * so it must not be wrapped a second time here.
         */
        return view('pages/home', [
            'title' => 'Dashboard | SimplePOS',
        ]);
    }

    public function about(): string
    {
        $data = [
            'title' => 'About | SimplePOS',
        ];

        /*
         * The About view is a content-only view, so the controller
         * supplies its shared header and footer.
         */
        return view('templates/header', $data)
            . view('pages/about', $data)
            . view('templates/footer');
    }
}