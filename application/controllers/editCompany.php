<?php

/*
 * controller for editing company's information
 */

class EditCompany extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('captcha');
        $this->load->model('Muser', 'user');
        $this->load->model('Mcompany', 'company');
        $this->load->helper('file');
//        $this->output->enable_profiler(TRUE); 
    }

    function editCompanyInformations() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted
            if ($this->form_validation->run('editCompanyInformations') == FALSE) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            } else {
                extract($_POST);
//                $result = $this->user->selectByEmail($email);
//                if ($result != FALSE) {
//                    //so the email address is in use by someone else or by the current user
//                    if ($result['member_id'] != $logged)
//                        die(json_encode(array('Error' => 1, 'Message' => 'The current Email is already used in the site.')));
//                }
//                $result = $this->user->selectByUsername($username);
//                if ($result != FALSE) {
//                    //so the email address is in use by someone else or by the current user
//                    if ($result['member_id'] != $logged)
//                        die(json_encode(array('Error' => 1, 'Message' => 'The current Username is already used in the site.')));
//                }
                //convert de DOB to timestamp before sending it to the model
                if($companyCreationDate != ""){
                    $companyCreationDate = explode('-', $companyCreationDate);
                    $year = $companyCreationDate[0];
                    $month = $companyCreationDate[1];
                    $day = $companyCreationDate[2];
                    $companyCreationDate = mktime(0, 0, 0, $month, $day, $year);
                }
                //we save informations in the database  
                $result = $this->company->findByMemberId($logged);
                if ($result != FALSE) {                    
                    $this->user->editPersonalInformations($this->session->userdata('dob'), $email, NULL, $mobile, $name, $username, $this->session->userdata('member_id'));
                    $this->company->editCompanyInformations($companyType, $companyCreationDate, $nameHiringPersonnal, $portrait, $this->session->userdata('member_id'));
                }else{
                   $this->user->editPersonalInformations($this->session->userdata('dob'), $email, NULL, $mobile, $name, $username, $this->session->userdata('member_id'));
                    $this->company->addCompanyInformations($companyType, $companyCreationDate, $nameHiringPersonnal, $portrait, $this->session->userdata('member_id'));
                }
//                $this->company->editCompanyInformations($name, $companyType, $companyCreationDate, $email, $nameHiringPersonnal, $username, $mobile,$portrait, $this->session->userdata('member_id'));

                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('company_type_id', $companyType);
                $this->session->set_userdata('company_creation_date', $companyCreationDate);
                $this->session->set_userdata('name_hiring_personnel', $nameHiringPersonnal);
                $this->session->set_userdata('company_portrait', $portrait);
                $this->session->set_userdata('email', $email);
                $this->session->set_userdata('name', $name);
                $this->session->set_userdata('mobile', $mobile);
                $this->session->set_userdata('dob', $companyCreationDate);

                die(json_encode(array('Error' => 0, 'Message' => 'Your Personal informations have been saved.')));
            }
        } else {
            redirect('/login/editUserProfile/');
        }
    }

}

/* End of file template.php */
/* Location: ./system/application/controllers/template.php */