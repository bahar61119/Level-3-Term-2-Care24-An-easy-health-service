<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attendant_con extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('doctor_model/doctor_model');
        //$this->load->controller('doctor_list');
    }

    public function index() {
//        $this->load->model('admin_model');
//        $ADMIN = $this->admin_model->admin_profile('1');
//        $data['ADMIN'] = $ADMIN;
//        $data['admin_view'] = 'admin/admin-profile';
//        //echo print_r($ADMIN);
//        $this->load->view('admin/admin', $data);
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
         
            $this->db->select('doctor.id as id, doctor.name as name , doctor.email as email, doctor.specialist as specialist , doctor.phone_no as phone_no, doctor.address as address');
            $this->db->from('doctor');
            $this->db->join('hospital_doc_dept', 'doctor.id = hospital_doc_dept.d_id','right outer');
            $this->db->where('h_id',$h_id);
            $this->db->where('approve',1);
            
            
            $query = $this->db->get();
           
		$data['records']=$query->result();
                $this->load->view('attendant/doctor_list',$data);
       
        }
        
        
            public function user_list() {
        $query = $this->db->select('user.id,user.name')
                ->from('user')
                ->join('prescription', 'user.id = prescription.u_id', 'inner')
                ->where('prescription.h_id', $h_id)
                ->get();

        $data['users'] = $query->result();

//          var_dump($data);
        $this->load->view('attendant/user_list', $data);
    }

        
    
    
    
}