
<link rel="stylesheet" href="<?php echo base_url() ?>css/form.css" media="screen">

<h1>Login to your Account</h1>
 <p class="log-in">Not a member? <a href="<?php echo base_url() . 'index.php/login/signUp'; ?>">Sign Up</a> Here.</p>
<form action="<?php echo base_url() . 'index.php/login/signIn'; ?>" method="POST" id="signIn">
    <fieldset>
        <!-- Email -->
        <?php
        $loginError = $this->session->userdata('loginError');
        if (isset($loginError) && $loginError != FALSE)
            echo "<h5>".$loginError."</h5><br />";
        ?>
        <div>
            <label for="email">Your email address
                <abbr title="Required field">*</abbr></label>
            <?php echo form_error('email'); ?>
            <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>"/>
        </div>
         <!-- Password -->
        <div>
            <label for="password">Password
                <abbr title="Required field">*</abbr></label>
            <?php echo form_error('password'); ?>
            <input type="password" name="password" id="password" value=""/>
        </div>
        <p class="log-in">Forgot your password? <a href="<?php echo base_url() . 'index.php/login/forgot_password_page'; ?>">Change it here</a>.</p>
        <!-- Controls -->
        <div class="controls">
            <label for="submit"></label>
            <input id="submit" name="submit" type="submit"
                   value="Connection"/>
        </div>
    </fieldset>
</form>