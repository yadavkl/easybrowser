<?php

class ControllerUserStore extends Controller {

    public function index() {

        $this->load->model("user/store");
        $this->model_user_store->getStoreData();
    }

    public function storelist() {

        $this->load->model("user/store");
        $storelist = $this->model_user_store->getStoreData();
        $result['data'] = $storelist;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($result));
    }

    public function userstorelist() {

        $list = $this->userlist();

        $result['data'] = $list;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($result));
    }

    public function userselection() {

        if (isset($this->request->get['email'])) {
            $email = $this->request->get['email'];
        }
        $list = $this->userlist();

        $this->load->model("user/store");
        $storelist = $this->model_user_store->getStoreData();

        $data = array();

        foreach ($list as $index) {

            foreach ($storelist as $item) {

                if ($item['id'] == "$index")
                    $data[] = $item;
            }
        }

        $result['data'] = $data;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($result));
    }

    private function userlist() {

        if (isset($this->request->get['email'])) {
            $email = $this->request->get['email'];
        }
        $this->load->model('user/store');

        return $this->model_user_store->getUserSelectedList($email);
    }

    public function addtouserstore() {

        if (isset($this->request->get['id'])) {
            $siteid = $this->request->get['id'];
        }
        if (isset($this->request->get['email'])) {
            $email = $this->request->get['email'];
        }
        if ($siteid != "") {
            $list = $this->userlist();
            $key = array_search($siteid, $list);

            if ($siteid && isset($siteid) && !$key) {

                array_push($list, $siteid);
            }

            $this->load->model("user/store");
            $result = $this->model_user_store->setUserSelectedList(serialize($list), $email);
            if ($result) {
                $status = array('statusCode' => 200, 'id' => $siteid, 'email' => $email);
            } else {
                $status = array('statusCode' => 202, 'id' => $siteid, 'email' => $email);
            }
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($status));
        } else {
            $status = array('statusCode' => 201, 'id' => $siteid, 'email' => $email);
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($status));
        }
    }

    public function deleteitem() {

        if (isset($this->request->get['id'])) {
            $siteid = $this->request->get['id'];
        }
        if (isset($this->request->get['email'])) {
            $email = $this->request->get['email'];
        }

        if (isset($siteid) && $siteid != "") {
            $list = $this->userlist();
            $key = array_search($siteid, $list);
            unset($list[$key]);
            $this->load->model("user/store");
            $result = $this->model_user_store->setUserSelectedList(serialize($list), $email);
        }
    }

}
