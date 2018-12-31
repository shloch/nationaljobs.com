<?php

/*
 * the WorkHistory page
 */

class Document extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Muser', 'user');
        $this->load->model('Mcompany', 'company');
        $this->load->model('Mdocument', 'document');
        $this->load->helper('file');
    }

    function index() {
        
    }

    function refreshList($personalMessage = null) {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        $documents = $this->document->fetchByMemberId($logged);
//        $this->session->set_userdata('documents', $documents);
        echo '<table cellpadding="0" cellspacing="0" border="0" class="display" id="documentTableList">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Upload Date</th>
                            <th>Type</th>
                            <th>Url</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Upload Date</th>
                            <th>Type</th>
                            <th>Url</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>';
        $array_documents = '';
        foreach ($documents as $document) {
            $javascript_document_object = ',{"documents_id":"' . $document['documents_id'] . '",
                                              "document_name":"' . stripslashes($document['document_name']) . '"}';
            $array_documents .= $javascript_document_object;

            echo'    <tr class="gradeA" rel="' . $document['documents_id'] . '">
                    <td>' . stripslashes($document['document_name']) . '</td>
                    <td>' . date('Y-m-d H:i', $document['creation_date']) . '</td>
                    <td>' . ($document['title']) . '</td>
                    <td><a href="../../medias/documents/' . $document['document_url'] . '.' . $document['type'] . '" title="download">' . $document['document_url'] . '.' . $document['type'] . '</a></td>
                    <td class="center">
                        <input class="editAward editDocument" id="' . $document['documents_id'] . '" type="button" value = "Edit" />
                    </td>
                </tr>';
        }
        $array_documents = '[' . substr($array_documents, 1) . ']';

        echo '
    </tbody>
    </table>
    <script type="text/javascript">
        $(function(){        
            var array_documents= ' . $array_documents . ';
            var oTable = $(\'#documentTableList\').dataTable( {
                "sDom": \'T<"clear">lfrtip\',
                "oTableTools": {
                    "sRowSelect": "multi",
                    "aButtons": [ "select_all", "select_none" ]
                },
                "bJQueryUI": true,
                "sPaginationType": "full_numbers"
            });
            $(\'.editDocument\').click(function() { 
                $(\'#modal_parent_div\').show();
                $(\'.modal_windows\').hide();
                $(\'#modal_contener\').show();
                $(\'#modal_content\').html($(\'#edit_document_form_div\').html());
                $(\'#modal_content form\').attr(\'id\', \'editDocumentForm\');
                $(\'#modal_content #document_id\').val($(this).attr(\'id\'));
                for(var i=0;i<array_documents.length;i++){
                    if(array_documents[i].documents_id == $(this).attr(\'id\')){
                        $(\'#edit_document\').val(array_documents[i].document_name);
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

    function edit() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        if (isset($_POST)) {// if posted with a username, validate login or generate error message
            extract($_POST);
            $document = trim($document);
            if (empty($document) || (strlen($document) >= 50)) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            }
            if (!is_numeric($document_id) || ($document_id < 0)) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            }
            //we save informations in the database
            $document_edited = $this->document->edit($document, $document_id, $logged);
            
            die(json_encode(array('Error' => 0, 'Message' => 'Your Document has been updated.')));
        } else {
            redirect('/login/document');
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
            foreach ($listId as $document_id) {
                $the_document = $this->document->findDocumentByIdAndOwner($document_id, $logged);
                if($the_document === FALSE)
                    continue;
                //we delete informations in the database
                $this->document->delete($document_id, $logged);
                //delete file
                $document_path = 'medias/documents/' . $the_document->document_url . '.' . $the_document->type; //$the_document->member_id;
                @unlink($document_path);
            }
            $personalMessage = 'Document DELETED!';
            if(count($listId) > 1)
                $personalMessage = 'Documents DELETED!';
            $this->refreshList($personalMessage);
        } else {
            redirect('/login/document');
        }
    }

}