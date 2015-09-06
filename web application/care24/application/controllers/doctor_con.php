<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doctor_con extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('doctor_model/doctor_model');
        //$this->load->controller('doctor_list');
    }

    public function index() {
//        $this->load->model('admin_model');
//        $ADMIN = $this->admin_model->admin_profile('1');
//        $data['ADMIN'] = $ADMIN;
//        $data['admin_view'] = 'admin/admin-profile';
//        //echo print_r($ADMIN);
//        $this->load->view('admin/admin', $data);
    }

    
    public function get_requests() {
//        echo "getting Requests....";
    
        
        $this->db->select('*');
        $this->db->from('doctor');
        $this->db->where('pen_no', $this->session->userdata('pen_no'));
        $query = $this->db->get();
//	  $d_id;
        foreach ($query->result() as $row) {
            $d_id = $row->id;
        }
        
        $query = $this->db->select('hospital.id,hospital.h_name,hospital_doc_dept.id as a_id')
                ->from('hospital')
                ->join('hospital_doc_dept', 'hospital.id = hospital_doc_dept.h_id', 'inner')
                ->where('hospital_doc_dept.d_id', $d_id)
                ->where('approve',0)
                ->get();
//          var_dump($query->result());
        $data['hospitals'] = $query->result();
//        var_dump($data);
            $this->load->view('doctor/request_list', $data);
    
    }
    
        public function accept_request($request_id) {

            $data = array(
                'approve' => '1'
            );

            $this->db->where('id', $request_id);
            $query=$this->db->update('hospital_doc_dept', $data);
            if($query)
                $this->get_requests();
        
    }
    
        public function cancel_request($request_id) {

             $query="DELETE FROM hospital_doc_dept WHERE id=".$request_id;
             $query=$this->db->query($query);
//        var_dump($request_id);
//            DELETE FROM table_name WHERE some_column=some_value
//    $this->db->where('id', $request_id);
//    $$this->db->delete('hospital_doc_dept');
             if($query)
                $this->get_requests();
        
        }
    public function prescribe() {
        
//          var_dump($_POST);
          
        $query = $this->db->select()
                ->from('doctor')
                ->where('pen_no', $this->session->userdata('pen_no'));

        foreach ($query->get()->result() as $row) {
            $d_id = $row->id;
            $name = $row->name;
        }
//          var_dump($this->input->post('name'));
        $data = array(
            'u_id' => $_GET["u_id"],
            'd_id' => $d_id,
            'h_id' => $_GET["h_id"],
            'doc_sig' => $name,
            'disease'=> $this->input->post('name'),
            'details'=> $this->input->post('details'),
            'suggestion'=> $this->input->post('suggestion')
        );
        $this->doctor_model->prescribe($data);
       
        $i=1;
        $pres_id = $this->db->insert_id();
        while(1){
            if($this->input->post('med'.$i)==null){break;}
//            else {echo "he he";break;}
        $reg="";
        if($this->input->post('reg1'.$i)=="on")$reg.="1--";
        else $reg.="0--";
        if($this->input->post('reg2'.$i)=="on")$reg.="1--";
        else $reg.="0--";
        if($this->input->post('reg3'.$i)=="on")$reg.="1";
        else $reg.="0";
        
        $dosetime = $this->input->post('dosetime'.$i);
        $dose = $this->input->post('dose'.$i);
        $med_name=$this->input->post('med'.$i);
        
        $med = array(
          'med_name'=>$med_name,
          'p_id'=>$pres_id,//returns the last inserted id in db
          'regulation'=>$reg,
          'details'=>$dosetime,
          'dose'=>$dose
        );
//        var_dump($med);
        $this->doctor_model->insert_med_into_prescription($med);
       
        $i+=1;
        }        
        
        redirect('appointment_doc/prescribe?u_id='.$_GET["u_id"].'&h_id='.$_GET["h_id"]);
    }

}

