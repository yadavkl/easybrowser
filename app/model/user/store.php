<?php

class ModelUserStore extends Controller {

    public function getStoreData() {

        $result = $this->db->query("SELECT  mss.id,mss.title, mss.site,mss.image,mss.detail, ms.category ,mss.status FROM " . DB_PREFIX . "manage_store_site mss "
                . "LEFT JOIN " . DB_PREFIX . "manage_store ms ON mss.categoryid=ms.id WHERE mss.status='1' ORDER BY ms.category ASC ");

        if ($result->num_rows > 0) {

            return $result->rows;
        }
        return "";
    }

    public function setUserSelectedList($list, $email) {

        $result = $this->db->query("UPDATE " . DB_PREFIX . "manage_user SET userlist='$list' WHERE email='$email'");
        if($result){
            return true;
        }
    }

    public function getUserSelectedList($email) {

        $result = $this->db->query("SELECT userlist FROM " . DB_PREFIX . "manage_user WHERE email='$email'");

        if ($result->num_rows > 0) {

            return unserialize($result->row['userlist']);
        }
        return [];
    }

    public function getDefaultList() {

        $result = $this->db->query("SELECT id FROM  " . DB_PREFIX . "manage_store_site GROUP BY  categoryid");
        $data = array();
        if ($result->num_rows > 0) {
            $index = 0;
            foreach ($result->rows as $item) {

                $data[$index++] = $item['id'];
            }
        }
        return $data;
    }

    public function getCategoryList() {

        $result = $this->db->query("SELECT category FROM  " . DB_PREFIX . "manage_store WHERE status='1' ");

        if ($result->num_rows > 0) {
            return $result->rows;
        }
    }
}
