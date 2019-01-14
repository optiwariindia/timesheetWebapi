<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of session
 *
 * @author Om Prakash Tiwari
 */
class session {
    private $sess=Array();
    public function __construct($sesskey="") {
        global $db;
        if($sesskey!=""){
            $db->mode(1);
            $usr=$db->select("session","*","where sesskey='{$sesskey}'");
            if(count($usr)){
                $this->sess=$usr[0];
            }else{
            }
        }else{
        }
    }
    public function getUser(){
        if($this->sess['userinfo']??''!=''){
            return $this->sess;
        }else{
            return "";
        }
    }
    public function setUser($user){
        global $db;
        date_default_timezone_set('Asia/Kolkata');
        $user['date'] = date('Y-m-d H:i:s', time());
        $sesskey=md5(json_encode($user));
        $db->insert("session",Array('sesskey'=>$sesskey,'userinfo'=>json_encode($user),"validupto"=>date('Y-m-d H:i:s',strtotime('+1 hour', time()))));
        return $sesskey;
    }
}
