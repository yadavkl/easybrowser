<?php

class ControllerNewsFeeds extends Controller{
    
    function index(){
        
        $url = "https://ajax.googleapis.com/ajax/services/search/news?ned=in&rsz=8&topic=h&v=1.0";  
	        $emparray[] = array();
		$json = file_get_contents($url);
		$data_el = json_decode($json,true);   
	        $count=$data_el['responseData']['results'];
	        $size = count($count);
	            
	        for($i=0;$i<$size;$i++){
	
	            $result[]=array(
                        
	                'title'=>$data_el['responseData']['results'][$i]['title'],
	                'titleNoFormatting'=>$data_el['responseData']['results'][$i]['titleNoFormatting'],
	                'clusterUrl'=>$data_el['responseData']['results'][$i]['clusterUrl'],
	                'content'=>$data_el['responseData']['results'][$i]['content'],
	                'unescapedUrl'=>$data_el['responseData']['results'][$i]['unescapedUrl'],
	                'image'=>(isset($data_el['responseData']['results'][$i]['image']['url'])) ? $data_el['responseData']['results'][$i]['image']['url'] :""
	              ); 
	        }
                            $final['data'] =$result; 
                            $this->response->addHeader('Content-Type: application/json');
	        $this->response->setOutput((json_encode($final)));                
    }
    
    public function headlines(){
        
        $this->load->model("common/cards");
        $result=$this->model_common_cards->getNewsCardData();
        $data['data']=$result;
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($data)); 
    }
    
}

