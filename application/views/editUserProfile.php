<?php
/*
 * view (glide switching)  page to edit profile
 */
?>
<link rel="stylesheet" href="<?php echo base_url() ?>css/featuredcontentglider.css" media="screen">
<script type="text/javascript" src="<?php echo base_url() . 'js/'; ?>featuredcontentglider.js">
    /***********************************************
     * Featured Content Glider script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
     * Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
     * This notice must stay intact for legal use
     ***********************************************/
</script>
<script type="text/javascript">

    featuredcontentglider.init({
        gliderid: "gliderDivs", //ID of main glider container
        contentclass: "glidecontent", //Shared CSS class name of each glider content
        togglerid: "p-select", //ID of toggler container
        remotecontent: "", //Get gliding contents from external file on server? "filename" or "" to disable
        selected: 0, //Default selected content index (0=1st)
        persiststate: false, //Remember last content shown within browser session (true/false)?
        speed: 500, //Glide animation duration (in milliseconds)
        direction: "rightleft", //set direction of glide: "updown", "downup", "leftright", or "downup"
        autorotate: false, //Auto rotate contents (true/false)?
        autorotateconfig: [3000, 2] //if auto rotate enabled, set [milliseconds_btw_rotations, cycles_before_stopping]
    })
		
</script>
<div id="p-select" class="glidecontenttoggler">
    <?php 
        //1(simple member), 2(enterprise)
        if($this->session->userdata('access_level_id') == 1){
    ?>
            <a href="#" class="toc page_01">Personal></a>
<!--            <a href="#" class="toc page_02">Education History></a>-->
            <a href="#" class="toc page_02">Skills></a>
<!--            <a href="#" class="toc page_04">Special professional training></a>-->
<!--            <a href="#" class="toc page_05">Work history and references></a>-->
            <a href="#" class="toc page_03">Links></a>
    <?php
        }
        else{
    ?>
            <a href="#" class="toc page_01">Enterprise Informations></a>
            <a href="#" class="toc page_02">Links></a>
    <?php
        }
    ?>

</div>



<div id="gliderDivs" class="glidecontentwrapper">
    
        <?php 
        //1(simple member), 2(enterprise)
        if($this->session->userdata('access_level_id') == 1){
            
            echo '<div class="glidecontent">';
                $this->load->view('editProfile/user/personal.php');
            echo '</div>';
            
           
            echo '<div class="glidecontent">';
                $this->load->view('editProfile/user/skills.php');
            echo '</div>';
            
            
        }
        else{
            echo '<div class="glidecontent">';
                $this->load->view('editProfile/enterprise/enterprise_infos.php');
            echo '</div>';
        }
        ?>
    
   
    <div class="glidecontent">
        <?php $this->load->view('editProfile/user/links.php'); ?>
    </div>

    


</div> <!-- end of glidecontent wrapper -->