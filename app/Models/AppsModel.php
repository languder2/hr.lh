<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class AppsModel extends PollsModel {

    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }

    public function addApp($form):bool{
        $form->answers= json_decode($form->answers);
        $form->results= json_decode($form->results);
        $poll= $this->getPoll($form->pid,true);
        $results= $this->getResultByPoll($poll);
        $app= (object)[
            "name"=>$form->name,
            "phone"=>$form->phone,
            "email"=>$form->email,
            "poll_id"=>$form->pid,
        ];
        $this->db->table("apps")->insert($app);
        $appDetail= (object)[
            "appID"=>$this->db->insertID(),
            "poll"=>(object)[
                "poll_id"=>$form->pid,
                "poll_name"=>$poll->name,
                "answers"=>[],
                "results"=>[],
            ],
        ];
        foreach ($form->answers as $answer)
            $appDetail->poll->answers[]=(object)[
                "question"=> $poll->questions[$answer->qid]->question,
                "answer"=> $poll->questions[$answer->qid]->answers[$answer->aid]->answer
            ];
        foreach ($form->results as $result)
            if(is_object($result) && !empty($result->rid) && !empty($result->weight))
                $appDetail->poll->results[]= (object)[
                    "id"=>$result->rid,
                    "name"=>$results[$result->rid]->name,
                    "link"=>$results[$result->rid]->link,
                    "weight"=>$result->weight
                ];
        if(empty($appDetail->results))
            $appDetail->poll->results[]= (object)[
                "id"=>$poll->result,
                "name"=>$results[$poll->result]->name,
                "link"=>$results[$poll->result]->link,
                "weight"=>1
            ];
        $appDetail->poll= json_encode($appDetail->poll);
        $this->db->table("apps_detail")->insert($appDetail);
        $this->checkClient("email",$app->email);
        $this->checkClient("phone",$app->phone);
        return false;
    }
    public function checkClient($type= false,$contact= false):bool{
        if($type === false || $contact === false) return false;
        $cnt= $this->db->table("apps")->where([$type=>$contact])->get()->getNumRows();
        $sql= [
            "type"=> $type,
            "contact"=> $contact,
            "count"=>$cnt
        ];
        $q= $this->db->table("clients")->where(["type"=>$type,"contact"=>$contact])->get();
        if($q->getNumRows()==0)
            $this->db->table("clients")->insert($sql);
        else
            $this->db->table("clients")->where("id",$q->getFirstRow()->id)->update($sql);
      return  false;
    }
    public function getApps($param= [],$filter= []):bool|array{
        if(empty($param['orders']))
            $param['orders']= ["date desc"];
        $results= [];
        $q= $this->db->table("apps");
        if(!empty($filter)) {
            if($filter['status'] === "all")
                unset($filter['status']);
            $q= $q->like($filter);
        }
        $q= $q->orderBy(implode(", ",$param['orders']))->get();
        foreach ($q->getResult() as $result) {
            $date= date_create($result->date);
            $result->day= date_format($date,"d-m-Y");
            $result->time= date_format($date,"H:i:s");
            $results[$result->day][]= $result;
        }
        return $results;
    }
    public function appsChangeStatus($req):bool{
        $this->db->table("apps")->update(["status"=>$req['status']],["id"=>$req['id']]);
        $this->db->error()['message'];
        return false;
    }
    public function getAppByID($id):object|bool{
        if(!$id) return false;
        $q= $this->db->table("apps")->where("id",$id)
            ->join("apps_detail","apps.id=apps_detail.appID","left")
            ->get();
        if(!$q->getNumRows())  return false;
        $result= $q->getFirstRow();
        $date= date_create($result->date);
        $result->day= date_format($date,"d-m-Y");
        $result->time= date_format($date,"H:i:s");
        $result->poll= json_decode($result->poll);
        $result->comments= json_decode($result->comments);
        return $result;
    }

    public function addComment2App($form):bool{
        $q= $this->db->table("apps_detail")->where("appID",$form['appID'])->get();
        if(!$q->getNumrows()) return false;
        $app= $q->getFirstRow();
        if(!empty($app->comments)){
            $comments= json_decode($app->comments);
        }
        $comments[]= (object)[
            "dt"=>date("d-m-Y H:i:s"),
            "comment"=>$form['comment']
        ];
        $comments= json_encode($comments);
        $this->db->table("apps_detail")->update(["comments"=>$comments],["appID"=>$form['appID']]);
        return true;
    }

}
