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
        ?>
    </p>
</div>

<div id="searchResult">
    <center>
        <h3 id="searchResultHeadLine"></h3>
    </center>

    <!--start results-->
    <div id="searchResultsOnly">
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
    <div id="searchSorting">
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