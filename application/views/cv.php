<?php
/*
 * html CV page
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet"  href="<?php echo base_url() . 'css/myCVstyle.css'; ?>" media="screen">
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <!-------------------------------------PERSONAL INFOS------------------------------------------------------------------------------------------------>
        <div id="personalInfos"><!--begin of personalInfos block--->  
            <div id="cvPicture">
                <?php
                $photo_path = base_url() . "medias/photos/";
                $photo = $this->session->userdata('photo');
                if ($photo != '') { // On appele la fonction depuis le front-office
                    echo '<center><img src=' . $photo_path . $photo . ' alt=profileImage id=thePhoto /></center>';
                } else {
                    if ($this->session->userdata('access_level_id') == 1) {
                        //simple user
                        $gender = $this->session->userdata('gender');
                        $photo = $photo_path . "/default_U.jpg";
                        if ($gender == "Male")
                            $photo = $photo_path . "/default_M.jpg";
                        else if ($gender == "Female")
                            $photo = $photo_path . "/default_F.jpg";
                    }else {
                        //enterprise
                        $photo = $photo_path . "/default_E.jpg";
                    }
                    echo '  <center>
                                        <img src=' . $photo . ' alt=image id=thePhoto />
                                    </center>';
                }
                ?>
            </div>

            <div id="adresses">
            <?php
            //                $name = '<strong class=Name>'. $this->session->userdata('name') .'</strong><br/>';
            echo ($this->session->userdata('name') == NULL) ? " " : '<strong class=Name>' . $this->session->userdata('name') . '</strong><br/>';
            echo ($this->session->userdata('email') == NULL) ? " " : '<strong>E-mail</strong> :' . $this->session->userdata('email') . '<br/>';
            echo ($this->session->userdata('work_address') == NULL) ? " " : '<strong>Work address</strong> :' . $this->session->userdata('work_address') . '<br/>';
            echo ($this->session->userdata('home_address') == NULL) ? " " : '<strong>Home address</strong> :' . $this->session->userdata('home_address') . '<br/>';
            echo ($this->session->userdata('mobile') == NULL) ? " " : '<strong>Mobile</strong> :' . $this->session->userdata('mobile') . '<br/>';
            echo ($this->session->userdata('facebook') == NULL) ? " " : '<strong>Facebook</strong> : <a href="' . $this->session->userdata('facebook') . '" title="Facebook Profile">' . $this->session->userdata('facebook') . '</a><br/>';
            echo ($this->session->userdata('linkedIn') == NULL) ? " " : '<strong>linkedIn</strong> : <a href="' . $this->session->userdata('linkedIn') . '" title="LinkedIn Profile">' . $this->session->userdata('linkedIn') . '</a><br/>';
            echo ($this->session->userdata('twitter') == NULL) ? " " : '<strong>twitter</strong> : <a href="' . $this->session->userdata('twitter') . '" title="Twitter Profile">' . $this->session->userdata('twitter') . '</a><br/>';
            echo ($this->session->userdata('hobbies') == NULL) ? " " : '<strong>Hobbies</strong> :' . $this->session->userdata('hobbies') . '<br/>';
            ?>

            </div>
        </div><!--end of personalInfos block--->
        <div class="cleaner"></div>
        
        <!--------------------------------WORK HISTORY----------------------------------------------------------------------------------------------------->

<?php
if (count($workHistory) != 0) {
    ?>
            <div id="workHis"><!--begin education history---> 

                <h1>Work History</h1><hr/>

                <?php 
                foreach ($workHistory as $i)
                {
                ?>
               <div class="child"> <!--begin CHILD-->
                <div class="leftSquare">
                    <strong><?php echo $i['company_name']; ?> </strong> 
                    {<?php echo date('m-d-Y', $i['start_date']); ?> - <?php echo date('m-d-Y',$i['end_date']); ?>} :<br/>
                </div>

                <div class="rightSquare">
                    <?php echo $i['job_description']; ?> 
                </div>
            </div><!--begin CHILD-->
                 <?php 
                }
                ?>
               
            </div><!--end education history--->

    <?php
}
?>
        <!------------------------------------EDUCATION HISTORY------------------------------------------------------------------------------------------------->       

        <div id="educationHis"><!--begin work history--->    
            <h1>Education History //static </h1><hr/>

            <div class="child"> <!--begin CHILD-->
                <div class="leftSquare">
                    <strong>school Name</strong> 
                    {dateFrom> - {dateTo} :<br/>
                </div>

                <div class="rightSquare">
                    Fusce vitae accumsan massa accumsan massa.accumsan massa.
                </div>
            </div><!--begin CHILD-->

            <div class="child"> <!--begin CHILD-->
                <div class="leftSquare">
                    <strong>school Name</strong>
                    {dateFrom> - {dateTo}: <br/>
                </div>

                <div class="rightSquare">
                    Fusce vitae accumsan massa accumsan massa.accumsan massa.
                    Fusce vitae accumsan massa accumsan massa.accumsan massa.
                    Fusce vitae accumsan massa accumsan massa.accumsan massa.
                    Fusce vitae accumsan massa accumsan massa.accumsan massa.
                </div>
            </div><!--begin CHILD-->
        </div><!--end work history--->

        <!--------------------------------SPECIAL PROFESSIONAL TRAINING----------------------------------------------------------------------------------------------------->       

<?php
if (count($profTraining) != 0) {
    ?>
        <div id="proffTraining"><!--begin work proffTraining--->     
            <h1>Special professional training</h1><hr/>
           
            <?php 
            foreach ($profTraining as $i)
            {
            ?>
            <div class="child"> <!--begin CHILD-->
                <strong>{<?php echo $i['training_period']; ?>} :</strong> :<?php echo $i['certificate_obtened']; ?><br/>
            </div><!--begin CHILD-->          
            <?php
            }
            ?>

        </div><!--end work proffTraining--->

    <?php
}
?>
        <!------------------------------- AWARDS------------------------------------------------------------------------------------------------------>       

<?php
if (count($award) != 0) {
    ?>
        <div id="awards"><!--begin awards--->   

            <h1>Awards Obtained</h1><hr/>
            
            <?php 
            foreach ($award as $i)
            {
            ?>
            <div class="child"> <!--begin CHILD-->
                <strong><?php echo date( 'd-m-Y', $i['date']); ?> :</strong> : "<?php echo $i['title']; ?>"
                <br/> <em> (Delivered by <?php echo $i['issuing_organization']; ?> )</em><br/>
                <?php echo $i['description']; ?>
            </div><!--begin CHILD-->

            <?php
            }
            ?>
            
        </div><!--end awards--->
 <?php
}
?>
        <!-------------------------------------SKILLS------------------------------------------------------------------------------------------------>

<?php
if (count($skills) != 0) {
    ?>
        <div id="skills"><!--begin skills--->  
            <h1>Skills</h1><hr/>
            <?php 
            foreach ($skills as $i)
            {
                echo $i['title'].', ';
            }
            ?>
        </div><!--end skills--->
<?php
}
?>
        <!-----------------------------------REFERENCE-------------------------------------------------------------------------------------------------->

<?php
if (count($ref) != 0) {
    ?>
        <div id="references"><!--begin references--->   

            <h1>References</h1><hr/>
            <ul>
                <?php 
                foreach ($ref as $i)
                {
                    echo '<li>'.$i['reference'].'</li>';
                }
                ?>
            </ul>
        </div><!--end references--->
<?php
}
?>
        <!------------------------------------------------------------------------------------------------------------------------------------->
    <center>Generted by <?php echo site_url(); ?></center><br/>
    <center><a href="<?php echo site_url('pdf/generate'); ?>">Click here to Generate PDF </a></center>
</body>
</html>
