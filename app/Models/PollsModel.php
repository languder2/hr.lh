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
                "weight"=> $answers['weight'][$key],
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
    public function addPoll($poll= false):bool{
        if(!is_object($poll)) return false;
        $sql= (object)[
            "name"=>$poll->name,
            "result"=>$poll->fixed,
            "status"=>'1',
        ];
        $this->db->table("polls")->insert($sql);
        $pid= $this->db->insertID();
        $si= 1;
        foreach ($poll->questions as $question){
            $sql= (object)[
                "poll"=>$pid,
                "question"=> $question->question,
                "answers"=> json_encode($question->answers),
                "status"=>"1",
                "sort"=>$si++,
            ];
            $this->db->table("questions")->insert($sql);
        }
        $this->session->setFlashdata("message",(object)["type"=>"success","class"=>"callout-success","message"=>"Опрос добавлен: #$pid, $poll->name"]);
        return true;
    }
    public function getQuestions($pid,$status= false){
        $results= [];
        $where= ["poll"=>$pid];
        if($status!== false) $where= ["status"=>$status];
        $q= $this->db->table("questions")->where($where)->get();
        foreach ($q->getResult() as $result){
            $result->answers= json_decode($result->answers);
            $results[$result->id]= $result;
        }
        return $results;
    }
    public function getPolls($where= [],$order= false):array{
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
            $results[$result->id]= $result;
        }
        return $results;
    }

    public function getAdminPollsView(array $data):string{
        $result= "";
        $data['where']['status']= '1';
        $data['polls']= $this->getPolls($data['where']??false,$data['order']??false);
        $result.= view("admin/PollsTableView",$data);
        $data['where']['status']= '0';
        $data['polls']= $this->getPolls($data['where']??false,$data['order']??false);
        $result.= view("admin/PollsTableView",$data);
        return $result;
    }

}
