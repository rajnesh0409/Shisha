<?php


App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	var $components = array('Security','Email','Session', 'Cookie','RequestHandler','Auth');
	var $helpers=array('Js');
	var $uses = array('User','Listing');
	  
	/*** security related functions *****/
	
	function beforeFilter()
    {
       $this->Auth->allow('deny','logout');
	   $this->Security->blackHoleCallback = 'blackhole';
	   $this->Security->unlockedActions = 'login';
	   $user = $this->Session->read('user');
       if(!empty($user)) { 
       $this->Auth->allow('index','login','listing','listing_detail');
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
	
	// admin logout
	function listing()
    {
        Configure::write('debug',0);
		$this->set('title','listing');
		
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
							 $i=0;
							 
							 if(!empty($test)) {
									 foreach($makeit as $value)
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
										
										 $i++;
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
				  
				  
	
		//echo "<pre>";
		//print_r($this->request->data);
		//print_r($this->request->form);
		//die;
	}
	}
	
	// listing_detail page
		public function listing_detail() {
		Configure::write('debug',0);
		$this->set('title','listing-detail');
		
	    $this->paginate = array('limit' => '10','order' => array('id' => 'DESC'));
	
		
	
		$listings = $this->paginate('Listing');
		
		//$listings = $this->Listing->find('all');
		$this->set('listings',$listings);
		
	}
	
	
	
}
