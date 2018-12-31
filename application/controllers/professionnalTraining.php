<?php

/*
 * the ProfessionnalTraining page
 */

class ProfessionnalTraining extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Mprofessionnaltraining', 'professionnalTraining');
        $this->load->helper('file');
    }

    function index() {
        
    }

    function add() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted with a username, validate login or generate error message
            if ($this->form_validation->run('addProfessionnalTraining') == FALSE) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            } else {
                extract($_POST);
                //we save informations in the database
                $professionnalTraining = $this->professionnalTraining->add($trainer, $training_period, $certificate_obtened, $logged);
                
                $professionnalTrainings = $this->professionnalTraining->fetchByMemberId($logged);
                $this->session->set_userdata('professionnalTrainings', $professionnalTrainings);

                die(json_encode(array('Error' => 0, 'Message' => 'Your Training has been saved.')));
            }
        } else {
            redirect('/login/professionnalTraining');
        }
    }

    function edit() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted with a username, validate login or generate error message
            if ($this->form_validation->run('addProfessionnalTraining') == FALSE) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            } else {
                extract($_POST);                
                //we save informations in the database
                $professionnalTraining = $this->professionnalTraining->edit($trainer, $training_period, $certificate_obtened, $special_professionnal_training_id, $logged);                
                $professionnalTrainings = $this->professionnalTraining->fetchByMemberId($logged);
                $this->session->set_userdata('professionnalTrainings', $professionnalTrainings);
                die(json_encode(array('Error' => 0, 'Message' => 'Your Training has been updated.')));
            }
        } else {
            redirect('/login/professionnalTraining');
        }
    }

    function delete() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted with a username, validate login or generate error message            
            extract($_POST);
            $listId = explode(',', $listId);
            foreach ($listId as $special_professionnal_training_id) {
                //we delete informations in the database
                $this->professionnalTraining->delete($special_professionnal_training_id, $logged);
            }
            //add the delete training to the array of awards already in the session
            //or recreate the entire session AWARD
            $personalMessage = 'Training DELETED!';
            if(count($listId) > 1)
                $personalMessage = 'Training(s) DELETED!';
            $this->refreshList($personalMessage);
        } else {
            redirect('/login/professionnalTraining');
        }
    }

    function refreshList($personalMessage = null) {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        $professionnalTrainings = $this->professionnalTraining->fetchByMemberId($logged);
        $this->session->set_userdata('professionnalTrainings', $professionnalTrainings);
        echo '<table cellpadding="0" cellspacing="0" border="0" class="display" id="professionnalTrainingTableList">
                    <thead>
                        <tr>
                            <th>Trainer</th>
                            <th>Period</th>
                            <th>Certificate Obtened</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Trainer</th>
                            <th>Period</th>
                            <th>Certificate Obtened</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>';
        $array_professionnalTrainings = '';
        foreach ($professionnalTrainings as $professionnalTraining) {
            $javascript_object = ',{"special_professionnal_training_id":"' . $professionnalTraining['special_professionnal_training_id'] . '",
                                    "trainer":"' . $professionnalTraining['trainer'] . '",
                                    "training_period":"' . $professionnalTraining['training_period'] . '",
                                    "certificate_obtened":"' . stripslashes($professionnalTraining['certificate_obtened']) . '"}';
            $array_professionnalTrainings .= $javascript_object;

            echo'    <tr class="gradeA" rel="' . $professionnalTraining['special_professionnal_training_id'] . '">
                    <td>' . stripslashes($professionnalTraining['trainer']) . '</td>
                    <td>' . stripslashes($professionnalTraining['training_period']) . '</td>
                    <td>' . stripslashes($professionnalTraining['certificate_obtened']) . '</td>
                    <td class="center">
                        <input class="editAward editProfessionnalTraining" id="' . $professionnalTraining['special_professionnal_training_id'] . '" type="button" value = "Edit" />
                    </td>
                </tr>';
        }
        $array_professionnalTrainings = '[' . substr($array_professionnalTrainings, 1) . ']';

        echo '
    </tbody>
    </table>
    <script type="text/javascript">
        $(function(){        
            var array_professionnalTrainings= ' . $array_professionnalTrainings . ';
            var oTable = $(\'#professionnalTrainingTableList\').dataTable( {
                "sDom": \'T<"clear">lfrtip\',
                "oTableTools": {
                    "sRowSelect": "multi",
                    "aButtons": [ "select_all", "select_none" ]
                },
                "bJQueryUI": true,
                "sPaginationType": "full_numbers"
            });
            $(\'.editProfessionnalTraining\').click(function() { 
                $(\'#modal_parent_div\').show();
                $(\'.modal_windows\').hide();
                $(\'#modal_contener\').show();
                $(\'#modal_content\').html($(\'#edit_professionnal_training_form_div\').html());
                $(\'#modal_content form\').attr(\'id\', \'editProfessionnalTrainingForm\');
                $(\'#modal_content #special_professionnal_training_id\').val($(this).attr(\'id\'));
                for(var i=0;i<array_professionnalTrainings.length;i++){
                    if(array_professionnalTrainings[i].special_professionnal_training_id == $(this).attr(\'id\')){
                        $(\'#edit_trainer\').val(array_professionnalTrainings[i].trainer);
                        $(\'#edit_training_period\').val(array_professionnalTrainings[i].training_period);
                        $(\'#edit_certificate_obtened\').val(array_professionnalTrainings[i].certificate_obtened);
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
