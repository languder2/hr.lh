<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class AppsController extends BaseController
{
    public function saveResult():bool|string{
        $form= (object)$this->request->getVar("form");
        $this->model->addApp($form);
        return false;
    }
    public function list($modal= false):string|RedirectResponse{
        if(!$this->model->hasAuth()) return redirect()->to(base_url(ADMIN));
        $data["title"]= "Control Panel: Заявки";
        $data['mainMenu']= view("admin/mainMenu",["menu4MainMenu"=>$this->model->getMenu("admin")]);
        $data['filter']= $this->session->get("appsFilter");
        if(!isset($data['filter']['status']))
            $data['filter']['status']= "app-new";
        if($this->session->has("message"))
            $data['message']= $this->session->getFlashdata("message");
        $data['polls']= $this->model->getPolls(false,false,true);
        $data['results']= $this->model->results();
        $params=[
            "order"=> "id desc",
        ];
        $data['apps']= $this->model->getApps($params,$data['filter']);
        $data['statuses']= $this->model->getStatuses();
        $data['appsTable']= view("admin/AppsTableView",$data);
        $data['filterBox']= view("admin/AppsFilterView",$data);
        $data['content']= view("admin/AppsTemplate",$data);
        return $modal?$data['appsTable']:view(ADMIN."/templateView",$data);
    }
    public function test():bool|string{


        return false;
    }
    public function changeStatus():bool|string{
        $req= $this->request->getVar();
        $this->model->appsChangeStatus($req);
        return false;
    }
    public function setFilter():RedirectResponse{
        if(!$this->model->hasAuth()) return redirect()->to(base_url(ADMIN));
        $form= $this->request->getVar("filter");
        $this->session->set("appsFilter",$form);
        return redirect()->to(base_url(ADMIN."/apps/modal"));
    }
    public function detail($aid= false,$modal=false):string|RedirectResponse{
        if(!$this->model->hasAuth()) return redirect()->to(base_url(ADMIN));
        $data["title"]= "Control Panel: Заяка #$aid";
        $data['mainMenu']= view("admin/mainMenu",["menu4MainMenu"=>$this->model->getMenu("admin")]);
        $data['statuses']= $this->model->getStatuses();

        if($this->session->has("message"))
            $data['message']= $this->session->getFlashdata("message");
        $data['appD']= $this->model->getAppByID($aid);
        if(!$data['appD'])
            return redirect()->to(base_url(ADMIN_MAIN_PAGE));
//        $data['polls']= $this->model->getPolls(false,false,true);
//        $data['results']= $this->model->results();
        $data['appsTable']= view("admin/AppsTableView",$data);
        $data['content']= view("admin/AppDetailView",$data);
        return view(ADMIN."/templateView",$data);
    }
}