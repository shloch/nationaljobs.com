<?php
/*
 * To Sign Up
 */
?>
<link rel="stylesheet" href="<?php echo base_url() ?>css/form.css" media="screen">

<h1>Sign Up</h1>
<div id="sign-up">

    <p class="log-in">Already a member? <a href="<?php echo base_url() . 'index.php/login/login_page'; ?>">Log in</a>.</p>
    <form action="<?php echo base_url() . 'index.php/login/signup2DB'; ?>" method="post">
        <fieldset>
            <p class="introduction">Hi there! We're excited to have you as
                a part of our community. To get started, please create an
                account.</p>
            <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>
            
            <!--validation error sub block---->
            <?php
            $jobRegistered = $this->session->userdata('emailExistError');
            if (isset($jobRegistered) && $jobRegistered != FALSE) {
                echo "<h5 class='error'>" . $jobRegistered . "</h5><br />";
            }
            $this->session->set_userdata('emailExistError', '');
            ?>
            
            <!-- Email -->
            <div>
                <label for="email">Your email address
                    <abbr title="Required field">*</abbr></label>
                <?php echo form_error('email'); ?>
                <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>"/>
            </div>
            <!-- Account Type -->
            <div>
                <label for="access_level_id">Account Type
                    <abbr title="Required field">*</abbr></label>
                <?php echo form_error('access_level_id'); ?>
                <select name="access_level_id" id="access_level_id" class="default_select_style">
                    <option value="1">Simple Member</option>
                    <option value="2">Enterprise</option>
                </select>
            </div>
            <!-- Username -->
            <div>
                <label for="username">Your Username
                    <abbr title="Required field">*</abbr></label>
                <?php echo form_error('username'); ?>
                <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>"/>
            </div>
            <!-- Password -->
            <div>
                <label for="password">Create Password
                    <abbr title="Required field">*</abbr></label>
                <?php echo form_error('password'); ?>
                <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>"/>
            </div>
            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation">Confirm Password
                    <abbr title="Required field">*</abbr></label>
                <?php echo form_error('password_confirmation'); ?>
                <input type="password" name="password_confirmation" value="<?php echo set_value('password_confirmation'); ?>"
                       id="password_confirmation"/>
            </div>

            <!--reserved for the CAPTCHA----------------------->
            <div>


                <input type="hidden" value="<?php echo $CAPTCHA['word'] ?>"    name="captchaWord" id="captchaWord"> 
                <?php
                echo $CAPTCHA['image'] . ' ';
                //echo $CAPTCHA['word'];
                ?>
                <label for="captchaInput">Fill input with text from image...
                    <abbr title="Required field">*</abbr>
                </label>
                <?php echo form_error('captchaInput'); ?>
                <input type="text" value=""    name="captchaInput" id="captchaInput"/>

            </div>


            <!-- Terms of Service -->


            <div id="field-agree-tos">
                <?php echo form_error('agree_tos'); ?>
                <ul>
                    <li>
                        <label for="agree_tos">
                            <input type="checkbox" id="agree_tos" name="agree_tos" value="yes"/>
                            I have read and agree to the <a href="<?php echo base_url() . 'index.php/terms_of_service'; ?>">Terms
                                of Service</a>.
                        </label>
                    </li>
                </ul>
            </div>
            <!-- Controls -->
            <div class="controls">
                <label for="submit"></label>
                <input id="submit" name="submit" type="submit"
                       value="Create Profile"/>
            </div>
        </fieldset>
    </form>

</div>