<?php

class Registration_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
    }
	public function insert_registration_info()
	{
            $hospital_data=array(
            'h_name'=>$this->input->post('h_name',true),
            'address'=>$this->input->post('address',true),
            'details'=>$this->input->post('details',true),
            'phone_no'=>$this->input->post('phone_no'),
	    'email'=>$this->input->post('email'),
	    'website'=>$this->input->post('website'),
	    'emergency_no'=>$this->input->post('emergency_no'),
	    'fax_no'=>$this->input->post('fax_no'),
	  
          );
	       $insert_hospital=$this->db->insert('hospital',$hospital_data);
	  $this->db->select('id');
          $this->db->from('hospital');
          $this->db->where('h_name', $this->input->post('h_name',true));
          $query = $this->db->get();
	  foreach ($query->result() as $row)
          {
              $h_id=$row->id;
          }
          $registration_data=array(
            'h_id'=>$h_id,        
            'name'=>$this->input->post('name',true),
            'username'=>$this->input->post('username',true),
            'password'=>md5($this->input->post('password',true)),     
            'post'=>$this->input->post('post',true),
            		
        );
               	$insert_attendant=$this->db->insert('attendant',$registration_data);
		return $insert_attendant;
	}
}