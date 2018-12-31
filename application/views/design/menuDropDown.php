
<!--/*
 * this is the animated drop down menu (top right)
 */-->
<ul>
    <?php
    $logged = $this->session->userdata('member_id');
    if (isset($logged) && $logged != FALSE) {
        ?>
        <li><a href="javascript:void(0);">Hi <?php echo $this->session->userdata('username') ?><img title="" alt="LOGO" src="<?php echo base_url() ?>images/chat.png" class="dropDownArrow"/></a>
            <ul>
                <?php
                if ($this->session->userdata('access_level_id') == 2) { //enterprise
                    ?>
                    <li><a href="<?php echo base_url() . 'index.php/company/listJobs'; ?>">Manage Jobs</a></li>
                    <?php
                }else{ //simple user
                    ?>
                    <li><a href="<?php echo base_url() . 'index.php/jobSearch/jobAppliedFor'; ?>">Jobs Applied For</a></li>
                    <?php
                }
                ?>

                <?php
                if ($this->session->userdata('access_level_id') == 1) { //simple user
                    ?>
                    <li><a href="<?php echo base_url() . 'index.php/login/workHistory'; ?>">Work history</a></li>
                <li><a title="in PDF format" href="<?php echo base_url() . 'index.php/pdf'; ?>">Generate CV</a></li>
                    <li><a href="<?php echo base_url() . 'index.php/login/professionnalTraining'; ?>">Professionnal Training</a></li>                                  
                    <?php
                }
                ?>

                <li><a href="<?php echo base_url() . 'index.php/login/document'; ?>">Documents</a></li>
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
