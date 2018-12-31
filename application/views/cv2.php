<center><a href="<?php echo site_url('pdf/generate'); ?>" class="googleButton">Click here to Generate PDF </a></center><br/>
<?php
error_reporting(0);
$content = "<!DOCTYPE html>";
$content .= "<html>";
$content .="<head>";
$content .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
        <link rel=\"stylesheet\"  href=\"".base_url()."css/myCVstyle.css\">";
$content .= " <title>".$title."</title>";
$content .="    </head>";
$content .= "    <body>";
$content .= "<div id=personalInfos>";
$content .="<div id=\"cvPicture\">";
                $photo_path = base_url() . "medias/photos/";
                $photo = $this->session->userdata('photo');
                if ($photo != '') { // On appele la fonction depuis le front-office
$content .= "                    <center><img src=\"$photo_path$photo\" alt=profileImage id=thePhoto /></center>";
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
$content .= "   <center>
                    <img src=\" . $photo .\" alt=image id=thePhoto />
                </center>";
                }
$content .="            </div>";

$content .= "            <div id=\"adresses\">";
            //                $name = '<strong class=Name>'. $this->session->userdata('name') .'</strong><br/>';
$content .=    ($this->session->userdata('name') == NULL) ? " " : "<strong class=Name>" . $this->session->userdata('name') . "</strong><br/>";
$content .=    ($this->session->userdata('email') == NULL) ? " " : "<strong>E-mail</strong> :" . $this->session->userdata('email') . "<br/>";
$content .=    ($this->session->userdata('work_address') == NULL) ? " " : '<strong>Work address</strong> :' . $this->session->userdata('work_address') . '<br/>';
$content .=   ($this->session->userdata('home_address') == NULL) ? " " : '<strong>Home address</strong> :' . $this->session->userdata('home_address') . '<br/>';
$content .=   ($this->session->userdata('mobile') == NULL) ? " " : '<strong>Mobile</strong> :' . $this->session->userdata('mobile') . '<br/>';
$content .=   ($this->session->userdata('facebook') == NULL) ? " " : '<strong>Facebook</strong> : <a href="' . $this->session->userdata('facebook') . '" title="Facebook Profile">' . $this->session->userdata('facebook') . '</a><br/>';
$content .=   ($this->session->userdata('linkedIn') == NULL) ? " " : '<strong>linkedIn</strong> : <a href="' . $this->session->userdata('linkedIn') . '" title="LinkedIn Profile">' . $this->session->userdata('linkedIn') . '</a><br/>';
$content .=   ($this->session->userdata('twitter') == NULL) ? " " : '<strong>twitter</strong> : <a href="' . $this->session->userdata('twitter') . '" title="Twitter Profile">' . $this->session->userdata('twitter') . '</a><br/>';
$content .=   ($this->session->userdata('hobbies') == NULL) ? " " : '<strong>Hobbies</strong> :' . $this->session->userdata('hobbies') . '<br/>';
            

$content .=  "</div>";
$content .= "         </div>";
$content .= "        <div class=\"cleaner\"></div>";
   
if (count($workHistory) != 0) {
   
$content .= "            <div id=\"workHis\">";

$content .= "                <h1>Work History</h1><hr/>";

                foreach ($workHistory as $i)
                {
$content .= "              <div class=\"child\"> ";
$content .= "                <div class=\"leftSquare\">";
$content .= "                    <strong>". $i['company_name'] ."</strong> ";
$content .= "                    {". date('m-d-Y', $i['start_date'])."; - ". date('m-d-Y',$i['end_date'])."; } <br/>";
$content .= "                </div>";

$content .= "                 <div class=\"rightSquare\">";
$content .=                 $i['job_description']; 
$content .= "                </div>";
$content .= "            </div>";
                }
               
$content .= "            </div>";

}

$content .= "         <div id=\"educationHis\">";    
$content .= "            <h1>Education History //static </h1><hr/>";

$content .= "            <div class=\"child\">";
$content .= "                 <div class=\"leftSquare\">";
$content .= "                     <strong>school Name</strong> ";
$content .= "                    {dateFrom> - {dateTo} :<br/>";
$content .= "                 </div>

                <div class=\"rightSquare\">
                    Fusce vitae accumsan massa accumsan massa.accumsan massa.
                </div>
            </div><!--begin CHILD-->

            <div class=\"child\"> <!--begin CHILD-->
                <div class=\"leftSquare\">
                    <strong>school Name</strong>
                    {dateFrom> - {dateTo}: <br/>
                </div>

                <div class=\"rightSquare\">
                    Fusce vitae accumsan massa accumsan massa.accumsan massa.
                    Fusce vitae accumsan massa accumsan massa.accumsan massa.
                    Fusce vitae accumsan massa accumsan massa.accumsan massa.
                    Fusce vitae accumsan massa accumsan massa.accumsan massa.
                </div>
            </div><!--begin CHILD-->
        </div><!--end work history--->";

if (count($profTraining) != 0) {
  
$content .= "         <div id=\"proffTraining\"><!--begin work proffTraining--->     
            <h1>Special professional training</h1><hr/>";
           
            
            foreach ($profTraining as $i)
            {
            
$content.= "            <div class=\"child\"> <!--begin CHILD-->";
$content .= "                <strong>". $i['training_period'] ."} :</strong> :". $i['certificate_obtened']." <br/>";
$content .= "            </div><!--begin CHILD-->  ";        
            
            }

$content .= "        </div><!--end work proffTraining--->";

}

if (count($award) != 0) {
   
$content .= "         <div id=\"awards\"><!--begin awards--->   

            <h1>Awards Obtained</h1><hr/>";
            
            
            foreach ($award as $i)
            {
$content .= "            <div class=\"child\"> <!--begin CHILD-->";
$content .= "                <strong>". date('d-m-Y', $i['date'])." :</strong> : \"". $i['title'];
$content .= "               <br/> <em> (Delivered by ". $i['issuing_organization']." )</em><br/>";
$content .=                  $i['description']; 
$content .= "            </div><!--begin CHILD-->";

            }
            
$content .= "        </div><!--end awards--->";

}

if (count($skills) != 0) {
   
$content .= "        <div id=\"skills\"><!--begin skills--->  
            <h1>Skills</h1><hr/>";
            
            foreach ($skills as $i)
            {
$content .=                  $i['title'].', ';
            }
$content .= "        </div><!--end skills--->";

}

if (count($ref) != 0) {
   
$content .= "        <div id=\"references\"><!--begin references--->   

            <h1>References</h1><hr/>
            <ul>";
                
                foreach ($ref as $i)
                {
$content .= " <li>".$i['reference']."</li>";
                }
                
 $content .= "           </ul>
        </div><!--end references--->";

}

$content .= " <center>Generated by ". site_url() ."</center><br/>

</body>
</html>";
echo $content;
//generate pdf file

if ( ! write_file('./medias/pdf_cvs/mycv.html', $content))
{
     echo 'Unable to write the file';
}
?>


<center><a href="<?php echo site_url('pdf/generate'); ?>" class="googleButton">Click here to Generate PDF </a></center>