<?php

namespace App\Controllers;

class Home extends BaseController
{
    private array $data;

    public function index(): string
    {
        return view('main');
    }
    public function test():bool{
        return false;
    }
}
