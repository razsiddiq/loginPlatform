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


        $applicationname = base64_decode($this->input->get('application'));
    
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

       
        if($applicationname == 'onboarding'){
            redirect('https://launch.tradly.app');
        }else if($applicationname == 'admin'){

            if(ENVIRONMENT == 'production'){
                redirect('https://admin-dev.tradly.app');
            } 
            else{
                redirect('http://localhost/tradly-admin');
            }
            
        }    
    }

    

}