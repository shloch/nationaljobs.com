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
        <p class="note loaderImageContener" id="loaderContenerFor_searchJob">
            &nbsp;
        </p>
        <h3 id="searchResultHeadLine"> Search 5 of BALTIMORE WASHINGTON</h3>
    </center>
    <div id="searchResultsOnly">
        <div class="result">
            <div class="resultImg"><img src="<?php echo base_url() ?>images/o_image_01.jpg" alt="Image 01" /></div>
            <div class="resultInfos">
                <strong>Integer venenatis pharetra magna vitae   condimentum   ultrices.</strong>
                <p>
                    <span class="jobdetails">Req. Skills : </span> HTML , PHP5; CSS3; jQuery; Javascript<br/>
                    <span class="jobdetails">Educ.. Req : </span> My first jQuery lets us do this with the css <br/>
                    <span class="jobdetails">Salary Range : </span> 100 - 500£<br/>
                    <span class="jobdetailsAdditional">Other Skills : </span> Cook, respiratory<br/>
                    <span class="jobdetailsAdditional">Prefered Skills : </span> Zohan force<br/>
                    <strong> Listed:</strong> 05/06/2013 
                    &nbsp; &nbsp; <span class="deadline">DEADLINE</span>07/02/2013
                    &nbsp;&nbsp; <span class="apply">APPLY</span>
                    &nbsp;&nbsp; <span class="SHARE">SHARE</span>
                </p>
            </div>
            <div class="cleaner"></div>
        </div>

        <div class="result">
            <div class="resultImg"><img src="<?php echo base_url() ?>images/o_image_02.jpg" alt="Image 01" /></div>
            <div class="resultInfos">
                <strong>Integer venenatis pharetra magna vitae   condimentum   ultrices.</strong>
                <p>
                    <span class="jobdetails">Req. Skills : </span> HTML , PHP5; CSS3; jQuery; Javascript<br/>
                    <span class="jobdetails">Educ.. Req : </span> My first jQuery lets us do this with the css <br/>
                    <span class="jobdetails">Salary Range : </span> 100 - 500£<br/>
                    <span class="jobdetailsAdditional">Other Skills : </span> Cook, respiratory<br/>
                    <span class="jobdetailsAdditional">Prefered Skills : </span> Zohan force<br/>
                    <strong> Listed:</strong> 05/06/2013 
                    &nbsp; &nbsp; <span class="deadline">DEADLINE</span>07/02/2013
                    &nbsp;&nbsp; <span class="apply">APPLY</span>
                    &nbsp;&nbsp; <span class="SHARE">SHARE</span>
                </p>
            </div>
            <div class="cleaner"></div>
        </div>

        <div class="result">
            <div class="resultImg"><img src="<?php echo base_url() ?>images/o_image_02.jpg" alt="Image 01" /></div>
            <div class="resultInfos">
                <strong>Integer venenatis pharetra magna vitae   condimentum   ultrices.</strong>
                <p>
                    <span class="jobdetails">Req. Skills : </span> HTML , PHP5; CSS3; jQuery; Javascript<br/>
                    <span class="jobdetails">Educ.. Req : </span> My first jQuery lets us do this with the css <br/>
                    <span class="jobdetails">Salary Range : </span> 100 - 500£<br/>
                    <span class="jobdetailsAdditional">Other Skills : </span> Cook, respiratory<br/>
                    <span class="jobdetailsAdditional">Prefered Skills : </span> Zohan force<br/>
                    <strong> Listed:</strong> 05/06/2013 
                    &nbsp; &nbsp; <span class="deadline">DEADLINE</span>07/02/2013
                    &nbsp;&nbsp; <span class="apply">APPLY</span>
                    &nbsp;&nbsp; <span class="SHARE">SHARE</span>
                </p>
            </div>
            <div class="cleaner"></div>
        </div>

        <div id="insert_result_before_me"></div>
    </div>
    <!--start pagination-->
    <div class="cleaner"></div>
    <div id="searchResultsPaginationOnly">
        <table border=1 width=100% cellpadding=6 cellspacing=6 class="paginationTable">
            <tr>
                <td colspan=7 align=center>  
                    <div class='paginate'>
                        <a href='search.php?t=true&page=10'>previous</a>
                        <a href='search.php?t=true&page=1'>1</a>
                        <a href='search.php?t=true&page=2'>2</a>
                        ...
                        <a href='search.php?t=true&page=7'>7</a>
                        <a href='search.php?t=true&page=8'>8</a>
                        <a href='search.php?t=true&page=9'>9</a>
                        <a href='search.php?t=true&page=10'>10</a>
                        <span class='current'>11</span><a href='search.php?t=true&page=12'>12</a>
                        <a href='search.php?t=true&page=13'>13</a>
                        <a href='search.php?t=true&page=14'>14</a>
                        <a href='search.php?t=true&page=15'>15</a>
                        ...
                        <a href='search.php?t=true&page=58'>58</a>
                        <a href='search.php?t=true&page=59'>59</a>
                        <a href='search.php?t=true&page=12'>Next</a>
                    </div>
                </td>
            </tr>
        </table>
        <div id="insert_pagination_before_me"></div>
    </div>
    <!--end pagination-->
    <div class="cleaner"></div>
</div>

<div id="searchParam">
    <div id="newsletter">
        Get new jobs for <br/>this search in your email
        <form>
            <input type="text" name="searchWords"/><input type="image" src="<?php echo base_url() ?>images/go.gif" alt="GO" name="submitSearch"/>
        </form>
    </div>
    <div id="searchSorting">
        <form>
            <label for="salaryRange">Salary Range</label><br/>
            <select name="salaryRange" id="salaryRange">
                <option value="0 - 500">0 - 500</option>
                <option value="0 - 500">500 - 1000</option>
                <option value="0 - 500">500 - 1000</option>
                <option value="0 - 500">500 - 1000</option>

            </select><br/><br/>

            <label for="searchCompany">Company</label><br/>
            <select name="searchCompany" id="searchCompany">
                <option value="0 - 500">Company1</option>
                <option value="0 - 500">Company2</option>
                <option value="0 - 500">Company3</option>
                <option value="0 - 500">Company4</option>

            </select><br/><br/>

            <label for="searchLocation">searchLocation</label><br/>
            <select name="searchLocation" id="searchLocation">
                <option value="0 - 500">Location1</option>
                <option value="0 - 500">Location2</option>
                <option value="0 - 500">Location3</option>
                <option value="0 - 500">Location4</option>

            </select><br/><br/>

            <label for="searchJobType">Job Type</label><br/>
            <select name="searchJobType" id="searchJobType">
                <option value="0 - 500">volunteer</option>
                <option value="0 - 500">Part time</option>
                <option value="0 - 500">Contract</option>
                <option value="0 - 500">Internship</option>

            </select><br/><br/>
            <label for="searchexperience">My experience</label><br/>

            <select name="searchexperience" id="searchexperience">
                <option value="0 - 500">1 year</option>
                <option value="0 - 500">2 years</option>
                <option value="0 - 500">3 years</option>
                <option value="0 - 500">4 years</option>

            </select><br/><br/>

            <label for="searchPagination">Jobs per page</label><br/>
            <select name="searchPagination" id="searchPagination">
                <option value="0 - 500">1</option>
                <option value="0 - 500">2</option>
                <option value="0 - 500">3</option>
                <option value="0 - 500">4</option>

            </select><br/><br/>
        </form>
    </div>
</div>
