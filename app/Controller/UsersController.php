<?php


App::uses('AppController', 'Controller');

class UsersController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	var $components = array('Security','Email','Session', 'Cookie','RequestHandler','Auth');
	var $helpers=array('Js');
	var $uses = array('User','Listing','Event','Country');
	  
	/*** security related functions *****/
	
	function beforeFilter()
    {
       $this->Auth->allow('deny','logout');
	   $this->Security->blackHoleCallback = 'blackhole';
	   $this->Security->unlockedActions = 'login';
	   $user = $this->Session->read('user');
       if(!empty($user)) { 
       $this->Auth->allow('index','login','listing','listing_detail','events','event_detail','list_event_detail','event_images','listing_images');
	   }
	
	}
	
    public function blackhole($type) {
	  if($type == 'get' || $type == 'csrf' || $type == 'post' || $type == 'put' || $type == 'delete' || $type == 'secure')
	   {
		  $this->redirect('/deny');  
	   }
	}
	
	public function deny()
	{
      $this->layout = 'error';
    }

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
   
    // Dashboard
	public function index() {
	
	Configure::write('debug',0);	
	$this->set('title','dashboard');
	
	}
	
	// login page
	public function login() {
		Configure::write('debug',0);
		$this->layout = 'login';

				   if($this->request->data) {
			        $username = $this->request->data['username'];
					$password = AuthComponent::password( $this->request->data['password']);
					$user = $this->User->find('first', array('conditions' => array('User.username' =>$username,'User.password' => $password)));
                    if(!empty($user)){
						$this->Session->write('user',$user);
						$this->Session->setFlash('Admin logged in successfully','default', array(), 'good');
						$this->redirect('/dashboard');
					}
					else
					{
					  $this->Session->setFlash('Your username or password is not correct', 'default', array(), 'bad');
					}
                  }
                  else
                  {
					   $user = $this->Session->read('user');
					   if(!empty($user)) { 
					   $this->redirect('/dashboard');
					   }
				  }					  

	}
	
	// admin logout
	function logout()
    {
        $this->Session->delete('user');
	    $this->Session->destroy();
	    $this->redirect('/');
	}
	
	// Add listing page
	function listing()
    {
        Configure::write('debug',0);
		$this->set('title','listing');

		$countries = Hash::extract($this->Country->find('all'), '{n}.Country.country_name');
		$this->set('countries',$countries);
		
		          if($this->request->data) {
	              unset($this->request->data['_Token']);	
				  
				  if(array_key_exists('banner_image', $this->request->form))
	                      {
	                         $img_name = $this->request->form['banner_image']['name'];
							 
							 if(!empty($img_name)) {
								 
						     $ext = strrchr($img_name, ".");
						     $type = $this->request->form['banner_image']['type'];
							 $tmp_name = $this->request->form['banner_image']['tmp_name'];
							 $error =  $this->request->form['banner_image']['error'];
							 $size = $this->request->form['banner_image']['size'];
							
							$uid = uniqid();
							$img_name = $uid."_".$img_name;
							$this->request->data['banner_image'] = $img_name;
							$uploads_dir = WWW_ROOT.'files/banner_images/'.$img_name;
							
							if ($error == 0 && $size <= 16000000 && $ext != '.exe') {
							move_uploaded_file($tmp_name,$uploads_dir);  }
	                      } }
				  
				  if(array_key_exists('rest_images', $this->request->form))
	                      {
	                         $makeit = $this->request->form['rest_images']['name'];
							 $test = $this->request->form['rest_images']['name']['0'];

							 $count = sizeof($makeit);
							 $max = $count-1;
						
							 if(!empty($test)) {
								     
									 	//die('dfgdfgdf');
									 for($i = 0; $i<$max; $i++)
									 {
										 $img_name = $this->request->form['rest_images']['name'][$i];
										 $ext = strrchr($img_name, ".");
										 $type = $this->request->form['rest_images']['type'][$i];
										 $tmp_name = $this->request->form['rest_images']['tmp_name'][$i];
										 $error =  $this->request->form['rest_images']['error'][$i];
										 $size = $this->request->form['rest_images']['size'][$i];
										
										$uid = uniqid();
										$img_name = $uid."_".$img_name;
										
										if(empty($rimages))
										{
											$rimages = $img_name;
										}
									   else
									   {
										   $rimages = $rimages.','.$img_name;
									   }							   
										
										$uploads_dir = WWW_ROOT.'files/listing_images/'.$img_name;
										
										if ($error == 0 && $size <= 16000000 && $ext != '.exe') {
										move_uploaded_file($tmp_name,$uploads_dir);  } 
										
										 
									 }
										 
										 $this->request->data['rest_images'] = $rimages;
								}
	                      }
				  
				  
				 
				  $this->request->data['mon'] = $this->request->data['mon_open'].'-'.$this->request->data['mon_close'];
				  $this->request->data['tue'] = $this->request->data['tue_open'].'-'.$this->request->data['tue_close'];
				  $this->request->data['wed'] = $this->request->data['wed_open'].'-'.$this->request->data['wed_close'];
				  $this->request->data['thr'] = $this->request->data['thr_open'].'-'.$this->request->data['thr_close'];
				  $this->request->data['fri'] = $this->request->data['fr_open'].'-'.$this->request->data['fr_close'];
				  $this->request->data['sat'] = $this->request->data['sat_open'].'-'.$this->request->data['sat_close'];
				  $this->request->data['sun'] = $this->request->data['sun_open'].'-'.$this->request->data['sun_close'];
				  $data = array('Listing'=> $this->request->data); 
				  
				  unset($this->request->data['mon_open']);
				  unset($this->request->data['tue_open']);
				  unset($this->request->data['wed_open']);
				  unset($this->request->data['thr_open']);
				  unset($this->request->data['fr_open']);
				  unset($this->request->data['sat_open']);
				  unset($this->request->data['sun_open']);
				  
				  unset($this->request->data['mon_close']);
				  unset($this->request->data['tue_close']);
				  unset($this->request->data['wed_close']);
				  unset($this->request->data['thr_close']);
				  unset($this->request->data['fr_close']);
				  unset($this->request->data['sat_close']);
				  unset($this->request->data['sun_close']);
				  $this->Listing->save($data);
				  $this->Session->setFlash('Listing details saved successfully','default', array(), 'good');

	}
	}
	
	// listing_detail page
		public function listing_detail() {
		Configure::write('debug',0);
		$this->set('title','listing-detail');
		if(array_key_exists('srch', $this->request->params['named']))
	    {
		  $search  = $this->request->params['named']['srch'];
		  $this->paginate = array('conditions'=>array("OR" => array('title LIKE' => $search.'%','country LIKE' => $search.'%','city LIKE' => $search.'%'))); 
	    }
		$listings = $this->paginate('Listing');
		$this->set('listings',$listings);
		
	}
	
	 // listing images
		public function listing_images($listid=null) {
		Configure::write('debug',2);
		$this->set('title','list_images/'.$listid);
		$lists = $this->Listing->findAllById($listid,array('title','rest_images'));	
		$lists = Hash::flatten($lists);
		/* 
		echo "<pre>";
		print_r($lists); */
		
		$this->set('lists',$lists);
	}
	
	   // add event page
	   function events($id=null)
       {
        Configure::write('debug',0);
		$this->set('title','events/'.$id);
		$list = $this->Listing->findAllById($id,array('title'));
		$title = $list['0']['Listing']['title'];
		$this->set('listname',$title);
        $this->set('listid',$id);	
	 
		if($this->request->data) {
		 unset($this->request->data['_Token']);	

		  if(array_key_exists('rest_images', $this->request->form))
	                      {
	                         $makeit = $this->request->form['rest_images']['name'];
							 $test = $this->request->form['rest_images']['name']['0'];
							 $i=0;
						     $count = sizeof($makeit);
							 $max = $count-1;

						     if(!empty($test)) {
	
									 for($i = 0; $i<$max; $i++)
									 {
										
										 $img_name = $this->request->form['rest_images']['name'][$i];
										 $ext = strrchr($img_name, ".");
										 $type = $this->request->form['rest_images']['type'][$i];
										 $tmp_name = $this->request->form['rest_images']['tmp_name'][$i];
										 $error =  $this->request->form['rest_images']['error'][$i];
										 $size = $this->request->form['rest_images']['size'][$i];
										
										$uid = uniqid();
										$img_name = $uid."_".$img_name;
										
										if(empty($rimages))
										{
											$rimages = $img_name;
										}
									   else
									   {
										   $rimages = $rimages.','.$img_name;
									   }							   
										
										$uploads_dir = WWW_ROOT.'files/event_images/'.$img_name;
										
										if ($error == 0 && $size <= 16000000 && $ext != '.exe') {
										move_uploaded_file($tmp_name,$uploads_dir);  } 
										
								
									 }
										 
										 $this->request->data['event_images'] = $rimages;
								}
	                      }
		 
		 
		 $this->request->data['event_time'] = $this->request->data['eventstart'].' - '.$this->request->data['eventend'];
		 unset($this->request->data['eventstart']);
		 unset($this->request->data['eventend']);
		 $data = $this->request->data;
		 $this->Event->save($data);
		 $this->Session->setFlash('Event details saved successfully','default', array(), 'good');
		 $this->redirect('/list-event-detail/'.$this->request->data['listing_id']);
		 
		}	
	  }
	  
	  // event_detail page
		public function event_detail() {
		Configure::write('debug',0);
		$this->set('title','event-detail');
		$events = $this->Event->find('all');
		$this->set('events',$events);
		
	}
	
	 // listing_event_detail page
		public function list_event_detail($lidtid=null) {
		Configure::write('debug',0);
		$this->set('title','list-event-detail/'.$lidtid);
		$events = $this->Event->findAllByListingId($lidtid); 
		$this->set('events',$events);
		
	}
	
	   // event images page
		public function event_images($eventid=null) {
		Configure::write('debug',0);
		$this->set('title','event_images/'.$eventid);
		$events = $this->Event->findAllById($eventid,array('title','listname','event_images'));	
		$events = Hash::flatten($events);
		$this->set('events',$events);
	}
	
	 
	
}
