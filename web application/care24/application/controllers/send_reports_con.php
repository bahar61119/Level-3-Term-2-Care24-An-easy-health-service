<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class send_reports_con extends CI_Controller {

    public function index() {
        echo "ok";
        /* $this->load->view('attendant/send_reports'); */
    }

    public function user_list() {


        $this->db->select('*');
        $this->db->from('attendant');
        $this->db->where('username', $this->session->userdata('username'));
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $h_id = $row->h_id;
        }



        $query = $this->db->select('user.id,user.name')
                ->from('user')
                ->join('prescription', 'user.id = prescription.u_id', 'inner')
                ->where('prescription.h_id', $h_id)
                ->get();

        $data['users'] = $query->result();

//          var_dump($data);
        $this->load->view('attendant/user_list', $data);
    }

    public function user_profile($u_id, $u_name) {
//            echo $u_id;
//            echo $u_name;
        
                $this->db->select('*');
        $this->db->from('attendant');
        $this->db->where('username', $this->session->userdata('username'));
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $h_id = $row->h_id;
        }

        
        
        $query = $this->db->select('prescription.id')
                ->from('prescription')
//                ->join('prescription', 'user.id = prescription.u_id', 'inner')
                ->where('prescription.u_id', $u_id)
                ->where('prescription.h_id', $h_id)
                ->get();

        $data['options'] = $query->result();
        
//var_dump($data['options']);
        $this->load->view('attendant/send_report_form', $data);
    }

    public function upload_report() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';

        $this->load->library('upload', $config);

        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
//                    echo "error...";
//                    
            $error = array('error' => $this->upload->display_errors());
            var_dump(is_dir('./uploads/'));
            var_dump($error);
//			$this->load->view('upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
//                        if($this->input->post('userfile')!=null)
//                       echo $this->input->post('userfile');
//                        else echo "nothing returned";
//                        var_dump($data['upload_data']['file_name']);
            $file_name = $data['upload_data']['file_name'];
            echo $file_name;
            echo $this->input->post('p_id');
            $this->load->model('attendant/send_reports_model');
            $this->send_reports_model->upload_report($file_name);

            redirect('send_reports_con/user_list');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */