<?php

/*
 * the skills page
 */

class Company extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Mcompany', 'company');
        $this->load->helper('file');
//        $this->load->library('calendar');
//        $this->output->enable_profiler(TRUE);
        $this->load->helper('text');
    }

    function index() {
        $member_id = $this->session->userdata('member_id');
        if (isset($member_id) && $member_id != FALSE) {
            $this->listJobs();
        } else {
            redirect('/login/login_page/');
        }
    }

    function editJob($jobID) {
        $member_id = $this->session->userdata('member_id');
        if (isset($member_id) && $member_id != FALSE) { //are u logged ??
            if (is_integer(intval($jobID))) {//is parameter an integer
                $result = $this->company->selectJobByID($jobID);
                if ($result != FALSE) {//if job  exists then....
                    if ($result->owner == $member_id) {//if the job belongs to currently logged owner
                        $thisJobCategories = $this->company->selectPresentJobCategories($jobID, $member_id);
                        $data['title'] = "Edit job details";
                        $data['include'] = "editProfile/enterprise/editJobsForm.php";
                        $data['job'] = $result;
                        $data['companyCategories'] = $this->company->selectAllCompanyCategories();
//                        $data['PresentJobCategories'] = ($thisJobCategories != FALSE) ? $thisJobCategories : FALSE;
                        $data['PresentJobCategories'] = $thisJobCategories;
                        $this->load->view('template2', $data);
                    } else {
                        ?>
                        <script>alert('You are not the owner of this job');</script>
                        <?php

                        $this->listJobs();
                    }
                } else {
                    ?>
                    <script>alert('Job doesn\'t exist');</script>
                    <?php

                    $this->listJobs();
                }
            } else {
                ?>
                <script>alert('invalid URL parameter');</script>
                <?php

                $this->listJobs();
            }
        } else {
            redirect('/login/login_page/');
        }
    }

    function deleteJob($jobID) {
        $member_id = $this->session->userdata('member_id');
        if (isset($member_id) && $member_id != FALSE) { //are u logged ??
            if (is_integer(intval($jobID))) {//is parameter an integer
                $result = $this->company->selectJobByID($jobID);
                if ($result != FALSE) {//if job  exists then....
                    if ($result->owner == $member_id) {//if the job belongs to currently logged owner
                        $this->company->deleteJob($jobID);
                        $this->listJobs();
                    } else {
                        ?>
                        <script>alert('You are not the owner of this job');</script>
                        <?php

                        $this->listJobs();
                    }
                } else {
                    ?>
                    <script>alert('Job doesn\'t exist');</script>
                    <?php

                    $this->listJobs();
                }
            } else {
                ?>
                <script>alert('not an interger');</script>
                <?php

                $this->listJobs();
            }
        } else {
            redirect('/login/login_page/');
        }
    }

    function listJobs() {
        $member_id = $this->session->userdata('member_id');
        if (isset($member_id) && $member_id != FALSE) {
            $data['title'] = "List company jobs";
            $data['include'] = "editProfile/enterprise/listJobs.php";
            $data['jobsForThisCompany'] = $this->company->selectAllJobsByCompany($member_id);
            $this->load->view('template2', $data);
        } else {
            redirect('/login/login_page/');
        }
    }

    function createJob() {
        $logged = $this->session->userdata('member_id');
        $accessLevel = $this->session->userdata('access_level_id');
        if (isset($logged) && $logged != FALSE) {
            $data['title'] = "Create New Job";
            $data['include'] = "editProfile/enterprise/createJob.php";
            if ($accessLevel == 2) {
                $data['companyCategories'] = $this->company->selectAllCompanyCategories();
            }
            $this->load->view('template2', $data);
        } else {
            redirect('/login/login_page/');
        }
    }

    function addJob() {
        $memberID = $this->session->userdata('member_id');
        if (isset($memberID) && $memberID != FALSE) {
            if (isset($_POST)) {
                if ($this->form_validation->run('addJob') == FALSE) {
//               
                    $this->createJob();
                } else {

                    $jobTitle = $this->input->post('jobTitle');
                    $jobDescription = $this->input->post('jobDescription');
                    $jobSkills = $this->input->post('jobSkills');
                    $jobSpecialTraining = $this->input->post('jobSpecialTraining');
                    $companyTypeID = $this->input->post('companyCategorie'); //this is array
                    $contractType = $this->input->post('contractType');
                    $educationRequirement = $this->input->post('educationRequirement');
                    $deadline = $this->input->post('deadline');

                    //convert DEADLINE to timestamp
                    if ($deadline != "") {
                        $deadline = explode('-', $deadline);
                        $year = $deadline[0];
                        $month = $deadline[1];
                        $day = $deadline[2];
                        $deadline = mktime(0, 0, 0, $month, $day, $year);
                    }

//                    print_r($companyCategorie);
                    foreach ($companyTypeID as $key => $value) {
                        //$value corresponds to #categorieID checked in the checkboxes
                        $this->company->associateJobToCategory($memberID, $value); #DB insert
                    }
                    $this->company->addNewJob($memberID, $jobDescription, $jobTitle, $deadline, $jobSkills, $jobSpecialTraining, $contractType, $educationRequirement);
                    $this->session->set_userdata('jobRegistered', 'The Job has been registered correctly....');
                    ?>
                        <script>alert('The Job has been registered successfully');</script>
                        <?php
                    $this->createJob();
                }
            } else {
                $this->createJob();
            }
        } else {
            redirect('/login/login_page/');
        }
    }

    function SaveEditedJob() {
        $memberID = $this->session->userdata('member_id');
        if (isset($memberID) && $memberID != FALSE) {
            if (isset($_POST)) {
                if ($this->form_validation->run('addJob') == FALSE) {
                    $jobID = intval($this->input->post('jobID'));
                    $this->editJob($jobID);
                } else {
                    $jobID = intval($this->input->post('jobID'));
                    $jobTitle = $this->input->post('jobTitle');
                    $jobDescription = $this->input->post('jobDescription');
                    $jobSkills = $this->input->post('jobSkills');
                    $jobSpecialTraining = $this->input->post('jobSpecialTraining');
                    $companyTypeID = $this->input->post('companyCategorie'); //this is array
                    $contractType = $this->input->post('contractType');
                    $educationRequirement = $this->input->post('educationRequirement');
                    $deadline = $this->input->post('deadline');

                    //convert DEADLINE to timestamp
                    if ($deadline != "") {
                        $deadline = explode('-', $deadline);
                        $year = $deadline[0];
                        $month = $deadline[1];
                        $day = $deadline[2];
                        $deadline = mktime(0, 0, 0, $month, $day, $year);
                    }


                    //empty "kj_jobs_and_their_categories" table to repopulate
                    //removing only the categories that was checked for this copmpany
                    //$memberID corresponds to the ID of the company in the member table
                    $this->company->emptyJobAndCategorie($memberID);
                    
                    //repopulation
                    foreach ($companyTypeID as $key => $value) {
                        //$value corresponds to #categorieID checked in the checkboxes
                        $this->company->associateJobToCategory($memberID, $value); #DB insert
                    }
                    $this->company->addEditedJob($jobID,$memberID, $jobDescription, $jobTitle, $deadline, $jobSkills, $jobSpecialTraining, $contractType, $educationRequirement);
                    $this->session->set_userdata('jobEdited', 'The Job has been updated successfully....');
                     ?>
                        <script>alert('The Job has been updated successfully....');</script>
                        <?php
//                    $this->editJob($jobID);
                    $this->listJobs();
                }
            } else {
                $this->createJob();
            }
        } else {
            redirect('/login/login_page/');
        }
    }

}