<?php

/*
 * the login page
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('captcha');
        $this->load->model('Muser', 'user');
        $this->load->model('Mskills', 'skills');
        $this->load->model('Mcompany', 'company');
		$this->load->model('Maward', 'award');
        $this->load->helper('file');
//        $this->output->enable_profiler(TRUE);
    }

    function index() {
        $this->signUp( );
    }

    function signUp() {
        $logged = $this->session->userdata('member_id');
        if (isset($logged) && $logged != FALSE) {

            $this->editUserProfile();
        } else {
            // display information for the view
            $data['title'] = "SignUp to search jobs";
            $data['include'] = "signup.php";
            // ============CAPTCHA===================================       
            $vals = array(
                'img_path' => './images/captcha/',              
                'img_url' => base_url() . 'images/captcha/',
                'img_width' => '120',
                'img_height' => '30',
                'font_path' => './images/captchaFONT/tahomabd.ttf',
                'expiration' => '7200'
            );
            $data['CAPTCHA'] = create_captcha($vals);

            $this->load->view('template2', $data);
        }
    }

    function changePwd() {
        // display information for the view
        $data['title'] = "Change password";
        $data['include'] = "changePwd.php";

        $this->load->view('template2', $data);
        
    }

    /**
     * view (glide switching)  page to edit profile
     */
    function editUserProfile() {
        $logged = $this->session->userdata('member_id');
        $accessLevel = $this->session->userdata('access_level_id');
        if (isset($logged) && $logged != FALSE) {
            // display information for the view
            $data['title'] = "Edit User Profile";
            $data['include'] = "editUserProfile.php";
            if ($accessLevel == 2) {
                $data['companyCategories'] = $this->company->selectAllCompanyCategories();
            }
            $this->load->view('template2', $data);
        } else {
            $this->login_page();
        }
    }

    function editUserAwards() {
        $logged = $this->session->userdata('member_id');
        if (isset($logged) && $logged != FALSE) {
            $data['title'] = "Edit User Awards";
            $data['include'] = "editProfile/user/awards.php";

            $this->load->view('template2', $data);
        } else {
            $this->login_page();
        }
    }

    /**
     * function that stores sign up form values to DB
     */
    function signup2DB() {
        if (isset($_POST)) {// if posted with a username, validate login or generate error message
            if ($this->form_validation->run('signup') == FALSE) {
                $this->form_validation->set_message('greater_than[0]', 'The %s is an Invalid User Account Type');
                $this->form_validation->set_message('less_than[3]', 'The %s is an Invalid User Account Type');
                $this->signUp();
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $email = $this->input->post('email');
                $access_level_id = $this->input->post('access_level_id'); //this represent the user account type: 1(member), 2(enterprise), etc...
                delete_files('./images/captcha/', TRUE);
                if ($this->user->selectByUsername($username) == FALSE) {
                    if ($this->user->selectByEmail($email) == FALSE) {
                        //we insert new user if there's no email like this in the DB
                        $lastInsertID = $this->user->signUp($email, $username, $password, $access_level_id);
                        $this->session->set_userdata('member_id', $lastInsertID);
                        $this->session->set_userdata('username', $username);
                        $this->session->set_userdata('email', $email);
                        $this->session->set_userdata('password', md5($password));
                        $this->session->set_userdata('access_level_id', $access_level_id);

                        $this->session->set_userdata('name', "");
                        $this->session->set_userdata('gender', "");
                        $this->session->set_userdata('mobile', "");
                        $this->session->set_userdata('photo', "");
                        $this->session->set_userdata('dob', "");


                        $this->session->set_userdata('facebook', "");
                        $this->session->set_userdata('twitter', "");
                        $this->session->set_userdata('linkedIn', "");

                        $this->session->set_userdata('skills', "");

//                        $this->editUserProfile();
                        redirect('/login/editUserProfile/');
//                        redirect('/login/login_page');
                    } else {
                        $this->session->set_userdata('emailExistError', 'The current Email is already used in the site.');
                        $this->index();
                    }
                } else {
                    $this->session->set_userdata('emailExistError', 'The current Username is already used in the site.');
                    $this->index();
                }
            }
        } else {
            $this->login_page();
        }
    }

    function forgot_password_page() {
        // display information for the view
        $data['title'] = "Forgot Password";
        $data['include'] = "forgot_password_page.php";

        $this->load->view('template2', $data);
    }

    //login and components
    function login_page() {
        // display information for the view
        $data['title'] = "Log into your account";
        $data['include'] = "login_page.php";

        $this->load->view('template2', $data);
    }

    function signIn() {
        if (isset($_POST)) {// if posted
            if ($this->form_validation->run('login') == FALSE) {
                $this->login_page();
            } else {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $result = $this->user->findByEmailAndPassword($email, $password);
                if ($result != FALSE) {
                    $this->session->set_userdata('member_id', $result->member_id);
                    $this->session->set_userdata('username', $result->username);
                    $this->session->set_userdata('email', $result->email);
                    $this->session->set_userdata('name', $result->name);
                    $this->session->set_userdata('access_level_id', $result->access_level_id);
                    $this->session->set_userdata('gender', $result->gender);
                    $this->session->set_userdata('mobile', $result->mobile);
                    $this->session->set_userdata('photo', $result->photo);
                    $this->session->set_userdata('password', $result->password);
                    $this->session->set_userdata('dob', $result->dob);
                    //
                    $this->session->set_userdata('facebook', $result->facebook);
                    $this->session->set_userdata('twitter', $result->twitter);
                    $this->session->set_userdata('linkedIn', $result->linkedIn);
                    $this->session->set_userdata('skills', "");
                    $resultSkills = $this->skills->findByMemberId($result->member_id);
                    if ($resultSkills != FALSE) {
                        $this->session->set_userdata('skills', $resultSkills->title);
                    }
                    //
                    redirect(base_url());
                } else {
                    $this->session->set_userdata('loginError', 'Incorrect Email/Password combination');
                    $this->login_page();
                }
            }
        } else {
            $this->login_page();
        }
    }

    function logout() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            $this->login_page();
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    //end
    //change password
    function change_password() {
        if (isset($_POST)) {// if posted
            if ($this->form_validation->run('change_password') == FALSE) {
                $this->changePwd();
            } else {
                $logged = $this->session->userdata('member_id');
                if (($logged == FALSE)) {
                    $this->login_page();
                } else {
                    $current_password = md5($this->input->post('current_password'));
                    if ($current_password != $this->session->userdata('password')) {
                        $this->session->set_userdata('changePasswordError', 'The current password doesn\'t match, try again.');
                        $this->changePwd();
                    } else {
                        $password = $this->input->post('password');
                        $this->user->change_password($password, $this->session->userdata('member_id'));
                        $this->session->set_userdata('password', md5($password));
                        $this->session->set_userdata('changePasswordError', 'The password has been changed successfully.');
                        $this->changePwd();
                    }
                }
            }
        } else {
            $this->login_page();
        }
    }

    //yousilb
    function editPersonalInformations() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted
            if ($this->form_validation->run('editPersonalInformations') == FALSE) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            } else {
                extract($_POST);
                $result = $this->user->selectByEmail($email);
                if ($result != FALSE) {
                    //so the email address is in use by someone else or by the current user
                    if ($result['member_id'] != $logged)
                        die(json_encode(array('Error' => 1, 'Message' => 'The current Email is already used in the site.')));
                }
                $result = $this->user->selectByUsername($username);
                if ($result != FALSE) {
                    //so the email address is in use by someone else or by the current user
                    if ($result['member_id'] != $logged)
                        die(json_encode(array('Error' => 1, 'Message' => 'The current Username is already used in the site.')));
                }
                //convert de DOB to timestamp before sending it to the model
                if ($dob != "") {
                    $dob = explode('-', $dob);
                    $year = $dob[0];
                    $month = $dob[1];
                    $day = $dob[2];
                    $dob = mktime(0, 0, 0, $month, $day, $year);
                }
                //we save informations in the database    
                $this->user->editPersonalInformations($dob, $email, $gender, $mobile, $name, $username, $this->session->userdata('member_id'));

                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('email', $email);
                $this->session->set_userdata('name', $name);
                $this->session->set_userdata('gender', $gender);
                $this->session->set_userdata('mobile', $mobile);
                $this->session->set_userdata('dob', $dob);

                die(json_encode(array('Error' => 0, 'Message' => 'Your Personal informations have been saved.')));
            }
        } else {
            $this->editUserProfile();
        }
    }

    function editLinks() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted
            if ($this->form_validation->run('editLinks') == FALSE) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            } else {
                extract($_POST);
                //we save informations in the database    
                $this->user->editLinks($facebook, $twitter, $linkedIn, $this->session->userdata('member_id'));

                $this->session->set_userdata('facebook', $facebook);
                $this->session->set_userdata('twitter', $twitter);
                $this->session->set_userdata('linkedIn', $linkedIn);

                die(json_encode(array('Error' => 0, 'Message' => 'Your Links have been saved.')));
            }
        } else {
            $this->editUserProfile();
        }
    }

    //end yousilb

    function reInitializePwd() {

        if (isset($_POST)) {// if posted
            if ($this->form_validation->run('reinitializePasswd') == FALSE) {
                $this->forgot_password_page();
            } else {

                $email = ($this->input->post('email'));
                $result = $this->user->selectByEmail($email);
                if ($result == FALSE) {
                    //this email is not in our database
                    $this->session->set_userdata('emailError', 'The Email you entered is not in our Database');
                    $this->forgot_password_page();
                } else {
                    $generatedWord = $this->generateNumCode();
                    /*** replace DB passwd with regenerated one**/
                    $this->user->storeReInitializedPwd($email, $generatedWord);
                    /******* {end}*******************************/
                    $this->load->library('email'); //not obligatory since its initialized in the config file

                    $this->email->from('noreply@nationaljoblist.com', 'NATIONAL JOB LIST');
                    $this->email->to($email);
                    $this->email->subject('PASSWORD RE-INITIALISATION NATIONALJOB LISTS');
                    
                    $msg = "You just asked for re-initialisation of your password 
                        at http://www.nationaljoblist.com/, a password was generated 
                        for you, use it to login to  http://www.nationaljoblist.com/ and change your password later<br/><br/>
                        Your generated password is = \"$generatedWord\"";
                    $this->email->message($msg);

                    if($this->email->send()){
                        $this->index();
                    }else{
                        echo $this->email->print_debugger();
                    }

                }
            }
        } else {
            $this->forgot_password_page();
        }
    }

    private function generateNumCode() {
        $liste = '1234567890';
        $lenght = 9;
        $numCode = '';
        while (strlen($numCode) != $lenght) {
            $temp = $liste[rand(0, $lenght)];
            $numCode .= $temp;
        }

        return $numCode;
    }
    
    function photo() {
        $logged = $this->session->userdata('member_id');
        $accessLevel = $this->session->userdata('access_level_id');
        if (isset($logged) && $logged != FALSE) {
            // display information for the view
            $data['title'] = "Edit User Photo";
            $data['include'] = "photo.php";
            if ($accessLevel == 2) {
                $data['companyCategories'] = $this->company->selectAllCompanyCategories();
            }
            $this->load->view('template2', $data);
        } else {
            $this->login_page();
        }
    }
    
    //yousilb
    function workHistory() {
        $logged = $this->session->userdata('member_id');
        if (isset($logged) && $logged != FALSE) {
            $data['title'] = "Work history";
            $data['include'] = "editProfile/user/work_history.php";

            $this->load->view('template2', $data);
        } else {
            $this->login_page();
        }
    }
    function reference() {
        $logged = $this->session->userdata('member_id');
        if (isset($logged) && $logged != FALSE) {
            $data['title'] = "Reference";
            $data['include'] = "editProfile/user/reference.php";

            $this->load->view('template2', $data);
        } else {
            $this->login_page();
        }
    }
    function professionnalTraining() {
        $logged = $this->session->userdata('member_id');
        if (isset($logged) && $logged != FALSE) {
            $data['title'] = "Professionnal Training";
            $data['include'] = "editProfile/user/special_professional_training.php";

            $this->load->view('template2', $data);
        } else {
            $this->login_page();
        }
    }
    function document() {
        $logged = $this->session->userdata('member_id');
        if (isset($logged) && $logged != FALSE) {
            $data['title'] = "Document";
            $data['include'] = "editProfile/user/document.php";

            $this->load->view('template2', $data);
        } else {
            $this->login_page();
        }
    }
    function uploadDocument() {
        $logged = $this->session->userdata('member_id');
        if (isset($logged) && $logged != FALSE) {
            $data['title'] = "Document";
            $data['include'] = "editProfile/user/uploadDocument.php";

            $this->load->view('template2', $data);
        } else {
            $this->login_page();
        }
    }
    //end yousilb
}

/* End of file template.php */
/* Locat
 * 
 * ion: ./system/application/controllers/template.php */