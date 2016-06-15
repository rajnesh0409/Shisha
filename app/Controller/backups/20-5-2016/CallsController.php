<?php
App::import('Controller', 'Loves');
App::uses('AppController', 'Controller');

class CallsController extends AppController {

    var $components = array('Session', 'Cookie','RequestHandler');
	var $helpers=array('Js');
	var $uses = array('User','Listing');
	  
	function beforeFilter()
    {
      
	}
	
	/*** Ajax call functions starts *****/
	
    // Delete - Block driver
	public function delete_listings() {
	Configure::write('debug',0);
	$main = WWW_ROOT;
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $listids = $this->request->data['list_ids'];
				
			$list_ids = array_filter($listids);
			//print_r($list_ids);
			
			foreach($list_ids as $key=>$val){
			
			//echo $val;
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
					
					
			        
			
			//echo $banner_image;
			//print_r($rest_images);
			//die;
			
			
			
					
					
				}  
				
			}
			
			die;
							
	   }
	 }
	}
	
	
	 // verify driver
	 public function verify_driver() {
	 Configure::write('debug',0);
	 $this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
	       
		    $this->Driver->create();
		    $this->request->data['Driver']['id'] = $this->request->data['driver_id'];
		    $this->request->data['Driver']['isverified'] = $this->request->data['driver_do'];
		    if($this->Driver->save($this->request->data))
		    { die("Driver status changed successfully"); }  else { die("failure");  }
		   
	   }
	 }  
	}

	// Delete cab pricing detail
	public function action_price() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $price_id = $this->request->data['price_id'];
			$todo = $this->request->data['price_do'];
			
			if($todo == 'Delete')
			{
			    $query = $this->Price->deleteAll(array('Price.id' => $price_id), false);
				if($query == true)
		        { 
					die("success"); 
				}  
				else 
				{ 
			       die("failure");  
				} 
			
			}
       }
	 }
	}
	
	
	// Delete customer details
	public function action_customer() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $customer_id = $this->request->data['customer_id'];
			$todo = $this->request->data['customer_do'];
			
			if($todo == 'Delete')
			{
			    $query = $this->Customer->deleteAll(array('Customer.id' => $customer_id), false);
				if($query == true)
		        { 
					die("success"); 
				}  
				else 
				{ 
			       die("failure");  
				} 
			
			}
       }
	 }
	}
	
	// Delete airport pricing detail
	public function action_airportprice() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $price_id = $this->request->data['price_id'];
			$todo = $this->request->data['price_do'];
			
			if($todo == 'Delete')
			{
			    $query = $this->AirportPrice->deleteAll(array('AirportPrice.id' => $price_id), false);
				if($query == true)
		        { 
					die("success"); 
				}  
				else 
				{ 
			       die("failure");  
				} 
			
			}
       }
	 }
	}
	
	// Delete/ active/ deactive promos detail
	public function action_promos() {
	Configure::write('debug',2);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $promos_id = $this->request->data['promos_id'];
			$todo = $this->request->data['promos_do'];
			
			if($todo == 'Delete')
			{
			    $query = $this->PromoCode->deleteAll(array('PromoCode.id' => $promos_id), false);
				if($query == true)
		        { 
					die("success"); 
				}  
				else 
				{ 
			       die("failure");  
				} 
			
			}
			else
			{
				$this->PromoCode->create();
				$this->request->data['PromoCode']['id'] = $promos_id;
				$this->request->data['PromoCode']['isactive'] = $todo;
			    if($this->PromoCode->save($this->request->data))
				{ 
			      if($todo == 'yes'){
					die("Promo code activated successfully");  
				  }
				  else{
					die("Promo code deactivated successfully");    
				  }
			    }  else { die("failure");  }
				
			}	
       }
	 }
	}
	
	// Delete cab type
	public function action_cabtype() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $cabtype_id = $this->request->data['cabtype_id'];
			$todo = $this->request->data['cabtype_do'];
			
			if($todo == 'Delete')
			{
			    $query = $this->VehicleName->deleteAll(array('VehicleName.id' => $cabtype_id), false);
				if($query == true)
		        { 
					die("success"); 
				}  
				else 
				{ 
			       die("failure");  
				} 
			
			}
       }
	 }
	}
	
    // Delete - Block Cabs
	public function action_cabs() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $cab_id = $this->request->data['cab_id'];
			$todo = $this->request->data['cab_do'];
			
			if($todo == 'Delete')
			{
			    $cabdetail = $this->InfoVehicle->find('all',array('conditions'=>array('InfoVehicle.id'=>$cab_id)));
				$query = $this->InfoVehicle->deleteAll(array('InfoVehicle.id' => $cab_id), false);
				if($query == true)
		        { 
					
					$reg_cr = $cabdetail['0']['InfoVehicle']['reg_cr'];
					$em_cr = $cabdetail['0']['InfoVehicle']['em_cr'];
					$vehimg = $cabdetail['0']['InfoVehicle']['vehimg'];
					$insurace_cr = $cabdetail['0']['InfoVehicle']['insurace_cr'];
					
					$reg_cr = WWW_ROOT.'files/cab/'.$reg_cr;
					$em_cr = WWW_ROOT.'files/cab/'.$em_cr;
					$vehimg = WWW_ROOT.'files/cab/'.$vehimg;
					$insurace_cr = WWW_ROOT.'files/cab/'.$insurace_cr;
					
					unlink($reg_cr);
					unlink($em_cr);
					unlink($vehimg);
					unlink($insurace_cr);
					die("success"); 
				}  
				else 
				{ 
			       die("failure");  
				} 
			
			}
            else
            {
				$this->InfoVehicle->create();
				$this->request->data['InfoVehicle']['id'] = $cab_id;
				$this->request->data['InfoVehicle']['action'] = $todo;
			    if($this->InfoVehicle->save($this->request->data))
				{ echo "Cab ".$todo." successfully";
				die(); }  else { die("failure");  }
			}				
	   }
	 }
	}	
	
	
     // assign cabs
	 public function assign_cabs() {
	 Configure::write('debug',0);
	 $this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
	        $driver_id = $this->request->data['driver_id'];
		    $vehicle_id = $this->request->data['vehicle_id'];
			$veh_assign = $this->request->data['veh_assign'];
		    
			$this->Driver->create();
		    $this->request->data['Driver']['id'] = $driver_id;
		    $this->request->data['Driver']['vehicle_id'] = $vehicle_id;
			$this->request->data['Driver']['Isallocated'] = 'allocated';
			$this->request->data['Driver']['veh_assign'] = $veh_assign;

		    if($this->Driver->save($this->request->data))
		    { 
		        $this->InfoVehicle->create();
				$this->request->data['InfoVehicle']['id'] = $vehicle_id;
				$this->request->data['InfoVehicle']['Isassigned'] = 'assigned';
				$this->InfoVehicle->save($this->request->data);
			    die("success"); 
			}  
			else 
			{ 
		       die("failure");  
			}
		   
	   }
	 }  
	}
	
	 // unassign cabs
	 public function unassign_cabs() {
		 
		 Configure::write('debug',0);
		 $this->layout = false;
		 
		  if($this->request->isAjax)
	       {
	         if($this->request->is('post'))
	          { 
				  $driver_id = $this->request->data['driver_id'];
				  $iscab = $this->AssignVehicleToDriver->find('count', array('conditions' => array('AssignVehicleToDriver.driver_id' => $driver_id)));
				  
				  if($iscab != '0')
				  {
					 echo "Driver can't be unallocated. To unallocate this driver please first free it from intercity route.";
					 exit;
				  }
				 
				 $driver_details = $this->Driver->findById($driver_id,'vehicle_id');
				 $vehicle_id = $driver_details['Driver']['vehicle_id'];
				 $this->Driver->updateAll(array('Driver.Isallocated' => '"unallocated"','Driver.vehicle_id' => '"null"','Driver.veh_assign' => '"null"'),array('Driver.id' => $driver_id));
				 $this->InfoVehicle->updateAll(array('InfoVehicle.Isassigned' => '"Unassigned"'),array('InfoVehicle.id' => $vehicle_id));
			     echo "success";
				 exit;
			  } 				
	     }
	
	}
	
	
	// Delete routes
	public function deleteroutes() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $route_id = $this->request->data['route_id'];
			$vehicle_id = $this->request->data['vehicle_id'];
			$driver_id = $this->request->data['driver_id'];

			   $caborder = $this->IntercityFindCabOrders->find('count', array('conditions' => array('IntercityFindCabOrders.assigned_cab_id' => $route_id)));
				  
				  if($caborder != '0')
				  {
					 echo "This route can't be deleted. To delete this route please make sure that none of your booking order contain this route.";
					 exit;
				  }

				$query = $this->AssignVehicleToDriver->deleteAll(array('AssignVehicleToDriver.id' => $route_id), false);
				if($query == true)
		        { 
					$this->Driver->updateAll(array('Driver.Isallocated' => '"unallocated"','Driver.vehicle_id' => '"null"','Driver.veh_assign' => '"null"'),array('Driver.id' => $driver_id));
				    $this->InfoVehicle->updateAll(array('InfoVehicle.Isassigned' => '"Unassigned"'),array('InfoVehicle.id' => $vehicle_id));
					die("success"); 
				}  
				else 
				{ 
			       die("failure");  
				} 
		
	   }
	 }
	
	}	
	
	// Delete later rides
	public function delelet_later_ride() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $ride_id = $this->request->data['ride_id'];
			$vehicle_id = $this->request->data['vehicle_id'];
			$driver_id = $this->request->data['driver_id'];
			
				$query = $this->LaterRide->deleteAll(array('LaterRide.id' => $ride_id), false);
				if($query == true)
		        { 
					$this->Driver->updateAll(array('Driver.Isallocated' => '"unallocated"','Driver.vehicle_id' => '"null"','Driver.veh_assign' => '"null"'),array('Driver.id' => $driver_id));
				    $this->InfoVehicle->updateAll(array('InfoVehicle.Isassigned' => '"Unassigned"'),array('InfoVehicle.id' => $vehicle_id));
					die("success"); 
				}  
				else 
				{ 
			       die("failure");  
				} 
		
	   }
	 }
	
	}	
	
	// Delete booking order
	public function deleteorder() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $order_id = $this->request->data['order_id'];
               $query = $this->IntercityFindCabOrders->deleteAll(array('IntercityFindCabOrders.id' => $order_id), false);
				if($query == true)
		        { 
					die("success"); 
				}  
				else 
				{ 
			       die("failure");  
				} 
	   }
	 }
	
	}
	
	// Delete pickup point
	public function deletepickpoints() {
	Configure::write('debug',0);
	$this->layout = false;
	 if($this->request->isAjax)
	 {
	   if($this->request->is('post'))
	   { 
		    $pick_id = $this->request->data['pick_id'];
               $query = $this->PickupPoint->deleteAll(array('PickupPoint.id' => $pick_id), false);
				if($query == true)
		        { 
					die("success"); 
				}  
				else 
				{ 
			       die("failure");  
				} 
	   }
	 }
	
	}
	
	// update pickup points
	public function get_pickup_points() {
	Configure::write('debug',0);
    $pickup_city = $_POST['pickup_city'];
	 $pickupPoints = $this->PickupPoint->find('all', array('conditions' => array('PickupPoint.city_name' => $pickup_city)));
	 $count = count($pickupPoints);
	 if($count>0){
	 			$pickup_points='<select id="pickup_points" name="pickup_points[]" required multiple="multiple">';
								
                               foreach($pickupPoints as $key=>$value) { 
								$pickup_points.='<option value="'.$value['PickupPoint']['pickup_point'].'">'.$value['PickupPoint']['pickup_point'].'</option>';
                                } 
								$pickup_points.='</select><i class="arrow double"></i>
                            <span class="field-icon"><i class="fa fa-map-marker"></i></span>   
                            <b class="tooltip tip-right-top"><em>Select multiple pickup points</em></b>';
	 
	 echo $pickup_points;
	 die;
	 }else{
		 echo $pickup_points='<select id="driver_id" name="driver_id" required multiple="multiple">
		 <option value="">No pickup points</option></select><i class="arrow double"></i>
                            <span class="field-icon"><i class="fa fa-map-marker"></i></span>   
                            <b class="tooltip tip-right-top"><em>Select multiple pickup points</em></b>';
		 die;
		 }
	
	}

 
}


