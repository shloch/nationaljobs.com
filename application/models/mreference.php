<?php

class Mreference extends CI_Model {

    var $table = 'kj_reference';

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
    function add($reference, $member_id) {
        $this->output->enable_profiler(TRUE);
        $this->db->set('member_id', $member_id);
        $this->db->set('reference', $reference);     
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }
    function edit($reference, $reference_id, $member_id) {
        $data = array(
            'reference' => $reference
        );
        $this->db->where('reference_id', $reference_id);
        $this->db->where('member_id', $member_id);
        $this->db->update($this->table, $data);
    }
    function delete($reference_id, $member_id) {
        $this->db->where('reference_id', $reference_id);
        $this->db->where('member_id', $member_id);
        $this->db->delete($this->table);
    }

}