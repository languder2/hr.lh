<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;
class GeneralModel extends AuthModel{
    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }
    public function getFlashdata($arg):array|object|string
    {
        return $this->session->getFlashdata($arg);
    }
    public function getMenu($section= "public",$parent= 0){
        $q= $this->db->table("menu")->where(["section"=>$section,"parent"=>$parent,"display"=>'1'])->orderBy("sort")->get();
        $results= [];
        foreach($q->getResult() as $record){
            $results[$record->id]= $record;
            $results[$record->id]->submenu= $this->getMenu($section,$parent= $record->id);

        }
        return $results;
    }
    public function getFormErrors($validator){
        $results= [];
        $errors= $validator->getErrors();
        if($errors){
            $results= array_diff($errors, ['required']);
            if(in_array("required",$errors))
                $results= $results+['required'=>"Заполните обязательные поля"];
        }
        return $results;
    }
    public function getStatuses($group= [],$sort= "sort asc"):array|object{
        $results= (object)[];
        $q= $this->db->table("statuses")->where($group)->orderBy($sort)->get();
        foreach ($q->getResult() as $record){
            if(!isset($results->{$record->grp})) $results->{$record->grp}= [];
            $results->{$record->grp}[$record->code]= $record;
        }
        return $results;
    }

}
