<?php

//error_reporting(0);
/*
 * generate USER CV in pdf format
 */

class Pdf extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Maward', 'award');
        $this->load->model('mworkhistory', 'workhistory');
        $this->load->model('mprofessionnaltraining', 'profTraining');
        $this->load->model('mskills', 'skills');
        $this->load->model('mreference', 'ref');
        $this->load->helper('file');
//        $this->load->helper('download');
//        $this->output->enable_profiler(TRUE);
    }

    function index() {
        $this->displayCV();
    }

    /**
     * display the HTML version first before PDF generate 
     */
    function displayCV() {
        $member_id = $this->session->userdata('member_id');
        $name = $this->session->userdata('name');
        if (isset($member_id) && $member_id != FALSE) {
            $data['title'] = 'CV : ' . $name;

            $data['workHistory'] = $this->workhistory->fetchByMemberId($member_id);
            $data['profTraining'] = $this->profTraining->fetchByMemberId($member_id);
            $data['award'] = $this->award->fetchByMemberId($member_id);
            $data['ref'] = $this->ref->fetchByMemberId($member_id);
            $data['skills'] = $this->skills->findByMemberId2($member_id);
            $this->load->view('cv2', $data);
        } else {
            redirect('/login/login_page/');
        }
    }

    function generate() {
        $member_id = $this->session->userdata('member_id');
        if (isset($member_id) && $member_id != FALSE) {
//            $this->_createHTML();
            $strContent = read_file('./medias/pdf_cvs/mycv.html'); //Returns FALSE (boolean) on failure.           
            if ($strContent != FALSE) {
                require('pdf_scripts/html2fpdf.php');
                $pdf = new HTML2FPDF();
                $pdf->AddPage();
                $pdf->WriteHTML($strContent);
                $pdf->Output('medias/pdf_cvs/cv_' . $member_id . '.pdf');
                
                $url = site_url('pdf/blankPage'); //prepare the link for redirection by JS (since header has alredy been sent
                $this->js_redirect($url);
            } else {
                echo "cannot read file";
            }
        } else {
            redirect('/login/login_page/');
        }
    }

    function js_redirect($url, $seconds = 0) {
        echo "<script language=\"JavaScript\">\n";
        echo "<!-- hide from old browser\n\n";
        echo "function redirect() {\n";
        echo "window.location = \"" . $url . "\";\n";
        echo "}\n\n";
        echo "timer = setTimeout('redirect()', '" . ($seconds * 1000) . "');\n\n";
        echo "-->\n";
        echo "</script>\n";
        return true;
    }

    function blankPage() {
        $member_id = $this->session->userdata('member_id');
        $name = $this->session->userdata('name');
        if (isset($member_id) && $member_id != FALSE) {
            $data['title'] = 'CV : ' . $name;

            $this->load->view('blankPage', $data);
        } else {
            redirect('/login/login_page/');
        }
    }

    private function _createHTML() {
//        $returnContent ="<html>";
//        $returnContent .="<head>";
//        $returnContent .="<title>FACTURE/BON DE COMMANDE</title>";
//        $returnContent .="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
//        $returnContent .="</head>";
//        $returnContent .="<body style=\"background: #EEEEEE;font-family: Arial;\">";
//       
//        $returnContent .="<table width=\"100%\" border=\"1\" align=\"center\">
//                <thead style=\"background-color: #000000;    font-family: Arial;    font-weight: bold;\">
//                    <tr>                            
//                        <td>Titre</td>
//                        <td>Affiche</td>
//                        <td>Taille</td>
//                        <td>Prix</td>
//                    </tr>
//                </thead>";
//       
//        $returnContent .= "<center><h3>Merci de votre confiance</h3></center>
//                    <center><h3>Contact: (+237) 55 26 11 47 / 75 33 11 01. Yaoundé.         2013. <a href=\"http://www.cvraimentbien.com\" title=\"leSite\" >www.cvraimentbien.com</a></h3></center>
//                    <hr />
//                    </body>
//                    </html>";
////        $monfichier = fopen("order_html_to_pdf/sample.html", "w");
////        fputs($monfichier, ($returnContent));
////        fclose($monfichier);
//        $pdfFileGenerate = write_file('./medias/pdf_cvs/cv.html', $returnContent, 'w');
//        if ($pdfFileGenerate) {
//            $file = get_filenames('./medias/pdf_cvs/').'cv.html';
//            chmod($file, 777);
//        }else{
//            echo "unable to generate file";
//        }
    }

}