<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointment_doc extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('doctor_model/doctor_model');
        //$this->load->controller('doctor_list');
    }

    public function index() {
        $this->load->view('attendant/doctor_list');
    }

    public function appointment_list() {

        $this->db->select('*');
        $this->db->from('doctor');
        $this->db->where('pen_no', $this->session->userdata('pen_no'));
        $query = $this->db->get();
//	  $d_id;
        foreach ($query->result() as $row) {
            $d_id = $row->id;
        }

//        var_dump($d_id);
        //// getting hospitals

        $query = $this->db->select('hospital.id,hospital.h_name')
                ->from('hospital')
                ->join('hospital_doc_dept', 'hospital.id = hospital_doc_dept.h_id', 'inner')
                ->where('hospital_doc_dept.d_id', $d_id)
                ->where('hospital_doc_dept.approve', 1)
                ->get();
//          var_dump($query->result());
        $data['hospitals'] = $query->result();

//          var_dump($data);
        $this->load->view('doctor/appointment_list', $data);
    }

    public function appointment_list_load() {
//        $_GET["h_id"];

        $query = $this->db->select('user.id as u_id,user.name as name,user.age as age,user.sex as sex, appointments.date as date, appointments.time as time ')
                ->from('appointments')
                ->join('user', 'user.id = appointments.u_id', 'inner')
                ->where('h_id', $_GET["h_id"])
                ->order_by('appointments.date,appointments.time')
                ->get();
//          var_dump($query->result());
        $data['appointments'] = $query->result();


        $this->load->view('doctor/appointment_hospital', $data);
    }

    public function prescribe() {

//        if($_GET["u_id"]!=null){
//        $data = array(
//            'pen_no' => $this->session->userdata('pen_no'),
//            'is_logged_in_doctor' => true,
//            'u_id'=> $_GET["u_id"]
//        );
//         $this->session->set_userdata($data);
                                    
//        }
        
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $_GET["u_id"]);

        $query = $this->db->get();

        $data['users'] = $query->result();
        
        
        

        $this->db->select('*');
        $this->db->from('doctor');
        $this->db->where('pen_no', $this->session->userdata('pen_no'));
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $d_id = $row->id;
        }



        $this->db->select('*');
        $this->db->from('prescription');
        $this->db->where('d_id', $d_id);
        $this->db->where('u_id', $_GET["u_id"]);
        $this->db->where('h_id', $_GET["h_id"]);

        $query = $this->db->get();

        $data['prescriptions'] = $query->result();

        /////////// getting reports
        
                $query = $this->db->select('reports.id as id,reports.date as date,reports.pdf as pdf')
                ->from('reports')
                ->join('prescription', 'reports.p_id = prescription.id', 'inner')
                ->where('prescription.u_id', $_GET["u_id"])
                ->order_by('reports.date')
                ->get();
        $data['reports'] = $query->result();


        
        //// getting medicine

        $query = $this->db->select('pres_medication.med_name,pres_medication.p_id,pres_medication.regulation,pres_medication.details,pres_medication.dose')
                ->from('pres_medication')
                ->join('prescription', 'pres_medication.p_id = prescription.id', 'inner')
                ->where('prescription.u_id', $_GET["u_id"])
                ->get();
//          var_dump($query->result());
        $data['medicines'] = $query->result();


        $this->load->view('doctor/prescribe', $data);
    }

}

