<?php

class Send_reports_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
    }
	public function upload_report($file_name)
	{
            $report_data=array(
            'p_id'=>$this->input->post('p_id'),
            'pdf'=>$file_name,
             );
	    $insert_report=$this->db->insert('reports',$report_data);
	 
		return $insert_report;
	}
        
}