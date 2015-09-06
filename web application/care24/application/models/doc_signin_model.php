<?php

class Doc_signin_model extends CI_Model{
    
        function check_signin($username) {
        $query = $this->db->select('EMAIL,PASSWORD')
                ->from('doctor')
                ->where('EMAIL', $username);
        $res = $query->get()->result();
//        var_dump($res);
        if (!$res)
            return 0;
        
        $result = array();
        
          foreach($res as $r)
            foreach($r as $title => $value)
            {
                $result[$title] = $value;
            }
            
        var_dump($result);
            if($result["PASSWORD"]!= $this->input->post('password')){echo "hh";return 1;}
        
    }

    function admin_profile($MEMBER_ID){
        
        $query = $this->db->select()
                         ->from('admin')
                         ->where('ID',$MEMBER_ID);
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
}
    