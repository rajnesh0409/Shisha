<?php
App::import('Controller', 'Loves');
App::uses('AppController', 'Controller');

class CallsController extends AppController {

    var $components = array('Session', 'Cookie','RequestHandler');
	var $helpers=array('Js');
	var $uses = array('User','Listing','Event');
	  
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
	
	//edit listing
	public function edit_listing() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
	      $dataval = $this->request->data['dataval'];	
		  $fieldname = $this->request->data['fieldname'];
		  $listid = $this->request->data['listid'];
		  $this->Listing->updateAll(array($fieldname => "'$dataval'"),array('id' => $listid));
		  die('success');
       }
	 }
    exit;
	}	
	
	  // Delete listing
	public function delete_event() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $eventid = $this->request->data['eventid'];	
			$eventdetail = $this->Event->find('all',array('conditions'=>array('Event.id'=>$eventid)));
            $query = $this->Event->deleteAll(array('Event.id' => $eventid), false);
         
				if($query == true)
		        { 
					
					$event_image = $eventdetail['0']['Event']['event_images'];
					if(!empty($event_image))
			        {
					   $eventimage = explode(",",$event_image);
					   foreach($eventimage as $key=>$val){
						   $event_file = WWW_ROOT.'files/event_images/'.$event_image;
					       unlink($event_file);
			           }
			        }

				 $this->Session->setFlash('Event deleted successfully','default', array(), 'good');						
				
				}  
				
			}
			
			die;
							
	   }
	 }
	 
	 // edit event
	 public function edit_event() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
	      $dataval = $this->request->data['dataval'];	
		  $fieldname = $this->request->data['fieldname'];
		  $listid = $this->request->data['listid'];
		  $this->Event->updateAll(array($fieldname => "'$dataval'"),array('id' => $listid));
		  die('success');
       }
	 }
    exit;
	}
	
	// change listing status
	public function listing_status() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
	      $status = $this->request->data['status'];	
		  $listid = $this->request->data['listid'];
		  $this->Listing->updateAll(array('status' => "'$status'"),array('id' => $listid));
		  die('success');
       }
	 }
    exit;
	}
	
	// change event status
	public function event_status() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
	      $status = $this->request->data['status'];	
		  $eventid = $this->request->data['eventid'];
		  $this->Event->updateAll(array('status' => "'$status'"),array('id' => $eventid));
		  die('success');
       }
	 }
    exit;
	}

 
}


