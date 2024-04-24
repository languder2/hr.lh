<?php
namespace App\Controllers;
use CodeIgniter\HTTP\RedirectResponse;
class TestController extends BaseController
{
    public function test(){
        dd($_SERVER);
    }

}