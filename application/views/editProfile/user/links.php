<br /><div class="header_01"><h1>EDIT LINKS AND REFERENCES</h1></div>
<form action="<?php echo base_url() . 'index.php/login/editLinks'; ?>" id="editLinksForm" method="post">
    <fieldset>
        <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

        <!-- Facebook -->
        <div>
            <label for="facebook">Your Facebook link
                <abbr title="Required field"></abbr>
            </label>
            <input type="text" name="facebook" id="facebook" value="<?php echo $this->session->userdata('facebook'); ?>"/>
            <span id="errorFacebook" class="error2" style="display:none">Enter valid URL, please no more than 50 characters.</span>
        </div>
        <!-- Twitter -->
        <div>
            <label for="twitter">Your Twitter link
                <abbr title="Required field"></abbr>
            </label>
            <input type="text" name="twitter" id="twitter" value="<?php echo $this->session->userdata('twitter'); ?>"/>
            <span id="errorTwitter" class="error2" style="display:none">Enter valid URL, please no more than 50 characters.</span>
        </div>
        <!-- LinkedIn -->
        <div>
            <label for="linkedIn">Your LinkedIn link
                <abbr title="Required field"></abbr>
            </label>
            <input type="text" name="linkedIn" id="linkedIn" value="<?php echo $this->session->userdata('linkedIn'); ?>"/>
            <span id="errorLinkedIn" class="error2" style="display:none">Enter valid URL, please no more than 50 characters.</span>
        </div>
        <!-- Controls -->
        <div class="controls">
            <label for="submit"></label>
            <input id="submit" name="submit" type="submit" class="button_editLinks"
                   value="Save" />
        </div>
        <p class="note loaderImageContener" id="loaderContenerFor_editLinks">
            &nbsp;
        </p>
    </fieldset>
</form>


<script language="javascript">
    $(function(){                    
        $('#editLinksForm').submit(function() {
            dataString = $(this).serialize();
            var error_contener = "loaderContenerFor_editLinks";
            var button = "button_editLinks";
            var stop = false;
            var facebook = $('#facebook').val();
            var twitter = $('#twitter').val();
            var linkedIn = $('#linkedIn').val();
            
            //facebook
            if(facebook != ""){
                if(!/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(facebook)){
                    $('#errorFacebook').show(); stop = true;
                }else
                    $('#errorFacebook').hide();
            }
            
            //twitter
            if(twitter != ""){
                if(!/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(twitter)){
                    $('#errorTwitter').show(); stop = true;
                }else
                    $('#errorTwitter').hide();
            }
            
            //linkedIn
            if(linkedIn != ""){
                if(!/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(linkedIn)){
                    $('#errorLinkedIn').show(); stop = true;
                }else
                    $('#errorLinkedIn').hide();
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