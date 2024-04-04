<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\HubModel;

class ResultsController extends BaseController
{
    public function __construct(){
        $this->session= \Config\Services::session();
        $this->model= model(HubModel::class);
        $this->data= [];
        helper(['form', 'url']);
    }
    public function exit(){
        $this->session->destroy();
        return redirect()->to(base_url("admin/"));
    }

    public function list(){
        if(!$this->model->hasAuth($this->session))
            return redirect()->to(base_url(ADMIN));
        $this->data["title"]= "Control Panel: Polls";
        $this->data['menu4MainMenu']= $this->model->getMenu("admin");
        $this->data['mainMenu']= view("admin/mainMenu",$this->data);
        $this->data['header']= view("admin/header",$this->data);
        $this->data['footer']= view("admin/footer");
        if($this->session->has("message"))
            $this->data['message']= $this->session->getFlashdata("message");
        $this->data['results']= $this->model->results();
        return view("admin/ResultsTemplate",$this->data);
    }

    public function form($op= "add",$id= false){
        if(!$this->model->hasAuth($this->session))
            return redirect()->to(base_url(ADMIN));
        $this->data["title"]= "Control Panel: Results";
        $this->data['menu4MainMenu']= $this->model->getMenu("admin");
        $this->data['mainMenu']= view("admin/mainMenu",$this->data);
        $this->data['header']= view("admin/header",$this->data);
        $this->data['footer']= view("admin/footer");
        $this->data['op']= $op;
        $this->data['id']= $id;
        if($this->session->has("form")){
            $this->data['form']= $this->session->getFlashdata("form");
            $this->data['validator']= $this->session->getFlashdata("validator");
            $this->data['errors'] = $this->model->getFormErrors($this->data['validator']);
        }
        elseif($op=="edit")
            $this->data['form']= $this->model->getResult($id);
        if($op=="edit" && empty($this->data['form']))
            return redirect()->to(base_url("/admin/results/"));
        return view("admin/ResultsFormTemplate",$this->data);
    }

    public function processing(){
        $form= (object)$this->request->getVar('form');
        if(!$this->model->hasAuth($this->session))
            return redirect()->to(base_url(ADMIN));
        $rules= [
            'form.name' => 'required|is_unique[results.name]',
            'form.link' => 'required|valid_url_strict',
            'form.description' => 'required',
        ];
        if($form->op=="edit") $rules['form.name']= "required|is_unique[results.name, id, ".$form->id."]";
        $messages= [
            'form.name'=>[
                "required"=>"required",
                "is_unique"=>"Результат с таким названием уже существует"
            ],
            'form.link'=>[
                "required"=>"required",
                "valid_url_strict"=>"Не верный формат ссылки",
            ],
            'form.description'=>[
                "required"=>"required",
            ],
        ];

        $inputs = $this->validate($rules,$messages);
        if (!$inputs) {
            $this->session->setFlashdata("form",$this->request->getVar('form'));
            $this->session->setFlashdata("validator",$this->validator);
            if($form->op=="add")
                return redirect()->to(base_url("/admin/results/add"));
            else
                return redirect()->to(base_url("/admin/results/edit/".$form->id));
        }
        if($form->op=="add") $this->model->addResult($form);
        if($form->op=="edit") $this->model->changeResult($form);
        return redirect()->to(base_url("/admin/results/"));
    }

    public function status(){
        $req= $this->request->getVar();
        $this->model->resultChangeStatus($req);
    }

    public function delete($id){
        $this->model->deleteResult($id);
        return redirect()->to(base_url("/admin/results/"));
    }

}