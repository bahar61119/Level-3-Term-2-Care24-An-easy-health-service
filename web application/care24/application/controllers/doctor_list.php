<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor_list extends CI_Controller {
     public function __construct() {
        parent::__construct();
		$this->load->model('');
		$is_logged_in_attendant=$this->session->userdata('is_logged_in_attendant');
		//$is_logged_in_user=$this->session->userdata('is_logged_in_user');
      //  if (isset($is_logged_in_attendant) || $is_logged_in_attendant == TRUE) {

        //    redirect();

        //}
    }

	public function index()
	{
          $this->db->select('*');
          $this->db->from('attendant');
          $this->db->where('username', $this->session->userdata('username'));
          $query = $this->db->get();
	  foreach ($query->result() as $row)
          {
              $h_id=$row->h_id;
          }
         $query="SELECT * FROM hospital_doc_dept RIGHT JOIN doctor ON hospital_doc_dept.d_id=doctor.id 
             WHERE hospital_doc_dept.d_id IS NOT NULL AND hospital_doc_dept.approve=1";
         $query=$this->db->query($query);

           
		$data['records']=$query->result();
                $this->load->view('attendant/show_doctor_view',$data);
          
	}
	public function add_doctor()
	{
	  $this->db->select('*');
          $this->db->from('attendant');
          $this->db->where('username', $this->session->userdata('username'));
          $query = $this->db->get();
	  foreach ($query->result() as $row)
          {
              $h_id=$row->h_id;
          }
          
          
//         $query="SELECT * FROM hospital_doc_dept RIGHT JOIN doctor ON hospital_doc_dept.d_id=doctor.id WHERE hospital_doc_dept.d_id IS NULL";
         $query="SELECT * FROM doctor WHERE doctor.id NOT IN(SELECT doctor.id FROM doctor RIGHT JOIN hospital_doc_dept ON hospital_doc_dept.d_id=doctor.id WHERE hospital_doc_dept.h_id =".$h_id." )";
         $query=$this->db->query($query);

           
		$data['records']=$query->result();
                $this->load->view('attendant/add_doctor',$data);
       	}
        
        public function  insert_doctor($doctor_id)
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
          $this->db->where('id', $doctor_id);
          $query = $this->db->get();
	  foreach ($query->result() as $row)
          {
              $department=$row->specialist;
          }
          $this->db->select('*');
          $this->db->from('departments');
          $this->db->where('department_name', $department);
          $query = $this->db->get();
	  foreach ($query->result() as $row)
          {
              $dept_id=$row->id;
          }
          $request_data=array(
            'd_id'=>$doctor_id,
            'h_id'=>$h_id,
            'dept_id'=>$dept_id
          );
	       $insert_doctor=$this->db->insert('hospital_doc_dept',$request_data);
	  if($insert_doctor)
          {
              
              $data['msg']="doctor has been added.";
              $this->add_doctor();
          }
          else
          {
          $data['msg']="Sorry try again.";
              $this->add_doctor();
              
          }
        }
        public function delete_doctor()
	{
	$this->load->view('attendant/delete_doctor');
	}
}

