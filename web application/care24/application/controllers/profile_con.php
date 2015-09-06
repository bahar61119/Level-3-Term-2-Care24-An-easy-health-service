<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_con extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('signin_model/authentication_model');
        //$this->load->controller('doctor_list');
    }
	public function index()
	{
		$this->load->view('signin/signin');
	}
        public function authentication(){
                   $this->load->library('form_validation');
                   $this->form_validation->set_rules('username','','trim|required');
                   $this->form_validation->set_rules('password','','trim|required');
                           if ($this->form_validation->run() == FALSE) {

                               $is_logged_in = $this->session->userdata('is_logged_in_attendant');
                                       if (!isset($is_logged_in) || $is_logged_in != TRUE) {
                                             $this->doctor_list;;
                                       }
                                       else  $this->load->view('signin/signin');
                           }

                           else
                           {
                                   $query=$this->authentication_model->validate();
//                                   var_dump($query);
//                                   if($query){
//                                       echo "success";
//                                   }
//                                   else echo "failure";
                                      if($query=="attendant")
                                   {
//                                          echo $query;
//                                      var_dump($query);
                                       $data = array(
                                           'username' =>$this->input->post('username',true),
                                           'is_logged_in_attendant' =>true
                                       );

                                     $this->load->library('session');
                                     $this->session->set_userdata($data);

                                     redirect('profile_con');
                                   }
                                   else if($query=="doctor")
                                   {
//                                       echo $query;
                                        $data = array(
                                           'pen_no' =>$this->input->post('username',true),
                                           'is_logged_in_doctor' =>true
                                       );

                                     $this->load->library('session');
                                     $this->session->set_userdata($data);
                                     
                                     redirect('profile_con');
//                                     $this->load->view('welcome_message');
                                   }

                                   else $this->load->view('signin/signin');

                           }


        }
        public function doctor_list()
        {
            
          $this->db->select('*');
          $this->db->from('attendant');
          $this->db->where('username', $this->session->userdata('username'));
          $query = $this->db->get();
	  foreach ($query->result() as $row)
          {
              $h_id=$row->h_id;
          }
         
            $this->db->select('*');
            $this->db->from('doctor');
            $this->db->join('hospital_doc_dept', 'doctor.id = hospital_doc_dept.d_id','right outer');
            $this->db->where('h_id',$h_id);
            $this->db->where('approve',1);
            
            
            $query = $this->db->get();
           
		$data['records']=$query->result();
                $this->load->view('attendant/doctor_list',$data);
       
        }
}

