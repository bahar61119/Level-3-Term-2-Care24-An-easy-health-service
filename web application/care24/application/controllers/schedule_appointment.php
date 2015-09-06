<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule_appointment extends CI_Controller {

    public function index() {
        $this->load->view('attendant/schedule_appointment_view');
    }

    public function appointment_list() {
        
    }

    public function approve_set_time($appointment_id) {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('time', '', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['msg'] = "Please try again";
            $this->load->view('attendant/show_request_view', $data);
        } else {
            $data = array(
                'time' => $this->input->post('time'),
                'approve' => '1'
            );

            $this->db->where('id', $appointment_id);
            $query = $this->db->update('appointments', $data);





            if ($query) {


                $this->db->select('*');
                $this->db->from('appointments');
                $this->db->where('id', $appointment_id);
                $query = $this->db->get();
                foreach ($query->result() as $row) {
                    $u_id = $row->u_id;
                }



                $this->db->select('*');
                $this->db->from('user');
                $this->db->where('id', $u_id);
                $query = $this->db->get();
                foreach ($query->result() as $row) {
                    $regId = $row->gcm_regid;
                }

                $registatoin_ids = array($regId);
                $message = "Your appointment has approved.Appointment time is: " . $this->input->post('time');
                $message = array("push" => $message);

                $result = $this->push_notification->send_notification($registatoin_ids, $message);

                $this->appointment_request_list($_GET["d_id"]);
            }
        }
    }

    public function cancel_appointment($a_id) {

//            echo $a_id;



        $this->db->select('*');
        $this->db->from('appointments');
        $this->db->where('id', $a_id);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $u_id = $row->u_id;
            $d_id = $row->d_id;
        }


        $this->db->select('*');
        $this->db->from('hospital_doc_dept');
        $this->db->where('d_id', $d_id);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $dept_id = $row->dept_id;
//                    $d_id=$row->d_id;
        }

//                echo $dept_id."----";

        $d_query = 'SELECT DISTINCT doctor.name AS name FROM 
              hospital_doc_dept,doctor WHERE doctor.id!=' . $d_id . '
                    AND hospital_doc_dept.dept_id=' . $dept_id . ' AND hospital_doc_dept.approve=1';
        $d_query = $this->db->query($d_query);
$msg=" ";
        foreach ($d_query->result() as $row) {
            $msg.=$row->name." ";
//                    $d_id=$row->d_id;
        }
//        echo $msg."-----";

//        var_dump($d_query->result());





        
          $this->db->select('*');
          $this->db->from('user');
          $this->db->where('id', $u_id);
          $query = $this->db->get();
          foreach ($query->result() as $row) {
          $regId = $row->gcm_regid;
          }

          $registatoin_ids = array($regId);
          $message = "Your appointment has been cancelled...You can make appointment to the following doctors: ".$msg;
          $message = array("push" => $message);

          $result = $this->push_notification->send_notification($registatoin_ids, $message);





          $this->db->where('id', $a_id);
          $query = $this->db->delete('appointments');
          //
          //

          if ($query){
          //            $this->request_list();
          $result = $this->push_notification->send_notification($registatoin_ids, $message);


          }
          $this->appointment_request_list($_GET["d_id"]);

         
    }

    public function appointment_request_list($d_id=null) {
        
        if($d_id==null)
        {
            $d_id=$_GET["d_id"];
        }
        $this->db->select('*');
        $this->db->from('attendant');
        $this->db->where('username', $this->session->userdata('username'));
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $h_id = $row->h_id;
        }
//        echo $_GET["d_id"];
        $query = 'SELECT a.id AS aid,a.date AS adate,a.description AS adescription,
              a.invoice_no AS ainvoice_no,a.card_no AS acard_no,a.bkash_no AS abkash_no,
              u.id AS uid,u.name AS uname,u.phone AS uphone,u.address AS uaddress,
              u.email AS uemail,u.sex AS usex,u.weight AS uweight,u.age AS uage,
              d.id AS did,d.name AS dname,d.specialist AS dspecialist,d.email AS demail,
              d.phone_no AS dphone_no,d.address AS daddress
              FROM appointments a, user u, doctor d
           where u.id = a.u_id AND a.d_id = d.id AND d.id='.$d_id.' AND a.h_id='. $h_id . ' AND a.approve=0 ORDER BY adate';
        
        $d_query = 'SELECT doctor.id AS id,doctor.name AS name FROM 
              doctor WHERE 
               doctor.id='.$_GET["d_id"];
        $query = $this->db->query($query);
        $d_query = $this->db->query($d_query);
//        var_dump($query->result());
        $data['records'] = $query->result();
        $data['drecords'] = $d_query->result();
        $this->load->view('attendant/show_request_view', $data);
    }

    public function schedule_time() {
        $this->load->view('attendant/approve_appointment_view');
    }

    public function search_appointment() {

        $date_data = $this->input->post('year') . '-' . $this->input->post('month') . '-' . $this->input->post('day');
        $d_id = $this->input->post('doctor_name');
        $this->db->select('*');
        $this->db->from('attendant');
        $this->db->where('username', $this->session->userdata('username'));
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $h_id = $row->h_id;
        }

        if ($this->input->post('doctor_name')) {
            //$date_data=$this->input->post('year')."-".$this->input->post('month')."-".$this->input->post('day');

            $query = 'SELECT a.id AS aid,a.date AS adate,a.description AS adescription,
              a.invoice_no AS ainvoice_no,a.card_no AS acard_no,a.bkash_no AS abkash_no,
              u.id AS uid,u.name AS uname,u.phone AS uphone,u.address AS uaddress,
              u.email AS uemail,u.sex AS usex,u.weight AS uweight,u.age AS uage,
              d.id AS did,d.name AS dname,d.specialist AS dspecialist,d.email AS demail,
              d.phone_no AS dphone_no,d.address AS daddress
              FROM appointments a, user u, doctor d
           where u.id = a.u_id AND a.d_id = d.id AND a.h_id=' . $h_id . ' AND a.approve=0 AND a.d_id=' . $d_id;
        } else if (!$this->input->post('doctor_name')) {
            $query = 'SELECT a.id AS aid,a.date AS adate,a.description AS adescription,
              a.invoice_no AS ainvoice_no,a.card_no AS acard_no,a.bkash_no AS abkash_no,
              u.id AS uid,u.name AS uname,u.phone AS uphone,u.address AS uaddress,
              u.email AS uemail,u.sex AS usex,u.weight AS uweight,u.age AS uage,
              d.id AS did,d.name AS dname,d.specialist AS dspecialist,d.email AS demail,
              d.phone_no AS dphone_no,d.address AS daddress
              FROM appointments a, user u, doctor d
           where u.id = a.u_id AND a.d_id = d.id AND a.h_id=' . $h_id . ' AND a.approve=0 ORDER BY adate';
        }
        else
            $data['error'] = "doesn't match";
        $d_query = 'SELECT doctor.id AS id,doctor.name AS name FROM 
              hospital_doc_dept,doctor WHERE doctor.id=hospital_doc_dept.d_id
                    AND h_id=' . $h_id . ' AND hospital_doc_dept.approve=1';
        $query = $this->db->query($query);
        $data['records'] = $query->result();
        $d_query = $this->db->query($d_query);
        $data['drecords'] = $d_query->result();

        $this->load->view('attendant/show_request_view', $data);
    }

    public function approved_appointment_list() {

        $this->db->select('*');
        $this->db->from('attendant');
        $this->db->where('username', $this->session->userdata('username'));
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $h_id = $row->h_id;
        }
        $query = 'SELECT a.id AS aid,a.date AS adate,a.description AS adescription,
              a.invoice_no AS ainvoice_no,a.card_no AS acard_no,a.bkash_no AS abkash_no,
              u.id AS uid,u.name AS uname,u.phone AS uphone,u.address AS uaddress,
              u.email AS uemail,u.sex AS usex,u.weight AS uweight,u.age AS uage,
              d.id AS did,d.name AS dname,d.specialist AS dspecialist,d.email AS demail,
              d.phone_no AS dphone_no,d.address AS daddress
              FROM appointments a, user u, doctor d
           where u.id = a.u_id AND a.d_id = d.id AND a.h_id=' . $h_id . ' AND a.approve=1 ORDER BY adate';
        $d_query = 'SELECT doctor.id AS id,doctor.name AS name FROM 
              hospital_doc_dept,doctor WHERE doctor.id=hospital_doc_dept.d_id
                    AND h_id=' . $h_id . ' AND hospital_doc_dept.approve=1';
        $query = $this->db->query($query);
        $d_query = $this->db->query($d_query);
        $data['records'] = $query->result();
        $data['drecords'] = $d_query->result();
        $this->load->view('attendant/approved_request_view', $data);
    }

    public function search_approved_appointment() {
        $d_id = $this->input->post('doctor_name');
        $this->db->select('*');
        $this->db->from('attendant');
        $this->db->where('username', $this->session->userdata('username'));
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $h_id = $row->h_id;
        }

        if ($this->input->post('doctor_name')) {
            //$date_data=$this->input->post('year')."-".$this->input->post('month')."-".$this->input->post('day');

            $query = 'SELECT a.id AS aid,a.date AS adate,a.description AS adescription,
              a.invoice_no AS ainvoice_no,a.card_no AS acard_no,a.bkash_no AS abkash_no,
              u.id AS uid,u.name AS uname,u.phone AS uphone,u.address AS uaddress,
              u.email AS uemail,u.sex AS usex,u.weight AS uweight,u.age AS uage,
              d.id AS did,d.name AS dname,d.specialist AS dspecialist,d.email AS demail,
              d.phone_no AS dphone_no,d.address AS daddress
              FROM appointments a, user u, doctor d
           where u.id = a.u_id AND a.d_id = d.id AND a.h_id=' . $h_id . ' AND a.approve=1 AND a.d_id=' . $d_id;
        } else if (!$this->input->post('doctor_name')) {
            $query = 'SELECT a.id AS aid,a.date AS adate,a.description AS adescription,
              a.invoice_no AS ainvoice_no,a.card_no AS acard_no,a.bkash_no AS abkash_no,
              u.id AS uid,u.name AS uname,u.phone AS uphone,u.address AS uaddress,
              u.email AS uemail,u.sex AS usex,u.weight AS uweight,u.age AS uage,
              d.id AS did,d.name AS dname,d.specialist AS dspecialist,d.email AS demail,
              d.phone_no AS dphone_no,d.address AS daddress
              FROM appointments a, user u, doctor d
           where u.id = a.u_id AND a.d_id = d.id AND a.h_id=' . $h_id . ' AND a.approve=1 ORDER BY adate';
        }
        else
            $data['error'] = "doesn't match";
        $d_query = 'SELECT doctor.id AS id,doctor.name AS name FROM 
              hospital_doc_dept,doctor WHERE doctor.id=hospital_doc_dept.d_id
                    AND h_id=' . $h_id . ' AND hospital_doc_dept.approve=1';
        $query = $this->db->query($query);
        $data['records'] = $query->result();
        $d_query = $this->db->query($d_query);
        $data['drecords'] = $d_query->result();

        $this->load->view('attendant/approved_request_view', $data);
    }

}

