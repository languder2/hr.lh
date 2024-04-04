<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\HubModel;

class AuthController extends BaseController
{
    public function __construct(){
        $this->model= model(HubModel::class);
    }
    public function exit(){
        $this->session->destroy();
        return redirect()->to(base_url(ADMIN));
    }

    public function auth(){
        if($this->model->hasAuth($this->session))
            return redirect()->to(base_url(ADMIN_MAIN_PAGE));
        $this->data["title"]= "Control Panel: Authentication";

        $this->data['header']= view("admin/header",$this->data);

        $this->data['footer']= view("admin/footer");
        if(is_array($this->request->getVar('authForm'))) {
            if(!$this->model->auth($this->request->getVar('authForm'),$this->session))
                $this->data['ErrorMessage']= $this->session->getFlashdata("ErrorMessage");
            $this->data['form']= $this->request->getVar('authForm');
        }
        if($this->model->hasAuth($this->session))
            return redirect()->to(base_url(ADMIN_MAIN_PAGE));

        return view("admin/AuthTemplate",$this->data);
    }
}