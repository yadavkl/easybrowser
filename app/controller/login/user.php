<?php

class ControllerLoginUser extends Controller {

    function index() {
        
        if (isset($this->request->get["email"])) {
            $email = $this->request->get["email"];
        }
        
        $this->load->model("login/user");
        
        if( !$this->model_login_user->isUserExist($email)){
            
            $this->model_login_user->registerUser($email);
        }
    }

}
