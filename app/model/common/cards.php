<?php

class ModelCommonCards extends Model {

    public function getNewsCardData() {

        $result = $this->db->query("SELECT  title, url FROM " . DB_PREFIX . "manage_card_site WHERE cardid='1' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getTopSitesCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='2' AND type='fixed' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getTopSitesCategoryCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='2' AND type='category' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getTopAppsCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='3' AND status='1' AND type='variable' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getTopAppsCategoryCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='3' AND status='1' AND type='fixed' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getTopAppsTrendingCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='3' AND status='1' AND type='trending' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getTrendingVideoCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='4' AND type='trending' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }
    
        public function getCategoryVideoCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='4' AND type='category' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getLatestSongsCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='6' AND type='variable' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getLatestTrendingSongsCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='6' AND type='trending' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getLatestCaegorySongsCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='6' AND type='category' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getFreeGamesCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='7' AND  type='variable' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getFreeTrendingGamesCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='7' AND  type='trending' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getFreeCategoryGamesCardData() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='7' AND  type='category' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getShopping() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='9' AND  type='variable' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getShoppingTrending() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='9' AND  type='trending' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getShoppingCategory() {

        $result = $this->db->query("SELECT  title, url , image FROM " . DB_PREFIX . "manage_card_site WHERE cardid='9' AND  type='category' AND status='1' ");

        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getTopsitesLinkCardData() {

        $result = $this->db->query("SELECT  title, url  FROM " . DB_PREFIX . "manage_card_site WHERE cardid='13' AND status='1' ");
        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getUtilityData() {

        $result = $this->db->query("SELECT  title, image,url  FROM " . DB_PREFIX . "manage_card_site WHERE cardid='10' AND type='fixed' AND status='1' ");
        if ($result->num_rows) {
            return $result->rows;
        }
    }

    public function getUtilityCategoryData() {

        $result = $this->db->query("SELECT  title, url  FROM " . DB_PREFIX . "manage_card_site WHERE cardid='10' AND type='category' AND status='1' ");
        if ($result->num_rows) {
            return $result->rows;
        }
    }

        public function getUtilityMoreData() {

            $result = $this->db->query("SELECT  title, url  FROM " . DB_PREFIX . "manage_card_site WHERE cardid='10' AND type='more' AND status='1' ");
            if ($result->num_rows) {
                return $result->rows;
            }
        }

    }
    