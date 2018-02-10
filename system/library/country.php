<?php

/*
  This PHP class is free software: you can redistribute it and/or modify
  the code under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  However, the license header, copyright and author credits
  must not be modified in any form and always be displayed.

  This class is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  @author geoPlugin (gp_support@geoplugin.com)
  @copyright Copyright geoPlugin (gp_support@geoplugin.com)
  $version 1.01


  This PHP class uses the PHP Webservice of http://www.geoplugin.com/ to geolocate IP addresses

  Geographical location of the IP address (visitor) and locate currency (symbol, code and exchange rate) are returned.

  See http://www.geoplugin.com/webservices/php for more specific details of this free service

 */

class Country {

    //the geoPlugin server
    private $host;
    //the default base currency
    private $currency;
    //initiate the geoPlugin var
    private $ip;
    private $city;
    private $region;
    private $areaCode;
    private $dmaCode;
    private $countryCode;
    private $countryName;
    private $continentCode;
    private $latitude;
    private $longitude;
    private $currencyCode;
    private $currencySymbol;
    private $currencyConverter;

    public function __construct($registry) {

        $this->session = $registry->get('session');
        $this->host = 'http://www.geoplugin.net/php.gp?ip={IP}&base_currency={CURRENCY}';
        //the default base currency
        $this->currency = 'USD';
        //initiate the geoPlugin vars
        $this->ip = null;
        $this->city = null;
        $this->region = null;
        $this->areaCode = null;
        $this->dmaCode = null;
        $this->countryCode = null;
        $this->countryName = null;
        $this->continentCode = null;
        $this->latitude = null;
        $this->longitude = null;
        $this->currencyCode = null;
        $this->currencySymbol = null;
        $this->currencyConverter = null;
        $this->locate('106.215.162.16');
    }

    public function locate($ip = null) {

        global $_SERVER;

        if (is_null($ip)) {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
         }
        $host = str_replace('{IP}', $ip, $this->host);
        $host = str_replace('{CURRENCY}', $this->currency, $host);

        $data = array();

        $response = $this->fetch($host);

        $data = unserialize($response);
        //echo $response;
        //set the geoPlugin vars
        $this->ip = $ip;
        $this->city = $data['geoplugin_city'];
        $this->region = $data['geoplugin_region'];
        $this->areaCode = $data['geoplugin_areaCode'];
        $this->dmaCode = $data['geoplugin_dmaCode'];
        $this->countryCode = $data['geoplugin_countryCode'];
        $this->countryName = $data['geoplugin_countryName'];
        $this->continentCode = $data['geoplugin_continentCode'];
        $this->latitude = $data['geoplugin_latitude'];
        $this->longitude = $data['geoplugin_longitude'];
        $this->currencyCode = $data['geoplugin_currencyCode'];
        $this->currencySymbol = $data['geoplugin_currencySymbol'];
        $this->currencyConverter = $data['geoplugin_currencyConverter'];
       // var_dump($data);
    }

    private function fetch($host) {

        if (function_exists('curl_init')) {

            //use cURL to fetch data
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $host);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
            $response = curl_exec($ch);
            curl_close($ch);
        } else if (ini_get('allow_url_fopen')) {

            //fall back to fopen()
            $response = file_get_contents($host, 'r');
        } else {

            trigger_error('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
            return;
        }

        return $response;
    }

    public function convert($amount, $float = 2, $symbol = true) {

        //easily convert amounts to geolocated currency.
        if (!is_numeric($this->currencyConverter) || $this->currencyConverter == 0) {
            trigger_error('geoPlugin class Notice: currencyConverter has no value.', E_USER_NOTICE);
            return $amount;
        }
        if (!is_numeric($amount)) {
            trigger_error('geoPlugin class Warning: The amount passed to geoPlugin::convert is not numeric.', E_USER_WARNING);
            return $amount;
        }
        if ($symbol === true) {
            return $this->currencySymbol . round(($amount * $this->currencyConverter), $float);
        } else {
            return round(($amount * $this->currencyConverter), $float);
        }
    }

    public function nearby($radius = 10, $limit = null) {

        if (!is_numeric($this->latitude) || !is_numeric($this->longitude)) {
            trigger_error('geoPlugin class Warning: Incorrect latitude or longitude values.', E_USER_NOTICE);
            return array(array());
        }

        $host = "http://www.geoplugin.net/extras/nearby.gp?lat=" . $this->latitude . "&long=" . $this->longitude . "&radius={$radius}";

        if (is_numeric($limit))
            $host .= "&limit={$limit}";

        return unserialize($this->fetch($host));
    }

    public function getCurrencyConverter() {
        return $this->currencyConverter;
    }

    public function getCurrencySymbol() {
        return $this->currencySymbol;
    }

    public function getCurrencyCode() {
        return $this->currencyCode;
    }

    public function getLattitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function getCountryName() {
        return $this->countryName;
    }

    public function getIP() {
        return $this->ip;
    }

    public function getCity() {
        return $this->city;
    }

    public function getRegion() {
        return $this->region;
    }

    public function getAreaCode() {
        return $this->areaCode;
    }

    public function getDmaCode() {
        return $this->dmaCode;
    }

    public function getCountryCode() {
        return $this->countryCode;
    }

    public function getContinentCode() {
        return $this->continentCode;
    }

}
