
<link rel="stylesheet" href="<?php echo base_url() ?>css/form.css" media="screen">


<h1>Put your email to re-initialize password</h1>

<p class="log-in">After Submitting, go to your e-mail to get a generated password. 
    <br/>(<strong>NB:</strong> If you dont see it in your inbox, try and check your spam box)</p>

<form action="<?php echo base_url() . 'index.php/login/reInitializePwd'; ?>" method="POST" id="reinitializePwd">
    <fieldset>
        <!-- Email -->
        <?php
        $emailError = $this->session->userdata('emailError');
        if (isset($emailError) && $emailError != FALSE)
            echo "<h5>".$emailError."</h5><br />";
        ?>
        <div>
            <label for="email">Your email address
                <abbr title="Required field">*</abbr></label>
            <?php echo form_error('email'); ?>
            <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>"/>
        </div>
        <!-- Controls -->
        <div class="controls">
            <label for="submit"></label>
            <input id="submit" name="submit" type="submit"
                   value="submit"/>
        </div>
    </fieldset>
</form>