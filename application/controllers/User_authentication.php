<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . "libraries/api/facebook/facebook.php";

class User_Authentication extends CI_Controller

{
	public function __construct()

	{
		parent::__construct();
		$this->load->library('session');
	}
	public function index()

	{
		$facebook = new Facebook(array(
			'appId' => $this->config->item('appID') ,
			'secret' => $this->config->item('appSecret') ,
		));
		$user = $facebook->getUser();
		if ($user) {
			try {
				$data['userData'] = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
				// we can insert and maintain user data here//
			}
			catch(FacebookApiException $e) {
				$user = null;
			}
		}
		if ($user) {
			
			$data['logout_url'] = site_url('/user_authentication/logout'); // Logs off application
			// OR
			// Logs off FB!
			// $data['logout_url'] = $this->facebook->getLogoutUrl();
		}
		else {
			$data['login_url'] = $facebook->getLoginUrl(array(
				// 'redirect_uri' => site_url('welcome/login'),
				'redirect_uri' => 'https://rajapandiyarajan16.000webhostapp.com/bookshelf/index.php/user_authentication/',
				'scope' => "email"
				// permissions here
			));
		}
		
		$this->load->view('user_authentication/index', $data);
	}
	function logout()
	{		
		$facebook = new Facebook(array(
			'appId' => $this->config->item('appID') ,
			'secret' => $this->config->item('appSecret') ,
		));
		$facebook->getLogoutUrl();
		header('Location: ' . site_url('/user_authentication/'));
	}
}