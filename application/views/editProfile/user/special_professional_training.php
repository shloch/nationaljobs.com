<style type="text/css" title="currentStyle">
    @import "<?php echo base_url() ?>css/css_dataTable/demo_page.css";
    @import "<?php echo base_url() ?>css/css_dataTable/demo_table.css";
    @import "<?php echo base_url() ?>css/AutoFill.css";
    @import "<?php echo base_url() ?>css/modal_div.css";
    @import "<?php echo base_url() ?>css/css_dataTable/datatable_additional_css.css";
    @import "<?php echo base_url() ?>css/css_dataTable/TableTools.css";
    @import "<?php echo base_url() ?>css/css_dataTable/jquery-ui-1.8.4.custom.css";
</style>


<br /><div class="header_01"><h1>MANAGE YOUR PROFESSIONAL TRAININGS</h1></div>
<form>
    <fieldset>
        <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>
        
        <div>
            <label>Your Professionnal Training 
            </label>
            <br />
            <input type="button" class="addAward addProfessionnalTrainingButton" value="Add Training" />
            <br />
            <input type="button" class="addAward deleteProfessionnalTrainingButton" value="Delete Selected Training(s)" />
            <br />
            <div id="parentProfessionnalTrainingTableList" >
            </div>
        </div>
        <!-- Controls -->
        <div class="controls">
        </div>
    </fieldset>
</form>
<br />
<input type="button" class="addAward addProfessionnalTrainingButton" value="Add Training" />
<br />
<input type="button" class="addAward deleteProfessionnalTrainingButton" value="Delete Selected Training(s)" />
<p class="note loaderImageContener" id="loaderContenerFor_listProfessionnalTraining" rel="<?php echo base_url() . "index.php/professionnalTraining/refreshList" ?>" rel_2="<?php echo base_url() . "index.php/professionnalTraining/delete" ?>">
    &nbsp;
</p>
<div id="add_professionnal_training_form_div" class="modal_windows hidden">
    <form id="" action="<?php echo base_url() . 'index.php/professionnalTraining/add'; ?>" method="post">
        <fieldset>
            <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

            <!-- Trainer -->
            <div>
                <label for="trainer">Trainer
                    <abbr title="Required field">*</abbr>
                </label>
                <input name="trainer" id="trainer" type="text" />
                <span id="errorTrainer" class="error2" style="display:none">Maxlength 99 characters.</span>
            </div>
            <!-- Period -->
            <div>
                <label for="training_period">Training Duration
                    <abbr title="Required field">*</abbr>
                </label>
                <input name="training_period" id="training_period" type="text" />
                <span id="errorTrainingPeriod" class="error2" style="display:none">Maxlength 50 characters.</span>
            </div>
            <!-- Certificate Obtened -->
            <div>
                <label for="certificate_obtened">Certificate Obtened
                    <abbr title="Required field"></abbr>
                </label>
                <input name="certificate_obtened" id="certificate_obtened" type="text" />
                <span id="errorCertificateObtened" class="error2" style="display:none">Maxlength 100 characters.</span>
            </div>
            <!-- Controls -->
            <div class="controls">
                <label for="submit"></label>
                <input id="button_addProfessionnalTraining" name="button_addProfessionnalTraining" type="button" onclick="addProfessionnalTraining(); return false;" class="button_editPersonalInformations"
                       value="Save" />
            </div>
            <p class="note loaderImageContener" id="loaderContenerFor_addProfessionnalTraining">
                &nbsp;
            </p>
        </fieldset>
    </form>
</div>  
<div id="edit_professionnal_training_form_div" class="modal_windows hidden">
    <form id="" action="<?php echo base_url() . 'index.php/professionnalTraining/edit'; ?>" method="post">
        <fieldset>
            <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>
            
            <!-- Trainer -->
            <div>
                <label for="trainer">Trainer
                    <abbr title="Required field">*</abbr>
                </label>
                <input name="trainer" id="edit_trainer" type="text" />
                <span id="edit_errorTrainer" class="error2" style="display:none">Maxlength 99 characters.</span>
            </div>
            <!-- Period -->
            <div>
                <label for="training_period">Training Duration
                    <abbr title="Required field">*</abbr>
                </label>
                <input name="training_period" id="edit_training_period" type="text" />
                <span id="edit_errorTrainingPeriod" class="error2" style="display:none">Maxlength 50 characters.</span>
            </div>
            <!-- Certificate Obtened -->
            <div>
                <label for="certificate_obtened">Certificate Obtened
                    <abbr title="Required field"></abbr>
                </label>
                <input name="certificate_obtened" id="edit_certificate_obtened" type="text" />
                <span id="edit_errorCertificateObtened" class="error2" style="display:none">Maxlength 100 characters.</span>
            </div>
            <input type="hidden" name="special_professionnal_training_id" id="special_professionnal_training_id" />
            <!-- Controls -->
            <div class="controls">
                <label for="submit"></label>
                <input id="button_editProfessionnalTraining" name="button_editProfessionnalTraining" type="button" onclick="editProfessionnalTraining(); return false;" class="button_editPersonalInformations"
                       value="Edit" />
            </div>
            <p class="note loaderImageContener" id="loaderContenerFor_editProfessionnalTraining">
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
    function checkProfessionnalTrainingForm(){
        var stop = false;
        var trainer = $('#trainer').val();
        var training_period = $('#training_period').val();
        var certificate_obtened = $('#certificate_obtened').val();
        
        //trainer        
        if(trainer.length >99 || trainer == ""){
            $('#errorTrainer').show(); stop = true;
        }
        else
            $('#errorTrainer').hide();
        //training_period        
        if(training_period.length >50 || training_period == ""){
            $('#errorTrainingPeriod').show(); stop = true;
        }
        else
            $('#errorTrainingPeriod').hide();
        
        //training_period 
        if(certificate_obtened != ""){
            if(certificate_obtened.length >100){
                $('#errorCertificateObtened').show(); stop = true;
            }
            else
                $('#errorCertificateObtened').hide();
        }
            
        return stop;
    }
    function checkEditProfessionnalTrainingForm(){
        var stop = false;
        var trainer = $('#edit_trainer').val();
        var training_period = $('#edit_training_period').val();
        var certificate_obtened = $('#edit_certificate_obtened').val();
        
        //trainer        
        if(trainer.length >99 || trainer == ""){
            $('#edit_errorTrainer').show(); stop = true;
        }
        else
            $('#edit_errorTrainer').hide();
        //training_period        
        if(training_period.length >50 || training_period == ""){
            $('#edit_errorTrainingPeriod').show(); stop = true;
        }
        else
            $('#edit_errorTrainingPeriod').hide();
        
        //training_period 
        if(certificate_obtened != ""){
            if(certificate_obtened.length >100){
                $('#edit_errorCertificateObtened').show(); stop = true;
            }
            else
                $('#edit_errorCertificateObtened').hide();
        }
        return stop;
    }
    function refreshList(){
        var error_contener = "loaderContenerFor_listProfessionnalTraining";
        var contener = "parentProfessionnalTrainingTableList";
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
    function addProfessionnalTraining(){
        var dataString = $('form[id=addProfessionnalTrainingForm]').serialize();
        var error_contener = "loaderContenerFor_addProfessionnalTraining";
        var button = "button_addProfessionnalTraining";
        if(checkProfessionnalTrainingForm())
        {
            return false;
        }
        $.ajax({
            type: "POST",
            url: $('form[id=addProfessionnalTrainingForm]').attr('action'),
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
                    refreshList();
                    $('#'+ error_contener +' ').addClass('greenText');
                    $('.'+ button +'').removeAttr("disabled");
                    //empty the form
                    $('#trainer').val('');
                    $('#training_period').val('');
                    $('#certificate_obtened').val('');
                }
                else if(tabElement.Error=='404'){
                    //the user session is destroyed because it take too long to work, so he must logIn again
                    window.location.reload();
                }
            }
        })
        return false;
    }
    function editProfessionnalTraining(){
        var dataString = $('form[id=editProfessionnalTrainingForm]').serialize();
        var error_contener = "loaderContenerFor_editProfessionnalTraining";
        var button = "button_editProfessionnalTraining";
        if(checkEditProfessionnalTrainingForm())
        {
            return false;
        }
        $.ajax({
            type: "POST",
            url: $('form[id=editProfessionnalTrainingForm]').attr('action'),
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
                    refreshList();
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
    refreshList();
        $('.addProfessionnalTrainingButton').click(function() { 
            $('#modal_parent_div').show();
            $('.modal_windows').hide();
            $('#modal_contener').show();
            $('#modal_content').html($('#add_professionnal_training_form_div').html());
            $('#modal_content form').attr('id', 'addProfessionnalTrainingForm');
        });     
        $('.deleteProfessionnalTrainingButton').click(function() { 
            var oTT = TableTools.fnGetInstance('professionnalTrainingTableList');
            var aSelectedTrs = oTT.fnGetSelected();
            longueurTab = aSelectedTrs.length;
            if(longueurTab <= 0)
            {
                alert('Please choose at least one Training to delete');
                return false;
            }
            else
            {
                if(!confirm("Sure you want to delete selected Training(s)?")){
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
                var error_contener = "loaderContenerFor_listProfessionnalTraining";
                var contener = "parentProfessionnalTrainingTableList";
                var url = $('#'+ error_contener +' ').attr('rel_2');
                var button = "deleteProfessionnalTrainingButton";
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
