<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<link rel="stylesheet" href="<?php echo base_url() ?>css/form.css" media="screen">

<h1>Change Password</h1>
<form action="<?php echo base_url() . 'index.php/login/change_password'; ?>" method="POST">
    <fieldset>
        <!-- Current -->
        <?php
        $changePasswordError = $this->session->userdata('changePasswordError');
        if (isset($changePasswordError) && $changePasswordError != FALSE)
            echo "<h5>".$changePasswordError."</h5><br />"
        ?>
        <div>
            <label for="current">Current password<abbr title="Required field">*</abbr></label>
            <?php echo form_error('current_password'); ?>
            <input type="password" name="current_password" value=""
                   id="current_password"/>
        </div>
        <!-- New -->
        <div>
            <label for="new">New password<abbr title="Required field">*</abbr></label>
            <?php echo form_error('password'); ?>
            <input type="password" name="password" value="" id="password"/>
        </div>
        <!-- Confirm -->
        <div>
            <label for="confirm">Confirm password<abbr title="Required field">*</abbr></label>
            <?php echo form_error('password_confirmation'); ?>
            <input type="password" name="password_confirmation" value=""
                   id="password_confirmation"/>
        </div>
        <!-- Controls -->
        <div class="controls">
            <label for="submit"></label>
            <input id="submit" name="submit" type="submit"
                   value="Change password"/>
        </div>
    </fieldset>
</form>
