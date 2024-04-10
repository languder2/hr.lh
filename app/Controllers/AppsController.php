<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class AppsController extends BaseController
{
    protected array $data;
    public function list():string|RedirectResponse{
        if(!$this->model->hasAuth()) return redirect()->to(base_url(ADMIN));
        $this->data["title"]= "Control Panel: Polls";
        $this->data['menu4MainMenu']= $this->model->getMenu("admin");
        $this->data['mainMenu']= view("admin/mainMenu",$this->data);
        $this->data['header']= view("admin/header",$this->data);
        $this->data['footer']= view("admin/footer");
        if($this->session->has("message"))
            $this->data['message']= $this->session->getFlashdata("message");
        $results= $this->model->results();
        $data= [
            'results'=> $results,
            "order"=>"id desc",
        ];
        $this->data['polls']= $this->model->getAdminPollsView($data);
        return view("admin/PollsTemplate",$this->data);
    }
   public function test():bool|string{
        $this->model->checkClient("email","languder2@gmail.com");
        $this->model->checkClient("phone","+7 (990) 046-32-14");
       return false;
    }
}