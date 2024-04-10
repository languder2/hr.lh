<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class PollsController extends BaseController
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
    public function form($op= "add",$id= false):string|RedirectResponse{
        if(!$this->model->hasAuth()) return redirect()->to(base_url(ADMIN));
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

    public function processing():string|RedirectResponse{
        if(!$this->model->hasAuth()) return redirect()->to(base_url(ADMIN));
        $form= $this->request->getVar("form");
        $poll= $this->model->disassemblePollForm($form);
        $rules= [
            'form.poll-name' => 'required',
            'form.fixed' => 'required',
        ];
        $messages= [
            'form.poll-name'=>[
                "required"=>"required",
            ],
            'form.fixed'=>[
                "required"=>"required",
            ],
        ];
        $inputs = $this->validate($rules,$messages);
        if (!$inputs) {
            $this->session->setFlashdata("poll",$poll);
            $this->session->setFlashdata("validator",$this->validator);
            if($form['op']=="add")
                return redirect()->to(base_url("/admin/polls/add"));
            if($form['op']=="edit")
                return redirect()->to(base_url("/admin/polls/edit/".$poll->id));
            return false;
        }
        if($form['op']=="add") $this->model->addPoll($poll);
        return redirect()->to(base_url("/admin/polls/"));
    }

    public function display($pid= false,$width=false,$hegiht=false):string{
        $this->data["title"]= "Опрос";
        $this->data['poll']= $this->model->getPoll($pid);
        if(!is_object($this->data['poll']))
            $this->data['content']= view("PollsDisplayErrors",$this->data+["message"=>"Неверный идентификатор опроса"]);
        elseif($this->data['poll']->status!=1)
            $this->data['content']= view("PollsDisplayErrors",$this->data+["message"=>"Опрос отключен"]);
        if(empty($this->data['content'])){
            $this->data['results']= $this->model->getResultByPoll($this->data['poll']);
            $this->data['content']= view("PollsDisplay",$this->data);
        }
        $this->data['width']= $width??"auto";
        $this->data['height']= $width??"auto";
        return view("templateView",$this->data);
    }
    public function saveResult():bool{
        $req= $this->request->getVar();
        print_r($req);
        return false;
    }
}