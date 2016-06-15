<?php
App::import('Controller', 'Loves');
App::uses('AppController', 'Controller');

class CallsController extends AppController {

    var $components = array('Session', 'Cookie','RequestHandler');
	var $helpers=array('Js');
	var $uses = array('User','Listing');
	  
	/*** Ajax call functions starts *****/
	
    // Delete listing
	public function delete_listings() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $listids = $this->request->data['list_ids'];	
			$list_ids = array_filter($listids);
			
			foreach($list_ids as $key=>$val){

			$listdetail = $this->Listing->find('all',array('conditions'=>array('Listing.id'=>$val)));
            $query = $this->Listing->deleteAll(array('Listing.id' => $val), false);
         
				if($query == true)
		        { 
					
					$banner_image = $listdetail['0']['Listing']['banner_image'];
					if(!empty($banner_image))
			        {
				       $banner_file = WWW_ROOT.'files/banner_images/'.$banner_image;
					   unlink($banner_file);
			        }
				
					$restimages = $listdetail['0']['Listing']['rest_images'];
					if(!empty($restimages))
			        {
				       $rest_images = explode(",",$restimages);
					   foreach($rest_images as $key=>$val){
						   $rest_file = WWW_ROOT.'files/listing_images/'.$val;
						   unlink($rest_file);
			           }
			        }
				 $this->Session->setFlash('Listings deleted successfully','default', array(), 'good');						
				}  
				
			}
			
			die;
							
	   }
	 }
	}
	
	

 
}


