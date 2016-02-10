<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('user_auth');
		$this->load->model('User_model');
		$this->load->model('Funeral_model');
		$this->load->library("pagination");
	}

	public function features()
	{
		$data['title'] ='Features';
		$this->load->view('elements/header',$data);
		$this->load->view('features',$data);
		$this->load->view('elements/footer');
	}

	public function contact_us()
	{

		$data['title'] ='Contact';
		$this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('topic', 'Topic', 'required|trim|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|trim|xss_clean');
		if($this->form_validation->run())
        {
            $fields = array(
            'name'=>$this->form_validation->set_value('name'),
            'email'=>$this->form_validation->set_value('email'),
            'topic'=>$this->form_validation->set_value('topic'),
            'message'=>$this->form_validation->set_value('message'));
            $this->User_model->_send_email('contact_us',$fields['email'],$fields,$fields['topic']);
            $this->session->set_flashdata('success_msg', ' Email send successfully ');
			redirect('app/contact_us');	

        }
		$this->load->view('elements/header',$data);
		$this->load->view('contact_us',$data);
		$this->load->view('elements/footer');
	}

	public function help()
	{
		$data['title'] ='Help';
		$this->load->view('elements/header',$data);
		$this->load->view('help',$data);
		$this->load->view('elements/footer');
	}

	public function about_us()
	{
		$data['title'] ='About';
		$this->load->view('elements/header',$data);
		$this->load->view('about_us',$data);
		$this->load->view('elements/footer');
	}
}