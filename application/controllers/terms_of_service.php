<?php

/*
 * the TERMS OF SERVICE
 */

class Terms_of_service extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
//        $this->load->library('form_validation');
//        $this->load->helper('captcha');
//        $this->load->model('Muser', 'user');
//        $this->load->helper('file');
//        $this->output->enable_profiler(TRUE);
    }

    function index() {
        // display information for the view
        $data['title'] = "Terms of reference";
        $data['include'] = "tos.php";
        

        $this->load->view('template2', $data);
    }

  

}

/* End of file template.php */
/* Location: ./system/application/controllers/template.php */