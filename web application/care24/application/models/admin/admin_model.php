<?php

class Admin_model extends CI_Model {

    function admin_profile($MEMBER) {

        $query = $this->db->select()
                ->from('admin')
                ->where('USERNAME', $MEMBER);
        $res = $query->get()->result();
        if (!$res)
            return false;
        $result = array();

        foreach ($res as $r)
            foreach ($r as $title => $value) {
                $result[$title] = $value;
            }

        return $result;
    }

    function hospital_profile($h_id) {

        $query = $this->db->select()
                ->from('hospital')
                ->where('id', $h_id);
        $res = $query->get()->result();
        if (!$res)
            return false;
        $result = array();

        foreach ($res as $r)
            foreach ($r as $title => $value) {
                $result[$title] = $value;
            }

        return $result;
    }

    function doctor_profile($d_id) {

        $query = $this->db->select()
                ->from('doctor')
                ->where('id', $d_id);
        $res = $query->get()->result();
        if (!$res)
            return false;
        $result = array();

        foreach ($res as $r)
            foreach ($r as $title => $value) {
                $result[$title] = $value;
            }

        return $result;
    }

    function request_profile($r_id) {

        $query = $this->db->select()
                ->from('attendant')
                ->where('id', $r_id);
        $res = $query->get()->result();
        if (!$res)
            return false;
        $result = array();

        foreach ($res as $r)
            foreach ($r as $title => $value) {
                $result[$title] = $value;
            }

        return $result;
    }
    
        function request_hospital_profile($h_id) {

        $query = $this->db->select()
                ->from('hospital')
                ->where('id', $h_id);
        $res = $query->get()->result();
        if (!$res)
            return false;
        $result = array();

        foreach ($res as $r)
            foreach ($r as $title => $value) {
                $result[$title] = $value;
            }

        return $result;
    }

    
    
    function admin_username_exists($usrname) {

        $query = $this->db->select()
                ->from('admin')
                ->where('USERNAME', $usrname);
        $res = $query->get()->result();
        if (!$res)
            return false;
        else
            return true;
    }

    function add_admin($data) {
        $this->db->insert('admin', $data);
    }

}

