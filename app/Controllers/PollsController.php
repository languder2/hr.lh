<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class PollsController extends BaseController
{
    public function list():string|RedirectResponse{
        if(!$this->model->hasAuth()) return redirect()->to(base_url(ADMIN));
        $data['includes']=(object)[
            'js'=>[
                "js/admin/polls.js",
            ],
        ];
        $data["title"]= "Control Panel: Polls";
        $data['menu4MainMenu']= $this->model->getMenu("admin");
        $data['mainMenu']= view("admin/mainMenu",$data);
        if($this->session->has("message"))
            $data['message']= $this->session->getFlashdata("message");
        $results= $this->model->results();
        $dataPolls= [
            'results'=> $results,
            "order"=>"id desc",
        ];
        $data['polls']= $this->model->getAdminPollsView($dataPolls);
        $data['pageContent']= view("admin/Polls/Template",$data);
        return view(ADMIN."/templateView",$data);
    }
    public function form($op= "add",$id= false,$modal= false):string|RedirectResponse{
        if(!$this->model->hasAuth()) return redirect()->to(base_url(ADMIN));
        $data["title"]= "Control Panel: Results";
        $data['menu4MainMenu']= $this->model->getMenu("admin");
        $data['mainMenu']= view("admin/mainMenu",$data);
        $data['op']= $op;
        $data['id']= $id;
        $data['results']= $this->model->results(["status"=>"1"],["name"=>"asc"]);
        if($this->session->has("poll")){
                $data['poll']= $this->session->getFlashdata("poll");
            $data['validator']= $this->session->getFlashdata("validator");
            $data['errors'] = $this->model->getFormErrors($data['validator']);
        }
        elseif($op=="edit"){
            $data['poll']= $this->model->getPoll($id,true);
            $data['poll']->fixed= $data['poll']->result;
        }
        if($op=="edit" && empty($data['poll']))
            return redirect()->to(base_url("/admin/polls/"));
        $data['pageContent']=  view("admin/Polls/FormTemplate",$data);
        echo $modal;
        return $modal?$data['pageContent']:view("admin/templateView",$data);
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
                return redirect()->to(base_url("/admin/poll/edit/".$poll->id));
            return false;
        }
        if($form['op']=="add") $this->model->changePoll($poll);
        if($form['op']=="edit") $this->model->changePoll($poll);
        return redirect()->to(base_url("/admin/polls/"));
    }
    public function display($pid= false,$width=false,$hegiht=false):string{
        $data["title"]= "Опрос";
        if($pid === false)
            $pid= $this->model->getActivePoll();
        $data['poll']= $this->model->getPoll($pid);
        $data['width']= $width??"100%";
        $data['height']= $hegiht??400;
        if(!is_object($data['poll']))
            $data['content']= view("PollsDisplayErrors",$data+["message"=>"Неверный идентификатор опроса"]);
        elseif($data['poll']->status!=1)
            $data['content']= view("PollsDisplayErrors",$data+["message"=>"Опрос отключен"]);
        if(empty($data['content'])){
            $data['results']= $this->model->getResultByPoll($data['poll']);
            $data['content']= view("PollsDisplay",$data);
        }
        return view("templateView",$data);
    }
    public function remove($pid){
        $this->model->removePoll($pid);
        $this->model->removeQuestions(false,$pid);
    }

    public function changeStatus():string|bool{
        if(!$this->model->hasAuth()) return false;
        $req= $this->request->getVar();
        $this->model->changePollStatus($req->pid);
        return true;
    }

}