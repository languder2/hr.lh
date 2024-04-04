<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\HubModel;

class PollsController extends BaseController
{
    public function __construct(){
        $this->model= model(HubModel::class);
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
        $this->data['polls']= $this->model->polls();
        $this->data['results']= $this->model->results();


        return view("admin/PollsTemplate",$this->data);
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
        $this->data['results']= $this->model->results(["status"=>"1"],["name"=>"asc"]);
        if($this->session->has("poll")){
            $this->data['poll']= $this->session->getFlashdata("poll");
            $this->data['validator']= $this->session->getFlashdata("validator");
            $this->data['errors'] = $this->model->getFormErrors($this->data['validator']);
        }
        elseif($op=="edit")
            $this->data['form']= $this->model->getResult($id);
        if($op=="edit" && empty($this->data['form']))
            return redirect()->to(base_url("/admin/results/"));
        return view("admin/PollsFormTemplate",$this->data);
    }

    public function processing(){
        $form= $this->request->getVar("form");
        $poll= $this->model->disassemblePollForm($form);
        $rules= [
            'form.pollname' => 'required',
        ];
        $messages= [
            'form.pollname'=>[
                "required"=>"required",
            ],
        ];
        $inputs = $this->validate($rules,$messages);
        if (!$inputs) {
            $this->session->setFlashdata("poll",$poll);
            $this->session->setFlashdata("validator",$this->validator);
            if($form['op']=="add")
                return redirect()->to(base_url("/admin/polls/add"));
            else
                return redirect()->to(base_url("/admin/polls/edit/".$poll->id));
            print_r($this->validator->getErrors());
            return false;
        }
        if($form['op']=="add") $this->model->addPoll($poll);
        return redirect()->to(base_url("/admin/polls/"));
    }

}