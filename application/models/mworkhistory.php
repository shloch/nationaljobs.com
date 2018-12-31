<?php

class MworkHistory extends CI_Model {

    var $table = 'kj_working_history';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    
    public function fetchByMemberId($member_id) {
        $this->db->select('*');
        $this->db->where('member_id', $member_id);
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $rows = array();
            foreach ($query->result_array() as $row)
            {
               $rows[] = $row;
            }
            return $rows;
        } else {
            return array(); //an empty array
        }
    }
    function addWorkHistory($company_name, $company_address, $start_date, $end_date, $job_description, $member_id) {
        $this->output->enable_profiler(TRUE);
        $this->db->set('member_id', $member_id);
        $this->db->set('company_name', $company_name);       
        $this->db->set('company_address', $company_address);       
        $this->db->set('start_date', $start_date);       
        $this->db->set('end_date', $end_date);       
        $this->db->set('job_description', $job_description);       
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }
    function editWorkHistory($company_name, $company_address, $start_date, $end_date, $job_description, $working_history_id, $member_id) {
        $data = array(
            'company_name' => $company_name,            
            'company_address' => $company_address,            
            'start_date' => $start_date,            
            'end_date' => $end_date,            
            'job_description' => $job_description
        );
        $this->db->where('working_history_id', $working_history_id);
        $this->db->where('member_id', $member_id);
        $this->db->update($this->table, $data);
    }
    function deleteWorkHistory($working_history_id, $member_id) {
        $this->db->where('working_history_id', $working_history_id);
        $this->db->where('member_id', $member_id);
        $this->db->delete($this->table);
    }

}