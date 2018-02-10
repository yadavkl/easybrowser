<?php

class ControllerWebstoreSites extends Controller {

    public function index() {

        if (isset($this->request->get['email'])) {
            $email = $this->request->get['email'];
        }
        $this->load->model("user/store");
        $userlist = $this->model_user_store->getUserSelectedList($email);
        $storelist = $this->model_user_store->getStoreData();
        $count = 0;
        foreach ($storelist as $item) {
            foreach ($userlist as $index) {
                if ($item['id'] == "$index")
                    $storelist[$count]['status'] = 0;
            }
            $count++;
        }
        $data['data'] = $storelist;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function categories() {

        $this->load->model("user/store");
        $catlist = $this->model_user_store->getCategoryList();
        $data['data'] = $catlist;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

}
