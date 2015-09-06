<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_time extends CI_Controller {
      public function __construct() {
        parent::__construct();
       	$this->load->model('attendant/doctor_schedule_model');
        //$this->load->controller('doctor_list');
    }
    public function doctor_schedule()
    {
        $doctor_id=$_GET["d_id"];
        $data['doctor_id']=$doctor_id;
        $this->db->select('name');
          $this->db->from('doctor');
          $this->db->where('id', $doctor_id);
          $query = $this->db->get();
	  foreach ($query->result() as $row)
          {
              $data['doctor_name']=$row->name;
          }
        
        $this->load->view('attendant/schedule_time_view',$data);
    }
    public function insert_doctor_schedule()
    {
        $doctor_id=$_GET["d_id"];
        $data['doctor_id']=$doctor_id;
        if($this->doctor_schedule_model->insert_doctor_schedule($doctor_id))
        $this->load->view('attendant/schedule_time_view',$data);
    }
    public function  show_schedule_time($doctor_id)
    {
        $h_id=0;
        
        $this->db->select('*');
          $this->db->from('doctor');
          $this->db->where('id', $doctor_id);
          $query = $this->db->get();
	  foreach ($query->result() as $row)
          {
              $data['doctor_name']=$row->name;
          }
        
          $this->db->select('*');
          $this->db->from('attendant');
          $this->db->where('username', $this->session->userdata('username'));
          $query = $this->db->get();
	  foreach ($query->result() as $row)
          {
              $h_id=$row->h_id;
          }
        $this->db->select('*');
          $this->db->from('doc_appointment_time');
          $this->db->where('d_id', $doctor_id);
          $this->db->where('h_id', $h_id);
          
          $query = $this->db->get();
	  $data['records']=$query->result();
        $this->load->view('attendant/doctor_schedule_view',$data);  
        
    }
}