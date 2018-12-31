<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url() . 'css/fileuploader.css'; ?>" />
<script type="text/javascript" src="<?php echo base_url() . 'js/fileuploader.js'; ?>"></script>
<style>
    .qq-upload-list{        
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
<br /><div class="header_01">
    <h1>UPLOAD YOUR DOCUMENT(S)</h1>
    <a href="<?php echo base_url() . 'index.php/login/document'; ?>">Document List</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<form action="" id="" method="post">
    <fieldset>
        <center><p class="note">click on <strong><em>"select a file"</em></strong> below to send your document(s).</p></center>
        <!-- Photo -->
        <center>
             <div id="document-uploader-popup"></div>
        </center>
       
    </fieldset>
</form>
<script type="text/javascript">
    var uploader = new qq.FileUploader({
        element: document.getElementById('document-uploader-popup'),
        action: '../qqUploadedFileXhrForDocument/test',
        onComplete: function(id, fileName, response) {
//            $('.qq-upload-list').html("");
            if (response.success) {                
//                alert('Document(s) sent!');  
//                alert(response.message)
            } else alert(response.error)
        }
    });
</script>