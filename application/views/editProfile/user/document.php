<style type="text/css" title="currentStyle">
    @import "<?php echo base_url() ?>css/css_dataTable/demo_page.css";
    @import "<?php echo base_url() ?>css/css_dataTable/demo_table.css";
    @import "<?php echo base_url() ?>css/AutoFill.css";
    @import "<?php echo base_url() ?>css/modal_div.css";
    @import "<?php echo base_url() ?>css/css_dataTable/datatable_additional_css.css";
    @import "<?php echo base_url() ?>css/css_dataTable/TableTools.css";
    @import "<?php echo base_url() ?>css/css_dataTable/jquery-ui-1.8.4.custom.css";
</style>

<br />
<div class="header_01">
    <h1>EDIT YOUR DOCUMENT(S)</h1>
    <a href="<?php echo base_url() . 'index.php/login/uploadDocument'; ?>">Upload Document(s)</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<form>
    <fieldset>
        <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

        <!-- Document -->
        <div>
            <label>Your Document(s) 
            </label>
            <br />
            <input type="button" class="addAward deleteDocumentButton" value="Delete Selected Document(s)" />
            <br />
            <div id="parentDocumentTableList" >
            </div>
        </div>
        <!-- Controls -->
        <div class="controls">
        </div>
    </fieldset>
</form>
<br />
<input type="button" class="addAward deleteDocumentButton" value="Delete Selected Document(s)" />
<p class="note loaderImageContener" id="loaderContenerFor_listDocument" rel="<?php echo base_url() . "index.php/document/refreshList" ?>" rel_2="<?php echo base_url() . "index.php/document/delete" ?>">
    &nbsp;
</p>  
<div id="edit_document_form_div" class="modal_windows hidden">
    <form id="" action="<?php echo base_url() . 'index.php/document/edit'; ?>" method="post">
        <fieldset>
            <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

            <!-- Reference -->
            <br />
            <div>
                <label for="edit_reference">Document Name
                    <abbr title="Required field">*</abbr>
                </label>
                <input type="text" name="document" id="edit_document" />
                <span id="edit_errorDocument" class="error2">Maxlength 50 characters.</span>
            </div>
            <br />
            <br />
            <input type="hidden" name="document_id" id="document_id" />
            <!-- Controls -->
            <div class="controls">
                <label for="submit"></label>
                <input id="button_editDocument" name="button_editDocument" type="button" onclick="editDocument(); return false;" class="button_editPersonalInformations"
                       value="Edit" />
            </div>
            <p class="note loaderImageContener" id="loaderContenerFor_editDocument">
                &nbsp;
            </p>
        </fieldset>
    </form>
</div> 
<script type="text/javascript" charset="utf-8" src="<?php echo base_url() ?>js/dataTable/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url() ?>js/AutoFill.js"></script>

<script type="text/javascript" charset="utf-8" src="<?php echo base_url() ?>js/dataTable/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url() ?>js/dataTable/TableTools.js"></script>


<script type="text/javascript" src="<?php echo base_url() ?>js/for_the_date_picker/jquery-ui-1.8.11.custom.min.js"></script>

<script type="text/javascript" charset="utf-8">
    function checkDocumentForm(){
        var stop = false;
        var Document = $('#edit_document').val();
        
        //Document        
        if(Document.length >50){
            $('#edit_errorDocument').show(); stop = true;
        }
        else
            $('#edit_errorDocument').hide();
        if(Document == ""){
            $('#edit_errorDocument').show(); stop = true;
        }
            
        return stop;
    }
    
    function refreshDocumentList(){
        var error_contener = "loaderContenerFor_listDocument";
        var contener = "parentDocumentTableList";
        var url = $('#'+ error_contener +' ').attr('rel');
        $.ajax({
            type: "POST",
            url: url,
            data: "",
            beforeSend: function() {
                var innerContent = $('#loader_image').html();
                $('#'+ error_contener +' ').html(innerContent);
            },
            complete: function () {
            },
            error: function(){
                $('#'+ error_contener +' ').html('An error occured. Please try again later.');
            },
            success: function(response) {   
                $('#'+ error_contener +' ').html('&nbsp;'); 
                $('#'+ error_contener +' ').removeClass('greenText').removeClass('redText'); 
                try{
                    var tabElement = eval("(" + response + ")");
                    if(tabElement.Error=='1'){
                        //if error
                        $('#'+ error_contener +' ').addClass('redText');
                    }
                    else if(tabElement.Error=='0'){
                        //if success
                        $('#'+ error_contener +' ').addClass('greenText');                    
                    }
                    else if(tabElement.Error=='404'){
                        //the user session is destroyed because it take too long to work, so he must logIn again
                        window.location.reload();
                    }
                }catch(e){                    
                    $('#'+ contener +' ').html(response); 
                }                                
            }
        })
        
    }
    
    function editDocument(){
        var dataString = $('form[id=editDocumentForm]').serialize();
        var error_contener = "loaderContenerFor_editDocument";
        var button = "button_editDocument";
        if(checkDocumentForm())
        {
            return false;
        }
        $.ajax({
            type: "POST",
            url: $('form[id=editDocumentForm]').attr('action'),
            data: dataString,
            beforeSend: function() {
                var innerContent = $('#loader_image').html();
                $('#'+ error_contener +' ').html(innerContent);
                $('.'+ button +'').attr("disabled", "disabled");
            },
            complete: function () {
            },
            error: function(){
                $('#'+ error_contener +' ').html('An error occured. Please try again later.');
                $('.'+ button +'').removeAttr("disabled");
            },
            success: function(response) {
                var tabElement = eval("(" + response + ")");
                $('.'+ button +'').removeAttr("disabled");
                $('#'+ error_contener +' ').removeClass('greenText').removeClass('redText'); 
                $('#'+ error_contener +' ').html(tabElement.Message); 
                if(tabElement.Error=='1'){
                    //if error
                    $('#'+ error_contener +' ').addClass('redText');
                    $('.'+ button +'').removeAttr("disabled");
                }
                else if(tabElement.Error=='0'){
                    //if success
                    refreshDocumentList();
                    $('#'+ error_contener +' ').addClass('greenText');
                    $('.'+ button +'').removeAttr("disabled");                    
                }
                else if(tabElement.Error=='404'){
                    //the user session is destroyed because it take too long to work, so he must logIn again
                    window.location.reload();
                }
            }
        })
        return false;
    }
    
    $(function(){
        refreshDocumentList();
        $('.deleteDocumentButton').click(function() { 
            var oTT = TableTools.fnGetInstance('documentTableList');
            var aSelectedTrs = oTT.fnGetSelected();
            longueurTab = aSelectedTrs.length;
            if(longueurTab <= 0)
            {
                alert('Please choose at least one Document to delete');
                return false;
            }
            else
            {
                if(!confirm("Sure you want to delete selected "+longueurTab+" Document(s)?")){
                    return false;
                }
                var dataString = "listId=";
                for(i=0; i<longueurTab; i++)
                {
                    if(i<longueurTab-1)
                    {
                        dataString += $(aSelectedTrs[i]).attr("rel")+",";
                    }
                    else
                    {
                        dataString += $(aSelectedTrs[i]).attr("rel");
                    }
                }
                var error_contener = "loaderContenerFor_listDocument";
                var contener = "parentDocumentTableList";
                var url = $('#'+ error_contener +' ').attr('rel_2');
                var button = "deleteDocumentButton";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: dataString,
                    beforeSend: function() {
                        var innerContent = $('#loader_image').html();
                        $('#'+ error_contener +' ').html(innerContent);
                        $('.'+ button +'').attr("disabled", "disabled");
                    },
                    complete: function () {
                    },
                    error: function(){
                        $('#'+ error_contener +' ').html('An error occured. Please try again later.');
                        $('.'+ button +'').removeAttr("disabled");
                    },
                    success: function(response) {   
                        $('#'+ error_contener +' ').html('&nbsp;'); 
                        $('#'+ error_contener +' ').removeClass('greenText').removeClass('redText'); 
                        try{
                            var tabElement = eval("(" + response + ")");
                            if(tabElement.Error=='1'){
                                //if error
                                $('#'+ error_contener +' ').addClass('redText');
                            }
                            else if(tabElement.Error=='0'){
                                //if success
                                $('#'+ error_contener +' ').addClass('greenText');                    
                            }
                            else if(tabElement.Error=='404'){
                                //the user session is destroyed because it take too long to work, so he must logIn again
                                window.location.reload();
                            }
                        }catch(e){                    
                            $('#'+ contener +' ').html(response); 
                            $('.'+ button +'').removeAttr("disabled");
                        }                                
                    }
                })
            }
        });     
          
    } );
</script>