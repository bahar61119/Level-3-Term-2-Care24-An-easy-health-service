<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_doctor extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('doctor_model/registration_model');
		//$is_logged_in_admin=$this->session->userdata('is_logged_in_admin');
		//$is_logged_in_user=$this->session->userdata('is_logged_in_user');
        //if ((isset($is_logged_in_user) || $is_logged_in_user == TRUE) || (isset($is_logged_in_admin) || $is_logged_in_admin == TRUE)) {

          //  redirect();

        //}
    }
	
	public function index()
	{
		$this->load->view('doctor/signup');
	}
	public function insert_doctor()
	{
		$this->load->library('form_validation');
        $this->form_validation->set_rules('name', '', 'trim|required');
       // $this->form_validation->set_rules('username', '', 'trim|required');
        $this->form_validation->set_rules('password', '', 'trim|required');
        $this->form_validation->set_rules('confirm_password', '', 'trim|required');
        
        $this->form_validation->set_rules('specialist', '', 'trim|required');
	//$this->form_validation->set_rules('h_name', '', 'trim|required');
        $this->form_validation->set_rules('address', '', 'trim|required');
        //$this->form_validation->set_rules('details', '', 'trim|required');
	$this->form_validation->set_rules('phone_no', '', 'trim|required');
        $this->form_validation->set_rules('email', '', 'trim|valid_email');
        //$this->form_validation->set_rules('website', '', 'trim|required');
        //$this->form_validation->set_rules('emergency_no', '', 'trim|required');
        //$this->form_validation->set_rules('fax_no', '', 'trim|required');
	$degree=1;
          while(1)
            {
                $degree_temp= "degree_name{$degree}";
                  
                if($this->input->post($degree_temp))  
                {
                    $this->form_validation->set_rules("degree_name{$degree}",'','trim|required|callback_duration_check');
                    $this->form_validation->set_rules("institute{$degree}",'','trim|required|callback_alpha_with_space_check|min_length[3]|max_length[70]');
                 
                    $degree++;
                }
                else break;
            }       
          

      
        if ($this->form_validation->run() == FALSE) {
		      $data['msg']="Please try again";
              $this->load->view('doctor/signup',$data);
        }

        else {
            
                $query = $this->registration_model->insert_registration_info();
                if ($query) {
				
                    $data['msg']="Thanx For Your Registration.
					Your account will be activated after a confirmation mail.
					So keep in touch.";
                    $this->load->view('doctor/signup',$data);
                }

                else
				{
				$data['msg']="Please try again your email id has been is already used.So try with another email id.Thanx for your patience.";
				 $this->load->view('doctor/signup',$data);
				}
                   
        }
	
   }

}

