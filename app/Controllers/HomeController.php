<?php

namespace App\Controllers;

class HomeController
{
    public function index(): void
    {
        require dirname(__DIR__) . '/Views/home/index.php';
    }
}
