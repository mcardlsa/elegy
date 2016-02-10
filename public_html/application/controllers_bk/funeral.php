<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Funeral extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('user_auth');
		$this->load->model('User_model');
		$this->load->model('Funeral_model');
		$this->load->library("pagination");
		$this->load->helper('text');
	}
	public function find_funeral()
	{   

		if($this->user_auth->is_logged_in())
		{
			if(isset($link) && $link==1) {
			    $searchterm = '';
			}

	    $data = array();
		
		if(isset($_POST['searchContent'])){
		$searchterm = $_POST['searchContent'];
		}
		if(isset($searchterm))
		{
		$this->session->set_userdata('searchterm', $searchterm);
		$data['searchStr'] = $searchterm;
		}
		elseif($this->session->userdata('searchterm'))
		{
		$searchterm = $this->session->userdata('searchterm');
		$data['searchStr'] = $searchterm;
		}
		else
		{
		$searchterm ="";
		$data['searchStr'] = $searchterm;
		}
		
		if(isset($_POST['searchContent'])){
		$page = 0;
		}else{
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	    }
		$data['searchStr'] = empty($_POST['searchContent'])? $data['searchStr'] : $_POST['searchContent'];
		$view_data=$this->session->userdata('userInfo');
		$userId=$view_data->userId;
        $param['userId']=$userId;
		$param['email'] = $this->User_model->get_email_by_userId($userId);
		$config['total_rows'] = $this->Funeral_model->record_count_funeral($data['searchStr'],$param);
        $config['per_page'] = 10 ;
		$config['base_url'] = site_url('funeral/find_funeral');
  		$data['page'] = $page;
		$data['title'] = 'Find Funeral';
		$data['funeral_listing'] = $this->Funeral_model->all_funeral($config['per_page'], $page,$data['searchStr'],$param);
		    $this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
	        $this->form_validation->set_rules('code', 'code', 'required|trim|xss_clean');
	            if($this->form_validation->run())
			    {    
					$fields = array(
					'code'=>$this->form_validation->set_value('code'));
					$param = $this->input->post();
					$val = $this->Funeral_model->check_Invitation_code($param['code']);
				    if($val){
				    	
						$data = $this->Funeral_model->get_funeralId($param['code']);
						$id= $data[0]['funeralId'];
						$data['funeral_detail']=$this->Funeral_model->get_funeral_detail_by_funeral_id($id);
						$userInfo=$this->session->userdata('userInfo');
						$userInfo->funeralId=$id;
				        $userInfo->hostId=$data['funeral_detail']['hostId'];
				        $this->session->set_userdata(array('userInfo' =>$userInfo));
				        $view_data=$this->session->userdata('userInfo');
						
						
						redirect('funeral/memorial/'.$id);
					} else {
	                    $this->session->set_flashdata('error_msg', 'Invitation code is wrong');
						redirect('funeral/find_funeral');
					}
				}
		$this->load->view('elements/header',$data);
		$this->load->view('find_funeral/find_a_funeral_loggedin',$data);
		$this->load->view('elements/footer',$data);
		} else {
 			$data['title']= 'Find Funeral';
            $view_data['title']= 'Received an Invitation';
			$this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
	        $this->form_validation->set_rules('code', 'code', 'required|trim|xss_clean');
            if($this->form_validation->run())
		    { 
				$fields = array(
				'code'=>$this->form_validation->set_value('code'));
				$param = $this->input->post();
				$val = $this->Funeral_model->check_Invitation_code($param['code']);
			    if($val){
					$data = $this->Funeral_model->get_funeralId($param['code']);
					$id= $data[0]['funeralId'];
					$userInfo=$this->session->userdata('userInfo');
		            $userInfo->funeralId=$id; 
					$this->session->set_userdata(array('userInfo' =>$userInfo));
					redirect('funeral/memorial/'.$id);
				} else {
                   
				    $this->session->set_flashdata('error_msg', 'Invitation code is wrong');
				    redirect('funeral/find_funeral');
				}
			}	
			$this->load->view('elements/header',$data);
			$this->load->view('find_funeral/code',$view_data);
			$this->load->view('elements/footer',$data);
	 	}
    }
 

    public function create_funeral()
    {
      
        if($this->user_auth->is_logged_in())
        {
        	
	        $param = array();
	        $data = array();
	        $data['title'] = 'Create funeral';
	        $this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
	        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
	        $this->form_validation->set_rules('serviceType', 'serviceType', 'trim|xss_clean');
	        $this->form_validation->set_rules('dateOfBirth', 'DOB', 'trim|xss_clean');
	        $this->form_validation->set_rules('dateOfDeath', 'DOD', 'trim|xss_clean');
	        $this->form_validation->set_rules('familyMember', 'Family Member', 'xss_clean');
	       	$this->form_validation->set_rules('pallBearers', 'Pall Bearers', 'xss_clean');
	        $this->form_validation->set_rules('guest', 'Guest', 'required|xss_clean');
	        $this->form_validation->set_rules('about', 'About', 'trim|xss_clean');
	        $this->form_validation->set_rules('officient', 'Officient', 'xss_clean');
	        $this->form_validation->set_rules('event1', 'event1', 'xss_clean');
	        $this->form_validation->set_rules('event2', 'event2', 'xss_clean');
	        $this->form_validation->set_rules('event3', 'event3', 'xss_clean');
	        $this->form_validation->set_rules('event4', 'event4', 'xss_clean');
	        $this->form_validation->set_rules('eulogy', 'Eulogy', 'xss_clean');
	        $this->form_validation->set_rules('song', 'Song', 'xss_clean');
	        $this->form_validation->set_rules('reading', 'Reading', 'xss_clean');
	        if (empty($_FILES['imageUrl']['name']))
			{
			    $this->form_validation->set_rules('imageUrl', 'Image', 'required');
			}
	       
	        if($this->form_validation->run())
	        {
	        	
	            $fields = array(
	            'name'=>$this->form_validation->set_value('name'),
	            'serviceTypeId'=>$this->form_validation->set_value('serviceTypeId'),
	            'dateOfBirth'=>$this->form_validation->set_value('dateOfBirth'),
	            'dateOfDeath'=>$this->form_validation->set_value('dateOfDeath'),
	            'familyMember'=>$this->form_validation->set_value('familyMember'),
	            'pall_list'=>$this->form_validation->set_value('pall_list'),
	            'invite_guest'=>$this->form_validation->set_value('invite_guest'),
	            'about'=>$this->form_validation->set_value('about'),
	            'officient'=>$this->form_validation->set_value('officient'),
	            'eulogy'=>$this->form_validation->set_value('eulogy'),
	            'song_list'=>$this->form_validation->set_value('song_list'),
	            'reading_list'=>$this->form_validation->set_value('reading_list'));
	            
	           
	            $param = $this->input->post();
	            $param['event'] = array();
	            if(!empty($_POST['event1'][0]))
	            {
	            	$param['event'][0]['eventTypeId']=1;
	            	$param['event'][0]['locationName']=$_POST['event1'][0];
	            	$param['event'][0]['time']=$_POST['event1'][1];
	            	$param['event'][0]['address']=$_POST['event1'][2];
	            	$param['event'][0]['notes']=$_POST['event1'][3];
	            	$param['event'][0]['latitude']=$_POST['event1'][4];
	            	$param['event'][0]['longitude']=$_POST['event1'][5];

	            }
	            if(!empty($_POST['event2'][0]))
	            {
	            	$param['event'][1]['eventTypeId']=2;
	            	$param['event'][1]['locationName']=$_POST['event2'][0];
	            	$param['event'][1]['time']=$_POST['event2'][1];
	            	$param['event'][1]['address']=$_POST['event2'][2];
	            	$param['event'][1]['notes']=$_POST['event2'][3];
	            	$param['event'][1]['latitude']=$_POST['event2'][4];
	            	$param['event'][1]['longitude']=$_POST['event2'][5];
	            }
	            
	             if(!empty($_POST['event3'][0]))
	            {
	            	$param['event'][2]['eventTypeId']=3;
	            	$param['event'][2]['locationName']=$_POST['event3'][0];
	            	$param['event'][2]['time']=$_POST['event3'][1];
	            	$param['event'][2]['address']=$_POST['event3'][2];
	            	$param['event'][2]['notes']=$_POST['event3'][3];
	            	$param['event'][2]['latitude']=$_POST['event3'][4];
	            	$param['event'][2]['longitude']=$_POST['event3'][5];
	            }
	            if(!empty($_POST['event4'][0]))
	            {
	            	$param['event'][3]['eventTypeId']=4;
	            	$param['event'][3]['locationName']=$_POST['event4'][0];
	            	$param['event'][3]['time']=$_POST['event4'][1];
	            	$param['event'][3]['address']=$_POST['event4'][2];
	            	$param['event'][3]['notes']=$_POST['event4'][3];
	            	$param['event'][3]['latitude']=$_POST['event4'][4];
	            	$param['event'][3]['longitude']=$_POST['event4'][5];
	            }
	           
	           	$view_data=$this->session->userdata('userInfo');
	            $param['userId']=$view_data->userId;
	            $param['basePath']=PROFILE_IMAGE_PATH;
	            $data = $this->Funeral_model->add_funeral($param); 
	            redirect('funeral/find_funeral');          
	        }
        	$param['userId'] = 0;
	        $data['servicetype'] = $this->Funeral_model->get_serviceType();
	        $this->load->view('elements/header',$data);
	     	$this->load->view('funeral/create_funeral',$data);
	        $this->load->view('elements/footer');
    	} else  {
        	redirect('user/login');
    	}
    }
    
    function email_check($str)
	{    
		$email=$str;
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
	   		return true;
	    }else {
	        $this->form_validation->set_message('email_check', 'Please enter valid email address.');
	        return FALSE;
	    }    	
	}
   

    public function update_funeral($id)
    {
      
        if($this->user_auth->is_logged_in())
        {
        	
	        $param = array();
	        $data = array();
	        $data['title'] = 'Update funeral';
	        $this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
	        $this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
	        $this->form_validation->set_rules('serviceTypeId', 'serviceType', 'required|trim|xss_clean');
	        $this->form_validation->set_rules('dateOfBirth', 'DOB', 'trim|xss_clean');
	        $this->form_validation->set_rules('dateOfDeath', 'DOD', 'trim|xss_clean');
	        $this->form_validation->set_rules('familymember', 'Family Member', 'xss_clean');
	       	$this->form_validation->set_rules('pallBearers', 'Pall Bearers', 'xss_clean');
	        $this->form_validation->set_rules('guest', 'Guest', 'xss_clean');
	        $this->form_validation->set_rules('about', 'About', 'trim|xss_clean');
	        $this->form_validation->set_rules('officient', 'Officient', 'xss_clean');
	        $this->form_validation->set_rules('event1', 'event1', 'xss_clean');
	        $this->form_validation->set_rules('event2', 'event2', 'xss_clean');
	        $this->form_validation->set_rules('event3', 'event3', 'xss_clean');
	        $this->form_validation->set_rules('event4', 'event4', 'xss_clean');
	        $this->form_validation->set_rules('eulogy', 'Eulogy', 'xss_clean');
	        $this->form_validation->set_rules('song', 'Song', 'xss_clean');
	        $this->form_validation->set_rules('reading', 'Reading', 'xss_clean');
	        
	      	if($this->form_validation->run())
	        {
	        	
	            $fields = array(
	            'name'=>$this->form_validation->set_value('name'),
	            'serviceTypeId'=>$this->form_validation->set_value('serviceTypeId'),
	            'dateOfBirth'=>$this->form_validation->set_value('dateOfBirth'),
	            'dateOfDeath'=>$this->form_validation->set_value('dateOfDeath'),
	            'familymember'=>$this->form_validation->set_value('familymember'),
	            'pall_list'=>$this->form_validation->set_value('pall_list'),
	            'invite_guest'=>$this->form_validation->set_value('invite_guest'),
	            'about'=>$this->form_validation->set_value('about'),
	            'officient'=>$this->form_validation->set_value('officient'),
	            'eulogy'=>$this->form_validation->set_value('eulogy'),
	            'song_list'=>$this->form_validation->set_value('song_list'),
	            'reading_list'=>$this->form_validation->set_value('reading_list'));
	            
	           
	            $param = $this->input->post();
	          
	            $param['event'] = array();
	            if(!empty($_POST['event1'][0]))
	            {
	            	$param['event'][0]['eventTypeId']=1;
	            	$param['event'][0]['locationName']=$_POST['event1'][0];
	            	$param['event'][0]['time']=$_POST['event1'][1];
	            	$param['event'][0]['address']=$_POST['event1'][2];
	            	$param['event'][0]['notes']=$_POST['event1'][3];
	            	$param['event'][0]['latitude']=$_POST['event1'][4];
	            	$param['event'][0]['longitude']=$_POST['event1'][5];

	            }
	            if(!empty($_POST['event2'][0]))
	            {
	            	$param['event'][1]['eventTypeId']=2;
	            	$param['event'][1]['locationName']=$_POST['event2'][0];
	            	$param['event'][1]['time']=$_POST['event2'][1];
	            	$param['event'][1]['address']=$_POST['event2'][2];
	            	$param['event'][1]['notes']=$_POST['event2'][3];
	            	$param['event'][1]['latitude']=$_POST['event2'][4];
	            	$param['event'][1]['longitude']=$_POST['event2'][5];
	            }
	            
	             if(!empty($_POST['event3'][0]))
	            {
	            	$param['event'][2]['eventTypeId']=3;
	            	$param['event'][2]['locationName']=$_POST['event3'][0];
	            	$param['event'][2]['time']=$_POST['event3'][1];
	            	$param['event'][2]['address']=$_POST['event3'][2];
	            	$param['event'][2]['notes']=$_POST['event3'][3];
	            	$param['event'][2]['latitude']=$_POST['event3'][4];
	            	$param['event'][2]['longitude']=$_POST['event3'][5];
	            }
	            if(!empty($_POST['event4'][0]))
	            {
	            	$param['event'][3]['eventTypeId']=4;
	            	$param['event'][3]['locationName']=$_POST['event4'][0];
	            	$param['event'][3]['time']=$_POST['event4'][1];
	            	$param['event'][3]['address']=$_POST['event4'][2];
	            	$param['event'][3]['notes']=$_POST['event4'][3];
	            	$param['event'][3]['latitude']=$_POST['event4'][4];
	            	$param['event'][3]['longitude']=$_POST['event4'][5];
	            }
	           
	           	$view_data=$this->session->userdata('userInfo');
	            $param['userId']=$view_data->userId;
	            $param['funeralId']=$id;
	            $param['basePath']=PROFILE_IMAGE_PATH;
	           
	            $data = $this->Funeral_model->update_funeral($param); 
	            redirect('funeral/find_funeral');          
	        }
        	$param['userId'] = 0;
	        $data['servicetype'] = $this->Funeral_model->get_serviceType();
	        $data['funeral_detail']=$this->Funeral_model->get_funeral_detail_by_funeral_id($id);
	        $data['event']=$this->Funeral_model->get_event($id);

	        $this->load->view('elements/header',$data);
	        $this->load->view('elements/inner_header',$data);
	        $this->load->view('funeral/update_funeral',$data);
	        $this->load->view('elements/footer');
    	} else  {
        	redirect('user/login');
    	}
    }
   

    public function memorial($id)
    {
    	$userInfo='';
    	$data['title'] = 'Memorial';
    	$data['funeral_detail']=$this->Funeral_model->get_funeral_detail_by_funeral_id($id);
    	if($this->user_auth->is_logged_in()) {
    	$userInfo=$this->session->userdata('userInfo');
        $userInfo->hostId=$data['funeral_detail']['hostId'];
        }
		$userInfo->funeralId=$id; 
		$this->session->set_userdata(array('userInfo' =>$userInfo));
		$data['funeral_detail']=$this->Funeral_model->get_funeral_detail_by_funeral_id($id);
    	$this->load->view('elements/header',$data);
        $this->load->view('elements/inner_header',$data);
        $this->load->view('memorial',$data);
        $this->load->view('elements/footer');
    }
	

	public function add_journal()
	{
		if($this->user_auth->is_logged_in())
        {
		    $param = array();
	        $data = array();
	        $data['title'] = 'Journal';
	        $view_data=$this->session->userdata('userInfo');
		    $data['userId']=$view_data->userId;
		    $data['funeralId']=$view_data->funeralId;
			$data['journal_listing'] = $this->Funeral_model->get_journal($data);
	        $this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
	        $this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean');
	        $this->form_validation->set_rules('description', 'Description', 'required|trim|xss_clean');
			if($this->form_validation->run())
	        {
	            $fields = array(
	            'title'=>$this->form_validation->set_value('title'),
	            'description'=>$this->form_validation->set_value('description'));
	            $view_data=$this->session->userdata('userInfo');
		        $fields['userId']=$view_data->userId;
		        $fields['funeralId']=$view_data->funeralId;
	            $data = $this->Funeral_model->postJournal($fields);
	            if($data['status']=200){
            		redirect('funeral/add_journal');
            	} else {
            		$this->session->set_flashdata('error_msg', 'something is wrong');
					redirect('funeral/add_journal');
            	}
       		}
       		$data['funeral_detail']=$this->Funeral_model->get_funeral_detail_by_funeral_id($data['funeralId']);
       		$this->load->view('elements/header',$data);
       		$this->load->view('elements/inner_header',$data);
	        $this->load->view('journal/journal',$data);
	        $this->load->view('elements/footer');
        } else {
       	    redirect('/user');
       }
	}

	public function update_journal($id)
	{
	    $param = array();
        $data = array();
        $data['title'] = 'Update journal';
        
	   	$this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
        $this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'required|trim|xss_clean');
		if($this->form_validation->run())
        {
            $fields = array(
            'title'=>$this->form_validation->set_value('title'),
            'description'=>$this->form_validation->set_value('description'));
            $fields['id']=$id;
            $view_data=$this->session->userdata('userInfo');
       		$fields['userId']=$view_data->userId;
	    	$fields['funeralId']=$view_data->funeralId;
            
            $data = $this->Funeral_model->updateJournal($fields);
            if($data['status'] == 200){
            	redirect('funeral/add_journal');
            } else {
            	$this->session->set_flashdata('error_msg', 'something is wrong');
				redirect('funeral/update_journal');
            }
            
        }
        $view_data=$this->session->userdata('userInfo');
        $funeralId=$view_data->funeralId;
        $data['funeral_detail']=$this->Funeral_model->get_funeral_detail_by_funeral_id($funeralId);
        $data['journal_detail']=$this->Funeral_model->journal_detail($id);
        $this->load->view('elements/header',$data);
        $this->load->view('elements/inner_header',$data);
        $this->load->view('journal/update_jounal',$data);
        $this->load->view('elements/footer');
	}

	/**
	* Function to delete jou
	*
	* @author	Shashank
	* @param	var
	* @return	none
	*/
	public function delete_journal($id)
	{  
		
		if ($this->user_auth->is_logged_in())
	    {
			$view_data=$this->session->userdata('userInfo');
		    $data['userId']=$view_data->userId;
		    $data['id']=$id;
			$data=$this->Funeral_model->delete_journal($data);
            if($data['status']==200){
				$this->session->set_flashdata('success_msg', 'jounral deleted successfully');
				redirect('funeral/add_journal');
			} else {
				$this->session->set_flashdata('success_msg',$data['message']);
					
			}	
		} else {
		   redirect('users');
		}
	}
         
    public function gallery()
    {
    	
			$data = array();
			$data['title'] = 'Gallery';

		    if(!empty($_FILES['imageUrl']['name'])){ 
		  		$Image = $_FILES['imageUrl']['name'];
		        $exten=getExtension($Image);
                if ($exten=="jpg"||$exten=="gif"||$exten=="png"||$exten=="jepg"||$exten=="mov"||$exten=="mp4") 
				{
					$fields['imageUrl']= $_FILES['imageUrl']['name'];
		            $view_data=$this->session->userdata('userInfo');
		       		$fields['userId']=$view_data->userId;
			    	$fields['funeralId']=$view_data->funeralId;
			    	$fields['title']=$_FILES['imageUrl']['name'];
			    	
			    	if($exten=="mov"||$exten=="mp4"){
	 					$fields['mediaType']='video';
			    	} else {
			    		$fields['mediaType']='image';
			    	}
			    	$fields['basePath']=GALLERY_IMAGE_PATH;

			    	$data = $this->Funeral_model->uploadGalleryImage($fields);
		            if($data['status'] == 200){
		            	redirect('funeral/gallery');
		            } else {
		            	$this->session->set_flashdata('error_msg', 'something is wrong');
						redirect('funeral/gallery');
		            }
                } else {  
					$this->form_validation->set_message('check_image','Image should be .jpg, .jpeg, .gif, .png and video should be .mov ,.mp4');
					redirect('funeral/gallery');
				}
            }
            
            
	    	$view_data=$this->session->userdata('userInfo');
	    	$fields['funeralId']=$view_data->funeralId;
	    	if($this->user_auth->is_logged_in()) {
				$fields['userId']=$view_data->userId;
   			}
	    	$data['funeral_detail']=$this->Funeral_model->get_funeral_detail_by_funeral_id($fields['funeralId']);
    		if($this->user_auth->is_logged_in()) {
    			$data['gallery']=$this->Funeral_model->get_user_gallery($fields);
    		}
    		$data['share_gallery']=$this->Funeral_model->get_gallery($fields['funeralId']);

    		$this->load->view('elements/header',$data);
    		$this->load->view('elements/inner_header',$data);
	        $this->load->view('gallery',$data);
	        $this->load->view('elements/footer');
       
    }

	public function program()
	{
		
			$data = array();
	 		$data['title'] = 'Program';
			$view_data=$this->session->userdata('userInfo');
		    $data['funeralId']=$view_data->funeralId;
		    $data['program']=$this->Funeral_model->get_funeral($data['funeralId']);
		    $data['funeral_detail']=$this->Funeral_model->get_funeral_detail_by_funeral_id($data['funeralId']);
		    $this->load->view('elements/header',$data);
		    $this->load->view('elements/inner_header',$data);
	        $this->load->view('program',$data);
	        $this->load->view('elements/footer');
	   
	}	

	public function schedule(){

			$data = array();
	 		$data['title'] = 'Schedule';
			$view_data=$this->session->userdata('userInfo');
		    $data['funeralId']=$view_data->funeralId;
		    $data['schedule']=$this->Funeral_model->get_funeral_schedule($data['funeralId']);
		    $data['funeral_detail']=$this->Funeral_model->get_funeral_detail_by_funeral_id($data['funeralId']);
		     
		    $this->load->view('elements/header',$data);
		    $this->load->view('elements/inner_header',$data);
	        $this->load->view('schedule',$data);
	        $this->load->view('elements/footer');
	}


	public function create_feed()
	{
      if($this->user_auth->is_logged_in())
        {
        	$data = array();
			$data['title'] = 'Feed';
            
            $this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
        	$this->form_validation->set_rules('text', 'Text', 'required|trim|xss_clean');
        		if($this->form_validation->run())
		        {	
		        	$fields = array(
           				'text'=>$this->form_validation->set_value('text'));	
				    if(!empty($_FILES['imageUrl']['name'])){ 
				  		$Image = $_FILES['imageUrl']['name'];
				        $exten=getExtension($Image);
		                if ($exten=="jpg"||$exten=="gif"||$exten=="png"||$exten=="jepg"||$exten=="mov"||$exten=="mp4") 
						{
							$fields['imageUrl']= $_FILES['imageUrl']['name'];
				            $view_data=$this->session->userdata('userInfo');
				       		$fields['userId']=$view_data->userId;
					    	$fields['funeralId']=$view_data->funeralId;
					    	$fields['title']=$_FILES['imageUrl']['name'];
					    	
					    	if($exten=="mov"||$exten=="mp4"){
			 					$fields['mediaType']='video';
					    	} else {
					    		$fields['mediaType']='image';
					    	}
					    	$fields['basePath']=REMEMBRANCE_IMAGE_PATH;
						} else {  
							$this->form_validation->set_message('check_image','Image should be .jpg, .jpeg, .gif, .png and video should be .mov ,.mp4');
							redirect('funeral/gallery');
						} 
					}	
					$view_data=$this->session->userdata('userInfo');
			    	$fields['funeralId']=$view_data->funeralId;
			    	$fields['userId']=$view_data->userId;
		   			$data = $this->Funeral_model->create_feed($fields);
		            if($data['status'] == 200){
		            	redirect('funeral/create_feed');
		            } else {
		            	$this->session->set_flashdata('error_msg', 'something is wrong');
						redirect('uneral/create_feed');
		            }
		        } 
		        $view_data=$this->session->userdata('userInfo');
		    	$fields['funeralId']=$view_data->funeralId;
		    	$fields['userId']=$view_data->userId;
	    		$data['get_feed']=$this->Funeral_model->get_feed($fields['funeralId']);
	    		$data['funeral_detail']=$this->Funeral_model->get_funeral_detail_by_funeral_id($fields['funeralId']);
	    		$this->load->view('elements/header',$data);
	    		$this->load->view('elements/inner_header',$data);
		        $this->load->view('remembrances',$data);
		        $this->load->view('elements/footer');


        } else {
        	redirect('user/login');
        }
	}
	

	/**
	* Function to delete jou
	*
	* @author	Shashank
	* @param	var
	* @return	none
	*/
	public function delete_feed($id)
	{  
		
		if ($this->user_auth->is_logged_in())
	    {
			$view_data=$this->session->userdata('userInfo');
		    $data['userId']=$view_data->userId;
		    $data['id']=$id;
			$data=$this->Funeral_model->delete_feed($data);
            if($data['status']==200){
				$this->session->set_flashdata('success_msg', 'Feed deleted successfully');
				redirect('funeral/create_feed');
			} else {
				$this->session->set_flashdata('error_msg',$data['message']);
					redirect('funeral/create_feed');
			}	
		} else {
		   redirect('users');
		}
	}
}