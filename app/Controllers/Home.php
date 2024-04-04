<?php

namespace App\Controllers;

class Home extends BaseController
{
    private function init(): string{
        echo 1;
    }

    public function index(): string
    {
        return view('main');
    }
}
