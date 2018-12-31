<?php

class Mdocument extends CI_Model {

    var $table = 'kj_documents';    
    var $documentTable = 'kj_documents';
    var $type_of_document = 'kj_type_of_document';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    function findDocumentByIdAndOwner($id, $member_id) {
        $data = array(
            $this->type_of_document . '.title',
            $this->type_of_document . '.type',
            $this->type_of_document . '.type_of_document_id',
            $this->documentTable . '.document_name',
            $this->documentTable . '.documents_id',
            $this->documentTable . '.creation_date',
            $this->documentTable . '.document_url'
        );

        $this->db->select($data);
        $this->db->from($this->documentTable);
        $this->db->join($this->type_of_document, $this->documentTable . '.type_of_document_id = ' . $this->type_of_document . '.type_of_document_id', 'inner');

        $this->db->where($this->documentTable . '.owner', $member_id);
        $this->db->where($this->documentTable . '.documents_id', $id);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        } else {
            return FALSE;
        }
    }
    public function fetchByMemberId($member_id){
        $data = array(
            $this->type_of_document . '.title',
            $this->type_of_document . '.type',
            $this->type_of_document . '.type_of_document_id',
            $this->documentTable . '.document_name',
            $this->documentTable . '.documents_id',
            $this->documentTable . '.creation_date',
            $this->documentTable . '.document_url'
        );

        $this->db->select($data);
        $this->db->from($this->documentTable);
        $this->db->join($this->type_of_document, $this->documentTable . '.type_of_document_id = ' . $this->type_of_document . '.type_of_document_id', 'inner');

        $this->db->where($this->documentTable . '.owner', $member_id);
        
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
    function edit($name, $id, $member_id) {
        $data = array(
            'document_name' => $name
        );
        $this->db->where('documents_id', $id);
        $this->db->where('owner', $member_id);
        $this->db->update($this->documentTable, $data);
    }
    function delete($id, $member_id) {
        $this->db->where('documents_id', $id);
        $this->db->where('owner', $member_id);
        $this->db->delete($this->documentTable);
    }
    
   
}