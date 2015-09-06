<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_con extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->load->model('signin_model/authentication_model');
        //$this->load->controller('doctor_list');
    }

    public function index() {
//        $this->load->model('admin_model');
        $ADMIN = $this->admin_model->admin_profile('1');
        $data['ADMIN'] = $ADMIN;
        $data['admin_view'] = 'admin/admin-profile';
        //echo print_r($ADMIN);
        $this->load->view('admin/admin', $data);
    }

    public function admin_profile() {
//        $this->load->model('admin_model');
        $ADMIN = $this->admin_model->admin_profile($this->session->userdata('username'));
        $data['ADMIN'] = $ADMIN;
        $data['admin_view'] = 'admin/admin-profile';
        $this->load->view('admin/admin', $data);
    }

    public function add_admin_form($error = null) {
        $data['Error'] = $error;
        $data['admin_view'] = 'admin/add-admin';
        $this->load->view('admin/add-admin', $data);
    }

    public function add_admin() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
//        $this->form_validation->set_rules('con_password', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');


        if ($this->form_validation->run() == FALSE) {
            $err = validation_errors();
            $this->add_admin_form($err);
        } else if ($this->input->post('password') != $this->input->post('con_password')) {
            $this->add_admin_form("password mismatched");
            echo "Password missmatced!!!";
        } else if ($this->admin_model->admin_username_exists($this->input->post('username'))) {
            $this->add_admin_form("Username exists");
            echo "Username already exists, Try another one...";
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'role' => $this->input->post('role'),
            );

//            $this->load->model('admin_model');
            $this->admin_model->add_admin($data);
            redirect(admin_con);
        }
    }

    public function signin() {
     
//       $this->db->select('*');
//          $this->db->from('user');
//          $this->db->where('id',16);
//          $query = $this->db->get();
//	  foreach ($query->result() as $row)
//          {
//              $regId=$row->gcm_regid;
//          }
//        
//     $registatoin_ids = array($regId);
//     $message="i am VOoOoOt...";
//    $message = array("push" => $message);
//
//    $result = $this->push_notification->send_notification($registatoin_ids, $message);
//    var_dump($result);
    
//echo "he he";
//echo $regId;

        $this->load->view('admin/admin_signin');
    }

    public function authentication() {

//                var_dump("hiiiii");
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', '', 'trim|required');
        $this->form_validation->set_rules('password', '', 'trim|required');

        $query = $this->authentication_model->verify_admin();

        if ($query == "admin") {
//                                          echo $query;
            var_dump($query);
            $data = array(
                'username' => $this->input->post('username', true),
                'is_logged_in_admin' => true
            );

            $this->load->library('session');
            $this->session->set_userdata($data);
//                                     $this->doctor_list();
            redirect('admin_con/admin_profile');
//                                   }
//                                   else $this->load->view('signin/signin');
//                           }
        } else {
            $this->signin();
        }
    }

    public function hospital_list() {
        $query = $this->db->select('hospital.id,hospital.h_name')
                ->from('hospital')
                ->get();
//          var_dump($query->result());
        $data['hospitals'] = $query->result();

//          var_dump($data);
        $this->load->view('admin/hospital_list', $data);
    }

    public function doctor_list() {
        $query = $this->db->select('doctor.id,doctor.name')
                ->from('doctor')
                ->get();
//          var_dump($query->result());
        $data['doctors'] = $query->result();

//          var_dump($data);
        $this->load->view('admin/doctor_list', $data);
    }

    public function request_list() {
        $query = $this->db->select('attendant.id,attendant.name')
                ->from('attendant')
                ->where('active', 0)
                ->get();
//          var_dump($query->result());
        $data['requests'] = $query->result();

//          var_dump($data);
        $this->load->view('admin/request_list', $data);
    }

    public function hospital_profile() {
        $ADMIN = $this->admin_model->hospital_profile($_GET["h_id"]);
        $data['ADMIN'] = $ADMIN;
        $data['admin_view'] = 'admin/hospital_profile';
        $this->load->view('admin/admin', $data);
    }

    public function doctor_profile() {
        $ADMIN = $this->admin_model->doctor_profile($_GET["d_id"]);
        $data['ADMIN'] = $ADMIN;
        $data['admin_view'] = 'admin/doctor_profile';
        $this->load->view('admin/admin', $data);
    }

    public function request_profile() {
        $ADMIN = $this->admin_model->request_profile($_GET["a_id"]);
        $data['ADMIN'] = $ADMIN;
        $data['admin_view'] = 'admin/request_profile';



        $this->db->select('*');
        $this->db->from('attendant');
        $this->db->where('id', $_GET["a_id"]);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $h_id = $row->h_id;
        }



        $HOSPITAL = $this->admin_model->request_hospital_profile($h_id);
        $data['HOSPITAL'] = $HOSPITAL;


        $data['admin_view'] = 'admin/request_profile';
        $this->load->view('admin/admin', $data);
    }

    public function approve_request($a_id) {


        $data = array(
            'active' => '1'
        );

        $this->db->where('id', $a_id);
        $query = $this->db->update('attendant', $data);


        $this->db->select('*');
        $this->db->from('attendant');
        $this->db->where('id', $a_id);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $h_id = $row->h_id;
        }


        $this->db->where('id', $h_id);
        $query = $this->db->update('hospital', $data);



        if ($query)
            $this->request_list();
    }
    
        public function cancel_request($a_id) {



        $this->db->select('*');
        $this->db->from('attendant');
        $this->db->where('id', $a_id);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $h_id = $row->h_id;
        }

        
        $this->db->where('id', $a_id);
        $query = $this->db->delete('attendant');

        $this->db->where('id', $h_id);
        $query = $this->db->delete('hospital');



        if ($query)
            $this->request_list();
    }

}
