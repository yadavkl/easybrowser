<?php

class ControllerCommonTopsites extends Controller{
  
    function index(){
        
        $this->load->model("common/topsites");
        $result = $this->model_common_topsites->getTopsitesStoreData();
        $data['data']=$result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));        
    }
    
}
