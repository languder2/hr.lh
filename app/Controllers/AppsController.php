<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class AppsController extends BaseController
{
    public function list():string|RedirectResponse{
        if(!$this->model->hasAuth()) return redirect()->to(base_url(ADMIN));
        $data["title"]= "Control Panel: Заявки";
        $data['mainMenu']= view("admin/mainMenu",["menu4MainMenu"=>$this->model->getMenu("admin")]);
        if($this->session->has("message"))
            $data['message']= $this->session->getFlashdata("message");
        $data['polls']= $this->model->getPolls(false,false,true);
        $data['results']= $this->model->results();
        $params=[
            "order"=> "id desc",
        ];
        $data['apps']= $this->model->getApps($params);
        $data['appsTable']= view("admin/AppsTableView",$data);
        $data['content']= view("admin/AppsTemplate",$data);
        return view(ADMIN."/templateView",$data);
    }
   public function test():bool|string{
        $this->model->checkClient("email","languder2@gmail.com");
        $this->model->checkClient("phone","+7 (990) 046-32-14");
       return false;
    }
}