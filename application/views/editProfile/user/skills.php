<br /><div class="header_01"><h1>EDIT PERSONAL SKILLS</h1></div>
<form action="<?php echo base_url() . 'index.php/skills/editSkills'; ?>" id="editSkillsForm" method="post">
    <fieldset>
        <p class="note">List your skills in the textarea below and seprate them with <strong><em>commas</em></strong>.</p>
        <em> <strong> Example</strong> : Fast typing, organized, master graph analysis softwares</em><br/><br/>

        <!-- Skills -->
        <div>
            <label for="facebook">Your Skills
                <abbr title="Required field"></abbr>
            </label>
            <textarea id="skills" name="skills"><?php echo $this->session->userdata('skills'); ?></textarea> 
            <span id="errorSkills" class="error2">Please no more than 1000 characters.</span>
        </div>
        <!-- Controls -->
        <div class="controls">
            <label for="submit"></label>
            <input id="submit" name="submit" type="submit" class="button_editSkills"
                   value="Save" />
        </div>
        <p class="note loaderImageContener" id="loaderContenerFor_editSkills">
            &nbsp;
        </p>
    </fieldset>
</form>


<script language="javascript">
    
(function(w){

    var c = function() {
        return new c.fn.init();
    };
    c.fn = c.prototype = {
        init: function(){return this}
    };
    
    /* trim() ltrim() rtrim() */
    c.trim = function(str, chars)
    {
        return nlj.ltrim(nlj.rtrim(str, chars), chars);
    }

    c.ltrim = function(str, chars)
    {
        var car = (chars != undefined) ? chars : "\\s";
        return str.replace(new RegExp("^[" + chars + "]*", "g"), "");
    }

    c.trim = function(str, chars)
    {
        var car = (chars != undefined) ? chars : "\\s";
        return str.replace(new RegExp("[" + chars + "]*$", "g"), "");
    }

    //count chars
    c.countChars = function(max_chars, id, error_zone_id)
    {
        var skills = $('#'+id+'').val();
        var nbChars = skills.length;
        $('#'+error_zone_id+'').show(); 
        if(nbChars > max_chars)
            $('#'+error_zone_id+'').removeClass('greenText').addClass('redText').html('Please no more than '+max_chars+' characters. '+nbChars+'/'+max_chars);
        else        
            $('#'+error_zone_id+'').removeClass('redText').addClass('greenText').html(''+nbChars+'/'+max_chars);
    }
    w.nlj = c; /*Creating the nlj namespace for all this*/
    })(window)
    
    $(function(){
        var max_chars = 1000;
        var error_zone_id = 'errorSkills';
        var skills_id = 'skills';
        $('#skills').change(function() {
            nlj.countChars(max_chars, skills_id, error_zone_id);
        });
        $('#skills').keydown(function() {
            nlj.countChars(max_chars, skills_id, error_zone_id);
        });
        $('#skills').keyup(function() {
            nlj.countChars(max_chars, skills_id, error_zone_id);
        });
        $('#skills').focus(function() {
            nlj.countChars(max_chars, skills_id, error_zone_id);
        });
        $('#skills').blur(function() {
            nlj.countChars(max_chars, skills_id, error_zone_id);
        });
        
        $('#editSkillsForm').submit(function() {
            dataString = $(this).serialize();
            var error_contener = "loaderContenerFor_editSkills";
            var button = "button_editSkills";
            var stop = false;
            var skills = $('#skills').val();
            
            //skills
            if(skills != ""){
                if(skills.length > max_chars){
                    $('#errorSkills').show(); stop = true;
                }else
                    $('#errorSkills').hide();
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