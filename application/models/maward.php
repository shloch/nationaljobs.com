<?php

class Maward extends CI_Model {

    var $table = 'kj_award';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    public function fetchByMemberId($member_id) {
        $this->db->select('*');
        $this->db->where('id_member', $member_id);
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
    function addAward($title, $issuing_organization, $date, $place, $description, $member_id) {
//        $this->output->enable_profiler(TRUE);
        $this->db->set('id_member', $member_id);
        $this->db->set('title', $title);       
        $this->db->set('issuing_organization', $issuing_organization);       
        $this->db->set('date', $date);       
        $this->db->set('place', $place);       
        $this->db->set('description', $description);       
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }
    function editAward($title, $issuing_organization, $date, $place, $description, $award_id) {
        $data = array(
            'title' => $title,            
            'issuing_organization' => $issuing_organization,            
            'date' => $date,            
            'place' => $place,            
            'description' => $description
        );
        $this->db->where('award_id', $award_id);
        $this->db->update($this->table, $data);
    }
    function deleteAward($award_id, $member_id) {
        $this->db->where('award_id', $award_id);
        $this->db->where('id_member', $member_id);
        $this->db->delete($this->table);
    }

}