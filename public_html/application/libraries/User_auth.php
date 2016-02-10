<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

define('STATUS_ACTIVATED', '1');
define('STATUS_NOT_ACTIVATED', '0');

/**
 * User_auth
 *
 * Authentication library.
 *
 * @package		User_auth
 * @author		Saran Pal (saran.pal@tanzaniteinfotech.com)
 * @version		0.1
 */
class User_auth
{
	private $error = array();

	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->config('user_auth', TRUE);
		$this->ci->load->library('session');
		$this->ci->load->database();
	}

	
	
	/**
	 * Login user on the site. Return TRUE if login is successful
	 * (user exists and activated, password is correct), otherwise FALSE.
	 *
	 * @param	string	(username or email or both depending on settings in config file)
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function login($login, $password)
	{
		if ((strlen($login) > 0) AND (strlen($password) > 0)) {
			$conditions = array();
			$conditions['emailId'] = $login;
			$conditions['password'] = $password;
						
			$user = $this->ci->User_model->user_login_web($conditions);
            //pr($user);die;
			if (!empty($user) && $user['status'] == 200) {	// login ok
					 
				$userInfo = $user['userInfo'];
				if ($userInfo->isActive == 0) {	
						$this->error = array('not_activated' => '');
				} else {		// success
					$this->ci->session->set_userdata(array('userInfo' =>$userInfo));
					//if ($remember) {
					//	$this->create_autologin($user['userInfo']->userId);
					//}
					$this->ci->User_model->update_login_info($userInfo->userId);
					return TRUE;
				}
			} else {															// fail - wrong login
				
				$this->error = array('login' => 'The email or password you entered is incorrect.');
			}
		}
		return FALSE;
	}
	

	/**
	 * Login user on the site. Return TRUE if login is successful
	 * (user exists and activated, password is correct), otherwise FALSE.
	 *
	 * @param	string	(username or email or both depending on settings in config file)
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function sociallogin($id)
	{   
		
		if ($id){
			$user = $this->ci->User_model->user($id);
			if (!empty($user) && $user['status'] == 200) {	// login ok
					 
				$userInfo = $user['userInfo'];
		// success
					$this->ci->session->set_userdata(array('userInfo' =>$userInfo));
				
					$this->ci->User_model->update_login_info($userInfo->userId);
					return TRUE;
				
			} else {															// fail - wrong login
				return FALSE;
				$this->error = array('login' => 'facebookId is incorrect.');
			}
		}
		return FALSE;
	}

	/**
	 * Logout user from the site
	 *
	 * @return	void
	 */
	function logout()
	{
		
     	$this->ci->session->set_userdata(array('userInfo' => array('userId' => '', 'screenName' => '', 'isActive' => '')));
		$this->ci->session->sess_destroy();
	}
	/**
	 * Clear user's autologin data
	 *
	 * @return	void
	 */
	
	private function delete_autologin()
	{
		$this->ci->load->helper('cookie');
		if ($cookie = get_cookie($this->ci->config->item('autologin_cookie_name', 'user_auth'), TRUE)) {

			$data = unserialize($cookie);

			$this->ci->load->model('user_autologin');
			$this->ci->user_autologin->delete($data['user_id'], md5($data['key']));

			delete_cookie($this->ci->config->item('autologin_cookie_name', 'user_auth'));
		}
	}
	
	
	function getUserInfo() {
		return $this->ci->session->userdata('userInfo');
	}

	/**
	 * Check if user logged in. Also test if user is activated or not.
	 *
	 * @param	bool
	 * @return	bool
	 */
	function is_logged_in()
	{
		$userInfo = $this->getUserInfo();
		if(!empty($userInfo->userId)) {
			return $userInfo->userId;
		}
		return false;
	}

	/**
	 * Get user_id
	 *
	 * @return	string
	 */
	function get_user_id()
	{
		$userInfo = $this->getUserInfo();
		return $userInfo->userId;
	}

	/**
	 * Get username
	 *
	 * @return	string
	 */
	function get_username()
	{
		$userInfo = $this->getUserInfo();
		return $userInfo->screenName;
	}
	

	/**
	 * Get user_group_id
	 *
	 * @return	string
	 */
	function get_user_group_id()
	{
		$userInfo = $this->getUserInfo();
		return $userInfo->groupId;
	}
	
    
	/**
	 * Get error message.
	 * Can be invoked after any failed operation such as login or register.
	 *
	 * @return	string
	 */
	function get_error_message()
	{
		return $this->error;
	}
	
	
	

}

/* End of file User_auth.php */
/* Location: ./application/libraries/User_auth.php */