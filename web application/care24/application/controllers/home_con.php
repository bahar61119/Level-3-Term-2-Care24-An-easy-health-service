<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_con extends CI_Controller {

    public function index() {
        $this->load->view('home/home');
    }

    public function home_doc() {

        $this->load->model('doctor_model/doctor_model');
        $DOCTOR = $this->doctor_model->doctor_profile($this->session->userdata('pen_no'));
        $data['DOCTOR'] = $DOCTOR;

        $this->load->view('home/doc_profile', $data);
    }

    public function forgot_password() {
        
        $this->load->view('signin/forgot_password');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */