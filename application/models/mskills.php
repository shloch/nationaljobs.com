<?php

class Mskills extends CI_Model {

    var $table = 'kj_skills';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    public function findByMemberId($member_id) {
        $this->db->select('*');
        $this->db->where('member_id', $member_id);
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        } else {
            return FALSE;
        }
    }
    public function findByMemberId2($member_id) { //return in array format
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
    
    function addSkills($title, $member_id) {
        $this->output->enable_profiler(TRUE);
        $this->db->set('member_id', $member_id);
        $this->db->set('title', $title);       
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }
    function editSkills($title, $member_id) {
        $data = array(
            'title' => $title            
        );
        $this->db->where('member_id', $member_id);
        $this->db->update($this->table, $data);
    }

}