<style type="text/css" title="currentStyle">
    @import "<?php echo base_url() ?>css/css_dataTable/demo_page.css";
    @import "<?php echo base_url() ?>css/css_dataTable/demo_table.css";
    @import "<?php echo base_url() ?>css/AutoFill.css";
    @import "<?php echo base_url() ?>css/css_dataTable/datatable_additional_css.css";
    @import "<?php echo base_url() ?>css/css_dataTable/TableTools.css";
    @import "<?php echo base_url() ?>css/css_dataTable/jquery-ui-1.8.4.custom.css";
</style>


<br /><div class="header_01"><h1>Your Job(s) Applied For</h1></div>
<form>
    <fieldset>
        <!-- JAF -->
        <div>
            <label>Your Job(s) Applied For 
            </label>
            <br />
            <div id="parentJAFTableList" >
            </div>
        </div>
        <!-- Controls -->
        <div class="controls">
        </div>
    </fieldset>
</form>
<p class="note loaderImageContener" id="loaderContenerFor_listJAF" rel="<?php echo base_url() . "index.php/jobSearch/refreshJobAppliedForList" ?>" rel_2="<?php echo base_url() . "index.php/jobSearch/deleteJobAppliedFor" ?>">
    &nbsp;
</p>    
<script type="text/javascript" charset="utf-8" src="<?php echo base_url() ?>js/dataTable/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url() ?>js/AutoFill.js"></script>

<script type="text/javascript" charset="utf-8" src="<?php echo base_url() ?>js/dataTable/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url() ?>js/dataTable/TableTools.js"></script>


<script type="text/javascript" src="<?php echo base_url() ?>js/for_the_date_picker/jquery-ui-1.8.11.custom.min.js"></script>

<script type="text/javascript" charset="utf-8">    
    function refreshJAFList(){
        var error_contener = "loaderContenerFor_listJAF";
        var contener = "parentJAFTableList";
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
    
    
    $(function(){
        refreshJAFList();          
    } );
</script>