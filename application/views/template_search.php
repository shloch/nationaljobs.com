<!DOCTYPE html>
<?php
/*
 * template to manage serach results & results filtering
 */
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/search_jobs.css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/ddsmoothmenu.css" media="screen">      
        <link rel="stylesheet" href="<?php echo base_url() ?>js/autocomplete/jquery-ui.v1.10.3.css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/ddsmoothmenu.js"></script>
        <title><?php echo $title; ?></title>
    </head>
    <body>       
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

                <div id="paramRuban">
                    <?php $this->load->view('design/ruban'); ?>
                </div>
                <div class="cleaner"></div>

                <div id="googleForm">
                    <?php $this->load->view('design/jobSearchGoogleForm'); ?>
                </div>
                <div class="cleaner"></div>

                <div id="topSeparator"></div>
            </div><!--end of HEADER div--->
            <div class="cleaner"></div>

            <div id="middle"><!--begin of MIDDLE div--->
                <?php $this->load->view($include); ?>

            </div> <!--end of middle div--->
            <div class="cleaner"></div>

            <div id="footer"><!--begin of FOOTER div--->
                <?php $this->load->view('design/footer'); ?>
            </div><!--end of FOOTER div--->
            <div class="cleaner"></div>
        </div> <!--end of global div--->

	<script type="text/javascript" src="<?php echo base_url() ?>js/autocomplete/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/autocomplete/jquery-ui.v1.10.3.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/njl.js?refresh=<?php echo time(); ?>"></script>
<!--        <script type="text/javascript" src="<?php echo base_url() ?>js/searchJobs.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url() ?>js/searchJobs.js?refresh=<?php echo time(); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/myscript.js"></script>
        <div id="loader_image" style="display:none;" ><center><img src="<?php echo base_url() ?>images/loading.gif" alt="loading" title="loading"/></center></div>
        <div id="big_loader_image" style="display:none;" ><center><img src="<?php echo base_url() ?>images/big_loading.gif" alt="loading" title="loading"/></center></div>
	<input type="hidden" id="autocomplete_controler_url" rel="<?php echo base_url() . "index.php/jobSearch/autocomplete" ?>" />
        <style>
            .tpl {
                display: none;
            }
            .hidden{
                display: none;
            }
            a.more_result {
                background: url("<?php echo base_url() ?>images/image_more.png") no-repeat scroll right center #C8C8C8;
                clear: both;
                color: #333333;
                display: inline-block;
                font-weight: bold;
                height: 10px;
                margin-bottom: 10px;
                margin-left: 27%;
                margin-top: 2px;
                padding-bottom: 13px;
                padding-right: 20px;
                padding-top: 0;
                text-align: center;
                text-decoration: none;
                width: 417px;
            }
            .button a:hover {
                color: #000000;
            }
            .greenText{
                color: green
            }
            .redText{
                color:red
            }
        </style>
        <div class="tpl nlj result">            
            <div class="resultImg" ><img style=" height: 75px;"  src="<?php echo base_url() ?>medias/photos/" alt="image" /></div>
            <div class="resultInfos">
                <strong></strong>
                <p>
                    <span class="jobdetails">Company Name: </span><span class="jobdetailsCompanyName"></span><br/>
                    <span class="jobdetails">Req. Skills: </span><span class="jobdetailsReqSkills"></span><br/>
                    <span class="jobdetails">Educ. Req: </span><span class="jobdetailsEducationReq"></span><br/>
                    <span class="jobdetails">Salary Range: </span><span class="jobdetailsSalary"></span><br/>
<!--                    <span class="jobdetailsAdditional">Other Skills : </span><span class="jobdetailsOtherSkills"></span><br/>-->
                    <span class="jobdetailsAdditional">Prefered Skills: </span><span class="jobdetailsPreferedSkills"></span><br/>
                    <strong> Listed:</strong> <span class="jobdetailsListed"></span> 
                    &nbsp; &nbsp; <span class="deadline">DEADLINE: </span><span class="jobdetailsDeadLine"></span>
                    &nbsp;&nbsp; <span class="apply"><a id="" href="javascript:void(0);" title="apply" class="applyLink" onclick="">APPLY</a></span>
                    &nbsp;&nbsp; <span class="SHARE"><a id="" href="javascript:void(0);" title="share" class="shareLink">SHARE</a></span><br/>
                    <span class="jobdetailsErrorContener" id="" >&nbsp;</span>
                </p>
            </div>
            <div class="cleaner"></div>
        </div>
        <input type="hidden" id="urlPath" value="<?php echo base_url() . "index.php/jobSearch/jobDetails"; ?>" />
        <form id="jobApplyForm" action="<?php echo base_url() . 'index.php/jobSearch/apply'; ?>" method="post">
        </form>
        <script type="text/javascript" charset="utf-8"> 
            DeleteCookie(jobResultsCookieName); //delete and empty the cookie, because this is the first search
            $(function(){<?php
                if ($include != 'jobDetails.php') {
                    ?>
                njl.show('1');
    <?php
}
?>
            
    } );
        </script>
    </body>
</html>
