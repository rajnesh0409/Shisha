<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Services extends MY_Controller {  
	function __construct(){
		parent::__construct();
    	$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('brands_model');
    	
	}
	
	public function index(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/services/display_services');
		}
	}	
	
	
	   // stores - Add store
	  	public function add_store(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else{
			$pname = $this->uri->segment(5);
			$this->data['heading'] = 'Add Service store for '.$pname;
			$id = $this->uri->segment(4);
			$condition = array('partner_id' => $id);
			$this->data['partner_id'] = $id;
			$condition = array('partner_id' => $id);
			$this->data['Services'] = $this->user_model->get_all_details(SERVICES,$condition);
			$this->load->view('admin/services/add_store',$this->data);
		}
	}
	
	// Insert store details
	public function insert_store(){
		
       if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else
		{
			
		    $data = $this->input->post();
            $data['services'] = implode(', ',$this->input->post('services'));
			$id = $this->input->post('partner_id');
            $this->user_model->saveform(SERVICE_STORES,$data);
		    $this->setErrorMessage('success','Added successfully');
			redirect('admin/services/add_store/'.$id);
			
		}
	}
	  
     // View store details per partner
        public function display_stores(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$pname = $this->uri->segment(5);
			$this->data['heading'] = $pname.' Service Stores List';
			$id = $this->uri->segment(4);
			
			$condition = array('partner_id'=>$id);
			$this->data['details'] = $this->brands_model->get_all_details(SERVICE_STORES,$condition);
			$this->load->view('admin/services/display_stores',$this->data);
		}
	}
	
	  // View all store details
        public function display_stores_all(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Service Stores List';
			
			$condition = array();
			$stores = $this->brands_model->get_all_details(SERVICE_STORES,$condition);
			
			     $m = $stores->result_array();
				 foreach($m as $key=>$val) {
				 $partner_id = $val['partner_id'];	
				
				    $condition = array('id'=> $partner_id);
					$vehdetails = $this->brands_model->gedetails(SERVICE_PARTNERS,$condition);
					$s = $vehdetails->result_array();

                    $store = array('stores'=>$val);
				    $partner = array('partner'=>$s['0']);
				
				   
				   $data[] = array_merge($store,$partner);    
			}
			
			/* echo "<pre>";
			print_r($data); */
			
			$this->data['details'] = $data;
			$this->load->view('admin/services/display_stores_all',$this->data);
		}
	}
	
	// delete service
	 public function delete_store(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$id = $this->uri->segment(4,0);
			$partner_id = $this->uri->segment(5,0);
			$condition = array('id' => $id);
			$this->brands_model->commonDelete(SERVICE_STORES,$condition);
			$this->setErrorMessage('success','Deleted successfully');
			redirect('admin/services/display_stores/'.$partner_id);
		}
	}
	
	
	
	// Service categories - Add cat
	public function add_service_cats(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else{
			$this->data['heading'] = 'Add Service Category';
			$this->load->view('admin/services/add_service_cats',$this->data);
		}
	}

	// View cats
	public function service_cats(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Service Category List';
			$condition = array();
			$this->data['details'] = $this->brands_model->get_all_details(CATS,$condition);
			$this->load->view('admin/services/service_cats',$this->data);
		}
	}
	
	// change cat status
	public function change_cat_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$id = $this->uri->segment(5,0);
			$newdata = array('status' => $mode);
			$condition = array('id' => $id);
			$this->brands_model->update_details(CATS,$newdata,$condition);
			$this->setErrorMessage('success','Status Changed Successfully');
			redirect('admin/services/service_cats');
		}
	}
	
	// Delete cat
	public function delete_cat(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$id = $this->uri->segment(4,0);
			$condition = array('id' => $id);
			$this->brands_model->commonDelete(CATS,$condition);
			$this->setErrorMessage('success','Deleted successfully');
			redirect('admin/services/service_cats');
		}
	}

	// Insert cat
	public function insertcat(){
		
       if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$name = trim($this->input->post('name'));
            $checkDup = $this->brands_model->get_all_details(CATS,array('name'=>$name));
				if($checkDup->num_rows()>0){
						$this->setErrorMessage('error','Already exists');
						redirect('admin/services/add_service_cats');
				}else{
					
					$excludeArr = array("status","cat_image");
					//$config['encrypt_name'] = TRUE;
					$config['overwrite'] = FALSE;
					$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
					$config['max_size'] = 2000;
					$config['upload_path'] = './images/cats';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					if ( $this->upload->do_upload('cat_image')){
						$logoDetails = $this->upload->data();
						$ImageName = $logoDetails['file_name'];
					}else{
						$logoDetails = $this->upload->display_errors();
						$this->setErrorMessage('error',strip_tags($logoDetails));
						redirect('admin/brands/add_brand');
					}
					$amenity_data = array( 'cat_image' => $ImageName);
					$dataArr = $amenity_data;
					$this->brands_model->commonInsertUpdate(CATS,'insert',$excludeArr,$dataArr);

					//$data = $this->input->post();
					//$this->brands_model->saveform(CATS,$data);
					$this->setErrorMessage('success','Added successfully');
					redirect('admin/services/service_cats');
				}
		}
	}
	
	
	// Services - Add service
	public function add_service(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$pname = $this->uri->segment(5);
			$this->data['heading'] = 'Add Service for '.$pname ;
		    $id = $this->uri->segment(4);
			$condition = array('id' => $id);
			$this->data['partner_id'] = $id;
			$this->data['details'] = $this->user_model->get_all_details(SERVICE_PARTNERS,$condition);
			$this->load->view('admin/services/add_service',$this->data);
		}
	}
	
	// Display service per partner
	public function display_services(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		} else {
			$pname = $this->uri->segment(5);
			$this->data['heading'] = $pname.' Services List';
			$id = $this->uri->segment(4);
			$condition = array('partner_id' => $id);
			$this->data['details'] = $this->brands_model->get_all_details(SERVICES,$condition);
			$this->load->view('admin/services/display_services',$this->data);
		}
	} 
	
	// Display all services
	public function display_services_all(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		} else {
			$this->data['heading'] = 'Services List';

			$condition = array();
			$service = $this->brands_model->get_all_details(SERVICES,$condition);
			
			     $m = $service->result_array();
				 foreach($m as $key=>$val) {
				 $partner_id = $val['partner_id'];	
				
				    $condition = array('id'=> $partner_id);
					$vehdetails = $this->brands_model->gedetails(SERVICE_PARTNERS,$condition);
					$s = $vehdetails->result_array();

                    $store = array('service'=>$val);
				    $partner = array('partner'=>$s['0']);
				
				   
				   $data[] = array_merge($store,$partner);    
			}
			
			/* echo "<pre>";
			print_r($data);  */
			
			$this->data['details'] = $data;
			
			
			$this->load->view('admin/services/display_services_all',$this->data);
		}
	} 
   
	// Insert service
	public function insertService(){
       if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$name = trim($this->input->post('service_name'));
			$checkDup = $this->brands_model->get_all_details(SERVICES,array('service_name'=>$name));
				if($checkDup->num_rows()>0){
						$this->setErrorMessage('error','Service name already exist');
						redirect('admin/services/add_service');
				}else{
					$data = $this->input->post();
					$partner_id = $this->input->post('partner_id');
					$this->brands_model->saveform(SERVICES,$data);
					$this->setErrorMessage('success','Service added successfully');
					redirect('admin/services/display_services/'.$partner_id);
				}
		}
	}	
	
	// change service status
	public function change_service_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$id = $this->uri->segment(5,0);
			$partner_id = $this->uri->segment(6,0);
			$newdata = array('status' => $mode);
			$condition = array('id' => $id);
			$this->brands_model->update_details(SERVICES,$newdata,$condition);
			$this->setErrorMessage('success','Status Changed Successfully');
			redirect('admin/services/display_services/'.$partner_id);
		}
	}	
	
 	// delete service
	 public function delete_service(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$id = $this->uri->segment(4,0);
			$partner_id = $this->uri->segment(5,0);
			$condition = array('id' => $id);
			$this->brands_model->commonDelete(SERVICES,$condition);
			$this->setErrorMessage('success','Deleted successfully');
			redirect('admin/services/display_services/'.$partner_id);
		}
	}


   // Services - Add additional repair service
	public function add_repair_service(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Additional Repairs';
			$condition = array('status' => 'Active');
			$this->data['details'] = $this->user_model->get_all_details(CATS,$condition);
			$this->load->view('admin/services/add_repair_service',$this->data);
		}
	}
	
	// Display additional repair service
	public function repair_services(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		} else {
			$this->data['heading'] = 'Additional Repair Services List';
			$condition = array();
			$this->data['details'] = $this->brands_model->get_all_details(ADD_REPAIRS,$condition);
			$this->load->view('admin/services/repair_services',$this->data);
		}
	} 
   
	// Insert additional repair service
	public function insertRepairService(){
       if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$name = trim($this->input->post('service_name'));
			$checkDup = $this->brands_model->get_all_details(ADD_REPAIRS,array('service_name'=>$name));
				if($checkDup->num_rows()>0){
						$this->setErrorMessage('error','Service name already exist');
						redirect('admin/services/add_repair_service');
				}else{
					$data = $this->input->post();
					$this->brands_model->saveform(ADD_REPAIRS,$data);
					$this->setErrorMessage('success','Additional repair service added successfully');
					redirect('admin/services/repair_services');
				}
		}
	}
	
	// change repair status
	public function change_repair_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$id = $this->uri->segment(5,0);
		    $newdata = array('status' => $mode);
			$condition = array('id' => $id);
			$this->brands_model->update_details(ADD_REPAIRS,$newdata,$condition);
			$this->setErrorMessage('success','Status Changed Successfully');
			redirect('admin/services/repair_services');
		}
	}	
	
 	// delete repair
	 public function delete_repair(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		} else {
			$id = $this->uri->segment(4,0);
			$condition = array('id' => $id);
			$this->brands_model->commonDelete(ADD_REPAIRS,$condition);
			$this->setErrorMessage('success','Deleted successfully');
			redirect('admin/services/repair_services');
		}
	}

	
}/* End of file brand.php */
/* Location: ./application/controllers/admin/amenities.php */