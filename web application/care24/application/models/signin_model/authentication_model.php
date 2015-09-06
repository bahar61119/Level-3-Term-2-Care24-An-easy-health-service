<?php

class Authentication_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
    }
    
        public function verify_admin()
    {
                    $query = $this->db->select()
                         ->from('admin')
                         ->where('USERNAME',$this->input->post('username'))
                          ->where('PASSWORD',$this->input->post('password'));
        $res= $query->get()->result();
        if($res) return "admin";
        else return "notFound";
            
            
        }
    public function validate()
    {
//var_dump("asdfasd");
      
//        $this->db->select('USERNAME');
//        $this->db->where('USERNAME',$this->input->post('username'));
//        $this->db->where('PASSWORD',md5($this->input->post('password')),true);
////		 $this->db->where('active',  1);
////		
//        $query=$this->db->get('attendant');
//        var_dump($query);
        
        $query = $this->db->select()
                         ->from('attendant')
                         ->where('USERNAME',$this->input->post('username'))
                         ->where('PASSWORD',md5($this->input->post('password')))
                         ->where('ACTIVE',1);            
        
        $res= $query->get()->result();
        if($res) return "attendant";
//        else return "doctor";
        
        
        $query = $this->db->select()
                         ->from('doctor')
                         ->where('PEN_NO',$this->input->post('username'))
                        ->where('PASSWORD',md5($this->input->post('password')));

               $res= $query->get()->result();
        if($res!=null) return "doctor";
        else return "nothing";
        
        
        $result = array();
        
        foreach($res as $r)
            foreach($r as $title => $value)
            {
                $result[$title] = $value;
            }
            
        if($query->num_rows==1 )
        {
            return "attendant";
            
        }

      else
      {
        $this->db->where('pen_no',$this->input->post('username',true));
        $this->db->where('password',  md5($this->input->post('password')),true);
		 //$this->db->where('active',  1);
		
        $doc_query=$this->db->get('doctor');
		
       

        if($doc_query->num_rows==1 )
        {
            return "doctor";
            
        }
      }
   }
}
