<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class NotificationsModel extends AppsModel
{

    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }

    public function getNotificationForm():string{
        $data= [];
        return  view("admin/Notifications/Form-View",$data);
    }
    public function getNotificationsByApp($appID= false):string{
        $q= $this->db->table("notifications");
        if($appID) $q->where("appID",$appID);
        $q= $q->get();
        if($q->getNumRows()){
            $view= view("admin/Notifications/List-View",['list'=> $q->getResult()]);
        }
        $data['form']= $this->getNotificationForm();
        return $view;
    }

}
