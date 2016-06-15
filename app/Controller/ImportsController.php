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
class ImportsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	var $components = array('Email','Session');
	var $helpers=array('Js');
	var $uses = array('User','Geodata','Listing','BulkLog');
	  
    // Import geo data
	public function geodata() {
		
	$this->set('title','GeoLocation Data');	
	$csv_file;	
	if(array_key_exists('geodata', $this->request->form))
	                      {
	                         $img_name = $this->request->form['geodata']['name'];
						     $ext = strrchr($img_name, ".");
						     $type = $this->request->form['geodata']['type'];
							 $tmp_name = $this->request->form['geodata']['tmp_name'];
							 
							// echo $tmp_name;
							// exit;
							 
							 $error =  $this->request->form['geodata']['error'];
							 $size = $this->request->form['geodata']['size'];
							
							$uid = uniqid();
							$img_name = $uid."_".$img_name;
							$this->request->data['geodata'] = $img_name;
							$uploads_dir = WWW_ROOT.'files/geodata/'.$img_name;
							
							if ($error == 0 && $ext == '.csv') {
								move_uploaded_file($tmp_name,$uploads_dir); 
								$csv_file = $uploads_dir; 
							}
                            else
                            {
							   echo "vere csv only!!!";	
							   exit;
							}								
	                      }

    // Name of your CSV file
    
	if (($handle = fopen($csv_file, "r")) !== FALSE) {
	   fgetcsv($handle);   
	   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			for ($c=0; $c < $num; $c++) {
			  $col[$c] = $data[$c];
			}

	 $col1 = $col[0];
	 $col2 = $col[1];
	 $col3 = $col[2];
	 $col4 = $col[3];
	 
	 $status = $this->Geodata->query("INSERT INTO shisha_geodata(`country`,`list`,`state`,`city`) VALUES('".$col1."','".$col2."','".$col3."','".$col4."')");
					  
	}
	
	}

	}
	
	
	// Import listing data
	public function listings() {
		
		Configure::write('debug',0);
		$this->set('title','listing-bulk-upload');	
		$csv_file;	
		if(array_key_exists('listingdata', $this->request->form))
							  {
								 $img_name = $this->request->form['listingdata']['name'];
								 $ext = strrchr($img_name, ".");
								 $type = $this->request->form['listingdata']['type'];
								 $tmp_name = $this->request->form['listingdata']['tmp_name'];
								 
								// echo $tmp_name;
								// exit;
								 
								 $error =  $this->request->form['listingdata']['error'];
								 $size = $this->request->form['listingdata']['size'];
								
								$uid = uniqid();
								$img_name = $uid."_".$img_name;
								$this->request->data['listingdata'] = $img_name;
								$uploads_dir = WWW_ROOT.'files/listings/'.$img_name;
								
								if ($error == 0 && $ext == '.csv') {
									move_uploaded_file($tmp_name,$uploads_dir); 
									$csv_file = $uploads_dir; 
								}
								else
								{
								   echo "Bro csv files only!!!";	
								   exit;
								}								
							 

		// Name of your CSV file
		$txtname = date("Y-m-d-H-i-s", strtotime('now'));
		$filename = WWW_ROOT."files/logs/".$txtname.".txt";
		$fp = fopen($filename,"w") or die("Unable to open file!");
		
		if (($handle = fopen($csv_file, "r")) !== FALSE) {
		   fgetcsv($handle);   
		   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				for ($c=0; $c < $num; $c++) {
				  $col[$c] = $data[$c];
				}

		 $col0 = $col[0];
		 $col1 = $col[1];
		 $col2 = $col[2];
		 $col3 = $col[3];
		 $col4 = preg_replace('/[^A-Za-z0-9\. -]/', '', $col[4]);
		 $col5 = $col[5];
		 $col6 = $col[6];
		 $col7 = preg_replace('/[^A-Za-z0-9\. -]/', '', $col[7]);
		 $col8 = preg_replace('/[^A-Za-z0-9\. -]/', '', $col[8]);
		 $col9 = $col[9];
		 $col10 = $col[10];
		 $col11 = $col[11];
		 $col12 = $col[12];
		 $col13 = $col[13];
		 $col14 = $col[14];
		 $col15 = $col[15];
		 $col16 = $col[16];
		 $col17 = $col[17];
		 $col18 = $col[18];
		 $col19 = $col[19];
		 $col20 = $col[20];
		 $col21 = $col[21];
		 
		 $combo = $col[1].'-'.$col[2].'-'.$col[3].'-'.$col[4];
		 $raw_id = str_replace(" ","_",$combo);
		 $log_time = $txtname;
		 
		 $rawdata = $this->Listing->findAllByRawId($raw_id);
		 $status = "Already exist,\r\n";
		 
		 if(empty($rawdata))
		 {
			if(!empty($col4))
			{
			  $this->Listing->query("INSERT INTO shisha_listings(`banner_image`,`country`,`state`,`city`,`title`,`start_rating`,`start_reviews`,`address`,`neighborhood`,`phone`,`website`,`start_price`,`hublyz_reviews`,`hublyz_ratings`,`hublyz_price`,`mon`,`tue`,`wed`,`thr`,`fri`,`sat`,`sun`,`raw_id`,`log_time`) VALUES('".$col0."','".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."','".$col7."','".$col8."','".$col9."','".$col10."','".$col11."','".$col12."','".$col13."','".$col14."','".$col15."','".$col16."','".$col17."','".$col18."','".$col19."','".$col20."','".$col21."','".$raw_id."','".$log_time."')");
			  $status = "Inserted,\r\n";
			} 
		 }
		 
		$content =  $raw_id." -> ".$status;
		fwrite($fp,$content); 		 
		}
		
		fclose($fp);
		
		$this->BulkLog->create();
		$this->request->data['BulkLog']['file_name'] = $txtname.'.txt';
		$this->request->data['BulkLog']['created'] = date("Y-m-d H:i:s", strtotime('now'));
		$this->BulkLog->save($this->request->data,false);
		$this->Session->setFlash('Data imported successfully to the server.','default', array(), 'good');
		
		}
     }
	
	}
	
	// Read logs data from files
	public function logsdata() {	
	Configure::write('debug',0);
	$this->set('title','logsdata/fl:'.$this->request->params['named']['fl']);	

		if(array_key_exists('fl', $this->request->params['named']))
		{
			$txtname  = $this->request->params['named']['fl'];
			//$txtname = "2016-05-23-13-03-02.txt";
			$filename = WWW_ROOT."files/logs/".$txtname;
			$myfile = fopen($filename, "r") or die("Unable to open file!");
			$filedata = fread($myfile,filesize($filename));
			$logsdata = explode(",",$filedata);
			$this->set('logsdata',$logsdata);
			fclose($myfile);
		}
	
	}
	
	// view logs files
	public function logs_files() {
		Configure::write('debug',0);
		$this->set('title','logs-files');
		$logsfiles = $this->BulkLog->find('all');
		$this->set('logsfiles',$logsfiles);
		
	}
	
	public function sendFile($id) {
    //$file = $this->Attachment->getFile($id);
    $this->response->file(
    WWW_ROOT."files/logs/".$id,
    array('download' => true, 'name' => $id)
    );
    return $this->response;
}
	
}
