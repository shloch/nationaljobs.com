<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/myStyle2.css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/ddsmoothmenu.css" media="screen">
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/ddsmoothmenu.js"></script>
        <title> <?php echo $title; ?></title>
    </head>
    <body>
        <div id="modal_parent_div" class="hidden"> 
            <div id="modal_contener" class="hidden">                
                <div class="hide_box" title="Close the Window">

                </div>
                <div style="clear: both"></div>
                <div id="modal_content" style="margin-bottom: 20px; margin: auto">

                </div>        
            </div> 
        </div>
        <div id="globalDiv">
            <div id="header"><!--begin of HEADER div--->
                <div id="blackRuban">
                    <div id="miniLogo">
                        <a href="<?php echo base_url() . 'index.php/jobSearch' ?>">
                            <img title="" alt="LOGO" src="<?php echo base_url() ?>images/logo.png" />
                        </a><br/></div>
                    <div id="BigJobsUpperText"><a href="<?php echo base_url() . 'index.php/jobSearch' ?>">JOBS</a></div>
                </div>
                <div class="cleaner"></div>

                <div id="topSeparator"></div>
                <div id="paramRuban">
                    <?php $this->load->view('design/ruban'); ?>
                </div>
                <div class="cleaner"></div>




            </div><!--end of HEADER div--->
            <div class="cleaner"></div>

            <div id="middle"><!--begin of MIDDLE div--->


                <div id="content">
                    <?php $this->load->view($include); ?>
                </div>


            </div> <!--end of middle div--->
            <div class="cleaner"></div>

            <div id="footer"><!--begin of FOOTER div--->
                <?php $this->load->view('design/footer'); ?>

            </div><!--end of FOOTER div--->
            <div class="cleaner"></div>
        </div> <!--end of global div--->


        <script type="text/javascript" src="<?php echo base_url() ?>js/myscript.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.js"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>js/forms.js"></script>

        <div id="loader_image" style="display:none;" ><img src="<?php echo base_url() ?>images/loading.gif" alt="loading" title="loading"/></div>
        <div id="big_loader_image" style="display:none;" ><img src="<?php echo base_url() ?>images/big_loading.gif" alt="loading" title="loading"/></div>
        
        
        <script>
        $(function(){
            $('.hide_box').click(function() { 
                $('#modal_parent_div').hide();
                $('#modal_contener').hide();
                $('#modal_content').html('');
                $('.modal_windows').hide();
                $('#error_contener').html('&nbsp;');
            });
        });
    </script>
    </body>
    
</html>
