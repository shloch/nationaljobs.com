<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/myStyle2.css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/ddsmoothmenu.css" media="screen">
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/ddsmoothmenu.js"></script>
        <title> <?php echo $title; ?></title>
    </head>
    <body>
		<div id="modal_parent_div" class="hidden"> 
            <div id="modal_contener" class="hidden">                
                <div class="hide_box" title="Close the Window">
                    
                </div>
                <div style="clear: both"></div>
                <div id="modal_content" style="margin-bottom: 20px; margin: auto">
                    
                </div>        
            </div> 
        </div>
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

                <div id="topSeparator"></div>
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




            </div><!--end of HEADER div--->
            <div class="cleaner"></div>

            <div id="middle"><!--begin of MIDDLE div--->


                <div id="content">
                    <?php $this->load->view($include); ?>
                </div>


            </div> <!--end of middle div--->
            <div class="cleaner"></div>

            <div id="footer"><!--begin of FOOTER div--->
                <div style="width:auto;">
                    <div class="bottomBlocks">
                        <div class="bottomBloacksHeader">Kimber Jobs</div>
                        <div class="bottomBloacksContent">
                         <li><a href="<?php echo base_url() . 'index.php/login/terms_of_service'; ?>">TERMS OF SERVICE</a></li>
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
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.js"></script>
       
        <script type="text/javascript" src="<?php echo base_url() ?>js/forms.js"></script>
        
        <div id="loader_image" style="display:none;" ><img src="<?php echo base_url() ?>images/loading.gif" alt="loading" title="loading"/></div>
        <div id="big_loader_image" style="display:none;" ><img src="<?php echo base_url() ?>images/big_loading.gif" alt="loading" title="loading"/></div>
    </body>
    <script>
        $(function(){
            $('.hide_box').click(function() { 
                $('#modal_parent_div').hide();
                $('#modal_contener').hide();
                $('#modal_content').html('');
                $('.modal_windows').hide();
                $('#error_contener').html('&nbsp;');
            });
        });
    </script>
</html>
