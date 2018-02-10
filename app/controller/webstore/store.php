<?php

class ControllerWebstoreStore extends Controller {

    public function index() {
        
        $data['email']="";
        if (isset($this->request->get['email'])) {
            $data['email'] = $this->request->get['email'];
        }
        $this->response->setOutput($this->load->view('webstore/store.tpl', $data));    
        
    }

}
