<!--

/*
 * form in the site dedicated to search/filtering jobs
 */-->
<form name="searchJobs" id="searchJobs" onsubmit="return false;" action="<?php echo base_url() . "index.php/jobSearch/search" ?>">
    <div class="topBlocks logo">
        <img title="" alt="LOGO" src="<?php echo base_url() ?>images/logo.png" /><br/>
        Kimber Jobs <br/>
        <span id="logoCaption">Your daily Job delivery  system !!</span>
    </div>
    <div class="topBlocks inputs">
        <input type="text" name="jobTitle" id="jobTitle" placeholder="Job title"  value="<?php echo @$_POST['jobTitle']; ?>" /><br/>
        Exemple:<span class="searchExemple">Nurse</span>
    </div>

    <div id="IN">IN</div>

    <div class="topBlocks inputs">
        <input type="text" name="jobState" id="jobState" placeholder="Enter state" value="<?php echo @$_POST['jobState']; ?>" /><br/>
        <span class="searchExemple">Maryland</span>
    </div>
    <div class="topBlocks inputs">
        <input type="text" name="jobCountry" id="jobCountry" placeholder="Enter Country"  value="<?php echo @$_POST['jobCountry']; ?>" /><br/>
        <span class="searchExemple">Baltimore</span>
    </div>
    <div class="topBlocks inputs">
        <input type="text" name="jobCity" id="jobCity" placeholder="Enter City or Zip"  value="<?php echo @$_POST['jobCity']; ?>" /><br/>
        <span class="searchExemple">WoodLawn or 21207</span>
    </div>
    <div class="topBlocks inputs">
        <input type="submit" name="submit" value ="SEE JOBS" id="searchJobsButton" onclick="njl.show('1'); return false;" /><br/>
    </div>
</form>
