<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup_con extends CI_Controller {
    
	public function index()
	{
		$this->load->view('signin/signup');
	}
        public function check_signup()
	{
		redirect('home_con/home_doc');
	}
        public function forgot_password()
	{
		redirect('home_con/forgot_password');
	}
        
}