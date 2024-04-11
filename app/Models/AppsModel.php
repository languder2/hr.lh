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
            "poll_name"=>$poll->name,
            "answers"=>[],
            "results"=>[],
            "status"=>"new"
        ];
        foreach ($form->answers as $answer)
            $app->answers[]=(object)[
                "question"=> $poll->questions[$answer->qid]->question,
                "answer"=> $poll->questions[$answer->qid]->answers[$answer->aid]->answer
            ];
        foreach ($form->results as $result)
            if(is_object($result) && !empty($result->rid) && !empty($result->weight))
                $app->results[]= (object)[
                    "id"=>$result->rid,
                    "name"=>$results[$result->rid]->name,
                    "link"=>$results[$result->rid]->link,
                    "weight"=>$result->weight
                ];
        if(empty($app->results))
            $app->results[]= (object)[
                "id"=>$poll->result,
                "name"=>$results[$poll->result]->name,
                "link"=>$results[$poll->result]->link,
                "weight"=>1
            ];
        $app->answers= json_encode($app->answers);
        $app->results= json_encode($app->results);
        $this->db->table("apps")->insert($app);
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
    public function getApps($param= []):bool|array{
        if(empty($param['orders']))
            $param['orders']= ["time desc"];
        $results= [];
        $q= $this->db->table("apps");
        $q= $q->orderBy(implode(", ",$param['orders']))->get();
        foreach ($q->getResult() as $result) {
            $date= date_create($result->time);
            $result->day= date_format($date,"d-m-Y");
            $result->time= date_format($date,"H:i:s");
            $result->results= json_decode($result->results);
            $results[$result->day][]= $result;
        }
        return $results;
    }

}
