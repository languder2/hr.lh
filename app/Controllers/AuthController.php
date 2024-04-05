<?php

namespace App\Controllers;
use CodeIgniter\HTTP\RedirectResponse;

class AuthController extends BaseController
{
    private array $data;
    public function exit(): RedirectResponse
    {
        $this->model->exit();
        return redirect()->to(base_url(ADMIN));
    }

    public function auth(): string|RedirectResponse
    {
        if($this->model->hasAuth())
            return redirect()->to(base_url(ADMIN_MAIN_PAGE));
        $this->data["title"]= "Control Panel: Authentication";

        $this->data['header']= view("admin/header",$this->data);

        $this->data['footer']= view("admin/footer");
        if(is_array($this->request->getVar('authForm'))) {
            if(!$this->model->auth($this->request->getVar('authForm')))
                $this->data['ErrorMessage']= $this->session->getFlashdata("ErrorMessage");
            $this->data['form']= $this->request->getVar('authForm');
        }
        if($this->model->hasAuth())
            return redirect()->to(base_url(ADMIN_MAIN_PAGE));

        return view("admin/AuthTemplate",$this->data);
    }
}