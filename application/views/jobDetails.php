<div id="profile">
    <p>
        <?php
        $logged = $this->session->userdata('member_id');
        if (isset($logged) && $logged != FALSE) {
            ?>
            PROFILE INFOS
            <?php
        } else {
            ?>
            <b><a href="<?php echo base_url() . 'index.php/login/signUp'; ?>" title="sing up now">Not Registered?</a></b><br />
            <i>Create your account 
                today and expose 
                your resume to 
                thousands of 
                employers!</i> <br /><br />
            <b>Can’t Create a 
                Resume? </b><br />
            <i>We are here to help! <br /><br />
                Simply register an 
                account and we will 
                take care of the rest 
                for you! <br /><br />
                Extra Help is 
                available, should 
                you need it. </i>
            <?php
        }
        $job = $this->session->userdata('choosen_job');
        ?>
    </p>
</div>

<div id="searchResult">
    <center>
        <h3 id="searchResultHeadLine"><?php echo $job['title']; ?></h3>
    </center>

    <!--start results-->
    <div id="searchResultsOnly">
        <div class="result">            
            <div class="resultImg" ><img style=" height: 75px;"  src="<?php echo base_url() ?>medias/photos/<?php echo $job['photo'] ?>" alt="image" /></div>
            <div class="resultInfos">
                <strong>Listed: <?php echo date('Y-m-d', $job['job_registration_date']) ?> (<?php echo $job['visit_counter'] ?> view(s))</strong>
                <p>
                    <span class="jobdetails">Company Name: </span><span class="jobdetailsCompanyName"><?php echo $job['name'] ?></span><br/>
                    <span class="jobdetails">Description: </span><span class="jobdetailsJobCategory"><?php echo $job['description'] ?></span><br/>
                    
                    <span class="jobdetails">Contract Type: </span><span class="jobdetailsContractType"><?php echo $job['contract_type'] ?></span><br/>
                    <span class="jobdetails">Year of experience: </span><span class="jobdetailsYOE"><?php echo $job['year_of_experience'] ?></span><br/>
                    <span class="jobdetails">Job Category: </span><span class="jobdetailsJobCategory"><?php echo $job['category_title'] ?></span><br/>
                    <span class="jobdetails">Country: </span><span class="jobdetailsJobCategory"><?php echo $job['country'] ?></span><br/>
                    <span class="jobdetails">State: </span><span class="jobdetailsJobCategory"><?php echo $job['state'] ?></span><br/>
                    
                    <span class="jobdetails">Required Skills: </span><span class="jobdetailsReqSkills"><?php echo $job['skills'] ?></span><br/>
                    <span class="jobdetails">Education Required: </span><span class="jobdetailsEducationReq"><?php echo $job['education_requirement'] ?></span><br/>
                    <?php
                    $min = 0;$max = 500;
                    if($job['salary_range'] == 1000){
                        $min = 500;$max = 1000;
                    }
                    else if($job['salary_range'] == 10000){
                        $min = 1000;$max = 10000;
                    }
                    else if($job['salary_range'] == 100000){
                        $min = 10000;$max = 100000;
                    }
                    else if($job['salary_range'] == 1000000){
                        $min = 100000;$max = 1000000;
                    }
                    else if($job['salary_range'] == 10000000){
                        $min = 1000000;$max = 100000000;
                    }
                    ?>
                    <span class="jobdetails">Salary Range: </span><span class="jobdetailsSalary">Between <?php echo number_format($min, 2) ?> and <?php echo number_format($max, 2) ?> USD</span><br/>
<!--                    <span class="jobdetailsAdditional">Other Skills : </span><span class="jobdetailsOtherSkills"><<?php echo $job['photo'] ?>/span><br/>-->
                    <span class="jobdetailsAdditional">Prefered Skills: </span><span class="jobdetailsPreferedSkills"><?php echo $job['special_training'] ?></span><br/>
                    <strong> Listed:</strong> <span class="jobdetailsListed"><?php echo date('Y-m-d', $job['job_registration_date']) ?></span> 
                    &nbsp; &nbsp; <span class="deadline">DEADLINE: </span><span class="jobdetailsDeadLine"><?php echo date('Y-m-d', $job['deadline']) ?></span>
                    <?php
                    $appliyOrNot = $this->session->userdata('alreadyApply');
                    if(!$appliyOrNot){
                    ?>
                    &nbsp;&nbsp; <span class="apply"><a id="job_details_button_apply_<?php echo $job['job_id'] ?>" onclick="njl.applyForTheJob(<?php echo $job['job_id'] ?>);" href="javascript:void(0);" title="apply" class="applyLink">APPLY</a></span>
                    <?php
                    }
                    ?>
                    &nbsp;&nbsp; <span class="SHARE"><a href="javascript:void(0);" title="share" class="shareLink">SHARE</a></span><br />
                    <span class="jobdetailsErrorContener" id="job_details_error_contener_<?php echo $job['job_id'] ?>">&nbsp;</span>
                </p>
            </div>
            <div class="cleaner"></div>
        </div>
        <div id="insert_result_before_me"></div>
    </div>
    <!--end results-->

    <!--start pagination-->
    <div class="cleaner"></div>
    <div id="searchResultsPaginationOnly">        
        <!--        <div id="insert_pagination_before_me"></div>-->
        <a class="more_result" style="display:none;" href="javascript:void(0);" id="1" ></a>
    </div>
    <center>
        <p class="note loaderImageContener" id="loaderContenerFor_searchJob">
            &nbsp;
        </p>
    </center>
    <!--end pagination-->

    <!--start stargate-->
    <div id="stargate" class="hidden">
    </div>
    <!--end stargate-->

    <div class="cleaner"></div>
</div>

<div id="searchParam">
<!--    <div id="newsletter">
        Get new jobs for <br/>this search in your email
        <form>
            <input type="text" name="searchWords"/><input type="image" src="<?php echo base_url() ?>images/go.gif" alt="GO" name="submitSearch"/>
        </form>
    </div>-->
    <div id="searchSorting" style="display:none;">
        <form>
            <label for="salaryRange">Month salary Range</label><br/>
            <select name="salaryRange" id="salaryRange" class="jobFilterFormElement">
                <option value="">All</option>
                <option value="500">0 - 500</option>
                <option value="1000">500 - 1000</option>
                <option value="10000">1000 - 10000</option>
                <option value="100000">10000 - 100000</option>
                <option value="1000000">100000 - 1000000</option>
                <option value="10000000">More than 1000000</option>

            </select><br/><br/>

            <label for="searchCompany">Company</label><br/>
            <select name="searchCompany" id="searchCompany" class="jobFilterFormElement">
                <option value="">All</option>
            <?php
                $companies = $this->session->userdata('companies');
                foreach ($companies as $company) {
                    echo '<option value='.$company['member_id'].'>'.$company['name'].'</option>';
                }
            ?>               
            </select><br/><br/>

            <label for="searchLocation">searchLocation</label><br/>
            <select name="searchLocation" id="searchLocation" class="jobFilterFormElement">
                <option value="">All</option>
                <option value="douala">Douala</option>
                <option value="baltimore">Baltimore</option>
            </select><br/><br/>

            <label for="searchJobType">Job Type</label><br/>
            <select name="searchJobType" id="searchJobType" class="jobFilterFormElement">
                <option value="">All</option>
            <?php
                $jobCategories = $this->session->userdata('jobCategories');
                foreach ($jobCategories as $jobCategory) {
                    echo '<option value='.$jobCategory['job_category_id'].'>'.$jobCategory['title'].'</option>';
                }
            ?>
            </select><br/><br/>
            
            <label for="searchexperience">My experience</label><br/>
            <select name="searchexperience" id="searchexperience" class="jobFilterFormElement">
                <option value="">All</option>
                <option value="1">0 - 1 year</option>
                <option value="2">1 - 2 years</option>
                <option value="3">2 - 3 years</option>
                <option value="4">more than 3 years</option>

            </select><br/><br/>
<!--
            <label for="searchPagination">Jobs per page</label><br/>
            <select name="searchPagination" id="searchPagination">
                <option value="0 - 500">1</option>
                <option value="0 - 500">2</option>
                <option value="0 - 500">3</option>
                <option value="0 - 500">4</option>

            </select><br/><br/>-->
        </form>
    </div>
</div>