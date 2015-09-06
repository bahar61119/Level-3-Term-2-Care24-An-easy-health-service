<?php

class Doctor_schedule_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
    }
    public function insert_doctor_schedule($doctor_id){
        $username=$this->session->userdata('username');  
        $this->db->select('h_id');
          $this->db->from('attendant');
          $this->db->where('username', $username);
          $query = $this->db->get();
	  foreach ($query->result() as $row)
          {
              $h_id=$row->h_id;
          }
          
        $time=1;
          while(1)
            {
                $time_temp= "day{$time}";
                  
                if($this->input->post($time_temp))  
                {
                    $start=$this->input->post("start_time_{$time}").$this->input->post("ts{$time}");
                    $finish=$this->input->post("finish_time_{$time}").$this->input->post("tf{$time}");
                     
                    $data=array(
                             'h_id'=>$h_id,
                        'd_id'=>$doctor_id,    
                        'day'=>$this->input->post("day{$time}",true),
                        'start_time'=>$start,
                        'finish_time'=>$finish,
                        
                        //'password'=>md5($this->input->post('password',true)),     
                        //'post'=>$this->input->post('post',true),

                    );
               	$insert_time=$this->db->insert('doc_appointment_time',$data);
	    
                    $time++;
                }
                else break;
            }       
        return 	$insert_time;
    }
}