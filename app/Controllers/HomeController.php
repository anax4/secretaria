<?php

class HomeController
{
    public function index()
    {
        $viewFile = '../app/Views/home.php';
        require_once '../app/Views/layout.php';
    }
}
