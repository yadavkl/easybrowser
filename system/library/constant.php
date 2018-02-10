<?php

class Constant {

    public $PER_DAY_RECHARGE_LIMIT = 0;
    public $RECHARGE_API_URL = "";
    public $USERID = "";
    public $PASSWORD = "";
    public $ACCESSID = "";
    private $shareurl="";

    function __construct($registry) {

        $this->db = $registry->get('db');
        $this->country = $registry->get('country');
        
        $countrycode = $this->country->getCountryCode();
        //$countrycode = "IN";

        $result = $this->db->query("SELECT api,userid,password,accessid,rlimit FROM " . DB_PREFIX . "recharge_api WHERE countrycode='" . strtolower($countrycode) . "' LIMIT 1");

        if ($result->num_rows > 0) {
            
            $this->PER_DAY_RECHARGE_LIMIT = $result->row['rlimit'];
            $this->PRECHARGE_API_URL = $result->row['api'];
            $this->USERID = $result->row['userid'];
            $this->PASSWORD = $result->row['password'];
            $this->ACCESSID = $result->row['accessid'];
        }
    }
    
    public function setShareUrl($url){
        $this->shareurl=$url;
    }

    public function getShareUrl($url){
        return $this->shareurl;
    }    

}
