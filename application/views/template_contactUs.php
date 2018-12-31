<!DOCTYPE html>
<?php
/*
 * template to manage serach results & results filtering
 */
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/myStyle2.css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/search_jobs.css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/ddsmoothmenu.css" media="screen">
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/ddsmoothmenu.js"></script>
        <link rel="stylesheet" href="<?php echo base_url() ?>css/contact.css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/contactUsForm.css" media="screen">
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <div id="globalDiv">
            <div id="header"><!--begin of HEADER div--->
                <div id="blackRuban">
                    <div id="miniLogo"><img title="" alt="LOGO" src="<?php echo base_url() ?>images/logo.png" />
                        <br/></div>
                    <div id="BigJobsUpperText"> JOBS</div>
                </div>
                <div class="cleaner"></div>

                <div id="paramRuban">
                    <?php $this->load->view('design/ruban'); ?>
                </div>
                <div class="cleaner"></div>

                <div id="googleForm">
                   <!-- //have not included the google form here -->
                </div>
                <div class="cleaner"></div>

                <div id="topSeparator"></div>
            </div><!--end of HEADER div--->
            <div class="cleaner"></div>

            
            <div id="middle"><!--begin of MIDDLE div--->
                <div id="profile">
                    <p>
                        PROFILE INFOS
                    </p>
                </div>

                <div id="searchResult">
                    <h2>Contact Us</h2>
                    <form enctype="multipart/form-data" method="POST" name="contactUsForm" class="contactForm" action="<?php echo base_url() . 'index.php/contactUs/addContactMsg'; ?>">
                        <!-- com_foxcontact 2.0.17 1 -->
                        You may wish to contact us for any suggestions, information.....<br/><br/>


                        <!--validation error sub block---->
                        <?php
                        if (isset($jobRegistered) && $jobRegistered != FALSE) {
                            echo "<h5 class='success'>" . $jobRegistered . "</h5>";
                        }
                        echo "<h5 class='error'>" . validation_errors() . "</h5><br/>";
                        ?>


                        <label for="name">Your name <span class="asterisk">*</span></label><br/><input  name="name"  id="name" type="text"><br/><br/>
                        <label for="email">Your e-mail <span class="asterisk">*</span></label><br/><input  name="email" id="email" type="text"><br/><br/>
                        <label for="phone">Phone number</label><br/><input  name="phone" id="phone"  type="text"><br/><br/>

                        <label for="comment">Comment*</label><br/>

                        <textarea rows="5" cols="29"  name="comment" id="comment" ></textarea> <br/><br/>

                        <!--reserved for the CAPTCHA----------------------->
                        <input type="hidden" value="<?php echo $CAPTCHA['word'] ?>"    name="captchaWord" id="captchaWord"> 
                        <?php
                        echo $CAPTCHA['image'] . ' ';
                        ?>
                        <label for="captchaInput">Fill input with text from image...</label><br/>
                        <?php echo form_error('captchaInput'); ?>
                        <input type="text" value=""    name="captchaInput" id="captchaInput"/><br/>

                        <label></label><br/><input id="submit" name="submit" type="submit" value="Send">
                    </form>
                    <div class="cleaner"></div>
                </div>



                <div id="searchParam">
<!--                    <div id="newsletter">
                        Get new jobs for <br/>this search in your email
                        <form>
                            <input type="text" name="searchWords"/><input type="image" src="<?php echo base_url() ?>images/go.gif" alt="GO" name="submitSearch"/>
                        </form>
                    </div>-->
                    <div id="contactAside">
                        <div>         
                            <div class="contactInfos">
                                <h3 class="contactInfos-title">Adresses</h3>
                                <section class="contactInfos-content">

                                    <div class="custom">
                                        <p><br><span><strong>FRANCE</strong></span></p>
                                        <p><strong>Siège :</strong><br>Normandie Incubation<br>17, rue Claude Bloch - BP 55027<br>14076 Caen Cedex 5</p>
                                        <p><strong>Pôle technique :</strong><br>Plug'N'Work<br>2 Rue Jean Perrin, 14460 Colombelles</p>
                                        <p><strong>Etablissement secondaire :</strong><br> Bond'Innov<br>Campus IRD France Nord - 32 avenue Henri Varagnat 93143 Bondy Cedex</p>
                                        <p><strong>Succursale :<br></strong>QuickDo Cameroun<br>BP&nbsp;15345 Yaoundé</p></div>
                                </section>
                            </div>

                        </div>
                    </div>
                </div>


            </div> <!--end of middle div--->
            <div class="cleaner"></div>

            <div id="footer"><!--begin of FOOTER div--->
                <?php $this->load->view('design/footer'); ?>
            </div><!--end of FOOTER div--->
            <div class="cleaner"></div>
        </div> <!--end of global div--->


        <script type="text/javascript" src="<?php echo base_url() ?>js/myscript.js"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/forms.js"></script>
        
    </body>
</html>