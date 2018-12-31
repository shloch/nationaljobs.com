
$(function(){
    //example
    //   $('#login_link').click(function() {
    //        $('.hidden_pop_up_elements').hide();
    //        $('#forgot_password_contener_step1').hide();
    //        $('#forgot_password_contener_step2').hide();
    //        $('#forgot_password_contener_step3').hide();
    //        $('#cadre_login').show();
    //        $('#pop_up_parent_div').show();
    //    });
    //   $('#sms_link').click(function() {
    //        $('.hidden_pop_up_elements').hide();
    //        $('#cadre_sms').show();
    //        $('#pop_up_parent_div').show();
    //    });
    //   $('.hide_login_box').click(function() {
    //        $('.hidden_pop_up_elements').hide();
    //        $('#pop_up_parent_div').hide();
    //        $('#log_in_email').val('');
    //        $('#log_in_password').val('');
    //    });
    // end example
    ddsmoothmenu.init({
        mainmenuid: "top_nav", //menu DIV id
        orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
        classname: 'ddsmoothmenu', //class added to menu's outer DIV
        //customtheme: ["#1c5a80", "#18374a"],
        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
    })


    //trying to arrange the error js textx of the sign up form
    jQuery("span.error").prependTo('<input>');
})
