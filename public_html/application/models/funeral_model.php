<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Funeral_model extends CI_Model {

	private $user_table		= "users"; 			// main model table 	
	private $funeral_table		= "funeral"; 
	private $funeral_guests_table		= "funeral_guests"; 
	private $funeral_attribute_table		= "funeral_attribute";
	private $attributestype_table		= "attributestype";
	private $gallery_table ="gallery";
	private $journal_table ="journal";
	private $event_table		= "events"; 
	private $event_type_table		= "eventtype"; 
	private $service_table		= "servicetype"; 
	private $feed_table		= "feed";
	private $setting_table          = "user_settings";
	private $user_device_table      = "user_devices";
	private $anonymous_table        = "anonymous_user_device_token";
	public function __construct()
	{
		
	}

	
/**
	* Function to get list of funeral
	*
	* @author        Shashank
	* @param         var
	* @return        array
	*/
    public function get_funeral_list($emailId)
    {        
        if(isset($emailId))
        {
        
        	$sql = 'SELECT `funeral`.* , `users`.`emailId` as `hostEmailId` 
			FROM  `funeral` JOIN `users` ON (`users`.`userId` = `funeral`.`hostId`) 
			WHERE 	(`users`.`emailId` = "'.$emailId.'") 
			OR `funeral`.`funeralId` in (SELECT `funeral_guests`.`funeralId` 
			from `funeral_guests` where `funeral_guests`.`emailId` = "'.$emailId.'")';
			$response = $this->db->query($sql); 
			if($response->num_rows() > 0){
			return $response->result_array();
			}
    		return array(); 
			
        }
    }
    
    /**
	* Function to get list of funeral
	*
	* @author        Shashank
	* @param         var
	* @return        array
	*/
    public function get_gallery($funeralId)
    {        
        if(isset($funeralId))
        {
        
        	$sql = 'SELECT `gallery`.* , `users`.`emailId` as `uploadedBy`,`users`.`firstName`,`users`.`lastName` 
			FROM  `gallery` JOIN `users` ON (`users`.`userId` = `gallery`.`createdBy`) 
			WHERE 	(`gallery`.`funeralId` = "'.$funeralId.'")';
			$response = $this->db->query($sql);  
			return $response->result_array();
        }
    }

    
     /**
	* Function to get list of funeral
	*
	* @author        Shashank
	* @param         var
	* @return        array
	*/
    public function get_user_gallery($param)
    {        
        if(isset($param))
        {
            $this->db->select("{$this->gallery_table}.*,{$this->user_table}.firstName,lastName");
            $this->db->join($this->user_table,"{$this->user_table}.userId = .". $this->gallery_table.'.createdBy');
			$this->db->where('funeralId', $param['funeralId']);
			$this->db->where('createdBy', $param['userId']);
			$res_chk = $this->db->get($this->gallery_table);
        	return $res_chk->result_array();
        }
    }
	
	/**
	* Function to get detail of funeral
	*
	* @author        KS
	* @param         var
	* @return        array
	*/
    public function get_funeral_detail_by_funeral_id($funeralId)
    {        
        if(isset($funeralId))
        {
        
        	$sql = 'SELECT `funeral`.* , `users`.`emailId` as `hostEmailId` , `users`.`firstName` as `hostFirstName` ,
        	`users`.`lastName` as `hostLastName`  
			FROM  `funeral` JOIN `users` ON (`users`.`userId` = `funeral`.`hostId`) 
			WHERE 	(`funeral`.`funeralId` = "'.$funeralId.'")';
			
			return $this->get_funeral_detail($sql);
			
        } 
    }
    
    /**
	* Function to generate and check Invitation code
	*
	* @author	KS
	* @param	none
	* @return	variable
	*/	
	public function getNewInvitationCode() 
	{
		$InvitationCode = randomToken(12, false, true, false);
		if($this->check_Invitation_code($InvitationCode)){
			$this->getNewUserToken();
		}		
		return $InvitationCode;
    }

    /**
	* Function to check Invitation code
	*
	* @author	Shashank
	* @param	variable
	* @return	boolean
	*/
    public function check_Invitation_code($InvitationCode) 
	{
		$flag = FALSE;
    	if (empty($InvitationCode))
		{
			return $flag;
		}	
		$this->db->where('InvitationCode', $InvitationCode);
		if($this->db->count_all_results($this->funeral_table) > 0){
			$flag = TRUE;
		}
		 
		return $flag;
    }



    public function get_funeral_detail_by_invitationCode($data)
    {        
    	
        if(isset($data['invitationCode']))
        {
        
        	$sql = 'SELECT `funeral`.* , `users`.`emailId` as `hostEmailId` , `users`.`firstName` as `hostFirstName` ,
        	`users`.`lastName` as `hostLastName`  
			FROM  `funeral` JOIN `users` ON (`users`.`userId` = `funeral`.`hostId`) 
			WHERE 	(`funeral`.`invitationCode` = "'.$data['invitationCode'].'")';
			
			
			if(isset($data['deviceToken'])){
				$this->db->select("{$this->user_device_table}.*");
				$this->db->where('deviceToken',$data['deviceToken']);
				$res_chk = $this->db->get($this->user_device_table);
				if($res_chk->num_rows() == 0){
				$this->db->select("{$this->funeral_table}.funeralId");
				$this->db->where('invitationCode',$data['invitationCode']);
				$respo = $this->db->get($this->funeral_table);
				$response=$respo->result();
				$funeralId=$response[0]->funeralId;
				$fields['funeralId'] = $funeralId;
            	$fields['deviceToken'] = $data['deviceToken'];
            	
            	$res_ins = $this->db->insert($this->anonymous_table, $fields);
            }

              
			}
			return $this->get_funeral_detail($sql);
        }
       
    }
    
    private function get_funeral_detail($sql)
    {		
    		
    		$res_chk = $this->db->query($sql);  
			if($res_chk->num_rows() > 0){
			$row_chk = $res_chk->result();
			$result['funeralId'] = $row_chk[0]->funeralId;
			$result['name'] = $row_chk[0]->name;
			$result['dateOfBirth'] = $row_chk[0]->dateOfBirth;
			$result['dateOfDeath'] = $row_chk[0]->dateOfDeath;
			$result['hostId'] = $row_chk[0]->hostId;
			$result['hostEmailId'] = $row_chk[0]->hostEmailId;
			$result['hostFirstName'] = $row_chk[0]->hostFirstName;
			$result['hostLastName'] = $row_chk[0]->hostLastName;
			$result['createdTime'] = $row_chk[0]->createdTime;
			$result['profileImage'] = $row_chk[0]->profileImage;
			$result['serviceTypeId'] = $row_chk[0]->serviceTypeId;
			$result['invitationCode'] = $row_chk[0]->invitationCode;
			$result['about'] = $row_chk[0]->about;
			$result['guests'] = $this->getGuestList($result['funeralId']);
			$result['other_details']= $this->getFuneralAdditionalDetails($result['funeralId']);
			
            
   
			return $result;
			}else 
			{
			return null;
			}
			
			
    }
    
    private function getGuestList($funeralId)
    {
    
    		$this->db->select("{$this->funeral_guests_table}.*");
			$this->db->where('funeralId', $funeralId);
			$res_chk = $this->db->get($this->funeral_guests_table);
			if($res_chk->num_rows() > 0){
			return $res_chk->result_array();
			}
    		return array();
    }
    
    private function getFuneralAdditionalDetails($funeralId)
    {
    		$this->db->select("{$this->funeral_attribute_table}.*, {$this->attributestype_table}.name");
    		
    		$this->db->join($this->attributestype_table,"{$this->attributestype_table}.attributeTypeId = .". $this->funeral_attribute_table.'.attributeTypeId');		
			
			$this->db->where('funeralId', $funeralId);
			$res_chk = $this->db->get($this->funeral_attribute_table);
			$attributeResult = $this->db->get($this->attributestype_table);
			$additionalDetails = array();
			if ($res_chk->num_rows() > 0 && $attributeResult->num_rows() > 0)
			{
			
				foreach ($attributeResult->result() as $attribute)
   				{
   					$tempArray = array();
   					foreach ($res_chk->result() as $row)
   					{
   						if($row->attributeTypeId == $attribute->attributeTypeId)
   						{
   					 	array_push($tempArray, $row->value);
   						}
     			 	
   					}
   				$additionalDetails[$attribute->name]= $tempArray;	
   				}	
   				
   				return $additionalDetails;
			}
			return $additionalDetails;
    }
    
    public function uploadGalleryImage($param)
    {
    	$result = $this->uploadImage($param);
    
    	if($result)
    	{
    	$fields = array();
		$fields['createdBy'] = $param['userId'];
		$fields['funeralId'] =$param['funeralId'];
		$fields['title'] = $param['title'];
		if(strcasecmp('video',$param['mediaType'])==0)
		$fields['isVideo'] = 1;
		
		$fields['createdTime'] = date('Y-m-d H:i:s');
		$fields['uri']= $result['uri'] ;
		$fields['uri_thumb'] = $result['uri_thumb'] ;
		
    	$res_ins = $this->db->insert($this->gallery_table, $fields);
				if($res_ins){
				
				$result['message'] = "success";
				$result['status'] = 200;
				}else{
				$result['message'] = "There is something wrong, try after sometime.";
				$result['status'] = 202;
				}
				
		}	
		
		return $result;	
    }
    
    
    public function postJournal($param)
    {
    	
    	$fields = array();
		$fields['createdBy'] =$param['userId'];
		$fields['funeralId'] =$param['funeralId'];
		$fields['title'] = $param['title'];
		$fields['description'] = $param['description'];
		
		$fields['createdTime'] = date('Y-m-d H:i:s');
		
    	$res_ins = $this->db->insert($this->journal_table, $fields);
			if($res_ins){
				
				$result['message'] = "success";
				$result['status'] = 200;
			}else{
				$result['message'] = "There is something wrong, try after sometime.";
				$result['status'] = 202;
			}
		
		return $result;	

    }
    /**
	* Function to delete message
	*
	* @author	Shashank
	* @param	array
	* @return	array
	*/
   public function updateJournal($param)
    {
    	
    	$fields = array();
		$fields['createdBy'] = $param['userId'];
		$fields['title'] = $param['title'];
		$fields['description'] = $param['description'];
		$fields['createdTime'] = date('Y-m-d H:i:s');

		$this->db->select("{$this->journal_table}.createdBy");
		$this->db->where('id', $param['id']);
		$res = $this->db->get($this->journal_table);
		$resp=$res->result();
		$userId=$resp[0]->createdBy;
		if($userId == $fields['createdBy']) {
    	$this->db->where("{$this->journal_table}.id",$param['id']);
        $res_ins = $this->db->update($this->journal_table, $fields);
			if($res_ins){
				
				$result['message'] = "success";
				$result['status'] = 200;
			} else {
				$result['message'] = "There is something wrong, try after sometime.";
				$result['status'] = 202;
			}
		} else{
				$result['message'] = "you are no able to update the journal";
				$result['status'] = 202;
		}		
		
		
		return $result;	
    }
    

    /**
	* Function to delete message
	*
	* @author	Shashank
	* @param	array
	* @return	array
	*/
	public function delete_journal($param)
	{	
		$fields = array();	
		$fields['id'] = $param['id'];
		$this->db->select("{$this->journal_table}.createdBy");
		$this->db->where('id', $param['id']);
		$res = $this->db->get($this->journal_table);
		$resp=$res->result();
		$userId=$resp[0]->createdBy;
		if($userId == $param['userId']) {

		$res_ins = $this->db->delete($this->journal_table, $fields);
		if($res_ins){
			$result['message'] = "success";
			$result['status'] = 200;
		}else{
			$result['message'] = "There is something wrong, try after sometime.";
			$result['status'] = 202;
		}
		} else{
			$result['message'] = "you are no able to update the journal";
			$result['status'] = 202;
		}		
		return $result;
	}

	/**
	* Function to Journal list 
	*
	* @author	Shashank
	* @param	none
	* @return	array
	*/	
    public function get_journal($data)
    {        
        if(isset($data))
        {
        	$this->db->select("{$this->journal_table}.*");
			$this->db->where('funeralId', $data['funeralId']);
			$this->db->where('createdBy', $data['userId']);
			$result = $this->db->get($this->journal_table);
			return $result->result_array();
        }
    }

    /**
	* Function to Journal list 
	*
	* @author	Shashank
	* @param	none
	* @return	array
	*/	
    public function journal_detail($id)
    {        
        if(isset($id))
        {
        	$this->db->select("{$this->journal_table}.*");
			$this->db->where('id', $id);
			$result = $this->db->get($this->journal_table);
			return $result->result_array();
        }
    }
    
    /**
	* Function to serviceType list 
	*
	* @author	Shashank
	* @param	none
	* @return	array
	*/	
    
    public function get_service()
    {        
        $this->db->select("{$this->service_table}.*");
	    $result = $this->db->get($this->service_table);
		return $result->result_array();
        
    }
   
    /**
	* Function to eventType list
	*
	* @author	Shashank
	* @param	none
	* @return	array
	*/	

    public function get_eventType()
    {        
        $this->db->select("{$this->event_type_table}.*");
		$result = $this->db->get($this->event_type_table);
		return $result->result_array();
        
    }
    /**
	* Function to get funeralId by invitationCode
	*
	* @author	Shashank
	* @param	none
	* @return	array
	*/	

    public function get_funeralId($code)
    {        
        $this->db->select("{$this->funeral_table}.funeralId");
		$this->db->where('invitationCode', $code);
		$result = $this->db->get($this->funeral_table);
		return $result->result_array();
        
    }

    /**
	* Function to get funeralId by invitationCode
	*
	* @author	Shashank
	* @param	none
	* @return	array
	*/	

    public function get_event($funeralId)
    {        
        $this->db->select("{$this->event_table}.*");
		$this->db->where('funeralId', $funeralId);
		$this->db->order_by('eventTypeId','asc');
        $result = $this->db->get($this->event_table);
		return $result->result_array();
        
    }
    
	/**
	* Function to Upload Image
	*
	* @author	MP
	* @param	array
	* @return	array
	*/	
	public function uploadImage($param)
	{
		
		if(!empty($_FILES['imageUrl']['name'])){
			$result = array();
			$target_path = $param['basePath'];
			$target_path = $target_path .time().'_' . basename( $_FILES['imageUrl']['name']); 
			$img_resp = move_uploaded_file($_FILES['imageUrl']['tmp_name'], $target_path);
			if($img_resp){
			$target_thumb_path = $param['basePath'];
		    $target_thumb_path = $target_thumb_path .time().'_thumb_' . basename( $_FILES['imageUrl']['name']); 
				if(strcasecmp('video',$param['mediaType'])==0)
				{
					$ffmpeg = FFMPEG_PATH;
					$interval = 1; // At what time the screenshot to be taken after video is started 
					$size = '300x300'; // dimension of the image 
					$target_thumb_path2 = $target_thumb_path.".jpg";
					$cmd = "$ffmpeg -i $target_path -deinterlace -an -ss $interval -f mjpeg -r 1 -y -s $size $target_thumb_path2 2>&1"; 
					//$ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -vf transpose=1 -r 1 -y -s $size $image 2>&1
					shell_exec($cmd);
					if(file_exists($target_thumb_path2)){
						$result['uri_thumb'] = $target_thumb_path2;
					}else{					
						$result['uri_thumb'] = IMAGE_PATH."default.png";
					}
				} else if(strcasecmp('image',$param['mediaType'])==0) {
					createThumbs($target_path,$target_thumb_path,300);
					if(file_exists($target_thumb_path)){
					 $result['uri_thumb'] = $target_thumb_path;

					} else {
						$result['uri_thumb'] = IMAGE_PATH."default.png";
					}
				} else {
					$result['uri_thumb'] = IMAGE_PATH."default.png";
				}
				$result['uri'] = $target_path;
			}
			
		}
		return $result;
	}

	/**
	* Function to create funeral 
	*
	* @author	Shashank
	* @param	none
	* @return	array
	*/	
	public function add_funeral($param)
	{
		$fields = array();
		$fields['hostId'] = $param['userId'];
		$fields['name']   = $param['name'];
		$fields['dateOfBirth'] = $param['dateOfBirth'];
		$fields['dateOfDeath'] = $param['dateOfDeath'];
		$fields['createdTime'] = date('Y-m-d H:i:s');
		$fields['serviceTypeId'] = $param['serviceType'];
		$fields['about'] = $param['about'];
		$fields['invitationCode'] =$this->getNewInvitationCode();
		if(!empty($_FILES['imageUrl']['name'])){
			$target_path = $param['basePath'];

            $target_path = $target_path .time().'_'.basename(str_replace(' ', '_', $_FILES['imageUrl']['name'])); 
			$img_resp = move_uploaded_file($_FILES['imageUrl']['tmp_name'], $target_path);
			if($img_resp){
				$fields['profileImage'] = $target_path;
			} else {
				$result['message'] = "There is something wrong, try after sometime.";
			    $result['status'] = 202;
			}

		}	
		
		$res_ins = $this->db->insert($this->funeral_table, $fields);
		$last_id =$this->db->insert_id();
		if(isset($param['familyMember'])){
			foreach($param['familyMember'] as $val)
			{
				$fields1['funeralId']=$last_id;
				$fields1['value']=$val;
				$fields1['attributeTypeId']=1;
				$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
			}
	    }
	    if(isset($param['pallBearers'])){
			foreach($param['pallBearers'] as $val)
			{
				$fields1['funeralId']=$last_id;
				$fields1['value']=$val;
				$fields1['attributeTypeId']=2;
				$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
			}
	    }
	    if(isset($param['officient'])){
			foreach($param['officient'] as $val)
			{
				$fields1['funeralId']=$last_id;
				$fields1['value']=$val;
				$fields1['attributeTypeId']=3;
				$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
			}
	    }
	    if(isset($param['eulogy'])){
			foreach($param['eulogy'] as $val)
			{
				$fields1['funeralId']=$last_id;
				$fields1['value']=$val;
				$fields1['attributeTypeId']=4;
				$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
			}
	    }
	    if(isset($param['song'])){
			foreach($param['song'] as $val)
			{
				$fields1['funeralId']=$last_id;
				$fields1['value']=$val;
				$fields1['attributeTypeId']=5;
				$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
			}
	    }
	    if(isset($param['reading'])){
			foreach($param['reading'] as $val)
			{
				$fields1['funeralId']=$last_id;
				$fields1['value']=$val;
				$fields1['attributeTypeId']=6;
				$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
			}
	    }
	    if(isset($param['event'])){
			foreach($param['event'] as $key=>$val)
			{
				$fields2['funeralId']=$last_id;
				$fields2['eventTypeId']=$val['eventTypeId'];
				$fields2['time']=$val['time'];
				$fields2['locationName']=$val['locationName'];
				$fields2['address']=$val['address'];
				$fields2['notes']=$val['notes'];
				$fields2['latitude']=$val['latitude'];
				$fields2['longitude']=$val['longitude'];
				$res_ins = $this->db->insert($this->event_table, $fields2);
			}
	    }
	    foreach($param['guest'] as $val)
	    {
	    	$name = $param['name'];
	    	$fields3['emailId']=$val;
			$fields3['funeralId']=$last_id;
	    	$res_ins = $this->db->insert($this->funeral_guests_table, $fields3);
	    	$this->send_invitation($val,$name,$fields['invitationCode']);

	    }
	    

		if($res_ins){
			$result['funeralDetail'] = $this->get_funeral_detail_by_funeral_id($last_id);
			$result['message'] = "You have successfully created a memory for ".$fields['name'];
			$result['status'] = 200;
		}else{
			$result['message'] = "There is something wrong, try after sometime.";
			$result['status'] = 202;
		}
		return $result;
	}



    public function send_notification($deviceToken, $funeralId, $message, $type){
		$sendNotificationParam['deviceToken'] = $deviceToken;
		$sendNotificationParam['message'] = $message;
		$sendNotificationParam['funeralId'] = $funeralId;
		$sendNotificationParam['notificationType'] = $type;
		push_notification_ios($sendNotificationParam);
		
	}
		
	
	
 
	/**
	* Function to update funeral 
	*
	* @author	Shashank
	* @param	none
	* @return	array
	*/	
	public function update_funeral($param)
	{
		$fields = array();
		$fields['funeralId'] =$param['funeralId'];
		$fields['hostId'] = $param['userId'];
		$fields['name']   = $param['name'];
		$fields['dateOfBirth'] = $param['dateOfBirth'];
		$fields['dateOfDeath'] = $param['dateOfDeath'];
		$fields['createdTime'] = date('Y-m-d H:i:s');
		$fields['serviceTypeId'] = $param['serviceType'];
		$fields['about'] = $param['about'];

		$this->db->select("{$this->funeral_table}.invitationCode");
		$this->db->where('funeralId', $param['funeralId']);
		$res = $this->db->get($this->funeral_table);
		$invitation_code = $res->result_array();
		$fields['invitationCode'] =$invitation_code[0]['invitationCode'];
		if(!empty($_FILES['imageUrl']['name'])){
			$target_path = $param['basePath'];

            $target_path = $target_path .time().'_'.basename(str_replace(' ', '_', $_FILES['imageUrl']['name'])); 
			$img_resp = move_uploaded_file($_FILES['imageUrl']['tmp_name'], $target_path);
			if($img_resp){
				$fields['profileImage'] = $target_path;
			} else {
				$result['message'] = "There is something wrong, try after sometime.";
			    $result['status'] = 202;
			}

		}	
		$res_ins = $this->db->where('funeralId', $fields['funeralId']);
		$res_ins = $this->db->update($this->funeral_table, $fields);
		if(isset($param['familyMember'])){
			$res_ins = $this->db->delete($this->funeral_attribute_table, array('funeralId' =>$fields['funeralId'],'attributeTypeId'=>1));
			if($res_ins) {

				foreach($param['familyMember'] as $val)
				{
					$fields1['funeralId']=$fields['funeralId'];
					$fields1['value']=$val;
					$fields1['attributeTypeId']=1;
					$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
				}
			}	

	    }
	    if(isset($param['pallBearers'])){
			$res_ins = $this->db->delete($this->funeral_attribute_table, array('funeralId' =>$fields['funeralId'],'attributeTypeId'=>2));
			if($res_ins) {

				foreach($param['pallBearers'] as $val)
				{
					$fields1['funeralId']=$fields['funeralId'];
					$fields1['value']=$val;
					$fields1['attributeTypeId']=2;
					$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
				}
			}	
	    }
	    if(isset($param['officient'])){
			$res_ins = $this->db->delete($this->funeral_attribute_table, array('funeralId' =>$fields['funeralId'],'attributeTypeId'=>3));
			if($res_ins) {

				foreach($param['officient'] as $val)
				{
					$fields1['funeralId']=$fields['funeralId'];
					$fields1['value']=$val;
					$fields1['attributeTypeId']=3;
					$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
				}
			}	
	    }
	    if(isset($param['eulogy'])){
			$res_ins = $this->db->delete($this->funeral_attribute_table, array('funeralId' =>$fields['funeralId'],'attributeTypeId'=>4));
			if($res_ins) {

				foreach($param['eulogy'] as $val)
				{
					$fields1['funeralId']=$fields['funeralId'];
					$fields1['value']=$val;
					$fields1['attributeTypeId']=4;
					$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
				}
			}	
	    }
	    if(isset($param['song'])){
			$res_ins = $this->db->delete($this->funeral_attribute_table, array('funeralId' =>$fields['funeralId'],'attributeTypeId'=>5));
			if($res_ins) {

				foreach($param['song'] as $val)
				{
					$fields1['funeralId']=$fields['funeralId'];
					$fields1['value']=$val;
					$fields1['attributeTypeId']=5;
					$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
				}
			}	
	    }
	    if(isset($param['reading'])){
			$res_ins = $this->db->delete($this->funeral_attribute_table, array('funeralId' =>$fields['funeralId'],'attributeTypeId'=>6));
			if($res_ins) {

				foreach($param['reading'] as $val)
				{
					$fields1['funeralId']=$fields['funeralId'];
					$fields1['value']=$val;
					$fields1['attributeTypeId']=6;
					$res_ins = $this->db->insert($this->funeral_attribute_table, $fields1);
				}
			}	
	    }
	    
	    if(isset($param['event'])){
	    	if($res_ins) {
				foreach($param['event'] as $key=>$val)
				{	
					$fields2['funeralId']=$fields['funeralId'];
					$fields2['eventTypeId']=$val['eventTypeId'];
					$fields2['time']=$val['time'];
					$fields2['locationName']=$val['locationName'];
					$fields2['address']=$val['address'];
					$fields2['notes']=$val['notes'];
					$fields2['latitude']=$val['latitude'];
					$fields2['longitude']=$val['longitude'];

					$this->db->select("{$this->event_table}.*");
					$this->db->where('funeralId', $fields['funeralId']);
					$this->db->where('eventTypeId', $val['eventTypeId']);
					$res_chk=$this->db->get($this->event_table);

					if($res_chk->num_rows() > 0){
						$res=$res_chk->result_array();
						if(($res[0]['time'] != $fields2['time']) || ($res[0]['address'] != $fields2['address']) || ($res[0]['locationName'] != $fields2['locationName']) ||($res[0]['notes'] != $fields2['notes']) ){
							$this->db->where('funeralId', $fields['funeralId']);
							$this->db->where('eventTypeId', $val['eventTypeId']);
							$res_ins = $this->db->update($this->event_table, $fields2);
 							$id = $fields['funeralId'];
 							$sql="SELECT u.* , us.isScheduleNotification, us.isMemoryNotification, ud.deviceToken FROM `user_devices` ud JOIN `users` u on u.userId = ud.userId join `funeral_guests` fg on fg.emailId = u.emailId join `user_settings` us on us.userId= u.userId where fg.funeralId=".$id." and  us.isScheduleNotification =1";
							$res_chk = $this->db->query($sql);
							$type = 1;	
							$message = 'Schedule of funeral of ' .$param['name']. ' is updated ';
							if($res_chk->num_rows() > 0){

								$row_chk = $res_chk->result_array();
								foreach ($row_chk as $val) {
									     $this->send_notification($val['deviceToken'], $id,  $message, $type);
								}
							}

							$this->db->select("{$this->anonymous_table}.*");
							$this->db->where('funeralId', $fields['funeralId']);
							$resu = $this->db->get($this->anonymous_table);
							if($resu->num_rows() > 0){
								 $data = $resu->result_array();
								foreach ($data as $val) {
									     $this->send_notification($val['deviceToken'], $id,  $message, $type);
								}

							}	

						}
							
					}else{

						$id=$fields['funeralId'];
						$sql="SELECT u.* , us.isScheduleNotification, us.isMemoryNotification, ud.deviceToken FROM `user_devices` ud JOIN `users` u on u.userId = ud.userId join `funeral_guests` fg on fg.emailId = u.emailId join `user_settings` us on us.userId= u.userId where fg.funeralId=".$id." and  us.isScheduleNotification =1";
						$res_chk = $this->db->query($sql);
						$type = 1;
						$message = 'Schedule of funeral of ' .$param['name']. ' is updated ';
						if($res_chk->num_rows() > 0){

							$row_chk = $res_chk->result_array();
							foreach ($row_chk as $val) {
								     $this->send_notification($val['deviceToken'],$id, $message, $type);
							}
						} 
						$res_ins = $this->db->insert($this->event_table, $fields2);

						$this->db->select("{$this->anonymous_table}.*");
						$this->db->where('funeralId', $fields['funeralId']);
						$resu = $this->db->get($this->anonymous_table);
						if($resu->num_rows() > 0){
							 $data = $resu->result_array();
							foreach ($data as $val) {
								     $this->send_notification($val['deviceToken'], $id,  $message, $type);
							}

						}
					}
				}
			}
	    }
	    if(isset($param['guest'])){
		    foreach($param['guest'] as $val)
		    {
		    	$name = $param['name'];
		    	$fields3['emailId']=$val;
		    	$fields3['funeralId']=$fields['funeralId'];
		    	$res_ins = $this->db->insert($this->funeral_guests_table, $fields3);
		    	$this->send_invitation($val,$name,$fields['invitationCode']);
		    }
			if($res_ins){
				$result['funeralDetail'] = $this->get_funeral_detail_by_funeral_id($fields['funeralId']);
				$result['message'] = "success";
				$result['status'] = 200;
			}else{
				$result['message'] = "There is something wrong, try after sometime.";
				$result['status'] = 202;
			} 

		}
		return $result;
	}


   /**
	* Function to send invitation code to guest
	*=======
	* @author	Shashank
	* @param	variable
	* @return	none
	*/
	public function send_invitation($emailId,$name,$code) 
	{
		$data['deceased_name'] = $name;
		$data['invitation_code'] = $code;
		$data['site_name'] = $this->config->item('site_name', 'user_auth');
		$data['name']='ElegyApp';
		$this->User_model->_send_email('invite', $emailId, $data, 'Celebrate the life of '.$data['deceased_name']);
		
		return $data['invitation_code'];
	}

	/**
	* Function to send email
	*
	* @author	Shashank
	* @param	view file type, email, array, subject
	* @return	none
	*/
	public function _send_email($type, $email, &$data, $subject = '')
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'user_auth'), $this->config->item('site_name', 'user_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'user_auth'), $this->config->item('site_name', 'user_auth'));
		$this->email->set_mailtype("html");
		$this->email->to($email);
		
		if($subject != '')
		{
			$this->email->subject($subject);
		}
		else
		{
			$this->email->subject($this->config->item('site_name', 'user_auth'));
		}		
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));		
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}
    
     /**
	* Function to get program detail
	*
	* @author        Shashank
	* @param         var
	* @return        array
	*/

    private function get_program_detail($res_chk)
    {
    		
		
		$row_chk = $res_chk->result();
		
		$result['funeralId'] = $row_chk[0]->funeralId;
		$result['name'] = $row_chk[0]->name;
		$result['dateOfBirth'] = $row_chk[0]->dateOfBirth;
		$result['dateOfDeath'] = $row_chk[0]->dateOfDeath;
		$result['firstName'] = $row_chk[0]->firstName;
		$result['lastName'] = $row_chk[0]->lastName;
		$result['other_details']= $this->getFuneralAdditionalDetails($result['funeralId']);
		return $result;
		
			
			
    }

     /**
	* Function to get funeral
	*
	* @author        Shashank
	* @param         var
	* @return        array
	*/
    public function get_funeral($funeralId)
    {        
        if(isset($funeralId))
        {
        	$this->db->select("{$this->funeral_table}.funeralId,name,dateOfBirth,dateOfDeath ,{$this->user_table}.firstName,lastName");
    		$this->db->join($this->user_table,"{$this->user_table}.userId = .". $this->funeral_table.'.hostId');		
			$this->db->where('funeralId', $funeralId);
         	$res_chk=$this->db->get($this->funeral_table);
		    if($res_chk->num_rows() > 0){
				return $this->get_program_detail($res_chk);
        	} else {
		        return null;
			}
        }
    }
    
    /**
	* Function to get funeral schedule
	*
	* @author        Shashank
	* @param         var
	* @return        array
	*/

    public function get_funeral_schedule($funeralId)
    {
	    $this->db->select("{$this->event_table}.*,{$this->event_type_table}.eventType");
    	$this->db->join($this->event_type_table,"{$this->event_type_table}.eventTypeId = .". $this->event_table.'.eventTypeId');		
		$this->db->where('funeralId', $funeralId);
		$res_chk = $this->db->get($this->event_table);
        if($res_chk->num_rows() > 0)
	    
	    {	
	        return $res_chk->result_array();
        } else {
        	return null;
        }
    }

    /**
	* Function to Counting the number of pets
	*
	* @author        Shashank
	* @param         var
	* @return        array
	*/
    public function record_count_funeral($searchStr = null,$param) 
	{
		
		$hostId = $param['userId'];
		$emailId = $param['email']->emailId;
        if(!empty($searchStr)) {
	       $srchcond="and (funeral.name LIKE '%".$searchStr."%')";
	        $sql="SELECT funeral.* FROM funeral, funeral_guests WHERE hostId = $hostId $srchcond UNION SELECT funeral.* FROM funeral, funeral_guests WHERE funeral.funeralId = funeral_guests.funeralId and emailId = '".$emailId."' $srchcond ";
	        $response = $this->db->query($sql);
	        $count = $response->num_rows();
	        return $count;
		} else {
	        $sql="SELECT funeral.* FROM funeral, funeral_guests WHERE hostId = $hostId  UNION SELECT funeral.* FROM funeral, funeral_guests WHERE funeral.funeralId = funeral_guests.funeralId and emailId = '".$emailId."' ";
	        $response = $this->db->query($sql);
	        $count = $response->num_rows();
	        return $count;
	    }
    }

    /**
	* Function to LISTING
	*
	* @author        Shashank
	* @param         var,var,var
	* @return        array
	*/
    public function all_funeral($limit, $start,$searchStr=null,$param)
	{        
		if($start!=0){
		 	$start = (($start-1) * $limit);
		}  
	    $hostId = $param['userId'];
		$emailId = $param['email']->emailId;
        if(!empty($searchStr)){
	       	$srchcond="and (funeral.name LIKE '%".$searchStr."%')";
	        $sql="SELECT funeral.* FROM funeral, funeral_guests WHERE hostId = $hostId $srchcond UNION SELECT funeral.* FROM funeral, funeral_guests WHERE funeral.funeralId = funeral_guests.funeralId and emailId = '".$emailId."' $srchcond ";
	        $response = $this->db->query($sql);               
			return $response->result_array();
		} else {
	        $sql="SELECT funeral.* FROM funeral, funeral_guests WHERE hostId = $hostId  UNION SELECT funeral.* FROM funeral, funeral_guests WHERE funeral.funeralId = funeral_guests.funeralId and emailId = '".$emailId."' ";
	        $response = $this->db->query($sql);               
			return $response->result_array();
	    }
	}

    /**
	* Function to get pet Size
	*
	* @author       Shashank
	* @param        none
	* @return       array
	*/
	public function get_serviceType()
	{
		$this->db->select("{$this->service_table}.*");
		$query = $this->db->get($this->service_table);
		$servicelist = array();
		$servicelist[''] = 'Select Service';
		if ($query->num_rows() > 0) {
				foreach($query->result() as $serviceType) {
						$servicelist[$serviceType->serviceTypeId] = $serviceType->serviceType;
				}
		}
		return $servicelist;
	}
	
	/**
	* Function to create funeral 
	*
	* @author	Shashank
	* @param	none
	* @return	array
	*/	
	public function create_feed($param)
	{
		$fields = array();
		$fields['createdBy'] = $param['userId'];
		if(isset($param['text'])){
		$fields['text']   = $param['text'];
		}
		$fields['funeralId'] = $param['funeralId'];
		$fields['createdTime'] = date('Y-m-d H:i:s');
		if(isset($param['mediaType'])){
			if(strcasecmp('video',$param['mediaType'])==0)
				$fields['mediaType'] = 'video';
			else {
				$fields['mediaType'] = 'image';
			}
		}

		if(!empty($_FILES['imageUrl']['name'])){
			$target_path = $param['basePath'];
			$target_path = $target_path .time().'_' . basename( $_FILES['imageUrl']['name']); 
			$img_resp = move_uploaded_file($_FILES['imageUrl']['tmp_name'], $target_path);
			if($img_resp){
			$target_thumb_path = $param['basePath'];
		    $target_thumb_path = $target_thumb_path .time().'_thumb_' . basename( $_FILES['imageUrl']['name']); 
				if(strcasecmp('video',$param['mediaType'])==0){
					$ffmpeg = FFMPEG_PATH;
					$interval = 1; // At what time the screenshot to be taken after video is started 
					$size = '300x300'; // dimension of the image 
					$target_thumb_path2 = $target_thumb_path.".jpg";
					$cmd = "$ffmpeg -i $target_path -deinterlace -an -ss $interval -f mjpeg -vf transpose=1 -r 1 -y -s $size $target_thumb_path2 2>&1"; 
					//$ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -vf transpose=1 -r 1 -y -s $size $image 2>&1
					shell_exec($cmd);
					$fields['thumb_URL'] = $target_thumb_path2;
				} else if(strcasecmp('image',$param['mediaType'])==0) {

					createThumbs($target_path,$target_thumb_path,300);
					if(file_exists($target_thumb_path)){
						$fields['thumb_URL'] = $target_thumb_path;
						
					} 
				}
				$fields['media_URL'] = $target_path;
			}
			
			
			
		}
		$res_ins = $this->db->insert($this->feed_table, $fields);
		$last_id =$this->db->insert_id();
		$hostId=$this->get_HostId($param['funeralId']);
		$data = $this->get_funeral_detail_by_funeral_id($param['funeralId']);
		$name =$data['name'];
		$type = 2;
		if($hostId == $param['userId']) {
			
			$funeralId = $param['funeralId'];
			$sql="SELECT u.* , us.isScheduleNotification, us.isMemoryNotification, ud.deviceToken FROM `user_devices` ud JOIN `users` u on u.userId = ud.userId join `funeral_guests` fg on fg.emailId = u.emailId join `user_settings` us on us.userId= u.userId where fg.funeralId=".$funeralId." and  us.isMemoryNotification =1";
			$res_chk = $this->db->query($sql);
			$message = 'A new thought is submitted for ' .$name.'';
			
			if($res_chk->num_rows() > 0) {

				$row_chk = $res_chk->result_array();
				foreach ($row_chk as $val) {
					     
						$this->send_notification($val['deviceToken'],$funeralId, $message, $type);
					    
					
				}
			}

		   	$this->db->select("{$this->anonymous_table}.*");
			$this->db->where('funeralId', $fields['funeralId']);
			$resu = $this->db->get($this->anonymous_table);
			if($resu->num_rows() > 0){
				$data = $resu->result_array();
				foreach ($data as $val) {
					$this->send_notification($val['deviceToken'], $funeralId,  $message, $type);
				}

			} 
		} else {
			
			$funeralId = $param['funeralId'];
			$sql="SELECT u.* , us.isScheduleNotification, us.isMemoryNotification, ud.deviceToken FROM `user_devices` ud JOIN `users` u on u.userId = ud.userId join `funeral_guests` fg on fg.emailId = u.emailId join `user_settings` us on us.userId= u.userId where fg.funeralId=".$funeralId." and  us.isMemoryNotification =1";
			$res_chk = $this->db->query($sql);
			$message = 'A new thought is submitted for ' .$name.'';
			
			if($res_chk->num_rows() > 0){

				$row_chk = $res_chk->result_array();
				foreach ($row_chk as $val) {
					     
						$this->send_notification($val['deviceToken'],$funeralId, $message, $type);
				}
            }

            	$this->db->select("{$this->anonymous_table}.*");
				$this->db->where('funeralId', $fields['funeralId']);
				$resu = $this->db->get($this->anonymous_table);
				if($resu->num_rows() > 0){
					$data = $resu->result_array();
					foreach ($data as $val) {
						     $this->send_notification($val['deviceToken'], $funeralId,  $message, $type);
					}

				} 

           
            $this->db->select("{$this->user_device_table}.deviceToken");
			$this->db->where('userId',$hostId);
			$respo = $this->db->get($this->user_device_table);
			if($respo->num_rows() > 0){
				$response=$respo->result();
				$deviceToken=$response[0]->deviceToken;
				$this->send_notification($deviceToken, $funeralId, $message, $type);
			}
		}	
		if($res_ins){
				
				$result['feedDetail'] = $this->get_feed_by_feedId($last_id);
				$result['message'] = "success";
				$result['status'] = 200;
			}else{
				$result['message'] = "There is something wrong, try after sometime.";
				$result['status'] = 202;
			}
		
		return $result;	
	}


	/**
	* Function to get funeral schedule
	*
	* @author        Shashank
	* @param         var
	* @return        array
	*/

    public function get_feed_by_feedId($id)
    {
	    $this->db->select("{$this->feed_table}.*,{$this->user_table}.firstName,lastName");
    	$this->db->join($this->user_table,"{$this->user_table}.userId = .". $this->feed_table.'.createdBy');		
		$this->db->where('feedId', $id);
		$res_chk = $this->db->get($this->feed_table);
        return $res_chk->result_array();
       
    }


	/**
	* Function to get funeral schedule
	*
	* @author        Shashank
	* @param         var
	* @return        array
	*/

    public function get_feed($funeralId)
    {
	    $this->db->select("{$this->feed_table}.*,{$this->user_table}.firstName,lastName");
    	$this->db->join($this->user_table,"{$this->user_table}.userId = .". $this->feed_table.'.createdBy');		
		$this->db->where('funeralId', $funeralId);
		$this->db->order_by("{$this->feed_table}.createdTime", "desc");
		$res_chk = $this->db->get($this->feed_table);
        if($res_chk->num_rows() > 0)
	    
	    {	
	        return $res_chk->result_array();
        } else {
        	return null;
        }
    }


    /**
	* Function to delete message
	*
	* @author	Shashank
	* @param	array
	* @return	array
	*/
	public function delete_feed($param)
	{	
		$fields = array();
		$fields['funeralId']= $param['funeralId'];	
		$fields['feedId'] = $param['id'];
		$this->db->select("{$this->feed_table}.createdBy");
		$this->db->where('feedId', $param['id']);
		$res = $this->db->get($this->feed_table);
		$resp=$res->result();
		$this->db->select("{$this->funeral_table}.hostId");
		$this->db->where('funeralId', $param['funeralId']);
		$respo = $this->db->get($this->funeral_table);
		$response=$respo->result();
		$hostId=$response[0]->hostId;
		$userId=$resp[0]->createdBy;
		if($userId == $param['userId']) {
			$res_ins = $this->db->delete($this->feed_table, $fields);
		if($res_ins){
			$result['message'] = "success";
			$result['status'] = 200;
		}else{
			$result['message'] = "There is something wrong, try after sometime.";
			$result['status'] = 202;
		}
		}elseif($hostId == $param['userId']) { 
			$res_ins = $this->db->delete($this->feed_table, $fields);
			if($res_ins){
				$result['message'] = "success";
				$result['status'] = 200;
			}else{
				$result['message'] = "There is something wrong, try after sometime.";
				$result['status'] = 202;
			}
		}else {
			$result['message'] = "You Are Not Delete This Feed";
			$result['status'] = 202;
		}		
		return $result;
	}

	/**
	* Function to delete message
	*
	* @author	Shashank
	* @param	array
	* @return	array
	*/
	public function delete_gallery($param)
	{	
		$fields = array();
		$fields['funeralId']= $param['funeralId'];	
		$fields['id'] = $param['id'];
		$this->db->select("{$this->gallery_table}.createdBy");
		$this->db->where('id', $param['id']);
		$res = $this->db->get($this->gallery_table);
		$resp=$res->result();
		$this->db->select("{$this->funeral_table}.hostId");
		$this->db->where('funeralId', $param['funeralId']);
		$respo = $this->db->get($this->funeral_table);
		$response=$respo->result();
		$hostId=$response[0]->hostId;
		$userId=$resp[0]->createdBy;
		if($userId == $param['userId']) {
			$res_ins = $this->db->delete($this->gallery_table, $fields);
		if($res_ins){
			$result['message'] = "success";
			$result['status'] = 200;
		}else{
			$result['message'] = "There is something wrong, try after sometime.";
			$result['status'] = 202;
		}
		}elseif($hostId == $param['userId']) { 
			$res_ins = $this->db->delete($this->gallery_table, $fields);
			if($res_ins){
				$result['message'] = "success";
				$result['status'] = 200;
			}else{
				$result['message'] = "There is something wrong, try after sometime.";
				$result['status'] = 202;
			}
		}else {
			$result['message'] = "You Are Not Delete This Image";
			$result['status'] = 202;
		}		
		return $result;
	}

	public function get_HostId($id) {
		$this->db->select("{$this->funeral_table}.hostId");
		$this->db->where('funeralId', $id);
		$respo = $this->db->get($this->funeral_table);
		$response=$respo->result();
		$hostId=$response[0]->hostId;
		return $hostId;

	}

}
