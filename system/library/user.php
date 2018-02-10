<?php

class User {

    private $userid;
    private $deviceid;
    private $email;
    private $uuid;
 

    public function __construct($registry) {


        $this->db = $registry->get('db');
        $this->session = $registry->get('session');
        $this->country = $registry->get('country');
        
       $countrycode = $this->country->getCountryCode();      
       $this->session->data['userid'];
        if ( isset($this->session->data['userid'] ) ) {

            $result = $this->db->query("SELECT * FROM " . DB_PREFIX . strtolower($countrycode) . "_user WHERE userid='" . $this->session->data['userid'] . "' ");
            
            if ($result->num_rows > 0) {
                $this->email = $result->row['email'];
                $this->deviceid = $result->row['deviceid'];
                $this->uuid = $result->row['uuid'];
                $this->userid = $result->row['userid'];
            }
        } else {
            $this->logout();
        }
    }

    public function login($email, $deviceid) {
        
        $this->logout();  //<Logout if already login
        $countrycode = $this->country->getCountryCode(); 
        
        $result = $this->db->query("SELECT * FROM " . DB_PREFIX . strtolower($countrycode) . "_user WHERE email='$email' ");
        
        if ($result->num_rows > 0) {
            
            $this->email = $result->row['email'];
            $this->deviceid = $result->row['deviceid'];
            $this->userid = $result->row['userid'];
            $this->session->data['userid'] = $result->row['userid'];
            $this->uuid = $result->row['uuid'];
        }
    }

    public function registerUser($email, $deviceid) {

        $countrycode = $this->country->getCountryCode();
        $earr = explode("@", $email);
        $uuid = $earr[0] . $deviceid;
        $this->db->query("INSERT INTO " . DB_PREFIX . strtolower($countrycode) . "_user SET uuid='$uuid',email='$email',deviceid='$deviceid',regdate='" . date("Y-m-d") . "'");
        //<Create account table
        $userid = $this->db->getLastId();
        $this->db->query("INSERT INTO mogo_in_user_account SET userid = '$userid'");
    }

    public function getUuId() {
        return $this->uuid;
    }

    public function getUserId() {
        return $this->userid;
    }

    public function isUserExist() {
        return $this->userid;
    }

    public function isLogged() {
        return $this->userid;
    }

    public function logout() {
        if (isset($this->session->data['userid'])) {
            unset($this->session->data['userid']);
        }
        $deviceid = "";
        $email = "";
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDeviceId() {
        return $this->deviceid;
    }

}
