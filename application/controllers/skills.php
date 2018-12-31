<?php

/*
 * the skills page
 */

class Skills extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Mskills', 'skills');
        $this->load->helper('file');
//        $this->output->enable_profiler(TRUE);
    }

    function index() {
        
    }
    function editSkills() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error'=>404, 'Message'=>'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted
            if ($this->form_validation->run('editSkills') == FALSE) {
                die(json_encode(array('Error'=>1, 'Message'=>'Please fill the form properly.')));
            } else {
                extract($_POST);
                //we save informations in the database
                $resultSkills = $this->skills->findByMemberId($logged);
                if ($resultSkills != FALSE) {                    
                    $this->skills->editSkills($skills, $this->session->userdata('member_id'));
                }else{
                    $this->skills->addSkills($skills, $this->session->userdata('member_id'));
                }
               
                $this->session->set_userdata('skills', $skills);
                
                die(json_encode(array('Error'=>0, 'Message'=>'Your Skills have been saved.')));
            }
        } else {
           redirect('/login/editUserProfile');
        }
    }

}