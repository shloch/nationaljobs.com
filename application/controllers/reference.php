<?php

/*
 * the WorkHistory page
 */

class Reference extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Mreference', 'reference');
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
            if ($this->form_validation->run('addReference') == FALSE) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            } else {
                extract($_POST);
                //we save informations in the database
                $workHistory = $this->reference->add($reference, $logged);
                
                $references = $this->reference->fetchByMemberId($logged);
                $this->session->set_userdata('references', $references);

                die(json_encode(array('Error' => 0, 'Message' => 'Your Reference has been saved.')));
            }
        } else {
            redirect('/login/reference');
        }
    }

    function edit() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted with a username, validate login or generate error message
            if ($this->form_validation->run('addReference') == FALSE) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            } else {
                extract($_POST);                
                //we save informations in the database
                $workHistory = $this->reference->edit($reference, $reference_id, $logged);
                
                $references = $this->reference->fetchByMemberId($logged);
                $this->session->set_userdata('references', $references);

                die(json_encode(array('Error' => 0, 'Message' => 'Your Reference has been updated.')));
            }
        } else {
            redirect('/login/reference');
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
            foreach ($listId as $reference_id) {
                //we delete informations in the database
                $this->reference->delete($reference_id, $logged);
            }
            //add the delete award to the array of awards already in the session
            //or recreate the entire session AWARD
            $personalMessage = 'Reference DELETED!';
            if(count($listId) > 1)
                $personalMessage = 'Reference(s) DELETED!';
            $this->refreshList($personalMessage);
        } else {
            redirect('/login/reference');
        }
    }

    function refreshList($personalMessage = null) {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        $references = $this->reference->fetchByMemberId($logged);
        $this->session->set_userdata('references', $references);
        echo '<table cellpadding="0" cellspacing="0" border="0" class="display" id="referenceTableList">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Reference</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>';
        $array_references = '';
        foreach ($references as $reference) {
            $javascript_reference_object = ',{"reference_id":"' . $reference['reference_id'] . '",
                                              "reference":"' . stripslashes($reference['reference']) . '"}';
            $array_references .= $javascript_reference_object;

            echo'    <tr class="gradeA" rel="' . $reference['reference_id'] . '">
                    <td>' . stripslashes($reference['reference']) . '</td>
                    <td class="center">
                        <input class="editAward editReference" id="' . $reference['reference_id'] . '" type="button" value = "Edit" />
                    </td>
                </tr>';
        }
        $array_references = '[' . substr($array_references, 1) . ']';

        echo '
    </tbody>
    </table>
    <script type="text/javascript">
        $(function(){        
            var array_references= ' . $array_references . ';
            var oTable = $(\'#referenceTableList\').dataTable( {
                "sDom": \'T<"clear">lfrtip\',
                "oTableTools": {
                    "sRowSelect": "multi",
                    "aButtons": [ "select_all", "select_none" ]
                },
                "bJQueryUI": true,
                "sPaginationType": "full_numbers"
            });
            $(\'.editReference\').click(function() { 
                $(\'#modal_parent_div\').show();
                $(\'.modal_windows\').hide();
                $(\'#modal_contener\').show();
                $(\'#modal_content\').html($(\'#edit_reference_form_div\').html());
                $(\'#modal_content form\').attr(\'id\', \'editReferenceForm\');
                $(\'#modal_content #reference_id\').val($(this).attr(\'id\'));
                for(var i=0;i<array_references.length;i++){
                    if(array_references[i].reference_id == $(this).attr(\'id\')){
                        $(\'#edit_reference\').val(array_references[i].reference);
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