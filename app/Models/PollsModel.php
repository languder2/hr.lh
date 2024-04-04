<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class PollsModel extends ResultsModel {

    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }
    public function polls():array{
        return [];
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
        foreach ($poll->questions as $question){
            $sql= (object)[
                "poll"=>$pid,
                "question"=> $question->question,
                "answers"=> json_encode($question->answers),
                "status"=>"1",
            ];
            $this->db->table("questions")->insert($sql);
        }
        $this->session->setFlashdata("message",(object)["type"=>"success","class"=>"callout-success","message"=>"Опрос добавлен: #$pid, $poll->name"]);
        return true;
    }
}
