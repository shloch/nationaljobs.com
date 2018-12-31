<link rel="stylesheet" href="<?php echo base_url() ?>css/for_the_date_picker/ui-lightness/jquery-ui-1.8.11.custom.css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url() ?>css/form.css" media="screen"/>
<script type="text/javascript" src="<?php echo base_url() ?>js/for_the_date_picker/jquery-ui-1.8.11.custom.min.js"></script>

<br /><div class="header_01"><h1>EDIT YOUR JOB DETAILS</h1></div>
<form action="<?php echo base_url() . 'index.php/company/SaveEditedJob'; ?>" id="addJobForm" method="post">
    <fieldset>
        <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

        <!--validation error sub block---->
        <?php
        //$jobRegistered = $this->session->userdata('jobRegistered');
        if (isset($jobEdited) && $jobEdited != FALSE) {
            echo "<h5 class='success'>" . $jobEdited . "</h5>";
        }
//        $this->session->set_userdata('emailExistError', '');
        echo "<h5 class='error'>" . validation_errors() . "</h5><br/>";
        ?>

        
        <!-- job title -->
        <div>
            <label for="jobTitle">Job Title
                <abbr title="Required field">*</abbr>
            </label>
            <textarea id="jobTitle"  name="jobTitle" > <?php echo $job->title; ?></textarea>
        </div>
        <!-- job description--> 
        <div>
            <label for="jobDescription">Job Description
                <abbr title="Required field">*</abbr>
            </label>
            <textarea id="jobDescription"  name="jobDescription"> <?php echo $job->description; ?></textarea>
        </div>

        <!-- job Deadline -->
        <div>
            <label for="deadline">Deadline
                <abbr title="Required field"></abbr>
            </label>
            <input type="text" name="deadline" id="deadline" value="<?php echo date('Y-m-d', $job->deadline); ?>"/>
        </div>

        <!-- Required Skills--> 
        <div>
            <label for="jobSkills">Required Skills 
                <abbr title="Required field">*</abbr>
            </label>
            <textarea id="jobSkills"  name="jobSkills"> <?php echo $job->skills; ?></textarea>
        </div>

        <!-- Special Training--> 
        <div>
            <label for="jobSpecialTraining">Special Training Needed 
                <abbr title="Required field"></abbr>
            </label>
            <textarea id="jobSpecialTraining"  name="jobSpecialTraining"> <?php echo $job->special_training; ?></textarea>
        </div>

        <!-- company type -->
        <div>
            <label for="companyCategorie">Company Type
                <abbr title="Required field">*</abbr>
            </label>
            <?php
            if (isset($companyCategories)) {
                if ($companyCategories->num_rows > 0) {
                    foreach ($companyCategories->result() as $row) {
                        if (isset($PresentJobCategories[$row->industryTypeID])) { 
                            //if this categorie was listed in the "kj_jobs_and_their_categories" table
                            //display as checked
                            ?>

                            <input type="checkbox" 
                                   name="companyCategorie[]" 
                                   checked="checked"
                                   value="<?php echo $row->industryTypeID; ?>"/>

                            <?php echo $row->industry_type_categories; ?>
                            <?php
                        } else {
                            ?>

                            <input type="checkbox" 
                                   name="companyCategorie[]" 
                                   value="<?php echo $row->industryTypeID; ?>"/>

                            <?php echo $row->industry_type_categories; ?>
                            <?php
                        }
                    }
                }
            }
            ?>
        </div>



        <!-- contract type -->
        <div>
            <label for="contractType">Contract type
                <abbr title="Required field">*</abbr>
            </label>
            <input type="text" name="contractType" id="contractType" value="<?php echo $job->contract_type; ?>" />
        </div>

        <!-- Education Requirement -->
        <div>
            <label for="educationRequirement">Qualification needed
                <abbr title="Required field">*</abbr>
            </label>
            <input type="text" name="educationRequirement" id="educationRequirement" value="<?php echo $job->education_requirement; ?>"/>
        </div>

        <!-- Controls -->
        <div class="controls">
            <label for="submit"></label>
            <input id="submit" name="submit" type="submit" class="button_addJob"
                   value="Save" />
        </div>

        <!--hidden jobID input --->
        <input type="hidden" name="jobID"value="<?php echo $job->job_id; ?>"/>
       
    </fieldset>
</form>






<script language="javascript">
    $(function(){            
        $.datepicker.setDefaults($.datepicker.regional['eng']);

        $('#deadline').datepicker({
            dateFormat : 'yyyy-mm-dd',
            changeMonth : true,
            changeYear : true,
            yearRange: '-50y:c+nn'
            //            maxDate: '-1d'   //to consider future dates, this line should not exist
        });
    }); 
</script>    
