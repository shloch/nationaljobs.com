<?php

/*
 * the login page
 */

class Feedback extends CI_Controller {

        function __construct() {
                parent::__construct();
                $this->load->helper('url');   
        }

        function index() {
                // display information for the view
                $data['title'] = "Tell us what you think";
                $data['include'] = "feedback.php";

                $this->load->view('template2', $data);
        }
        
        

}

/* End of file template.php */
/* Location: ./system/application/controllers/template.php */