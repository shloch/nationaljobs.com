<?php

/*
 * this is the welcome page of the site
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet"  href="<?php echo base_url() . 'css/myStyle.css'; ?>" media="screen">
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <div id="globalDiv">
            <div id="header"><!--begin of HEADER div--->
                <div id="blackRuban">
                    <div id="miniLogo"><img title="" alt="LOGO" src="<?php echo base_url() ?>images/logo.png" /><br/></div>
                    <div id="BigJobsUpperText"> JOBS</div>
                </div>
                <div class="cleaner"></div>


                <div id="topSeparator"></div>
            </div><!--end of HEADER div--->
            <div class="cleaner"></div>

            <div id="middle"><!--begin of MIDDLE div--->
                <div id="topHomeButtons">
                    <div id="loginButton">
                            <?php
                            $logged = $this->session->userdata('member_id');
                                if (isset($logged) && $logged != FALSE) {
                            ?>
                            <a href="<?php echo site_url('login/editUserProfile'); ?>">EditProfile</a>
                            <?php
                                }else{
                            ?>
                            <a href="<?php echo site_url('login/login_page'); ?>">Login/Register</a>
                            <?php
                                }
                            ?>
                              
                    </div>                
                    <div id="jobListButton">List Jobs</div>

                </div><div class="cleaner"></div>
                
                 <div class="heightSpacing"></div> <!--separator-->

                <div id="bigLOGO">
                    <center>
                        <img src="<?php echo base_url() ?>images/bigLOGO2.png" alt="KimberJobs" title=""/>
                    </center>
                </div><div class="cleaner"></div>
                
                <div class="heightSpacing"></div> <!--separator-->

                <div id="googleForm">
                    <center>
                    <form>

                        <div class="topBlocks inputs">

                            <input type="text" name="jobTiltle"/><br/>
                            Exemple:<span class="searchExemple">Nurse</span>

                        </div>
                        <div id="IN">IN</div>

                        <div class="topBlocks inputs">
                            <input type="text" name="jobTiltle"/><br/>
                            <span class="searchExemple">Nurse</span>
                        </div>
                        <div class="topBlocks inputs">
                            <input type="text" name="jobTiltle"/><br/>
                            <span class="searchExemple">Nurse</span>
                        </div>
                        <div class="topBlocks inputs">
                            <input type="text" name="jobTiltle"/><br/>
                            <span class="searchExemple">Nurse</span>
                        </div>
                        
                        <div class="topBlocks inputs searchButton">
                            <input type="submit" value="Search"/><br/>
                        </div>
                    </form>
                    </center>
                </div><div class="cleaner"></div>

                <div class="heightSpacing"></div>

                <div id="searchCaptionText">
                    <H2>Search jobs all over the United States of America</h2>
                </div>
                
                 <div class="heightSpacing"></div> <!--separator-->
                 
            </div> <!--end of middle div--->
            <div class="cleaner"></div>

            <div id="footer"><!--begin of FOOTER div--->
                <div style="width:auto;">
                    <div class="bottomBlocks">
                        <div class="bottomBloacksHeader">Kimber Jobs</div>
                        <div class="bottomBloacksContent">
                            <li><a href="<?php echo base_url() . 'index.php/login/terms_of_service'; ?>">TERMS OF SERVICE</a></li>
			 <li><a href="<?php echo base_url() . 'index.php/contactUs; ?>">Contact Us</a></li>
                            <a href="#">Curabitur sed felis urna, </a><br/>
                            <a href="#">Curabitur sed felis urna, </a><br/>
                            <a href="#">Curabitur sed felis urna, </a><br/>
                            <a href="#">Curabitur sed felis urna, </a><br/>
                        </div>
                    </div>

                    <div class="bottomBlocks">
                        <div class="bottomBloacksHeader">Kimber Jobs</div>
                        <div class="bottomBloacksContent">
                            My first jQuery lets us do this with the css functionjQuery lets us do this with the css function
                            jQuery lets us do thisfunction paragraph.<a href="#" title="get more infos"> get more </a>

                        </div>
                    </div>

                    <div class="bottomBlocks">
                        <div class="bottomBloacksHeader">Kimber Jobs</div>
                        <div class="bottomBloacksContent">
			<li><a href="<?php echo base_url() . 'index.php/login/terms_of_service'; ?>">TERMS OF SERVICE</a></li>
			 <li><a href="<?php echo base_url() . 'index.php/contactUs; ?>">Contact Us</a></li>
                            My first jQuery lets us do this with the css functionjQuery lets us do this with the css function
                            jQuery lets us do thisfunction paragraph.<a href="#" title="get more infos"> get more </a>

                        </div>
                    </div>

                    <div class="bottomBlocks">
                        <div class="bottomBloacksHeader">Kimber Jobs</div>
                        <div class="bottomBloacksContent">
                            My first jQuery lets us do this with the css functionjQuery lets us do this with the css function
                            jQuery lets us do thisfunction paragraph.<a href="#" title="get more infos"> get more </a>

                        </div>
                    </div>

                    <div class="bottomBlocks">
                        <div class="bottomBloacksHeader">Kimber Jobs</div>
                        <div class="bottomBloacksContent">
                            My first jQuery lets us do this with the css functionjQuery lets us do this with the css function
                            jQuery lets us do thisfunction paragraph.<a href="#" title="get more infos"> get more </a>

                        </div>
                    </div>

                </div>


            </div><!--end of FOOTER div--->
            <div class="cleaner"></div>
        </div> <!--end of global div--->


        <script type="text/javascript" src="<?php echo base_url() . 'js/myScript.js'; ?>"></script>
    </body>
</html>
