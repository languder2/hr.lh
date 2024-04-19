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
        $data['includes']=(object)[
            'js'=>[
                "js/admin/apps.js",
            ],
            'css'=>[],
        ];
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
        $data['pageContent']= view("admin/AppsTemplate",$data);
        return $modal?$data['appsTable']:view(ADMIN."/templateView",$data);
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
        $data['includes']=(object)[
            'js'=>[
                "js/admin/appDetail.js",
            ],
            'css'=>[],
        ];
        if(!$modal){
            $data["title"]= "Control Panel: Заяка #$aid";
            $data['mainMenu']= view("admin/mainMenu",["menu4MainMenu"=>$this->model->getMenu("admin")]);
        }
        $data['statuses']= $this->model->getStatuses();
        if($this->session->has("message"))
            $data['message']= $this->session->getFlashdata("message");
        $data['appDetail']= $this->model->getAppByID($aid);
        if(!$data['appDetail'])
            return redirect()->to(base_url(ADMIN_MAIN_PAGE));
        $data['appDetail']->tabComments= view(ADMIN."/AppDetail/tabCommentsView",$data);
        $data['appDetail']->tabPresonal= view(ADMIN."/AppDetail/tabPersonalView",$data);
        $data['pageContent']= view("admin/AppDetail/templateView",$data);

        return $modal?$data['pageContent']:view(ADMIN."/templateView",$data);
    }
    public function addComment():string|RedirectResponse{
        if(!$this->model->hasAuth()) return redirect()->to(base_url(ADMIN));
        $req= $this->request->getVar('form');
        $this->model->addComment2App($req);
        $data['appDetail']= $this->model->getAppByID($req['appID']);
        return $data['appDetail']->tabComments= view(ADMIN."/AppDetail/tabCommentsView",$data);
    }
    public function removeComment($appID,$key):string|RedirectResponse{
        if(!$this->model->hasAuth()) return redirect()->to(base_url(ADMIN));
        $this->model->removeCommentByApp($appID,$key);
        $data['appDetail']= $this->model->getAppByID($appID);
        return $data['appDetail']->tabComments= view(ADMIN."/AppDetail/tabCommentsView",$data);
    }

}