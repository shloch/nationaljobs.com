<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url() . 'css/fileuploader.css'; ?>" />
<script type="text/javascript" src="<?php echo base_url() . 'js/fileuploader.js'; ?>"></script>
<style>
    .photo_box{        
        background-image: linear-gradient(white, #EBEBEB);
        border: 1px solid #CDD3D8;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.06);
        display: block;
        font-size: 16px;
        margin: 25px auto 0;
        max-width: 308px;
        min-width: 120px;
        padding: 12px 20px;
        width: 90%;
    }
</style>
<br /><div class="header_01"><h1>EDIT PROFILE PHOTO(Max: 200*200px, Min: 50*50px)</h1></div>
<form action="<?php echo base_url() . 'index.php/login/editPersonalInformations'; ?>" id="editPersonalInformationsForm" method="post">
    <fieldset>
        <center><p class="note">click on <strong><em>"select a file"</em></strong> below to edit your profile photo .</p></center>
        <!-- Photo -->
        <div class="ligneFormPhoto" id="uploadPhoto" style="margin:auto">         
          <div class="photo_box">
                 <?php
                    $photo_path = base_url() ."medias/photos/";
                    $photo = $this->session->userdata('photo');
                    if($photo != '') // On appele la fonction depuis le front-office
                    {
                        echo '<center><img src='.  $photo_path.$photo.' alt=profileImage id=thePhoto /></center>';
                    }
                    else
                    {
                        if($this->session->userdata('access_level_id') == 1){
                            //simple user
                            $gender = $this->session->userdata('gender');
                            $photo = $photo_path."/default_U.jpg";
                            if($gender == "Male")
                                $photo = $photo_path."/default_M.jpg";
                            else if($gender == "Female")
                                $photo = $photo_path."/default_F.jpg";
                        }else{
                            //enterprise
                            $photo = $photo_path."/default_E.jpg";
                        }
                         echo '  <center>
                                        <img src='. $photo.' alt=image id=thePhoto />
                                    </center>';
                    }
                  ?>
                <div style="text-align: center">
                    <div id="photo-uploader-popup"></div>
                </div>
                <div class="clearBoth"></div>
            </div>
        </div>
    </fieldset>
</form>
<script type="text/javascript">
    var uploader = new qq.FileUploader({
        element: document.getElementById('photo-uploader-popup'),
        action: '../qqUploadedFileXhr/test',
        onComplete: function(id, fileName, response) {
            $('.qq-upload-list').html("");
            if (response.success) {                
                $('#thePhoto').attr('src', response.photo);  
//                alert(response.message)
            } else alert(response.error)
        }
    });
</script>