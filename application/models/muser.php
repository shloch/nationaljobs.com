<?php

class Muser extends CI_Model {

    var $table = 'kj_member';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     *
     * @param type $email
     * @param type $username
     * @param type $password
     * @param type $access_level represent "account_type" field in memeber's database table
     * @return type 
     */
    function signUp($email, $username, $password, $access_level) {
        //$this->output->enable_profiler(TRUE);
        $this->db->set('email', $email);
        $this->db->set('username', $username);
        $this->db->set('password', md5($password));  
        //database insert 1 as default value in account_type, so it is unecessary to send 1 as value here, but only when the value is greater than 1
        if($access_level == 2)
            $this->db->set('access_level_id', $access_level);        
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }
    
    function storeReInitializedPwd($email, $generatedPwd){
        $this->db->set('password', md5($generatedPwd));    
        $this->db->where('email', $email);  
        $this->db->update($this->table);
    }

    function selectByEmail($email) {
        $this->db->select('*');
        $this->db->where('email', $email);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return FALSE;
        }
    }
    function selectByUsername($username) {
        $this->db->select('*');
        $this->db->where('username', $username);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return FALSE;
        }
    }

    function login($username, $password) {
        $pwd = md5($password);
        $sql = "SELECT
                  *
                FROM
                  user
                WHERE
                  user.username='$username' AND
                  user.password = '$pwd'";
        return $query = $this->db->query($sql);
    }

    
    
    public function findByEmailAndPassword($email, $password) {
        $this->db->select('*');
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        } else {
            return FALSE;
        }
    }
    function change_password($password,$member_id) {
        $data = array(
            'password' => md5($password)
        );
        $this->db->where('member_id', $member_id);
        $this->db->update($this->table, $data);
    }
    function editPersonalInformations($dob, $email, $gender, $mobile, $name, $username, $member_id) {
        $data = array(
            'dob' => $dob,
            'email' => $email,
            'gender' => $gender,
            'mobile' => $mobile,
            'name' => $name,
            'username' => $username
            
        );
        $this->db->where('member_id', $member_id);
        $this->db->update($this->table, $data);
    }
    function editLinks($facebook, $twitter, $linkedIn, $member_id) {
        $data = array(
            'facebook' => $facebook,
            'twitter' => $twitter,
            'linkedIn' => $linkedIn            
        );
        $this->db->where('member_id', $member_id);
        $this->db->update($this->table, $data);
    }
    
     function editPhoto($photo,$member_id) {
        $data = array(
            'photo' => $photo
        );
        $this->db->where('member_id', $member_id);
        $this->db->update($this->table, $data);
    }
    
    public function fetchUserByType($type=1) {
        $this->db->select('*');
        $this->db->where('access_level_id', $type);
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $rows = array();
            foreach ($query->result_array() as $row) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return array(); //an empty array
        }
    }
}

/* End of file mstudent.php */
/* Location: ./system/application/models/mstudent.php */