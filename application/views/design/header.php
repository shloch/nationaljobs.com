<!--

/*
 * header
 */-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="<?php echo base_url() ?>css/search_jobs.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url() ?>css/ddsmoothmenu.css" media="screen">
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/ddsmoothmenu.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>css/myStyle2.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url() ?>css/ddsmoothmenu.css" media="screen">


<?php
if ($this->uri->segment(1) == 'contactUs') {//if the contact page is opened, load the following CSS files
    ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>css/contact.css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/contactUsForm.css" media="screen">
    <?php
}else{
    ?>
   
    <?php
}
?>
<title><?php echo $title; ?></title>