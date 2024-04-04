<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class AuthModel extends Model{
    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        $this->session= \Config\Services::session();
    }
    public function hasAuth($session= false){
        if($session->get("adminAuthStatus")) return true;
        return false;
    }

    public function auth($authForm = false,$session= false){
        $user= $this->db->query("SELECT * FROM users WHERE login='".esc($authForm['login'])."'")->getFirstRow();
        if(empty($user)) {
            $session->setFlashdata(["ErrorMessage" => "login not found"]);
            return false;
        }
        if(!password_verify($authForm['password'],$user->password)){
            $session->setFlashdata(["ErrorMessage" => "invalid password"]);
            return false;
        }
        if(empty($user->status)){
            $session->setFlashdata(["ErrorMessage" => "User not active"]);
            return false;
        }
        $session->set([
           "adminAuthStatus"=>true,
           "adminAuthUID"=>$user->id,
           "adminAuthULogin"=>$user->login,
           "adminAuthUPerm"=>$user->perm,
        ]);
        return true;
    }
}
