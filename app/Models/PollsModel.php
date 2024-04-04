<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class PollsModel extends ResultsModel {
    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        $this->session= \Config\Services::session();
    }
    public function polls(){
        return [];
    }
    public function addPoll($poll= false){
        if(!is_object($poll)) return false;
        echo "<pre>";
        print_r($poll);
    }

    public function disassemblePollAnswers($answers){
        $results= [];
        $sort= $answers['sort'];
        $max= (int)max($sort);
        foreach ($sort as $key=>$value){
            if(empty($value)) $max++;
            $sort[$key]= empty($value)?$max:(int)$value;
        }
        asort($sort);
        $sort= array_flip($sort);
        $ns= 1;
        foreach ($sort as $key) {
            $results[$key]=(object)[
                "answer"=> $answers['answer'][$key],
                "sort"=> $ns++,
                "result"=> $answers['result'][$key],
                "weight"=> $answers['weight'][$key],
            ];
        }
        return $results;
    }
    public function disassemblePollForm($form){
        if(!is_array($form)) return false;
        $poll=(object)[
            "id"=>(int)$form['id'],
            "name"=>trim($form['pollname']),
            "fixed"=>empty($form['fixed'])?0:1,
            "questions"=> $form['questions']
        ];
        echo "<pre>";
        foreach ($poll->questions as $qid=>$question){
            $poll->questions[$qid]= (object)$question;
            $poll->questions[$qid]->answers= $this->disassemblePollAnswers($question['answers']);
        }
        return $poll;
    }
}
