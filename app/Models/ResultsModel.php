<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class ResultsModel extends GeneralModel{
    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        $this->session= \Config\Services::session();
    }

    public function deleteResult($id= false){
        if(!empty($id)){
            $q= $this->db->table("results")->where(["id"=>$id])->get();
            if($q->getNumRows()>0){
                $rec= $q->getFirstRow();
                $this->db->table("results")->delete(["id"=>$id]);
                $this->session->setFlashdata("message",(object)["type"=>"success","class"=>"callout-success","message"=>"Результат удален: #$rec->id, $rec->name"]);
            }
        }
        return true;
    }
    public function addResult($form){
        $q= $this->db->table("results")->orderBy("sort","desc")->get();
        $rec= $q->getFirstRow();
        $sql= [
            "name"=> trim($form->name),
            "link"=> trim($form->link),
            "description"=> trim($form->description),
            "status"=> !empty($form->status)?1:0,
            "sort"=> ($rec->sort<$q->getNumRows())?$q->getNumRows()+1:$rec->sort+1,
        ];
        $this->db->table("results")->insert($sql);
        $this->session->setFlashdata("message",(object)["type"=>"success","class"=>"callout-success","message"=>"Результат добавлен: ".$form->name]);
        return true;
    }
    public function resultChangeStatus($req){
        $this->db->table("results")->where(['id'=>$req['id']])->update(["status"=>$req['status']]);
    }
    public function changeResult($form){
        $sql= [
            "name"=> trim($form->name),
            "link"=> trim($form->link),
            "description"=> trim($form->description),
            "status"=> !empty($form->status)?1:0,
        ];
        $this->db->table("results")->where(["id"=>$form->id])->update($sql);
        $this->session->setFlashdata("message",(object)["type"=>"success","class"=>"callout-success","message"=>"Результат изменен: ".$form->name]);
        return true;
    }

    public function results($setWhere= false,$setOrder= false){
        $results= [];
        $where= [];
        if($this->session->has("adminResultsWhere"))
                $where= $this->session->get("adminResultsWhere");
        if($setWhere)
            $where= $setWhere;
        $q= $this->db->table("results")->where($where);
        if($setOrder)
            foreach ($setOrder as $field=>$direction)
                $q= $q->orderBy($field,$direction);
        else
            $q= $q->orderBy("sort","desc")->orderBy("id","desc");
        $q= $q->get();
        foreach($q->getResult() as $result)
            $results[$result->id]= $result;
        return $results;
    }
    public function getResult($id= false){
        if($id== false) return false;
        $q= $this->db->table("results")->where(["id"=>$id])->get();
        if($q->getNumRows()==0) return false;
        return  $q->getFirstRow("array");
    }



}
