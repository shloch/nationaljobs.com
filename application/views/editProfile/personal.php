<link rel="stylesheet" href="<?php echo base_url() ?>css/for_the_date_picker/ui-lightness/jquery-ui-1.8.11.custom.css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url() ?>css/form.css" media="screen"/>
<script type="text/javascript" src="<?php echo base_url() ?>js/for_the_date_picker/jquery-ui-1.8.11.custom.min.js"></script>
<br /><div class="header_01">Personal Informations</div>
<form action="<?php echo base_url() . 'index.php/login/editPersonalInformations'; ?>" id="editPersonalInformationsForm" method="post">
    <fieldset>
        <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

        <!--validation error sub block---->
        <?php
        $jobRegistered = $this->session->userdata('emailExistError');
        if (isset($jobRegistered) && $jobRegistered != FALSE) {
            echo "<h5 class='error'>" . $jobRegistered . "</h5><br />";
        }
        $this->session->set_userdata('emailExistError', '');
        ?>

        <!-- Name -->
        <div>
            <label for="email">Your Name
                <abbr title="Required field"></abbr>
            </label>
            <input type="text" name="name" id="name" value="<?php echo $this->session->userdata('name'); ?>"/>
            <span id="errorName" class="error2" style="display:none">Maxlength 99 characters.</span>
        </div>
        <!-- Gender -->
        <div>
            <label for="access_level_id">Gender
                <abbr title="Required field"></abbr>
            </label>
            <select name="gender" id="gender" class="default_select_style">
                <?php
                    if($this->session->userdata('gender')=="Male"){
                ?>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                <?php
                    }else{ 
                    ?>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                <?php
                    }
                    ?>
            </select>
        </div>
        <!-- DOB -->
        <div>
            <label for="username">Date of birthday
                <abbr title="Required field"></abbr>
            </label>
            <?php
                if($this->session->userdata('dob') != ""){
                    $dob = date ('Y-m-d', $this->session->userdata('dob'));
                }else{
                    $dob = '';
                }
            ?>
            <input type="text" name="dob" id="dob" value="<?php echo $dob; ?>"/>
            <span id="errorDob" class="error2" style="display:none">Please enter a valid date.</span>
        </div>
        <!-- Email -->
        <div>
            <label for="email">Your email address
                <abbr title="Required field">*</abbr>
            </label>
            <input type="text" name="email" id="email" value="<?php echo $this->session->userdata('email'); ?>"/>
            <span id="errorEmail" class="error2" style="display:none">Email not valid.</span>
        </div>
        <!-- Username -->
        <div>
            <label for="username">Your Username
                <abbr title="Required field">*</abbr>
            </label>
            <input type="text" name="username" id="username" value="<?php echo $this->session->userdata('username'); ?>"/>
            <span id="errorUsername" class="error2" style="display:none">Enter Value...</span>
        </div>
        <!-- Mobile -->
        <div>
            <label for="mobile">Mobile
                <abbr title="Required field"></abbr>
            </label>
            <input type="text" name="mobile" id="mobile" value="<?php echo $this->session->userdata('mobile'); ?>"/>
            <span id="errorMobile" class="error2" style="display:none">Please enter a valid number.</span>
        </div>
        <!-- Controls -->
        <div class="controls">
            <label for="submit"></label>
            <input id="submit" name="submit" type="submit" class="button_editPersonalInformations"
                   value="Save" />
        </div>
        <p class="note loaderImageContener" id="loaderContenerFor_editPersonalInformations">
            &nbsp;
        </p>
    </fieldset>
</form>


<script language="javascript">
    $(function(){            
        $.datepicker.setDefaults($.datepicker.regional['eng']);

        $('#dob').datepicker({
            dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
            yearRange: '-50y:c+nn',
            maxDate: '-1d'
        });
        $('#editPersonalInformationsForm').submit(function() {
            dataString = $(this).serialize();
            var error_contener = "loaderContenerFor_editPersonalInformations";
            var button = "button_editPersonalInformations";
            var stop = false;
            var email = $('#email').val();
            var name = $('#name').val();
            var username = $('#username').val();
            var dob = $('#dob').val();
            var mobile = $('#mobile').val();
            
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
                    $('#errorDob').show(); stop = true;
                }else
                    $('#errorDob').hide();
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