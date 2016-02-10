<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Funeral extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Funeral_model');
		$this->load->model('User_model');
	}

 /**
	* Function to get list of funeral in which user invited or created by himself
	*
	* @author	KS
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function funerals_post()
	{ 
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } 
		else
        {
			$userTokenStatus = $this->User_model->check_usertoken_validation($data);
			if($userTokenStatus['status'] == 200)
			{
				$emailId=$this->User_model->get_email_by_userToken($data['userToken']);
				$result=$this->Funeral_model->get_funeral_list($emailId);
				if($result)
				{
				$response['funerals']= $result;
				$response['message'] = "Success";
            	$response['status'] = "200";
				$this->response($response, 200); // 200 being the HTTP response code
				}else
				{
				$response['message'] = "No Result found";
            	$response['status'] = "202";
				}
			}
			else
			{
				$this->response($userTokenStatus, 200); // 200 being the HTTP response code
			}	
        }	
	}
	
	
	 /**
	* Function to get detail of funeral 
	*
	* @author	KS
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function funeral_details_post()
	{ 
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array( 'invitationCode');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } else {
        
        	$result=$this->Funeral_model->get_funeral_detail_by_invitationCode($data['invitationCode']);
			if($result) {
				$response['funerals']= $result;
				$response['message'] = "Success";
            	$response['status'] = "200";
				$this->response($response, 200); // 200 being the HTTP response code
			}else {
				$response['message'] = "Please double check your code and try entering it again";
            	$response['status'] = "202";
            	$this->response($response, 200);
			}
			
        }
	
	}
	
	/**
	* Function to upload photo in gallery
	*
	* @author	MP
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function upload_gallery_image_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken','funeralId','title','mediaType');
		if(empty($_FILES['imageUrl']['name']))
		{
			$response['message'] = "Image not found.";
			$response['status'] = "201";
				
			$this->response($response, 200); // 200 being the HTTP response code
		}else
		{
			if(! mandatory_params_present($mandatory_key,$data,$missing_param))
			{
				$response['message'] = "missing mandatory parameter : $missing_param";
				$response['status'] = "201";
				
				$this->response($response, 200); // 200 being the HTTP response code
			} 
			else
			{
				$userTokenStatus = $this->User_model->check_usertoken_validation($data);
				if($userTokenStatus['status'] == 200)
				{
					$data['userId'] = $this->User_model->get_user_id($data['userToken']);
					$data['basePath']=GALLERY_IMAGE_PATH;
					$result = $this->Funeral_model->uploadGalleryImage($data);
					if($result)
					{
						$this->response($result, 200); // 200 being the HTTP response code
					}else
					{
					$response['message'] = "Something went wrong. Image could not upload";
					$response['status'] = "202";
				
					$this->response($response, 200); 
					}
				}
				else
				{
					$this->response($userTokenStatus, 200); // 200 being the HTTP response code
				}	
			}
		}
		
		 
	}
	
	/**
	* @author	MP
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function gallery_list_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('funeralId');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        }else
        {
        		$result=$this->Funeral_model->get_gallery($data['funeralId']);
				if($result)
				{
				
				$response['gallery']= $result;
				$response['message'] = "Success";
            	$response['status'] = "200";
				$this->response($response, 200); // 200 being the HTTP response code
				}else
				{
				$response['message'] = "No Result found";
            	$response['status'] = "202";
				}
        }
	}
	
	
	function add_journal_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken','funeralId', 'title', 'description');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        }else
        {
        
       			$userTokenStatus = $this->User_model->check_usertoken_validation($data);
				if($userTokenStatus['status'] == 200)
				{
					$data['userId'] = $this->User_model->get_user_id($data['userToken']);
					
					$result = $this->Funeral_model->postJournal($data);
					if($result)
					{   
						$result['journals'] = $this->Funeral_model->get_journal($data);
						$this->response($result, 200); // 200 being the HTTP response code
					}else
					{
					$response['message'] = "No result found";
					$response['status'] = "202";
				
					$this->response($response, 200); 
					}
				}
				else
				{
					$this->response($userTokenStatus, 200); // 200 being the HTTP response code
				}	
        
        }
	}
     
    /**
	* Function to delete message
	*
	* @author	Shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/		   
	function update_journal_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken','id','title','description');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        }else
        {
        
       			$userTokenStatus = $this->User_model->check_usertoken_validation($data);
				if($userTokenStatus['status'] == 200)
				{
					$data['userId'] = $this->User_model->get_user_id($data['userToken']);
					
					$result = $this->Funeral_model->updateJournal($data);
					if($result)
					{
						$this->response($result, 200); // 200 being the HTTP response code
					}else {
					$response['message'] = "No result found";
					$response['status'] = "202";
				
					$this->response($response, 200); 
					}
				}else {
					$this->response($userTokenStatus, 200); // 200 being the HTTP response code
				}	
        
        }
	}

    /**
	* Function to delete message
	*
	* @author	Shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function delete_journal_post()
	{ 
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken','id');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } 
		else
        {
			$userTokenStatus = $this->User_model->check_usertoken_validation($data);
			if($userTokenStatus['status'] == 200)
			{
				$data['userId'] = $this->User_model->get_user_id($data['userToken']);
				$journalResult = $this->Funeral_model->delete_journal($data);
				if($journalResult)
				{
					$this->response($journalResult, 200); // 200 being the HTTP response code
				}
			}
			else
			{
				$this->response($userTokenStatus, 200); // 200 being the HTTP response code
			}	
        }	
	}
	

	/**
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/

	
	function journal_list_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken','funeralId');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
        {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        }else
        {
        		
				
				$userTokenStatus = $this->User_model->check_usertoken_validation($data);
				if($userTokenStatus['status'] == 200)
				{
					$data['userId'] = $this->User_model->get_user_id($data['userToken']);
					
					$result = $this->Funeral_model->get_journal($data);
					if($result)
					{
					
						$response['journals']= $result;
						$response['message'] = "Success";
            			$response['status'] = "200";
						$this->response($response, 200); // 200 being the HTTP response code
					}else {
						$response['message'] = "No result found";
						$response['status'] = "200";
				
						$this->response($response, 200); 
					}
				}
				else
				{
					$this->response($userTokenStatus, 200); // 200 being the HTTP response code
				}	
				
        }
	}


	/**
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function add_funeral_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken','name','serviceTypeId','dateOfBirth','dateOfDeath','familyMember','pallBearers','guest' );
		if(empty($_FILES['imageUrl']['name'])) {
			$response['message'] = "Image not found.";
			$response['status'] = "201";
			$this->response($response, 200); // 200 being the HTTP response code
		} else {
			if(! mandatory_params_present($mandatory_key,$data,$missing_param))
	       {
	            $response['message'] = "missing mandatory parameter : $missing_param";
	           $response['status'] = "201";
				
				$this->response($response, 200); // 200 being the HTTP response code
	       } else {
        		$userTokenStatus = $this->User_model->check_usertoken_validation($data);
				if($userTokenStatus['status'] == 200)
				{
					$data['userId'] = $this->User_model->get_user_id($data['userToken']);
    				$data['basePath']=PROFILE_IMAGE_PATH;
	        		$result=$this->Funeral_model->add_funeral($data);
					if($result) {
						$response['funeralDetail']=$result['funeralDetail'];
						$response['message'] = "Success";
		            	$response['status'] = "200";
						$this->response($response, 200); // 200 being the HTTP response code
					} else {
						$response['message'] = "No Result found";
		            	$response['status'] = "202";
		            	$this->response($response, 200);
					}
				} else {
					$this->response($userTokenStatus, 200);
				}
	        }
	    }
	}
   

    /**
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function update_funeral_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		$mandatory_key = array('userToken','funeralId','name','serviceTypeId','dateOfBirth','dateOfDeath','familyMember','pallBearers','guest' );
		// 200 being the HTTP response code
		if(! mandatory_params_present($mandatory_key,$data,$missing_param)) {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			$this->response($response, 200); // 200 being the HTTP response code
	    } else {
    		$userTokenStatus = $this->User_model->check_usertoken_validation($data);
			if($userTokenStatus['status'] == 200)
			{
				$data['userId'] = $this->User_model->get_user_id($data['userToken']);
				$data['basePath']=PROFILE_IMAGE_PATH;
        		$result=$this->Funeral_model->update_funeral($data);
				if($result) {
					$response['funeralDetail']=$result['funeralDetail'];
					$response['message'] = "Success";
	            	$response['status'] = "200";
					$this->response($response, 200); // 200 being the HTTP response code
				} else {
					$response['message'] = "No Result found";
	            	$response['status'] = "202";
	            	$this->response($response, 200);
				}
			} else {
				$this->response($userTokenStatus, 200);
			}
        }
	   
	}



    /**
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/

	function get_funeral_detail_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('funeralId');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param)) {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } else {
        	$id = $data['funeralId'];
        	$result=$this->Funeral_model->get_funeral_detail_by_funeral_id($id);
        	if($result){
        		$result1=$this->Funeral_model->get_event($id);
            }   
        	if(!empty($result)){
				
				$response['funeral_detail']= $result;
				$response['events']= $result1;
				$response['message'] = "Success";
            	$response['status'] = "200";
				 // 200 being the HTTP response code
			} else {
				$response['message'] = "No Result found";
            	$response['status'] = "200";
			}
			$this->response($response, 200);
        }

	}
 
	/**
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function get_program_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('funeralId');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param)) {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } else {
        		$id = $data['funeralId'];
        		$result=$this->Funeral_model->get_funeral($id);

				if(!empty($result)){
				
					$response['program']= $result;
					$response['message'] = "Success";
	            	$response['status'] = "200";
					 // 200 being the HTTP response code
				} else {
					$response['message'] = "No Result found";
	            	$response['status'] = "202";
				}
				$this->response($response, 200);
        }
	}
	
    /**
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function funeral_schedule_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('funeralId');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param)) {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } else {
        		$id = $data['funeralId'];
        		$result=$this->Funeral_model->get_funeral_schedule($id);
        		
				if(!empty($result)){
					$response['event']= $result;
					$response['message'] = "Success";
	            	$response['status'] = "200";
					 // 200 being the HTTP response code
				} else {
					$response['message'] = "No Result found";
	            	$response['status'] = "202";
				} 
				$this->response($response, 200);
        }     
	}
	

	/**
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/

	function create_feed_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken','funeralId','text');
		
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
			{
				$response['message'] = "missing mandatory parameter : $missing_param";
				$response['status'] = "201";
				
				$this->response($response, 200); // 200 being the HTTP response code
			} 
			else
			{
				$userTokenStatus = $this->User_model->check_usertoken_validation($data);
				if($userTokenStatus['status'] == 200)
				{
					$data['userId'] = $this->User_model->get_user_id($data['userToken']);
					$data['basePath']=REMEMBRANCE_IMAGE_PATH;
					$result = $this->Funeral_model->create_feed($data);
					if($result)
					{
						$this->response($result, 200); // 200 being the HTTP response code
					}else
					{
					$response['message'] = "Something went wrong. Image could not upload";
					$response['status'] = "202";
				
					$this->response($response, 200); 
					}
				}
				else
				{
					$this->response($userTokenStatus, 200); // 200 being the HTTP response code
				}	
			}
		}
		
	
	 /**
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function get_feed_post()
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('funeralId');
				
		if(! mandatory_params_present($mandatory_key,$data,$missing_param)) {
            $response['message'] = "missing mandatory parameter : $missing_param";
            $response['status'] = "201";
			
			$this->response($response, 200); // 200 being the HTTP response code
        } else {
        		$id = $data['funeralId'];
        		$result=$this->Funeral_model->get_feed($id);

				if(!empty($result)){
				
					$response['feed']= $result;
					$response['message'] = "Success";
	            	$response['status'] = "200";
					 // 200 being the HTTP response code
				} else {
					$response['message'] = "No Result found";
	            	$response['status'] = "202";
				}
				$this->response($response, 200);
        }
	}
	

	/**
	* @author	shashank
	* @param	data JSON Array
	* @return	HTTP response JSON
	*/
	function delete_feed_post()
	
	{
		$x		= stripslashes($this->input->post('data'));
        $data	= json_decode($x,true);
		
		$mandatory_key = array('userToken','feedId');
		
		if(! mandatory_params_present($mandatory_key,$data,$missing_param))
			{
				$response['message'] = "missing mandatory parameter : $missing_param";
				$response['status'] = "201";
				
				$this->response($response, 200); // 200 being the HTTP response code
			} 
			else
			{
				$userTokenStatus = $this->User_model->check_usertoken_validation($data);
				if($userTokenStatus['status'] == 200)
				{
					$data['userId'] = $this->User_model->get_user_id($data['userToken']);
					$data['id']= $data['feedId'];
					$result = $this->Funeral_model->delete_feed($data);
					if($result)
					{
						$this->response($result, 200); // 200 being the HTTP response code
					}else
					{
					$response['message'] = "Something went wrong";
					$response['status'] = "202";
				
					$this->response($response, 200); 
					}
				}
				else
				{
					$this->response($userTokenStatus, 200); // 200 being the HTTP response code
				}	
			}
		}
		

}
?>
