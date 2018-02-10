<?php

class ModelLoginUser extends Model{
    
    public function isUserExist($email){
        
        $result = $this->db->query("SELECT  *  FROM ".DB_PREFIX."manage_user WHERE email='$email'");
        
        if($result->num_rows > 0){
            return true;
        }
        return false;
    }
    
    public function registerUser($email){
        
        $this->load->model("user/store");
        $list =$this->model_user_store->getDefaultList();

        $this->db->query("INSERT INTO ".DB_PREFIX."manage_user SET email='$email',userlist='".  serialize($list)." ' ");
    }
}
