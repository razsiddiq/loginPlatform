<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public $userSession = null;

	public function __construct()
	{ 
		parent::__construct();
		$this->userSession = $this->session->userdata('username');
		$this->load->helper('cookie');
		$this->loginUrl = '/v1/users/clients/login'; 
	
	}

	public function index()
	{		
		$data['title'] = APPLICATION_NAME;

		$data['applicationname'] = ($this->input->get('application')) ?? 'onboarding';
		
		if($this->session->userdata('username')){
			$sessionData = $this->session->userdata('username');
			
			//$authkeycokkie = md5('authkeycookie');
			//$authkeyvalue = base64_encode($sessionData->key->auth_key);
			
		}

		// setcookie('authkeycookie', base64_encode("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1ODcyNzcyMjMsImRhdGEiOiJiNDUwNzY2NDFlMWM2MzNmNTk4NmRjMGM5Y2NhNzdlNjcxZjg3MzJhMTkyZTYxMmE2NWIwYjFhODA0MTBkYzM3YWJlZjhmYjIyNmZmMGUyNGIxNmEzZTA5OWE3OTEwM2Y5ZjU0OTFlNGZhMjBmM2NkODVkYzc4MTA5NzRmOTgxZCIsImlhdCI6MTU4NzI3NjAyM30.BjQbrI_KBUAkSFjpoxgIJbJKAF11ec739iHIfPjCHcM"));

		$authKey  = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1ODcyNzcyMjMsImRhdGEiOiJiNDUwNzY2NDFlMWM2MzNmNTk4NmRjMGM5Y2NhNzdlNjcxZjg3MzJhMTkyZTYxMmE2NWIwYjFhODA0MTBkYzM3YWJlZjhmYjIyNmZmMGUyNGIxNmEzZTA5OWE3OTEwM2Y5ZjU0OTFlNGZhMjBmM2NkODVkYzc4MTA5NzRmOTgxZCIsImlhdCI6MTU4NzI3NjAyM30.BjQbrI_KBUAkSFjpoxgIJbJKAF11ec739iHIfPjCHcM";

		setcookie(
			'CIUser_session_key',
			$authKey,
			(empty($this->config->item('cookie_lifetime')) ? 0 : time() + $this->config->item('cookie_lifetime')),
			$this->config->item('cookie_path'),
			$this->config->item('cookie_domain'),
			$this->config->item('cookie_secure'),
			TRUE
		);
		

		// stdClass Object
		// (
		// 	[id] => 900e536a-5200-497a-a7fd-109b473db387
		// 	[first_name] => hello
		// 	[last_name] => world
		// 	[email] => hell13@gmail.com
		// 	[profile_pic] => 
		// 	[email_verified] => 
		// 	[key] => stdClass Object
		// 		(
		// 			[auth_key] => eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1ODcyNzcyMjMsImRhdGEiOiJiNDUwNzY2NDFlMWM2MzNmNTk4NmRjMGM5Y2NhNzdlNjcxZjg3MzJhMTkyZTYxMmE2NWIwYjFhODA0MTBkYzM3YWJlZjhmYjIyNmZmMGUyNGIxNmEzZTA5OWE3OTEwM2Y5ZjU0OTFlNGZhMjBmM2NkODVkYzc4MTA5NzRmOTgxZCIsImlhdCI6MTU4NzI3NjAyM30.BjQbrI_KBUAkSFjpoxgIJbJKAF11ec739iHIfPjCHcM
		// 			[refresh_key] => eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1ODcyNzg3MjMsImRhdGEiOiJmMWU5MjgxNzA5NDUwZDkyM2EzZTg0ODkyNDU1MWRiODdhYTFhZTI1MmNiMzc1MzE1NGE1ZGM4ODA5MGUzYzg1YzEyZmFjNTdlNDFmMmQxODE4MmZjMGQ3YTk2ODcyN2MwMzdhNzE1NTYxNTFlMThjOTEyOGJhMDRmNzExNmMxOSIsImlhdCI6MTU4NzI3NjAyM30.ZJXbnX4UMhgkVt-raoOD3Llx2Lan55tcMJ7hlL6meXk
		// 		)
		
		// )
		
		// if($this->userSession){	
		// 	redirect('/dashboard');
		// }


		$this->load->view('login',$data);
	}

	public function login() {
		$Return = array('result'=>'', 'error'=>'');
		
		
		$email = trim($this->input->post('email'));
		$password = trim($this->input->post('password'));	
		//$ridirectpath = trim($this->input->post('ridirectpath'));
		/* Server side PHP input validation */
		if($email==='') {
			$Return['error'] = "Email field is required.";
		} 
		elseif($password ===''){
			$Return['error'] = "Password field is required.";
		}

		// show_data($this->security->get_csrf_hash());show_data($_COOKIE);die;
		// if($this->security->get_csrf_hash() != $_COOKIE['csrf_cookie_name']){
		// 	$Return['error'] = "Security Alert.";
		// }

		if($Return['error']!=''){
			output($Return);
		}
	

		

		$userData = array( 'user' => array (
			'uuid' => guid(),
			'email' => $email,
			'password' => $password
			)
		);

		$this->session->set_userdata('username', $userData);	
		$Return['result'] = 'Logged In Successfully.';
		output($Return);

		$data = json_encode($userData);  
		$jsonData = post_curl_function($this->loginUrl,$data);
		$extractData = json_decode($jsonData);

		if (@$extractData->status == 'success') {
			$session_data = $extractData->data->user;

			// Add user data in session
			$this->session->set_userdata('username', $session_data);	
			$Return['result'] = 'Logged In Successfully.';
			output($Return);

		} else {
			$Return['error'] = "Invalid Login Credential.";
			output($Return);
		}
	}

	public function logout(){
		$sess_array = array('username' => '');
		$this->session->sess_destroy();
		
		setcookie("tokencookie", "", time()-3600);
		$Return['result'] = 'Successfully Logout.';
		redirect('', 'refresh');
	}

}
