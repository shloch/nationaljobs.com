<?php

class MprofessionnalTraining extends CI_Model {

    var $table = 'kj_special_professionnal_training';

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
    function add($trainer, $training_period, $certificate_obtened, $member_id) {
        $this->output->enable_profiler(TRUE);
        $this->db->set('member_id', $member_id);
        $this->db->set('trainer', $trainer);     
        $this->db->set('training_period', $training_period);     
        $this->db->set('certificate_obtened', $certificate_obtened);     
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }
    function edit($trainer, $training_period, $certificate_obtened, $special_professionnal_training_id, $member_id) {
        $data = array(
            'trainer' => $trainer,
            'training_period' => $training_period,
            'certificate_obtened' => $certificate_obtened,
        );
        $this->db->where('special_professionnal_training_id', $special_professionnal_training_id);
        $this->db->where('member_id', $member_id);
        $this->db->update($this->table, $data);
    }
    function delete($special_professionnal_training_id, $member_id) {
        $this->db->where('special_professionnal_training_id', $special_professionnal_training_id);
        $this->db->where('member_id', $member_id);
        $this->db->delete($this->table);
    }

}