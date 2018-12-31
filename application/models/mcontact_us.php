<?php

class Mcontact_us extends CI_Model {

    var $table = 'kj_contact_us';

    function __construct() {
        parent::__construct();
    }

    function addContactMsg($phone, $name, $email, $comment) {
        $this->db->set('phone', $phone);       
        $this->db->set('name', $name);       
        $this->db->set('email', $email);       
        $this->db->set('comment', $comment);       
        $this->db->set('comment_date', time());       //current time
        $this->db->insert($this->table);
//        return $this->db->insert_id();
    }
   

}