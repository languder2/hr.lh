<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class PollsModel extends ResultsModel {

    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }
    public function disassemblePollAnswers($answers):array{
        $results= [];
        $sort= [];
        $max= (int)max($answers['sort']);
        foreach ($answers['sort'] as $value){
            if(empty($value)) $max++;
            $sort[]= empty($value)?$max:(int)$value;
        }
        asort($sort);
        $sort= array_keys($sort);
        $ns= 1;
        foreach ($sort as $key) {
            if(empty($answers['answer'][$key]))continue;
            $results[$key]=(object)[
                "answer"=> $answers['answer'][$key],
                "sort"=> $ns++,
                "result"=> $answers['result'][$key],
                "weight"=> $answers['weight'][$key] ?? 0,
                "status"=> $answers['status'][$key] ?? 1,
            ];
        }
        return $results;
    }
    public function disassemblePollForm($form):object|bool{
        if(!is_array($form)) return false;
        $poll=(object)[
            "id"=>(int)$form['id'],
            "name"=>trim($form['poll-name']),
            "maxQID"=> "n".((int)str_replace("n","",max(array_keys ($form['questions'])))+1),
            "fixed"=>empty($form['fixed'])?0:$form['fixed'],
            "questions"=> $form['questions']
        ];
        foreach ($poll->questions as $qid=>$question){
            $poll->questions[$qid]= (object)$question;
            $poll->questions[$qid]->answers= empty($question['answers'])?[]:$this->disassemblePollAnswers($question['answers']);
        }
        return $poll;
    }
    public function changePoll($poll= false):bool{
        if(!is_object($poll)) return false;
        $sql= (object)[
            "name"=>$poll->name,
            "result"=>$poll->fixed,
        ];
        if(!$poll->id)
            $this->db->table("polls")->insert($sql);
        else
            $this->db->table("polls")->update($sql,["id"=>$poll->id]);
        $pid= empty($poll->id)?$this->db->insertID():$poll->id;
        $si= 1;
        foreach ($poll->questions as $qid=>$question){
            $sql= (object)[
                "poll"=>$pid,
                "question"=> $question->question,
                "answers"=> json_encode($question->answers),
                "status"=>"0",
                "sort"=>$si++,
            ];
            if($question->type=== "isset")
                $this->db->table("questions")->update($sql,["id"=>$qid]);
            else
                $this->db->table("questions")->insert($sql);
        }
        $this->session->setFlashdata(
            "message",
            (object)[
                "type"=>"success",
                "class"=>"callout-success",
                "message"=>"Опрос ".($poll->id?"сохранен":"добавлен").": #$pid, $poll->name"
            ]
        );
        $this->checkPoll($pid);
        return true;
    }
    public function getQuestions($pid=false,$status= false,$pkey= false):array|bool{
        $results= [];
        $where= ["poll"=>$pid];
        if($status!== false) $where= ["status"=>$status];
        $q= $this->db->table("questions")->where($where)->get();
        foreach ($q->getResult() as $result){
            $result->answers= json_decode($result->answers);
            if($pkey)
                $results[$result->id]= $result;
            else
                $results[]= $result;
        }
        return $results;
    }
    public function getPolls($where= [],$order= false,$pkey= false):array{
        $results= [];
        if(empty($where) && $this->session->has("adminResultsWhere"))
            $where= $this->session->get("adminResultsWhere");
        if(!is_array($where)) $where= [];
        if(empty($order))
            $order= [
                "id desc",
            ];
        $q= $this->db->table("polls")->where($where)->orderBy(is_array($order)?implode(", ",$order):$order)->get();
        foreach ($q->getResult() as $result){
            $result->questions= $this->getQuestions($result->id);
            if($pkey)
                $results[$result->id]= $result;
            else
                $results[]= $result;
        }
        return $results;
    }

    public function getAdminPollsView(array $data):string{
        $result= "";
        $data['where']['status']= '1';
        $data['caption']= 'Активные';
        $data['polls']= $this->getPolls($data['where']??false,$data['order']??false);
        $result.= view("admin/Polls/TableView",$data);

        $data['where']['status']= '0';
        $data['caption']= 'Не активные';
        $data['polls']= $this->getPolls($data['where']??false,$data['order']??false);
        $result.= view("admin/Polls/TableView",$data);
        return $result;
    }

    public function getPoll($pid=false,$pkey= false):bool|object{
        $q= $this->db->table("polls");
        if(empty($pid))
            $q= $q->where("status","1")->orderBy("RAND()")->get();
        else
            $q= $q->where("id",$pid)->get();
        if($q->getNumRows()==0) return false;
        $poll= $q->getFirstRow();
        $poll->questions= $this->getQuestions($poll->id,false,$pkey);
        return $poll;
    }
    public function checkPoll($pid):bool{
        $q= $this->db->table("polls")->where("id",$pid)->get();
        if($q->getNumRows() === 0) return false;
        $this->db->table("questions")->delete("poll=$pid and answers like '[]'");
        $q= $this->db->table("questions")->where("poll",$pid)->get();
        if(!$q->getNumRows()){
            $this->db->table("polls")->update(["status"=>0],["id"=>$pid]);
            return true;
        }
        return true;
    }
    public function removePoll($pid):bool{
        $this->db->table("polls")->delete(["id"=>$pid]);
        return true;
    }
    public function removeQuestions($qid= false,$pid= false):bool{
        $q= $this->db->table("questions");
        if($qid)
            $q->delete(["id"=>$qid]);
        if($pid)
            $q->delete(["poll"=>$pid]);
        return  true;
    }
    public function changePollStatus($pid= false):bool{
        if(!$pid) return false;
        $this->db->table("polls")->update(["status"=>"0"],"id!=$pid");
        $q= $this->db->table("polls")->where("id",$pid)->get();
        if(!$q->getNumRows()) return false;
        $poll= $q->getFirstRow();
        $this->db->table("polls")->update(["status"=>$poll->status?"0":"1"],["id"=>$pid]);
        return true;
    }
    public function getActivePoll():int|bool{
        $q= $this->db->table("polls")->where("status","1")->get();
        if($q->getNumRows()) return $q->getFirstRow()->id;
        return false;
    }
}
