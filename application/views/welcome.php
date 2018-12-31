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
        <link rel="stylesheet" href="<?php echo base_url() ?>js/autocomplete/jquery-ui.v1.10.3.css" media="screen" />
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
                        } else {
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
                        <form name="" action="<?php echo base_url() . 'index.php/jobSearch'; ?>" method="post">

                            <div class="topBlocks inputs">

                                <input type="text" name="jobTitle" id="jobTitle" placeholder="Job title"/><br/>
                                Exemple:<span class="searchExemple">Nurse</span>

                            </div>
                            <div id="IN">IN</div>

                            <div class="topBlocks inputs">
                                <input type="text" name="jobState" id="jobState" placeholder="Enter state" /><br/>
                                <span class="searchExemple">Maryland</span>
                            </div>
                            <div class="topBlocks inputs">
                                <input type="text" name="jobCountry" id="jobCountry" placeholder="Enter Country" /><br/>
                                <span class="searchExemple">Baltimore</span>
                            </div>
                            <div class="topBlocks inputs">
                                <input type="text" name="jobCity" id="jobCity" placeholder="Enter City or Zip" /><br/>
                                <span class="searchExemple">WoodLawn or 21207</span>
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
                <?php $this->load->view('design/footer'); ?>
            </div><!--end of FOOTER div--->
            <div class="cleaner"></div>
        </div> <!--end of global div--->

        <script type="text/javascript" src="<?php echo base_url() ?>js/autocomplete/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/autocomplete/jquery-ui.v1.10.3.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/njl.js?refresh=<?php echo time(); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/searchJobs.js?refresh=<?php echo time(); ?>"></script>
        
        <script type="text/javascript" src="<?php echo base_url() . 'js/myScript.js'; ?>"></script>
        <input type="hidden" id="autocomplete_controler_url" rel="<?php echo base_url() . "index.php/jobSearch/autocomplete" ?>" />
    </body>
</html>
