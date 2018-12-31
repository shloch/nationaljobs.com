<?php

/*
 * the "contact us" page
 */

class ContactUs extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('captcha');
        $this->load->model('Mcontact_us', 'contact');
//        $this->output->enable_profiler(TRUE);
        $this->load->helper('text');
    }

    function index() {
        $this->contactForm();
    }

    function contactForm() {
        $data['title'] = "Contact Us";
//         delete_files('./images/captcha/', TRUE);
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

        $this->load->view('template_contactUs', $data);
    }

    function addContactMsg() {
//        $memberID = $this->session->userdata('member_id');
//        if (isset($memberID) && $memberID != FALSE) {
        if (isset($_POST)) {
            if ($this->form_validation->run('contactUs') == FALSE) {
//               
                $this->contactForm();
            } else {

                $name = $this->input->post('name');
                $phone = $this->input->post('phone');
                $email = $this->input->post('email');
                $comment = $this->input->post('comment');

                $this->contact->addContactMsg($phone, $name, $email, $comment);
                $this->session->set_userdata('jobRegistered', $name . ', Your message has been sent, you\'ll be contacted very soon....');
                ?>
                <script>alert(' Your message has been sent, you\'ll be contacted very soon....');</script>
                <?php

                /*************send email of notification to admin************ */
                
                $this->load->library('email'); //not obligatory since its initialized in the config file

                $this->email->from($email, $name);
                $this->email->to('shloch2007@yahoo.fr');
                $this->email->subject('SUGGESTIONS,QUERIES,COMMENTS FROM NATIONAL JOBS');

                $this->email->message($comment);

                if ($this->email->send()) {
                    $this->contactForm();
                } else {
                    echo $this->email->print_debugger();
                }
                /******************************************************** */
            }
        } else {
            $this->contactForm();
        }
//        } else {
//            redirect('/login/login_page/');
//        }
    }

}