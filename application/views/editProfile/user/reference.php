<style type="text/css" title="currentStyle">
    @import "<?php echo base_url() ?>css/css_dataTable/demo_page.css";
    @import "<?php echo base_url() ?>css/css_dataTable/demo_table.css";
    @import "<?php echo base_url() ?>css/AutoFill.css";
    @import "<?php echo base_url() ?>css/modal_div.css";
    @import "<?php echo base_url() ?>css/css_dataTable/datatable_additional_css.css";
    @import "<?php echo base_url() ?>css/css_dataTable/TableTools.css";
    @import "<?php echo base_url() ?>css/css_dataTable/jquery-ui-1.8.4.custom.css";
</style>


<br /><div class="header_01"><h1>EDIT YOUR REFERENCES</h1></div>
<form>
    <fieldset>
        <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

        <!-- Reference -->
        <div>
            <label>Your Reference(s) 
            </label>
            <br />
            <input type="button" class="addAward addReferenceButton" value="Add Reference" />
            <br />
            <input type="button" class="addAward deleteReferenceButton" value="Delete Selected Reference(s)" />
            <br />
            <div id="parentReferenceTableList" >
            </div>
        </div>
        <!-- Controls -->
        <div class="controls">
        </div>
    </fieldset>
</form>
<br />
<input type="button" class="addAward addReferenceButton" value="Add Reference" />
<br />
<input type="button" class="addAward deleteReferenceButton" value="Delete Selected Reference(s)" />
<p class="note loaderImageContener" id="loaderContenerFor_listReference" rel="<?php echo base_url() . "index.php/reference/refreshList" ?>" rel_2="<?php echo base_url() . "index.php/reference/delete" ?>">
    &nbsp;
</p>
<div id="add_reference_form_div" class="modal_windows hidden">
    <form id="" action="<?php echo base_url() . 'index.php/reference/add'; ?>" method="post">
        <fieldset>
            <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

            <!-- Reference -->
            <div>
                <label for="reference">Reference
                    <abbr title="Required field">*</abbr>
                </label>
                <textarea type="text" name="reference" id="reference"></textarea>
                <span id="errorReference" class="error2" style="display:none">Maxlength 199 characters.</span>
            </div>
            <!-- Controls -->
            <div class="controls">
                <label for="submit"></label>
                <input id="button_addReference" name="button_addReference" type="button" onclick="addReference(); return false;" class="button_editPersonalInformations"
                       value="Save" />
            </div>
            <p class="note loaderImageContener" id="loaderContenerFor_addReference">
                &nbsp;
            </p>
        </fieldset>
    </form>
</div>  
<div id="edit_reference_form_div" class="modal_windows hidden">
    <form id="" action="<?php echo base_url() . 'index.php/reference/edit'; ?>" method="post">
        <fieldset>
            <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>
            
            <!-- Reference -->
            <div>
                <label for="edit_reference">Reference
                    <abbr title="Required field">*</abbr>
                </label>
                <textarea type="text" name="reference" id="edit_reference"></textarea>
                <span id="edit_errorReference" class="error2" style="display:none">Maxlength 199 characters.</span>
            </div>
            <input type="hidden" name="reference_id" id="reference_id" />
            <!-- Controls -->
            <div class="controls">
                <label for="submit"></label>
                <input id="button_editReference" name="button_editReference" type="button" onclick="editReference(); return false;" class="button_editPersonalInformations"
                       value="Edit" />
            </div>
            <p class="note loaderImageContener" id="loaderContenerFor_editReference">
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
    function checkReferenceForm(){
        var stop = false;
        var reference = $('#reference').val();
        
        //reference        
        if(reference.length >199){
            $('#errorReference').show(); stop = true;
        }
        else
            $('#errorReference').hide();
        if(reference == ""){
            $('#errorReference').show(); stop = true;
        }
            
        return stop;
    }
    function checkEditReferenceForm(){
        var stop = false;
        var reference = $('#edit_reference').val();
        
        //reference        
        if(reference.length >99){
            $('#edit_errorReference').show(); stop = true;
        }
        else
            $('#edit_errorReference').hide();
        if(reference == ""){
            $('#edit_errorReference').show(); stop = true;
        }
        
        return stop;
    }
    function refreshReferenceList(){
        var error_contener = "loaderContenerFor_listReference";
        var contener = "parentReferenceTableList";
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
    function addReference(){
        var dataString = $('form[id=addReferenceForm]').serialize();
        var error_contener = "loaderContenerFor_addReference";
        var button = "button_addReference";
        if(checkReferenceForm())
        {
            return false;
        }
        $.ajax({
            type: "POST",
            url: $('form[id=addReferenceForm]').attr('action'),
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
                    refreshReferenceList();
                    $('#'+ error_contener +' ').addClass('greenText');
                    $('.'+ button +'').removeAttr("disabled");
                    //empty the form
                    $('#reference').val('');
                }
                else if(tabElement.Error=='404'){
                    //the user session is destroyed because it take too long to work, so he must logIn again
                    window.location.reload();
                }
            }
        })
        return false;
    }
    function editReference(){
        var dataString = $('form[id=editReferenceForm]').serialize();
        var error_contener = "loaderContenerFor_editReference";
        var button = "button_editReference";
        if(checkEditReferenceForm())
        {
            return false;
        }
        $.ajax({
            type: "POST",
            url: $('form[id=editReferenceForm]').attr('action'),
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
                    refreshReferenceList();
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
    refreshReferenceList();
        $('.addReferenceButton').click(function() { 
            $('#modal_parent_div').show();
            $('.modal_windows').hide();
            $('#modal_contener').show();
            $('#modal_content').html($('#add_reference_form_div').html());
            $('#modal_content form').attr('id', 'addReferenceForm');
        });     
        $('.deleteReferenceButton').click(function() { 
            var oTT = TableTools.fnGetInstance('referenceTableList');
            var aSelectedTrs = oTT.fnGetSelected();
            longueurTab = aSelectedTrs.length;
            if(longueurTab <= 0)
            {
                alert('Please choose at least one Reference to delete');
                return false;
            }
            else
            {
                if(!confirm("Sure you want to delete selected Reference(s)?")){
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
                var error_contener = "loaderContenerFor_listReference";
                var contener = "parentReferenceTableList";
                var url = $('#'+ error_contener +' ').attr('rel_2');
                var button = "deleteReferenceButton";
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