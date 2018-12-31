<?php
$member_id = $this->session->userdata('member_id');
if ($this->session->userdata('access_level_id')== 2) { //1 is default for simple member;2 for enterprise
    $companyDetails = $this->company->selectCompanyDetails($member_id);
    if ($companyDetails != FALSE) {
        //if the database is not empty
        $companyHiringPersonel =  ($companyDetails['name_of_hiring_personnel'] != NULL) ? $companyDetails['name_of_hiring_personnel'] :""  ;
        $companyCreationDate = ($companyDetails['date_of_company_creation'] != NULL) ? date('Y-m-d',$companyDetails['date_of_company_creation']) : "";
        $companyPortrait = ($companyDetails['portrait'] != NULL) ? $companyDetails['portrait'] : "" ;
        $industryTypeID = ($companyDetails['industryTypeID'] != NULL) ?  $companyDetails['industryTypeID'] : "";
        //$companyCategory = $companyDetails['industry_type_categories'];
    }else{
        $companyHiringPersonel = "";
        $companyCreationDate = "";
        $companyPortrait = "";
        $industryTypeID = "";
    }
}
?>
<link rel="stylesheet" href="<?php echo base_url() ?>css/for_the_date_picker/ui-lightness/jquery-ui-1.8.11.custom.css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url() ?>css/form.css" media="screen"/>
<script type="text/javascript" src="<?php echo base_url() ?>js/for_the_date_picker/jquery-ui-1.8.11.custom.min.js"></script>

<div class="header_01"><h1>EDIT ENTERPRISE INFORMATIONS</h1></div>


<form action="<?php echo base_url() . 'index.php/editCompany/editCompanyInformations'; ?>" id="editCompanyInformationsForm" method="post">
    <fieldset>
        <em>Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</em><br/>
        
        <!-- Name -->
        <div>
            <label for="email">Company Name
                <abbr title="Required field"></abbr>
            </label>
            <input type="text" name="name" id="name" value="<?php echo $this->session->userdata('name'); ?>"/>
            <span id="errorName" class="error2" style="display:none">Maxlength 99 characters.</span>
        </div>
        <!-- company type -->
        <div>
            <label for="access_level_id">Company Type
                <abbr title="Required field"></abbr>
            </label>
            <select name="companyType" id="companyType" class="default_select_style">
                <?php
                if (isset($companyCategories)) {
                    if ($companyCategories->num_rows > 0) {
                        foreach ($companyCategories->result() as $row) {
                            ?>
                            <option value="<?php echo $row->industryTypeID; ?>"><?php echo $row->industry_type_categories; ?></option>
                            <?php
                        }
                    }
                }
                ?>
            </select>
        </div>
        <!-- Company creation date -->
        <div>
            <label for="companyCreationDate">Date of Creation
                <abbr title="Required field"></abbr>
            </label>
            
            <input type="text" name="companyCreationDate" id="companyCreationDate" value="<?php echo $companyCreationDate; ?>"/>
            <span id="errorCompanyCreationDate" class="error2" style="display:none">Please enter a valid date.</span>
        </div>
        <!-- Email -->
        <div>
            <label for="email">Company email 
                <abbr title="Required field">*</abbr>
            </label>
            <input type="text" name="email" id="email" value="<?php echo $this->session->userdata('email'); ?>"/>
            <span id="errorEmail" class="error2" style="display:none">Email not valid.</span>
        </div>
        <!-- Hiring Personnel -->
        <div>
            <label for="nameHiringPersonnal">Hiring Personnel
                <abbr title="Required field"></abbr>
            </label>
            <input type="text" name="nameHiringPersonnal" id="nameHiringPersonnal" value="<?php echo $companyHiringPersonel; ?>"/>
        </div>
        <!-- Username -->
        <div>
            <label for="username">Company Username
                <abbr title="Required field">*</abbr>
            </label>
            <input type="text" name="username" id="username" value="<?php echo $this->session->userdata('username'); ?>"/>
            <span id="errorUsername" class="error2" style="display:none">Enter Value...</span>
        </div>
        <!-- Mobile -->
        <div>
            <label for="mobile">Company Mobile
                <abbr title="Required field"></abbr>
            </label>
            <input type="text" name="mobile" id="mobile" value="<?php echo $this->session->userdata('mobile'); ?>"/>
            <span id="errorMobile" class="error2" style="display:none">Please enter a valid number.</span>
        </div>
        <!-- Portrait Information -->
        <div>
            <label for="portrait">Company Description
                <abbr title="Required field"></abbr>
            </label>
            <textarea id="portrait"  name="portrait"> <?php echo $companyPortrait; ?></textarea>
        </div>
        <!-- Controls -->
        <div class="controls">
            <label for="submit"></label>
            <input id="submit" name="submit" type="submit" class="button_editCompanyInformations"
                   value="Save" />
        </div>
        <p class="note loaderImageContener" id="loaderContenerFor_editCompanyInformations">
            &nbsp;
        </p>
    </fieldset>
</form>


<script language="javascript">
    $(function(){            
        $.datepicker.setDefaults($.datepicker.regional['eng']);

        $('#companyCreationDate').datepicker({
            dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
            yearRange: '-50y:c+nn',
            maxDate: '-1d'
        });
        $('#editCompanyInformationsForm').submit(function() {
            dataString = $(this).serialize();
            var error_contener = "loaderContenerFor_editCompanyInformations";
            var button = "button_editCompanyInformations";
            var stop = false;
            var name = $('#name').val();
            var email = $('#email').val();
            var dob = $('#companyCreationDate').val();
            var hiringPersonnel = $('#nameHiringPersonnal').val();
            var username = $('#username').val();
            var mobile = $('#mobile').val();
            var portrait = $('#portrait').val();
            
            //email
            if(!/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(email)){
                $('#errorEmail').show(); stop = true;
            }else
                $('#errorEmail').hide();
            
            //username
            if(username == ""){
                $('#errorUsername').show(); stop = true;
            }else
                $('#errorUsername').hide();
            
            //dob
            if(dob != ""){
                if(!/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(dob)){
                    $('#errorCompanyCreationDate').show(); stop = true;
                }else
                    $('#errorCompanyCreationDate').hide();
            }
            
            //name
            if(name != ""){
                if(name.length >99){
                    $('#errorName').show(); stop = true;
                }else
                    $('#errorName').hide();
            }
            
            //mobile            
            if(mobile != ""){
                if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(mobile)){
                    stop = true; $('#errorMobile').show();
                }else{
                    $('#errorMobile').hide();
                }
            }
            
            if(stop)
            {
                return false;
            }
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
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
                        $('#'+ error_contener +' ').addClass('greenText');
                        $('.'+ button +'').removeAttr("disabled");
                    }
                    else if(tabElement.Error=='404'){
                        //the user session is destroyed because it take too long to work, so he must logIn again
                        window.location.reload();
                    }
                }
            })
            return false; //to stop the POST operation
        });
    })
</script>    
