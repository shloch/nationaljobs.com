$(document).ready(function(){    
    //==================contactUS form===================================
        $('#searchResult form[name="contactUsForm"]').validate({
                rules: {
                        name: {
                                required: true,
                                minlength:3
                        },
                        email: {
                                required: true,
                                email: true
                        },
                        phone: {
                                
                        },
                        
                        comment: {
                                required: true
                        },
                        captchaInput: {
                                required: true,
                                equalTo: "#captchaWord"
                        }
                },
                success: function(label) {
//                        label.html('<span style="color:green;">OK!</span>')
//                        .addClass('valid');
                }
        });
       
        //==================change password==================================
        $('form[id=reinitializePwd]').validate({
                rules: {
                         email: {
                                required: true,
                                email: true
                        }
                },
                success: function(label) {
                        label.html('<span class="validInput">Valid Email</span>')
                        .addClass('valid');
                }
        });
      
         //==================signup form===================================
        $('#sign-up form').validate({
                rules: {
                        username: {
                                required: true
                        },
                        email: {
                                required: true,
                                email: true
                        },
                        password: {
                                required: true,
                                minlength:7
                        },
                        password_confirmation: {
                                required: true,
                                equalTo: "#password",
                                minlength:7
                        },
                        agree_pos: {
                                required: true
                        },
                        captchaInput: {
                                required: true,
                                equalTo: "#captchaWord"
                        }
                },
                success: function(label) {
//                        label.html('<span style="color:green;">OK!</span>')
//                        .addClass('valid');
                }
        });
         //==================add job form===================================
        $('form[id="addJobForm"]').validate({
                rules: {
                        jobTitle: {
                                required: true
                        },
                        jobDescription: {
                                required: true
                        },
                        jobSkills: {
                                required: true
                        },
                        companyCategorie: {
                                required: false
                        },
                        contractType: {
                                required: true
                        },
                        educationRequirement: {
                                required: true
                        }
                },
                success: function(label) {
//                        label.html('<span style="color:green;">OK!</span>')
//                        .addClass('valid');
                }
        });
         //==================change password==================================
        $('form[id=changePwd]').validate({
                rules: {
                        current_password: {
                                required: true
                        },
                        password: {
                                required: true,
                                minlength:7
                        },
                         password_confirmation: {
                                required: true,
                                equalTo: "#password",
                                minlength:7
                        }
                },
                success: function(label) {
//                        label.html('<span style="color:green;">OK!</span>')
//                        .addClass('valid');
                }
        });
         //==================SIGN IN==================================
        $('form[id=signIn]').validate({
                rules: {
                        email: {
                                required: true,
                                email: true
                        },
                        password: {
                                required: true,
                                minlength:7
                        }
                },
                success: function(label) {
//                        label.html('<span style="color:green;">OK!</span>')
//                        .addClass('valid');
                }
        });
         //==================EDIT PERSONAL INFORMATIONS==================================
//        $('form[id=editPersonalInformationsForm]').validate({
//                rules: {
//                        name: {
//                                required: false,
//                                maxlength: 99
//                        },
//                        username: {
//                                required: true
//                        },
//                        email: {
//                                required: true,
//                                email: true
//                        },
//                        mobile: {
//                                required: false,
//                                number: true,
//                                maxlength: 30
//                        },
//                        dob: {
//                                required: false,
//                                date: true
//                        }
//                },
//                onsubmit: true
//                
//        });
});