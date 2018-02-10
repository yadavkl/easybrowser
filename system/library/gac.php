<?php

class Gac {

    private $youtube;

    public function __construct() {
        $class = 'GCLIENT\\gclient';
        if (class_exists($class)) {
            $this->youtube = new $class();
        } else {
            exit('Error: Could not load database driver gac !');
        }
    }
    
    public function searchVideo($query, $location, $locationRadius="5km", $maxResults=12){
        return $this->youtube->searchVideo($query, $location, $locationRadius, $maxResults);
    }
}
