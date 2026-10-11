<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        $this->helpers = [
            'url',
            'form',
            'media',
        ];

        parent::initController($request, $response, $logger);
    }

    protected function render(string $view, array $data = []): string
    {
        return view('templates/header', $data)
            . view($view, $data)
            . view('templates/footer', $data);
    }
}