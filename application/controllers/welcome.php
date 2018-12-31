<?php

/*
 * home.php
 */

class Welcome extends CI_Controller {

        function __construct() {
                parent::__construct();
                $this->load->helper('url');   
        }

        function index() {
                // display information for the view
                $data['title'] = "Search jobs all over the United States of America";

                $this->load->view('welcome', $data);
        }

}

/* End of file template.php */
/* Location: ./system/application/controllers/template.php */