<?php

namespace App\Controllers;
class HomeController extends BaseController
{
    public function index(): string
    {
        $this->response->setCache(['max-age' => 0, 's-maxage' => 0, 'private' => true]);
        $data['header']= view("headerView");
        $data['content']= 132;
        return view("templateView",$data);
    }
}
