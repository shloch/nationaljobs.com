<style type="text/css" title="currentStyle">
    @import "<?php echo base_url() ?>css/css_dataTable/demo_page.css";
    @import "<?php echo base_url() ?>css/css_dataTable/demo_table.css";
    @import "<?php echo base_url() ?>css/AutoFill.css";
    @import "<?php echo base_url() ?>css/modal_div.css";
    @import "<?php echo base_url() ?>css/css_dataTable/datatable_additional_css.css";
    @import "<?php echo base_url() ?>css/css_dataTable/TableTools.css";
    @import "<?php echo base_url() ?>css/css_dataTable/jquery-ui-1.8.4.custom.css";
</style>


<br /><div class="header_01"><h1>EDIT YOUR AWARDS</h1></div>
<form>
    <fieldset>
        <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

        <!-- Awards -->
        <div>
            <label>Your Awards 
            </label>
            <br />
            <input type="button" class="addAward addAwardButton" value="Add Award" />
            <br />
            <input type="button" class="addAward deleteAwardButton" value="Delete Selected Award(s)" />
            <br />
            <div id="parentAwardTableList" >
            </div>
        </div>
        <!-- Controls -->
        <div class="controls">
        </div>
    </fieldset>
</form>
<br />
<input type="button" class="addAward addAwardButton" value="Add Award" />
<br />
<input type="button" class="addAward deleteAwardButton" value="Delete Selected Award(s)" />
<p class="note loaderImageContener" id="loaderContenerFor_listAward" rel="<?php echo base_url() . "index.php/award/refreshAwardList" ?>" rel_2="<?php echo base_url() . "index.php/award/deleteAward" ?>">
    &nbsp;
</p>
<div id="add_award_form_div" class="modal_windows hidden">
    <form id="" action="<?php echo base_url() . 'index.php/award/addAward'; ?>" method="post">
        <fieldset>
            <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

            <!-- Title -->
            <div>
                <label for="title">Title
                    <abbr title="Required field">*</abbr>
                </label>
                <input type="text" name="title" id="title" />
                <span id="errorTitle" class="error2" style="display:none">Maxlength 99 characters.</span>
            </div>

            <!-- Issuing organization -->
            <div>
                <label for="title">Issuing Organization
                    <abbr title="Required field">*</abbr>
                </label>
                <textarea type="text" name="issuing_organization" id="issuing_organization"></textarea>
                <span id="errorIssuingOrganization" class="error2" style="display:none">Maxlength 199 characters.</span>
            </div>
            <!-- Date -->
            <div>
                <label for="date">Date
                    <abbr title="Required field">*</abbr>
                </label>
                <input type="text" name="date" id="date" placeholder="year-month-day"/>
                <span id="errorDate" class="error2" style="display:none">Please enter a valid date: yyyy-mm-dd.</span>
            </div>
            <!-- Place -->
            <div>
                <label for="place">Place
                    <abbr title="Required field">*</abbr>
                </label>
                <textarea type="text" name="place" id="place" ></textarea>
                <span id="errorPlace" class="error2" style="display:none">Maxlength 199 characters.</span>
            </div>
            <!-- Description -->
            <div>
                <label for="description">Description
                    <abbr title="Required field">*</abbr>
                </label>
                <textarea id="description" name="description"></textarea>
                <span id="errorDescription" class="error2" style="display:none">Maxlength 199 characters.</span>
            </div>
            <!-- Controls -->
            <div class="controls">
                <label for="submit"></label>
                <input id="button_addAward" name="button_addAward" type="button" onclick="addAward(); return false;" class="button_editPersonalInformations"
                       value="Save" />
            </div>
            <p class="note loaderImageContener" id="loaderContenerFor_addAward">
                &nbsp;
            </p>
        </fieldset>
    </form>
</div>  
<div id="edit_award_form_div" class="modal_windows hidden">
    <form id="" action="<?php echo base_url() . 'index.php/award/editAward'; ?>" method="post">
        <fieldset>
            <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

            <!-- Title -->
            <div>
                <label for="title">Title
                    <abbr title="Required field">*</abbr>
                </label>
                <input type="text" name="title" id="edit_title" />
                <span id="edit_errorTitle" class="error2" style="display:none">Maxlength 99 characters.</span>
            </div>

            <!-- Issuing organization -->
            <div>
                <label for="title">Issuing Organization
                    <abbr title="Required field">*</abbr>
                </label>
                <textarea type="text" name="issuing_organization" id="edit_issuing_organization"></textarea>
                <span id="edit_errorIssuingOrganization" class="error2" style="display:none">Maxlength 199 characters.</span>
            </div>
            <!-- Date -->
            <div>
                <label for="date">Date
                    <abbr title="Required field">*</abbr>
                </label>
                <input type="text" name="date" id="edit_date" placeholder="year-month-day"/>
                <span id="edit_errorDate" class="error2" style="display:none">Please enter a valid date: yyyy-mm-dd.</span>
            </div>
            <!-- Place -->
            <div>
                <label for="place">Place
                    <abbr title="Required field">*</abbr>
                </label>
                <textarea type="text" name="place" id="edit_place" ></textarea>
                <span id="edit_errorPlace" class="error2" style="display:none">Maxlength 199 characters.</span>
            </div>
            <!-- Description -->
            <div>
                <label for="description">Description
                    <abbr title="Required field">*</abbr>
                </label>
                <textarea id="edit_description" name="description"></textarea>
                <span id="edit_errorDescription" class="error2" style="display:none">Maxlength 199 characters.</span>
            </div>
            <input type="hidden" name="award_id" id="award_id" />
            <!-- Controls -->
            <div class="controls">
                <label for="submit"></label>
                <input id="button_editAward" name="button_editAward" type="button" onclick="editAward(); return false;" class="button_editPersonalInformations"
                       value="Edit" />
            </div>
            <p class="note loaderImageContener" id="loaderContenerFor_editAward">
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
    function checkAwardForm(){
        var stop = false;
        var title = $('#title').val();
        var issuing_organization = $('#issuing_organization').val();
        var date = $('#date').val();
        var place = $('#place').val();
        var description = $('#description').val();
        
        //title        
        if(title.length >99){
            $('#errorTitle').show(); stop = true;
        }
        else
            $('#errorTitle').hide();
        if(title == ""){
            $('#errorTitle').show(); stop = true;
        }
            
        //issuing_organization
        if(issuing_organization.length >199){
            $('#errorIssuingOrganization').show(); stop = true;
        }
        else
            $('#errorIssuingOrganization').hide();
        if(issuing_organization == ""){
            $('#errorIssuingOrganization').show(); stop = true;
        }
        
        //date        
        if(!/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(date)){
            $('#errorDate').show(); stop = true;
        }else
            $('#errorDate').hide();
        
        //place
        if(place.length >199){
            $('#errorPlace').show(); stop = true;
        }
        else
            $('#errorPlace').hide();
        if(place == ""){
            $('#errorPlace').show(); stop = true;
        }
        
        //description
        if(description.length >199){
            $('#errorDescription').show(); stop = true;
        }
        else
            $('#errorDescription').hide();
        if(description == ""){
            $('#errorDescription').show(); stop = true;
        }
        return stop;
    }
    function checkEditAwardForm(){
        var stop = false;
        var title = $('#edit_title').val();
        var issuing_organization = $('#edit_issuing_organization').val();
        var date = $('#edit_date').val();
        var place = $('#edit_place').val();
        var description = $('#edit_description').val();
                
        //title        
        if(title.length >99){
            $('#edit_errorTitle').show(); stop = true;
        }
        else
            $('#edit_errorTitle').hide();
        if(title == ""){
            $('#edit_errorTitle').show(); stop = true;
        }
            
        //issuing_organization
        if(issuing_organization.length >199){
            $('#edit_errorIssuingOrganization').show(); stop = true;
        }
        else
            $('#edit_errorIssuingOrganization').hide();
        if(issuing_organization == ""){
            $('#edit_errorIssuingOrganization').show(); stop = true;
        }
        
        //date        
        if(!/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(date)){
            $('#edit_errorDate').show(); stop = true;
        }else
            $('#edit_errorDate').hide();
        
        //place
        if(place.length >199){
            $('#edit_errorPlace').show(); stop = true;
        }
        else
            $('#edit_errorPlace').hide();
        if(place == ""){
            $('#edit_errorPlace').show(); stop = true;
        }
        
        //description
        if(description.length >199){
            $('#edit_errorDescription').show(); stop = true;
        }
        else
            $('#edit_errorDescription').hide();
        if(description == ""){
            $('#edit_errorDescription').show(); stop = true;
        }
        return stop;
    }
    function refreshAwardList(){
        var error_contener = "loaderContenerFor_listAward";
        var contener = "parentAwardTableList";
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
    function addAward(){
        var dataString = $('form[id=addAwardForm]').serialize();
        var error_contener = "loaderContenerFor_addAward";
        var button = "button_addAward";
        if(checkAwardForm())
        {
            return false;
        }
        $.ajax({
            type: "POST",
            url: $('form[id=addAwardForm]').attr('action'),
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
                    refreshAwardList();
                    $('#'+ error_contener +' ').addClass('greenText');
                    $('.'+ button +'').removeAttr("disabled");
                    //empty the form
                    $('#title').val('');
                    $('#issuing_organization').val('');
                    $('#date').val('');
                    $('#place').val('');
                    $('#description').val('');
                }
                else if(tabElement.Error=='404'){
                    //the user session is destroyed because it take too long to work, so he must logIn again
                    window.location.reload();
                }
            }
        })
        return false;
    }
    function editAward(){
        var dataString = $('form[id=editAwardForm]').serialize();
        var error_contener = "loaderContenerFor_editAward";
        var button = "button_editAward";
        if(checkEditAwardForm())
        {
            return false;
        }
        $.ajax({
            type: "POST",
            url: $('form[id=editAwardForm]').attr('action'),
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
                    refreshAwardList();
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
        refreshAwardList();
        $('.addAwardButton').click(function() { 
            $('#modal_parent_div').show();
            $('.modal_windows').hide();
            $('#modal_contener').show();
            $('#modal_content').html($('#add_award_form_div').html());
            $('#modal_content form').attr('id', 'addAwardForm');
        });     
        $('.deleteAwardButton').click(function() { 
            var oTT = TableTools.fnGetInstance('awardTableList');
            var aSelectedTrs = oTT.fnGetSelected();
            longueurTab = aSelectedTrs.length;
            if(longueurTab <= 0)
            {
                alert('Please choose at least one Award to delete');
                return false;
            }
            else
            {
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
                var error_contener = "loaderContenerFor_listAward";
                var contener = "parentAwardTableList";
                var url = $('#'+ error_contener +' ').attr('rel_2');
                var button = "deleteAwardButton";
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