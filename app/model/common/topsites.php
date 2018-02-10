<?php

class ModelCommonTopsites extends Model{
    
    public function getTopsitesStoreData(){
        
        $result = $this->db->query("SELECT title, category, url FROM ".DB_PREFIX."manage_card_store");
        if($result->num_rows){
            return $result->rows;
        }
    }
    
}
