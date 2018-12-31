<?php

/*
 * the skills page
 */

class Award extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Maward', 'award');
        $this->load->helper('file');
//        $this->output->enable_profiler(TRUE);
    }

    function index() {
        
    }

    function addAward() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted with a username, validate login or generate error message
            if ($this->form_validation->run('addAward') == FALSE) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            } else {
                extract($_POST);
                $date = explode('-', $date);
                $year = $date[0];
                $month = $date[1];
                $day = $date[2];
                $date = mktime(0, 0, 0, $month, $day, $year);
                //we save informations in the database
                $theAward = $this->award->addAward($title, $issuing_organization, $date, $place, $description, $logged);
                //add the new award to the array of awards already in the session
                //or recreate the entire session AWARD
                $awards = $this->award->fetchByMemberId($logged);
                $this->session->set_userdata('awards', $awards);

                die(json_encode(array('Error' => 0, 'Message' => 'Your Award has been saved.')));
            }
        } else {
            redirect('/login/editUserAwards');
        }
    }

    function editAward() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted with a username, validate login or generate error message
            if ($this->form_validation->run('addAward') == FALSE) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            } else {
                extract($_POST);
                $date = explode('-', $date);
                $year = $date[0];
                $month = $date[1];
                $day = $date[2];
                $date = mktime(0, 0, 0, $month, $day, $year);
                //we update informations in the database
                $theAward = $this->award->editAward($title, $issuing_organization, $date, $place, $description, $award_id);
                //add the updated award to the array of awards already in the session
                //or recreate the entire session AWARD
                $awards = $this->award->fetchByMemberId($logged);
                $this->session->set_userdata('awards', $awards);

                die(json_encode(array('Error' => 0, 'Message' => 'Your Award has been updated.')));
            }
        } else {
            redirect('/login/editUserAwards');
        }
    }

    function deleteAward() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted with a username, validate login or generate error message            
            extract($_POST);
            $listId = explode(',', $listId);
            foreach ($listId as $award_id) {
                //we delete informations in the database
                $this->award->deleteAward($award_id, $logged);
            }
            //add the delete award to the array of awards already in the session
            //or recreate the entire session AWARD
            $personalMessage = 'Award DELETED!';
            if(count($listId) > 1)
                $personalMessage = 'Award(s) DELETED!';
            $this->refreshAwardList($personalMessage);
        } else {
            redirect('/login/editUserAwards');
        }
    }

    function refreshAwardList($personalMessage = null) {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        $awards = $this->award->fetchByMemberId($logged);
        $this->session->set_userdata('awards', $awards);
        echo '<table cellpadding="0" cellspacing="0" border="0" class="display" id="awardTableList">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Issuing Organization</th>
                            <th>Date</th>
                            <th>Place</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Issuing Organization</th>
                            <th>Date</th>
                            <th>Place</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>';
        $array_awards = '';
        foreach ($awards as $award) {
            $javascript_award_object = ',{"award_id":"' . $award['award_id'] . '",
                                        "title":"' . $award['title'] . '",
                                        "issuing_organization":"' . $award['issuing_organization'] . '",
                                        "date":"' . date('Y-m-d', $award['date']) . '",
                                        "place":"' . $award['place'] . '",
                                        "description":"' . $award['description'] . '"}';
            $array_awards .= $javascript_award_object;

            echo'    <tr class="gradeA" rel="' . $award['award_id'] . '">
                    <td>' . $award['title'] . '</td>
                    <td>' . $award['issuing_organization'] . '</td>
                    <td>' . date('Y-m-d', $award['date']) . '</td>
                    <td>' . $award['place'] . '</td>
                    <td>' . $award['description'] . '</td>
                    <td class="center">
                        <input class="editAward" id="' . $award['award_id'] . '" type="button" value = "Edit" />
                    </td>
                </tr>';
        }
        $array_awards = '[' . substr($array_awards, 1) . ']';

        echo '
    </tbody>
    </table>
    <script type="text/javascript">
        $(function(){        
            var array_awards= ' . $array_awards . ';
            var oTable = $(\'#awardTableList\').dataTable( {
                "sDom": \'T<"clear">lfrtip\',
                "oTableTools": {
                    "sRowSelect": "multi",
                    "aButtons": [ "select_all", "select_none" ]
                },
                "bJQueryUI": true,
                "sPaginationType": "full_numbers"
            });
            $(\'.editAward\').click(function() { 
                $(\'#modal_parent_div\').show();
                $(\'.modal_windows\').hide();
                $(\'#modal_contener\').show();
                $(\'#modal_content\').html($(\'#edit_award_form_div\').html());
                $(\'#modal_content form\').attr(\'id\', \'editAwardForm\');
                $(\'#modal_content #award_id\').val($(this).attr(\'id\'));
                for(var i=0;i<array_awards.length;i++){
                    if(array_awards[i].award_id == $(this).attr(\'id\')){
                        $(\'#edit_title\').val(array_awards[i].title);
                        $(\'#edit_issuing_organization\').val(array_awards[i].issuing_organization);
                        $(\'#edit_date\').val(array_awards[i].date);
                        $(\'#edit_place\').val(array_awards[i].place);
                        $(\'#edit_description\').val(array_awards[i].description);
                    }
                }
            });   
        });    
    </script>';
        if ($personalMessage !== null) {
            echo '
                <script type="text/javascript">
                    $(function(){        
                        alert("' . $personalMessage . '");
                    });    
                </script>';
        }
    }

}