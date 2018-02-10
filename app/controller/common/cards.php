<?php

class ControllerCommonCards extends Controller {

    public function topsites() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getTopSitesCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function topsitescategory() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getTopSitesCategoryCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function toplinks() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getTopsitesLinkCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function topapps() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getTopAppsCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function topappscategory() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getTopAppsCategoryCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function topappstrending() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getTopAppsTrendingCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function videotrending() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getTrendingVideoCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function video() {
        
        $result = $this->youtube->searchVideo("Top Trending Music Videos of 2015 (India)", "28.6000 , 77.2000");
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }
    
        public function videocategory() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getCategoryVideoCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function latestsong() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getLatestSongsCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function latestsongtrending() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getLatestTrendingSongsCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function latestsongcategory() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getLatestCaegorySongsCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function freegame() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getFreeGamesCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function freegametrending() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getFreeTrendingGamesCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function freegamecategory() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getFreeCategoryGamesCardData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function shops() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getShopping();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function shopstrending() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getShoppingTrending();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function shopscategory() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getShoppingCategory();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function utility() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getUtilityData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function utilitycategory() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getUtilityCategoryData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

    public function utilitymore() {

        $this->load->model('common/cards');
        $result = $this->model_common_cards->getUtilityMoreData();
        $data['data'] = $result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data));
    }

}
