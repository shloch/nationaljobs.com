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
          <link rel="stylesheet" href="<?php echo base_url() ?>css/contact.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/contactUsForm.css" media="screen">
        <title>Job Search</title>
    </head>
    <body>
        <div id="globalDiv">
            <div id="header"><!--begin of HEADER div--->
                <div id="blackRuban">
                    <div id="miniLogo"><img title="" alt="LOGO" src="<?php echo base_url() ?>images/logo.png" /><br/></div>
                    <div id="BigJobsUpperText"> JOBS</div>
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
                                        if($this->session->userdata('access_level_id') == 2){
                                        ?>
                                        <li><a href="<?php echo base_url() . 'index.php/company/listJobs'; ?>">Manage Jobs</a></li>
                                        <?php
                                        }
                                        ?>
                                        
                                         <?php
                                        if($this->session->userdata('access_level_id') == 1){
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
                                }
                                else{
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
                    <form>
                        <div class="topBlocks logo">
                            <img title="" alt="LOGO" src="<?php echo base_url() ?>images/logo.png" /><br/>
                            Kimber Jobs <br/>
                            <span id="logoCaption">Your daily Job delivery  system !!</span>
                        </div>
                        <div class="topBlocks inputs">

                            <input type="text" name="jobTiltle" onfocus="if (this.value=='Job title') this.value='';" onblur="if (this.value=='') this.value='Job title';" value="Job title"/><br/>
                            Exemple:<span class="searchExemple">Nurse</span>

                        </div>
                        <div id="IN">IN</div>

                        <div class="topBlocks inputs">
                            <input type="text" name="jobState" onfocus="if (this.value=='Enter state') this.value='';" onblur="if (this.value=='') this.value='Enter state';" value="Enter state"/><br/>
                            <span class="searchExemple">Maryland</span>
                        </div>
                        <div class="topBlocks inputs">
                            <input type="text" name="jobCountry" onfocus="if (this.value=='Enter Country') this.value='';" onblur="if (this.value=='') this.value='Enter Country';" value="Enter Country"/><br/>
                            <span class="searchExemple">Baltimore</span>
                        </div>
                        <div class="topBlocks inputs">
                            <input type="text" name="jobCity" onfocus="if (this.value=='Enter City or Zip') this.value='';" onblur="if (this.value=='') this.value='Enter City or Zip';" value="Enter City or Zip"/><br/>
                            <span class="searchExemple">WoodLawn or 21207</span>
                        </div>
                        <div class="topBlocks inputs">
                            <input type="submit" name="submit" value ="SEE JOBS"/><br/>
                        </div>
                    </form>
                </div>
                <div class="cleaner"></div>

                <div id="topSeparator"></div>
            </div><!--end of HEADER div--->
            <div class="cleaner"></div>

            <div id="middle"><!--begin of MIDDLE div--->
               <?php $this->load->view('design/contactUsForm'); ?>

            </div> <!--end of middle div--->
            <div class="cleaner"></div>

            <div id="footer"><!--begin of FOOTER div--->
                <div style="width:auto;">
                    <div class="bottomBlocks">
                        <div class="bottomBloacksHeader">Kimber Jobs</div>
                        <div class="bottomBloacksContent">
                            <a href="Contact.html">Contact Us </a><br/>
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


        <script type="text/javascript" src="<?php echo base_url() ?>js/myscript.js"></script>
    </body>
</html>