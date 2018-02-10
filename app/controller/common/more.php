<?php

class ControllerCommonMore extends Controller{
    
   private $cards = array(
       'news'=>'http://huntnews.in/p/index?cat=entertainment',
       'video'=>'https://www.youtube.com/',
       'apps'=>'http://www.9apps.com/',
       'jokes'=>'http://funtime.ucweb.com/',
       'games'=>'http://www.9game.com/',
       'songs'=>'http://music.uodoo.com/index',
       'utility'=>'http://one.ucweb.com/helpmate',       
   ); 
   
   public function index(){
        if( isset($this->request->get['card'])){            
            $this->response->redirect($this->cards[$this->request->get['card']]);
        }
    }
}

