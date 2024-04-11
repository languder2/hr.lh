<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        $data['header']= view("headerView");
        $data['content']= 132;
        return view("templateView",$data);
    }
}
