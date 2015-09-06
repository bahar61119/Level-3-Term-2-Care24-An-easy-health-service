<?php

class Doctor_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
    }

        function doctor_profile($pen){
        
        $query = $this->db->select()
                         ->from('doctor')
                         ->where('PEN_NO',$pen);
        $res= $query->get()->result();
        if(!$res) return false;
        $result = array();
        
        foreach($res as $r)
            foreach($r as $title => $value)
            {
                $result[$title] = $value;
            }
        
        return $result;
    }
    
    
    
      function get_id(){
          $this->db->select('*');
          $this->db->from('doctor');
          $this->db->where('pen_no', $this->session->userdata('pen_no'));
          $query = $this->db->get();
//	  $d_id;
          foreach ($query->result() as $row)
          {
              $d_id = $row->id;
          }
          return $d_id;

        
           }
           
       function prescribe($data){
            
                  $this->db->insert('prescription',$data);
        
           }
    function insert_med_into_prescription($data)
    {
                  $this->db->insert('pres_medication',$data);
        
    }
}