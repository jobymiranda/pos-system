<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function about(): string
    {
        return $this->render('pages/about', [
            'title' => 'About | CasaForma',
        ]);
    }
}