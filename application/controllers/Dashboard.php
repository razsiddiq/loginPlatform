<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    protected $userSession = null;

	public function __construct()
    {
          parent::__construct();
          $this->userSession = $this->session->userdata('username');	  
          $this->load->helper('cookie');

          if( !$this->userSession ){
              redirect('/');
          }

    }

    public function index()
	{             



        $authKey  = $this->userSession->key->auth_key;
        $refreshKey =  $this->userSession->key->refresh_key;
        $id = $this->userSession->id;

        setcookie(
			'CIUser_session_key',
			$authKey,
			(empty($this->config->item('cookie_lifetime')) ? 0 : time() + $this->config->item('cookie_lifetime')),
			$this->config->item('cookie_path'),
			$this->config->item('cookie_domain'),
			$this->config->item('cookie_secure'),
			TRUE
        );

        setcookie(
			'CIUser_session_rkey',
			$refreshKey,
			(empty($this->config->item('cookie_lifetime')) ? 0 : time() + $this->config->item('cookie_lifetime')),
			$this->config->item('cookie_path'),
			$this->config->item('cookie_domain'),
			$this->config->item('cookie_secure'),
			TRUE
        );

        setcookie(
			'CIUser_session_Id',
			$id,
			(empty($this->config->item('cookie_lifetime')) ? 0 : time() + $this->config->item('cookie_lifetime')),
			$this->config->item('cookie_path'),
			$this->config->item('cookie_domain'),
			$this->config->item('cookie_secure'),
			TRUE
        );



        show_data($this->userSession);die;
        // $jsonData = get_curl_function_byauth($this->dataUrl);
        // $extractData = json_decode($jsonData);
        // $this->data['productData'] = [];
        // if(isset($extractData->status)){
        //     $this->data['productData']  = $extractData->data;
        // }

        // $cookie_name = "tokencookie";
		// $cookie_value = strtotime(date('Y-m-d H:i:s'));
		// setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        //     // if(!isset($_COOKIE[$cookie_name])){
        //     // 	echo "Cookie named '" . $cookie_name . "' is not set!";
        //     // } else{
        //     // 	echo "Cookie '" . $cookie_name . "' is set!<br>";
        //     // 	echo "Value is: " . $_COOKIE[$cookie_name];
        //     // }

        // $this->data['subview'] = $this->load->view('dashboard', $this->data, TRUE);
        // $this->load->view('layout', $this->data); //page load
    }

}