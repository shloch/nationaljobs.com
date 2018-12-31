<link rel="stylesheet" href="<?php echo base_url() ?>css/form.css" media="screen">


<h1>Feedback</h1>
<form action="#" method="post">
    <fieldset>
        <p class="introduction">Tell us what you think about the site.
            What is working for you? What would you like to see
            inproved? Your opinion is very valuable to us. <strong>All
                fields are required.</strong></p>
        <!-- Your Name -->
        <div>
            <label for="name">Your name
                <abbr title="Required field">*</abbr>
            </label>
            <input type="text" name="name" id="name"/>
        </div>
        <!-- Email -->
        <div>
            <label for="email">Your email address</label>
            <input type="text" name="email" id="email"/>
        </div>
        <!-- Password -->
        <div>
            <label for="comment">Your comments</label>
            <textarea name="comment" id="comment" cols="30" rows="6">
            </textarea>
        </div>
        <!-- Controls -->
        <div class="controls">
            <label for="submit"></label>
            <input id="submit" name="submit" type="submit"
                   value="Submit Feedback"/>
        </div>
    </fieldset>
</form>
