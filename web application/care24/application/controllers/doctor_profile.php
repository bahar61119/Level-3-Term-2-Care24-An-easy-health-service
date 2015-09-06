<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor_profile extends CI_Controller {
      public function __construct() {
        parent::__construct();
        $this->load->model('signin_model/authentication_model');
        //$this->load->controller('doctor_list');
    }
    public function profile()
    {
        $doctor_id = $_GET["d_id"];
        $query="SELECT degree.name AS degree_name,doctor.name AS doctor_name,doctor.id AS doctor_id,
               degree.id AS degree_id,institute FROM doctor JOIN degree ON degree.d_id=doctor.id
               WHERE degree.d_id=$doctor_id";
          $query=$this->db->query($query);
        $query_doc="SELECT name from doctor where id=$doctor_id";  
          $query_doc=$this->db->query($query_doc);
                $data['doc_records']=$query_doc->result();
		$data['records']=$query->result();
//                var_dump($data);
                $this->load->view('attendant/doctor_details',$data);
       
    }
}
