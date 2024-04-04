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
    public function addPoll($req= false){
        if(!is_array($req)) return false;
        echo "<pre>";
        print_r($req);

    }

}