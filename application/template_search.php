<!DOCTYPE html>
<?php
/*
 * template to manage serach results & results filtering
 */
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/search_jobs.css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/ddsmoothmenu.css" media="screen">
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/ddsmoothmenu.js"></script>
        <title>Job Search</title>
    </head>
    <body>
        <script type="text/javascript" charset="utf-8"> 
            jobResultsCookieName = 'jobResults';         
        </script>
        
        <div id="globalDiv">
            <div id="header"><!--begin of HEADER div--->
                <div id="blackRuban">
                    <div id="miniLogo">
                        <a href="<?php echo base_url() . 'index.php/jobSearch' ?>">
                            <img title="" alt="LOGO" src="<?php echo base_url() ?>images/logo.png" />
                        </a><br/></div>
                    <div id="BigJobsUpperText"><a href="<?php echo base_url() . 'index.php/jobSearch' ?>">JOBS</a></div>
                </div>
                <div class="cleaner"></div>

                <div id="paramRuban">
                    <div id="rubanIcons">
                        <center>
                            <img title="" alt="LOGO" src="<?php echo base_url() ?>images/chat.png" />f
                            <img title="" alt="LOGO" src="<?php echo base_url() ?>images/chat.png" />f
                            <img title="" alt="LOGO" src="<?php echo base_url() ?>images/chat.png" />f
                        </center>
                    </div>

                    <div id="rubanIDropDown">

                        <div id="top_nav" class="ddsmoothmenu">
                            <ul>
                                <?php
                                $logged = $this->session->userdata('member_id');
                                if (isset($logged) && $logged != FALSE) {
                                    ?>
                                    <li><a href="javascript:void(0);">Hi <?php echo $this->session->userdata('username') ?><img title="" alt="LOGO" src="<?php echo base_url() ?>images/chat.png" class="dropDownArrow"/></a>
                                        <ul>
                                            <?php
                                            if ($this->session->userdata('access_level_id') == 2) {
                                                ?>
                                                <li><a href="<?php echo base_url() . 'index.php/company/listJobs'; ?>">Manage Jobs</a></li>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if ($this->session->userdata('access_level_id') == 1) {
                                                ?>
                                                <li><a href="<?php echo base_url() . 'index.php/login/workHistory'; ?>">Work history</a></li>
                                                <li><a href="<?php echo base_url() . 'index.php/login/professionnalTraining'; ?>">Professionnal Training</a></li>                                  
                                                <?php
                                            }
                                            ?>

                                            <li><a href="<?php echo base_url() . 'index.php/login/reference'; ?>">References</a></li>

                                            <li><a href="<?php echo base_url() . 'index.php/login/Photo'; ?>">Profile Photo</a></li>
                                            <li><a href="<?php echo base_url() . 'index.php/login/editUserProfile'; ?>">Profile</a></li>
                                            <li><a href="<?php echo base_url() . 'index.php/login/editUserAwards'; ?>">Awards</a></li>

                                            <li><a href="<?php echo base_url() . 'index.php/login/change_password'; ?>">Change Password</a></li>
                                            <li><a href="<?php echo base_url() . 'index.php/login/logout'; ?>">LogOut</a></li>
                                        </ul>
                                    </li>
                                    <?php
                                } else {
                                    ?>
                                    <li>Already a member? <a href="<?php echo base_url() . 'index.php/login/login_page'; ?>">Log in</a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <br style="clear: left" />
                        </div> <!-- end of ddsmoothmenu -->
                    </div>

                </div>
                <div class="cleaner"></div>

                <div id="googleForm">
                    <form name="searchJobs" id="searchJobs" onsubmit="return false;" action="<?php echo base_url() . "index.php/jobSearch/search" ?>">
                        <div class="topBlocks logo">
                            <img title="" alt="LOGO" src="<?php echo base_url() ?>images/logo.png" /><br/>
                            Kimber Jobs <br/>
                            <span id="logoCaption">Your daily Job delivery  system !!</span>
                        </div>
                        <div class="topBlocks inputs">
                            <input type="text" name="jobTitle" placeholder="Job title"/><br/>
                            Exemple:<span class="searchExemple">Nurse</span>
                        </div>

                        <div id="IN">IN</div>

                        <div class="topBlocks inputs">
                            <input type="text" name="jobState" placeholder="Enter state"/><br/>
                            <span class="searchExemple">Maryland</span>
                        </div>
                        <div class="topBlocks inputs">
                            <input type="text" name="jobCountry" placeholder="Enter Country"/><br/>
                            <span class="searchExemple">Baltimore</span>
                        </div>
                        <div class="topBlocks inputs">
                            <input type="text" name="jobCity" placeholder="Enter City or Zip"/><br/>
                            <span class="searchExemple">WoodLawn or 21207</span>
                        </div>
                        <div class="topBlocks inputs">
                            <input type="submit" name="submit" value ="SEE JOBS" id="searchJobsButton" onclick="njl.show('1'); return false;" /><br/>
                        </div>
                    </form>
                </div>
                <div class="cleaner"></div>

                <div id="topSeparator"></div>
            </div><!--end of HEADER div--->
            <div class="cleaner"></div>

            <div id="middle"><!--begin of MIDDLE div--->
                <?php $this->load->view($include); ?>

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


        <script type="text/javascript" src="<?php echo base_url() ?>js/njl.js?refresh=<?php echo time(); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/searchJobs.js?refresh=<?php echo time(); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/myscript.js"></script>
        <div id="loader_image" style="display:none;" ><center><img src="<?php echo base_url() ?>images/loading.gif" alt="loading" title="loading"/></center></div>
        <div id="big_loader_image" style="display:none;" ><center><img src="<?php echo base_url() ?>images/big_loading.gif" alt="loading" title="loading"/></center></div>

        <style>
            .tpl {
                display: none;
            }

            a.more_result {
                background: url("http://localhost/KIMBER/images/image_more.png") no-repeat scroll right center #C8C8C8;
                clear: both;
                color: #333333;
                display: inline-block;
                font-weight: bold;
                height: 10px;
                margin-bottom: 10px;
                margin-left: 27%;
                margin-top: 2px;
                padding-bottom: 13px;
                padding-right: 20px;
                padding-top: 0;
                text-align: center;
                text-decoration: none;
                width: 417px;
            }
            .button a:hover {
                color: #000000;
            }
        </style>
        <div class="tpl nlj result">            
            <div class="resultImg" style="width: 200px; height: 200px;"><img src="<?php echo base_url() ?>medias/photos/" alt="image" /></div>
            <div class="resultInfos">
                <strong></strong>
                <p>
                    <span class="jobdetails">Req. Skills : </span><span class="jobdetailsReqSkills"></span><br/>
                    <span class="jobdetails">Educ. Req : </span><span class="jobdetailsEducationReq"></span><br/>
                    <span class="jobdetails">Salary Range : </span><span class="jobdetailsSalary"></span><br/>
                    <span class="jobdetailsAdditional">Other Skills : </span><span class="jobdetailsOtherSkills"></span><br/>
                    <span class="jobdetailsAdditional">Prefered Skills : </span><span class="jobdetailsPreferedSkills"></span><br/>
                    <strong> Listed:</strong> <span class="jobdetailsListed"></span> 
                    &nbsp; &nbsp; <span class="deadline">DEADLINE: </span><span class="jobdetailsDeadLine"></span>
                    &nbsp;&nbsp; <span class="apply"><a href="<?php echo base_url() ?>apply/" title="apply">APPLY</a></span>
                    &nbsp;&nbsp; <span class="SHARE"><a href="<?php echo base_url() ?>share/" title="share">SHARE</a></span>
                </p>
            </div>
            <div class="cleaner"></div>
        </div>
        <script type="text/javascript" charset="utf-8"> 
            $(function(){
                njl.show('1');
            } );
        </script>
    </body>
</html>
