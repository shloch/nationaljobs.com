<style type="text/css" title="currentStyle">
    @import "<?php echo base_url() ?>css/css_dataTable/demo_page.css";
    @import "<?php echo base_url() ?>css/css_dataTable/demo_table.css";
    @import "<?php echo base_url() ?>css/AutoFill.css";
    @import "<?php echo base_url() ?>css/modal_div.css";
    @import "<?php echo base_url() ?>css/css_dataTable/datatable_additional_css.css";
    @import "<?php echo base_url() ?>css/css_dataTable/TableTools.css";
    @import "<?php echo base_url() ?>css/css_dataTable/jquery-ui-1.8.4.custom.css";
</style>


<br /><div class="header_01"><h1>EDIT YOUR WORK HISTORY</h1></div>
<form>
    <fieldset>
        <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

        <!-- Working History -->
        <div>
            <label>Your Working Histories 
            </label>
            <br />
            <input type="button" class="addAward addWorkHistoryButton" value="Add History" />
            <br />
            <input type="button" class="addAward deleteWorkHistoryButton" value="Delete Selected History(ies)" />
            <br />
            <div id="parentWorkHistoryTableList" >
            </div>
        </div>
        <!-- Controls -->
        <div class="controls">
        </div>
    </fieldset>
</form>
<br />
<input type="button" class="addAward addWorkHistoryButton" value="Add History" />
<br />
<input type="button" class="addAward deleteWorkHistoryButton" value="Delete Selected History(ies)" />
<p class="note loaderImageContener" id="loaderContenerFor_listWorkHistory" rel="<?php echo base_url() . "index.php/workHistory/refreshWorkHistoryList" ?>" rel_2="<?php echo base_url() . "index.php/workHistory/deleteWorkHistory" ?>">
    &nbsp;
</p>
<div id="add_work_history_form_div" class="modal_windows hidden">
    <form id="" action="<?php echo base_url() . 'index.php/workHistory/addWorkHistory'; ?>" method="post">
        <fieldset>
            <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

            <!-- Company Name -->
            <div>
                <label for="company_name">Company Name
                    <abbr title="Required field">*</abbr>
                </label>
                <input type="text" name="company_name" id="company_name" />
                <span id="errorCompanyName" class="error2" style="display:none">Maxlength 99 characters.</span>
            </div>

            <!-- Company Address -->
            <div>
                <label for="company_address">Company Address
                    <abbr title="Required field"></abbr>
                </label>
                <textarea type="text" name="company_address" id="company_address"></textarea>
                <span id="errorCompanyAddress" class="error2" style="display:none">Maxlength 199 characters.</span>
            </div>
            <!-- Start Date -->
            <div>
                <label for="start_date">Start Date
                    <abbr title="Required field">*</abbr>
                </label>
                <input type="text" name="start_date" id="start_date" placeholder="year-month-day"/>
                <span id="errorStartDate" class="error2" style="display:none">Please enter a valid date: yyyy-mm-dd.</span>
            </div>
            <!-- end_date -->
            <div>
                <label for="end_date">End Date
                    <abbr title="Required field">*</abbr>
                </label>
                <input type="text" name="end_date" id="end_date" placeholder="year-month-day"/>
                <span id="errorEndDate" class="error2" style="display:none">Please enter a valid date: yyyy-mm-dd.</span>
            </div>
            <!-- Job Description -->
            <div>
                <label for="job_description">Job Description
                    <abbr title="Required field">*</abbr>
                </label>
                <textarea id="job_description" name="job_description"></textarea>
                <span id="errorJobDescription" class="error2" style="display:none">Maxlength 1000 characters.</span>
            </div>
            <!-- Controls -->
            <div class="controls">
                <label for="submit"></label>
                <input id="button_addWorkHistory" name="button_addWorkHistory" type="button" onclick="addWorkHistory(); return false;" class="button_editPersonalInformations"
                       value="Save" />
            </div>
            <p class="note loaderImageContener" id="loaderContenerFor_addWorkHistory">
                &nbsp;
            </p>
        </fieldset>
    </form>
</div>  
<div id="edit_work_history_form_div" class="modal_windows hidden">
    <form id="" action="<?php echo base_url() . 'index.php/workHistory/editWorkHistory'; ?>" method="post">
        <fieldset>
            <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>
            
            <!-- Company Name -->
            <div>
                <label for="edit_company_name">Company Name
                    <abbr title="Required field">*</abbr>
                </label>
                <input type="text" name="company_name" id="edit_company_name" />
                <span id="edit_errorCompanyName" class="error2" style="display:none">Maxlength 99 characters.</span>
            </div>

            <!-- Company Address -->
            <div>
                <label for="edit_company_address">Company Address
                    <abbr title="Required field"></abbr>
                </label>
                <textarea type="text" name="company_address" id="edit_company_address"></textarea>
                <span id="edit_errorCompanyAddress" class="error2" style="display:none">Maxlength 199 characters.</span>
            </div>
            <!-- Start Date -->
            <div>
                <label for="edit_start_date">Start Date
                    <abbr title="Required field">*</abbr>
                </label>
                <input type="text" name="start_date" id="edit_start_date" placeholder="year-month-day"/>
                <span id="edit_errorStartDate" class="error2" style="display:none">Please enter a valid date: yyyy-mm-dd.</span>
            </div>
            <!-- end_date -->
            <div>
                <label for="edit_start_date">End Date
                    <abbr title="Required field">*</abbr>
                </label>
                <input type="text" name="end_date" id="edit_end_date" placeholder="year-month-day"/>
                <span id="edit_errorEndDate" class="error2" style="display:none">Please enter a valid date: yyyy-mm-dd.</span>
            </div>
            <!-- Job Description -->
            <div>
                <label for="edit_job_description">Job Description
                    <abbr title="Required field">*</abbr>
                </label>
                <textarea id="edit_job_description" name="job_description"></textarea>
                <span id="edit_errorJobDescription" class="error2" style="display:none">Maxlength 1000 characters.</span>
            </div>
            
            <input type="hidden" name="working_history_id" id="working_history_id" />
            <!-- Controls -->
            <div class="controls">
                <label for="submit"></label>
                <input id="button_editWorkHistory" name="button_editWorkHistory" type="button" onclick="editWorkHistory(); return false;" class="button_editPersonalInformations"
                       value="Edit" />
            </div>
            <p class="note loaderImageContener" id="loaderContenerFor_editWorkHistory">
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
    function checkWorkHistoryForm(){
        var stop = false;
        var company_name = $('#company_name').val();
        var company_address = $('#company_address').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var job_description = $('#job_description').val();
        
        //company_name        
        if(company_name.length >99){
            $('#errorCompanyName').show(); stop = true;
        }
        else
            $('#errorCompanyName').hide();
        if(company_name == ""){
            $('#errorCompanyName').show(); stop = true;
        }
            
        //company_address        
        if(company_address != ""){
            if(company_address.length >199){
                $('#errorCompanyAddress').show(); stop = true;
            }
            else{
                $('#errorCompanyAddress').hide();
            }
        }
        //start_date        
        if(!/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(start_date)){
            $('#errorStartDate').show(); stop = true;
        }else
            $('#errorStartDate').hide();
        
        //end_date        
        if(!/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(end_date)){
            $('#errorEndDate').show(); stop = true;
        }else
            $('#errorEndDate').hide();
        
        //job_description
        if(job_description.length >1000){
            $('#errorJobDescription').show(); stop = true;
        }
        else
            $('#errorJobDescription').hide();
        if(job_description == ""){
            $('#errorJobDescription').show(); stop = true;
        }
        
        return stop;
    }
    function checkEditWorkHistoryForm(){
        var stop = false;
        var company_name = $('#edit_company_name').val();
        var company_address = $('#edit_company_address').val();
        var start_date = $('#edit_start_date').val();
        var end_date = $('#edit_end_date').val();
        var job_description = $('#edit_job_description').val();
        
        //company_name        
        if(company_name.length >99){
            $('#edit_errorCompanyName').show(); stop = true;
        }
        else
            $('#errorCompanyName').hide();
        if(company_name == ""){
            $('#edit_errorCompanyName').show(); stop = true;
        }
            
        //company_address        
        if(company_address != ""){
            if(company_address.length >199){
                $('#edit_errorCompanyAddress').show(); stop = true;
            }
            else{
                $('#edit_errorCompanyAddress').hide();
            }
        }
        //start_date        
        if(!/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(start_date)){
            $('#edit_errorStartDate').show(); stop = true;
        }else
            $('#edit_errorStartDate').hide();
        
        //end_date        
        if(!/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(end_date)){
            $('#edit_errorEndDate').show(); stop = true;
        }else
            $('#edit_errorEndDate').hide();
        
        //job_description
        if(job_description.length >1000){
            $('#edit_errorJobDescription').show(); stop = true;
        }
        else
            $('#edit_errorJobDescription').hide();
        if(job_description == ""){
            $('#edit_errorJobDescription').show(); stop = true;
        }
        
        return stop;
    }
    function refreshWorkHistoryList(){
        var error_contener = "loaderContenerFor_listWorkHistory";
        var contener = "parentWorkHistoryTableList";
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
    function addWorkHistory(){
        var dataString = $('form[id=addWorkHistoryForm]').serialize();
        var error_contener = "loaderContenerFor_addWorkHistory";
        var button = "button_addWorkHistory";
        if(checkWorkHistoryForm())
        {
            return false;
        }
        $.ajax({
            type: "POST",
            url: $('form[id=addWorkHistoryForm]').attr('action'),
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
                    refreshWorkHistoryList();
                    $('#'+ error_contener +' ').addClass('greenText');
                    $('.'+ button +'').removeAttr("disabled");
                    //empty the form
                    $('#company_name').val('');
                    $('#company_address').val('');
                    $('#start_date').val('');
                    $('#end_date').val('');
                    $('#job_description').val('');
                }
                else if(tabElement.Error=='404'){
                    //the user session is destroyed because it take too long to work, so he must logIn again
                    window.location.reload();
                }
            }
        })
        return false;
    }
    function editWorkHistory(){
        var dataString = $('form[id=editWorkHistoryForm]').serialize();
        var error_contener = "loaderContenerFor_editWorkHistory";
        var button = "button_editWorkHistory";
        if(checkEditWorkHistoryForm())
        {
            return false;
        }
        $.ajax({
            type: "POST",
            url: $('form[id=editWorkHistoryForm]').attr('action'),
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
                    refreshWorkHistoryList();
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
        refreshWorkHistoryList();
        $('.addWorkHistoryButton').click(function() { 
            $('#modal_parent_div').show();
            $('.modal_windows').hide();
            $('#modal_contener').show();
            $('#modal_content').html($('#add_work_history_form_div').html());
            $('#modal_content form').attr('id', 'addWorkHistoryForm');
        });     
        $('.deleteWorkHistoryButton').click(function() { 
            var oTT = TableTools.fnGetInstance('workHistoryTableList');
            var aSelectedTrs = oTT.fnGetSelected();
            longueurTab = aSelectedTrs.length;
            if(longueurTab <= 0)
            {
                alert('Please choose at least one WorkHistory to delete');
                return false;
            }
            else
            {
                if(!confirm("Sure you want to delete selected History(ies)?")){
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
                var error_contener = "loaderContenerFor_listWorkHistory";
                var contener = "parentWorkHistoryTableList";
                var url = $('#'+ error_contener +' ').attr('rel_2');
                var button = "deleteWorkHistoryButton";
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