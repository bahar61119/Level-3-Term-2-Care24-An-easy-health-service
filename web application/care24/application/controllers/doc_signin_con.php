<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doc_signin_con extends CI_Controller {

    public function index() {
//        $this->push_notification->some_function();
        $this->load->view('signin/signin');
    }

    public function check_signin() {
$this->load->model('doc_signin_model');
$res=  $this->doc_signin_model->check_signin($this->input->post('username'));
      if($res==0)
        {
              echo "doesn't exist";
        } 
        else if($res==1)
        {
            echo "Password mismatched";
        }
        else
        {
            echo "Login Successfull...";
        }
        
        
//        echo $this->input->post('username');
    }
    
    public function signout(){
$this->session->sess_destroy();
redirect('signin_con');
}

}

