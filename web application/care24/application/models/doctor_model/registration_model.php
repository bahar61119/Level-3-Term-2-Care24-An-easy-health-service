<?php

class Registration_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
    }
	public function insert_registration_info()
	{
            $doctor_data=array(
            'name'=>$this->input->post('name',true),
            'address'=>$this->input->post('address',true),
            'phone_no'=>$this->input->post('phone_no'),
	    'email'=>$this->input->post('email'),
	    'specialist'=>$this->input->post('specialist'),
	    'pen_no'=>$this->input->post('pen_no'),
	    'password'=>md5($this->input->post('password')),
	  
          );
	       $insert_hospital=$this->db->insert('doctor',$doctor_data);
	  $this->db->select('id');
          $this->db->from('doctor');
          $this->db->where('pen_no', $this->input->post('pen_no',true));
          $query = $this->db->get();
	  foreach ($query->result() as $row)
          {
              $d_id=$row->id;
          }
          $degree=1;
          while(1)
            {
                $degree_temp= "degree_name{$degree}";
                  
                if($this->input->post($degree_temp))  
                {
                          $degree_data=array(
                        'd_id'=>$d_id,    
                        'name'=>$this->input->post("degree_name{$degree}",true),
                        'institute'=>$this->input->post("institute{$degree}",true),
                        //'password'=>md5($this->input->post('password',true)),     
                        //'post'=>$this->input->post('post',true),

                    );
               	$insert_degree=$this->db->insert('degree',$degree_data);
	    
                    $degree++;
                }
                else break;
            }       
        
         	return $insert_degree;
	}
}