(function(c){
    c.jobListsResult = [];
    c.urlencode = function(clearString) {
        var output = '';
        var x = 0;
        clearString = clearString.toString();
        var regex = /(^[a-zA-Z0-9_.]*)/;
        while (x < clearString.length) {
            var match = regex.exec(clearString.substr(x));
            if (match != null && match.length > 1 && match[1] != '') {
                output += match[1];
                x += match[1].length;
            }
            else {
                if (clearString[x] == ' ') output += '_';
                else {
                    var charCode = clearString.charCodeAt(x);
                    var hexVal = charCode.toString(16);
                    output += '%' + ( hexVal.length < 2 ? '0' : '' ) + hexVal.toUpperCase();
                }
                x++;
            }
        }
        return output;
    }
    c.merge = function(array1, array2)
    {
        var array_1_lenght = array1.length;
        var array_2_lenght = array2.length;
        var result = [];

        for (i=0;i<array_1_lenght;i++) 
            result[i] = array1[i];
        var j = i;
        for (i=0;i<array_2_lenght;i++){
            result[j] = array2[i];
            j++;
        }            
			
        return result;
    };
    c.applyForTheJob = function(id)
    {   
        
        var dataString ='jobId='+id;
        var error_contener = 'job_details_error_contener_'+id;
        var button = 'job_details_button_apply_'+id;
        
        var url = $('form[id=jobApplyForm]').attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            beforeSend: function() {
                var innerContent = $('#loader_image').html();               
                $('#'+ error_contener +' ').html(innerContent);
                $('#'+ button +'').hide('500');
            },
            complete: function () {
            },
            error: function(){
                $('#'+ error_contener +' ').html('An error occured. Please try again later.');
                $('#'+ button +'').show('500');
            },
            success: function(response) {
                var tabElement = eval("(" + response + ")");
                $('#'+ error_contener +' ').removeClass('greenText').removeClass('redText');
                $('#'+ error_contener +' ').html("&nbsp;");
                if(tabElement.Error=='1'){
                    //if error
                    $('#'+ error_contener +' ').html(tabElement.Message);
                    $('#'+ error_contener +' ').addClass('redText');
                    $('#'+ button +'').show('500');
                }
                else if(tabElement.Error=='0'){
            //if success
            //we do nothing ;)
            }
            }
        })
        return false;
        
        
    };
    c.refreshJobsList = function(jobsList){
        //here we create the template for the results to be shown
        //the result is an array of javascripts object        
        //lets get it strarted            
        var job = jobsList.shift(); //take the first result
        //for each job...
        if (job) {	
            var resultLine = $('.nlj').clone(); //we take the result template; this one is hidden
            //            $(''+resultLine+'').insertBefore($('#insert_result_before_me')); //add the template to the result contener
            $('#searchResultsOnly').append(resultLine); //add the template to the result contener
            resultLine.fadeIn(500).removeClass('tpl').removeClass('nlj'); //we remove some classes css to make the template visible, especially the class .nlj
            var j = 1; //not use, but can by for indication about the job position
            //photo
            resultLine.find('.resultImg').find('img').attr('src', ''+resultLine.find('.resultImg').find('img').attr('src') + job.photo + '').attr('title', job.name).attr('alt', job.name); //we put the photo
            //end photo            
            //info part
            resultLine.find('.resultInfos').find('strong').first().html('<a href="'+$('#urlPath').val()+'/'+job.job_id+'/'+c.urlencode(job.title)+'" title="see details">'+job.title+'</a>'); //we put the title
            resultLine.find('.resultInfos').find('.jobdetailsCompanyName').text(job.name); //we put the jobdetailsReqSkills
            resultLine.find('.resultInfos').find('.jobdetailsReqSkills').text(job.skills); //we put the jobdetailsReqSkills
            resultLine.find('.resultInfos').find('.jobdetailsEducationReq').text(job.education_requirement); //we put the jobdetailsEducationReq
            min = 0;
            max = 500;
            if(job.salary_range == 1000){
                min = 500;
                max = 1000;
            }
            if(job.salary_range == 10000){
                min = 1000;
                max = 10000;
            }
            if(job.salary_range == 100000){
                min = 10000;
                max = 100000;
            }
            if(job.salary_range == 1000000){
                min = 100000;
                max = 1000000;
            }
            if(job.salary_range == 10000000){
                min = 1000000;
                max = 100000000;
            }
            resultLine.find('.resultInfos').find('.jobdetailsSalary').text('Between '+number_format(min, 2, '.', ',')+' and '+number_format(max, 2, '.', ',')+' USD'); //we put the jobdetailsSalary
            //            resultLine.find('.resultInfos').find('.jobdetailsOtherSkills').text('useless field'); //we put the jobdetailsOtherSkills
            resultLine.find('.resultInfos').find('.jobdetailsPreferedSkills').text(job.special_training); //we put the jobdetailsPreferedSkills
            resultLine.find('.resultInfos').find('.jobdetailsListed').text(job.job_registration_date); //we put the jobdetailsListed
            resultLine.find('.resultInfos').find('.jobdetailsDeadLine').text(job.deadline); //we put the jobdetailsDeadLine
            resultLine.find('.resultInfos').find('.apply').find('a').attr('id', 'job_details_button_apply_'+job.job_id).attr('onclick', 'njl.applyForTheJob('+job.job_id+')'); //we put the apply link
            resultLine.find('.resultInfos').find('.SHARE').find('a').attr('id', job.job_id); //we put the share link
            //            resultLine.find('.resultInfos').find('.apply').find('a').attr('href', ''+ resultLine.find('.resultInfos').find('.apply').find('a').attr('href')+job.job_id +'').attr('id', job.job_id); //we put the apply link
            //            resultLine.find('.resultInfos').find('.SHARE').find('a').attr('href', ''+resultLine.find('.resultInfos').find('.SHARE').find('a').attr('href')+job.job_id +'').attr('id', job.job_id); //we put the share link
            resultLine.find('.resultInfos').find('.jobdetailsErrorContener').attr('id', 'job_details_error_contener_'+job.job_id);
            //end info part
            j++;	
            //next job
            setTimeout(c.refreshJobsList, 0, jobsList)
        //yep..........we do it again, and again, and again.....til the array of result become empty
        //Aouh!
            
        }   
        
    }
    c.show = function(lastElement){
        var dataString = $('form[id=searchJobs]').serialize();
        dataString +='&lastElement='+lastElement;
        var error_contener = "loaderContenerFor_searchJob";
        if(lastElement == 1){
            //            DeleteCookie(jobResultsCookieName); //delet and empty the cookie, because this is the first search
            SetCookie(jobResultsCookieName, '', 1); //create the cookie with empty value
            error_contener = "searchResultsOnly";
        }
        var head_line = "searchResultHeadLine";
        var button = "searchJobsButton";
        var button_more_result = "more_result";
        var url = $('form[id=searchJobs]').attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            beforeSend: function() {
                var innerContent = $('#loader_image').html();
                if(lastElement == 1)
                    innerContent = $('#big_loader_image').html();                
                $('#'+ error_contener +' ').html(innerContent);                                   
                $('#'+ button +'').attr("disabled", "disabled");
                $('.'+ button_more_result +'').attr("disabled", "disabled");
            },
            complete: function () {
            },
            error: function(){
                $('#'+ error_contener +' ').html('An error occured. Please try again later.');
                $('#'+ button +'').removeAttr("disabled");
                $('.'+ button_more_result +'').removeAttr("disabled");
            },
            success: function(response) {
                var tabElement = eval("(" + response + ")");
                $('#'+ button +'').removeAttr("disabled");
                $('.'+ button_more_result +'').removeAttr("disabled");
                $('#'+ error_contener +' ').removeClass('greenText').removeClass('redText');
                $('#'+ error_contener +' ').html("&nbsp;");
                if(tabElement.Error=='1'){
                    //if error
                    $('#'+ error_contener +' ').html(tabElement.Message);
                    $('#'+ error_contener +' ').addClass('redText');
                }
                else if(tabElement.Error=='0'){
                    //if success
                    $('#stargate').html(tabElement.Data);
                    //why STARGATE? 
                    //Because the results will be loaded inside before sent to the real jobList element
                    //i did like this because of the framewrok wich was addinf "" to the tabElement.Data variable
                    jobsList = c.tempCollector;
                    //                    c.jobListsResult = c.tempoYousilb;
                    if(jobsList.length > 0){    
                        var cookieData = GetCookie(jobResultsCookieName); //here we have a string
                        //create an array of object using this string
                        //there is the order of element:
                        //job_id@_@description@_@title@_@deadline@_@job_registration_date@_@member_id@_@skills@_@special_training@_@visit_counter@_@
                        //job_category_id@_@contract_type@_@education_requirement@_@state@_@photo@_@country@_@city_or_zip@_@username@_@category_title@_@
                        //salary_range@_@year_of_experience@_@name
                        
                        //explode the string with |
                        var cookieDataArray = [];
                        if(cookieData != "")
                            cookieDataArray = cookieData.split('|'); //now we have an array of job string
                        //just create the array of object now
                        c.jobListsResult = [];
                        if(cookieDataArray.length > 0){                            
                            for(i=0;i<cookieDataArray.length;i++){
                                currentJob = cookieDataArray[i].split('@_@');//to take element as described previously, the separator is the caracter @_@, because it is very difficult to use it inside an announce
                                c.jobListsResult[i] = {
                                    "job_id":currentJob[0],
                                    "description":currentJob[1],
                                    "title":currentJob[2],
                                    "deadline":currentJob[3],
                                    "job_registration_date":currentJob[4],
                                    "member_id":currentJob[5],
                                    "skills":currentJob[6],
                                    "special_training":currentJob[7],
                                    "visit_counter":currentJob[8],
                                    "job_category_id":currentJob[9],
                                    "contract_type":currentJob[10],
                                    "education_requirement":currentJob[11],
                                    "state":currentJob[12],
                                    "photo":currentJob[13],
                                    "country":currentJob[14],
                                    "city_or_zip":currentJob[15],
                                    "username":currentJob[16],
                                    "category_title":currentJob[17],
                                    "salary_range":currentJob[18],
                                    "year_of_experience":currentJob[19], 
                                    "name":currentJob[20]
                                    };
                                    
                            }
                        }else{
                            //nothing inside the cookie, then first search
                            SetCookie(jobResultsCookieName, tabElement.JobsStrinFormatForTheCookie);
                        }
                        if(c.jobListsResult.length > 0){
                            //if we already have some result in the DOM
                            //we add the new data to the existin array
                            c.jobListsResult = c.merge(c.jobListsResult, jobsList);  
                            //to the cookie
                            //job_id@_@description@_@title@_@deadline@_@job_registration_date@_@member_id@_@skills@_@special_training@_@visit_counter@_@
                            //job_category_id@_@contract_type@_@education_requirement@_@state@_@photo@_@country@_@city_or_zip@_@username@_@category_title@_@
                            //salary_range@_@year_of_experience@_@name
                            var tempo = '';
                            for(i=0;i<c.jobListsResult.length;i++){
                                tempo += "|"+c.jobListsResult[i].job_id+"@_@"+c.jobListsResult[i].description+"@_@"+c.jobListsResult[i].title+"@_@";
                                tempo += c.jobListsResult[i].deadline+"@_@"+c.jobListsResult[i].job_registration_date+"@_@"+c.jobListsResult[i].member_id+"@_@";
                                tempo += c.jobListsResult[i].skills+"@_@"+c.jobListsResult[i].special_training+"@_@"+c.jobListsResult[i].visit_counter+"@_@";
                                tempo += c.jobListsResult[i].job_category_id+"@_@"+c.jobListsResult[i].contract_type+"@_@"+c.jobListsResult[i].education_requirement+"@_@";
                                tempo += c.jobListsResult[i].state+"@_@"+c.jobListsResult[i].photo+"@_@"+c.jobListsResult[i].country+"@_@";
                                tempo += c.jobListsResult[i].city_or_zip+"@_@"+c.jobListsResult[i].username+"@_@"+c.jobListsResult[i].category_title+"@_@";
                                tempo += c.jobListsResult[i].salary_range+"@_@"+c.jobListsResult[i].year_of_experience+"@_@"+c.jobListsResult[i].name;
                            }
                            tempo = tempo.substr(1); //remove the first character | in the string
                            //put it in the cookie
                            SetCookie(jobResultsCookieName, tempo);
                        }
                            
                        $('#'+ head_line +' ').html(tabElement.Message);   
                        //c.refreshJobsList(tabElement.Data);
                        //now the pagination        
                        //the ID of the pagination link will have the total of shown jobs, for example: 50 for the first part
                        //that means that the sql request will take the next, so 51 to 101 for a step by 50 elements
                        //yes!!!
                        if(tabElement.NextPage <= tabElement.Pages){
                            //we hide the MoreResult link
                            $('.more_result').show();
                            var nextPage = (tabElement.NextPage * 1);
                            $('.more_result').text('More Results (Page '+nextPage+'/'+tabElement.Pages+')');
                            $('.more_result').attr('id', nextPage);
                        }
                        else{
                            //we hide the MoreResult link
                            $('.more_result').hide();
                            //we remove his ID attribute value, meaning that we set it to value '0'
                            $('.more_result').attr('id', '1');
                        }
                        //$('Pagination').insertBefore($('#insert_result_before_me'));
                        if($("#searchSorting").is(":hidden"))
                        {
                            $("#searchSorting").show();
                        }
                        c.refreshJobsList(jobsList);
                        
                        $('#'+ error_contener +' ').addClass('greenText');
                    }else{
                        if(lastElement == 1){
                            $('#'+ head_line +' ').html(tabElement.Message);  //show the message in the headline
                            $('#loaderContenerFor_searchJob').html('&nbsp;');
                        }else
                            $('#'+ error_contener +' ').html(tabElement.Message);
                        
                        //we hide the MoreResult link
                        $('.more_result').hide();
                        //we remove his ID attribute value, meaning that we set it to value '0'
                        $('.more_result').attr('id', '1');
                    }                    
                }
                else if(tabElement.Error=='404'){
                    //the user session is destroyed because it take too long to work, so he must logIn again
                    $('#'+ error_contener +' ').html(tabElement.Message);
                    $('#'+ error_contener +' ').addClass('redText');
                    window.location.reload();
                }
            }
        })
        return false;
    }
    c.jobResultsFilter = function(salaryRange, searchCompany, searchLocation, searchJobType, searchexperience){       
        var cookieData = GetCookie(jobResultsCookieName); //here we have a string
        //create an array of object using this string
        //there is the order of element:
        //job_id@_@description@_@title@_@deadline@_@job_registration_date@_@member_id@_@skills@_@special_training@_@visit_counter@_@
        //job_category_id@_@contract_type@_@education_requirement@_@state@_@photo@_@country@_@city_or_zip@_@username@_@category_title@_@
        //salary_range@_@year_of_experience@_@name

        //explode the string with |
        var cookieDataArray = [];
        if(cookieData != "")
            cookieDataArray = cookieData.split('|'); //now we have an array of job string
        //just create the array of object now
        jobsList = [];
        if(cookieDataArray.length > 0){            
            for(i=0;i<cookieDataArray.length;i++){
                currentJob = cookieDataArray[i].split('@_@');//to take element as described previously, the separator is the caracter @_@, because it is very difficult to use it inside an announce
                jobsList[i] = {
                    "job_id":currentJob[0],
                    "description":currentJob[1],
                    "title":currentJob[2],
                    "deadline":currentJob[3],
                    "job_registration_date":currentJob[4],
                    "member_id":currentJob[5],
                    "skills":currentJob[6],
                    "special_training":currentJob[7],
                    "visit_counter":currentJob[8],
                    "job_category_id":currentJob[9],
                    "contract_type":currentJob[10],
                    "education_requirement":currentJob[11],
                    "state":currentJob[12],
                    "photo":currentJob[13],
                    "country":currentJob[14],
                    "city_or_zip":currentJob[15],
                    "username":currentJob[16],
                    "category_title":currentJob[17],
                    "salary_range":currentJob[18],
                    "year_of_experience":currentJob[19], 
                    "name":currentJob[20]
                    };

            }
        }
        var totalElements = jobsList.length; //this will be dynamic
        tempoJobList = []; //we will use it to store temporal result of the filter
        j = 0;
        filteringIndicatior = 0; //tell us if there is some filtergin positive operation, else we show the MoreResult button
        //we filter using the information provided in the filter form
        //salaryRange
        if(salaryRange != ""){
            filteringIndicatior = 1;
            //default
            min = 0;
            max = 500;
            if(salaryRange == 1000){
                min = 500;
                max = 1000;
            }
            if(salaryRange == 10000){
                min = 1000;
                max = 10000;
            }
            if(salaryRange == 100000){
                min = 10000;
                max = 100000;
            }
            if(salaryRange == 1000000){
                min = 100000;
                max = 1000000;
            }
            if(salaryRange == 10000000){
                min = 1000000;
                max = 100000000;
            }
            //here we go
            //open the array
            for(i=0;i<jobsList.length;i++){
                //for each element, check if matched                
                if((jobsList[i].salary_range >= min) && (jobsList[i].salary_range < max)){
                    //if matched, add object to the tempo array
                    tempoJobList[j] = jobsList[i];
                    j++;
                }
                
            }
            
        }
        
        if(tempoJobList.length != 0){
            jobsList = tempoJobList;
            tempoJobList = []; //we will use it to store temporal result of the filter
            j = 0;
        }else{
            if(salaryRange != ""){
                //we destruct the array, no result for the filter
                jobsList = [];
                tempoJobList = [];
                j = 0;
            }
        }
            
        //searchCompany
        if(searchCompany != ""){
            filteringIndicatior = 1;
            //open the array
            for(i=0;i<jobsList.length;i++){
                //for each element, check if matched                
                if(jobsList[i].member_id == searchCompany){
                    //if matched, add object to the tempo array
                    tempoJobList[j] = jobsList[i];
                    j++;
                }
                
            }
        }
        
        if(tempoJobList.length != 0){
            jobsList = tempoJobList;
            tempoJobList = []; //we will use it to store temporal result of the filter
            j = 0;
        }else{
            if(searchCompany != ""){
                //we destruct the array, no result for the filter
                jobsList = [];
                tempoJobList = [];
                j = 0;
            }
        }
        
        //searchLocation
        if(searchLocation != ""){
            filteringIndicatior = 1;
            //open the array
            for(i=0;i<jobsList.length;i++){
                //for each element, check if matched                
                if(jobsList[i].state == searchLocation){
                    //if matched, add object to the tempo array
                    tempoJobList[j] = jobsList[i];
                    j++;
                }
                
            }
        }
        
        if(tempoJobList.length != 0){
            jobsList = tempoJobList;
            tempoJobList = []; //we will use it to store temporal result of the filter
            j = 0;
        }else{
            if(searchLocation != ""){
                //we destruct the array, no result for the filter
                jobsList = [];
                tempoJobList = [];
                j = 0;
            }
        }
        
        //searchJobType
        if(searchJobType != ""){
            filteringIndicatior = 1;
            //open the array
            for(i=0;i<jobsList.length;i++){
                //for each element, check if matched                
                if(jobsList[i].job_category_id == searchJobType){
                    //if matched, add object to the tempo array
                    tempoJobList[j] = jobsList[i];
                    j++;
                }
                
            }
        }
        
        if(tempoJobList.length != 0){
            jobsList = tempoJobList;
            tempoJobList = []; //we will use it to store temporal result of the filter
            j = 0;
        }else{
            if(searchJobType != ""){
                //we destruct the array, no result for the filter
                jobsList = [];
                tempoJobList = [];
                j = 0;
            }
        }
        
        //searchexperience                
        if(searchexperience != ""){
            filteringIndicatior = 1;
            //default
            min = 0;
            max = 1;
            if(searchexperience == 2){
                min = 1;
                max = 2;
            }
            if(searchexperience == 3){
                min = 2;
                max = 3;
            }
            if(searchexperience == 4){
                min = 3;
                max = 99;
            }
            //here we go
            //open the array
            for(i=0;i<jobsList.length;i++){
                //for each element, check if matched                
                if((jobsList[i].year_of_experience >= min) && (jobsList[i].year_of_experience < max)){
                    //if matched, add object to the tempo array
                    tempoJobList[j] = jobsList[i];
                    j++;
                }
                
            }
            
        }
        //and we call the refreshList function
        var head_line = "searchResultHeadLine";
        var button_more_result = "more_result";
        if(filteringIndicatior == 1)
            $('.'+button_more_result+'').hide();
        else{
            if($('.'+button_more_result+'').attr('id') > 1){
                //it means that, we have already shown all the result, the no need to show the MoreResult again
                $('.'+button_more_result+'').show();
            }
        }
            
        if(tempoJobList.length != 0){
            $('#'+ head_line +' ').html('Showing '+tempoJobList.length+' of '+totalElements+' Job(s) for your filtering');
            $('#searchResultsOnly').html('');
            this.refreshJobsList(tempoJobList);
        }else{
            $('#'+ head_line +' ').html('Showing '+jobsList.length+' of '+totalElements+' Job(s) for your filtering');
            if(jobsList.length != 0){
                $('#searchResultsOnly').html('');
                this.refreshJobsList(jobsList);                
            }else{
                //no result for the filtering operation
                $('#searchResultsOnly').html('<center>No result for the filtering operation</center>');
            }
        }
    }
    
})(njl)


$(function(){
    $('.more_result').click(function() { 
        njl.show($(this).attr('id'));
    });
    
    $('.jobFilterFormElement').change(function() { 
        salaryRange = $("#salaryRange").val();
        searchCompany = $("#searchCompany").val();
        searchLocation = $("#searchLocation").val();
        searchJobType = $("#searchJobType").val();
        searchexperience = $("#searchexperience").val();        
        //question: do we filter the tempoArray or the total Array?
        //for the moment, we are filtering the whole array
        njl.jobResultsFilter(salaryRange, searchCompany, searchLocation, searchJobType, searchexperience);
    });
    
    $( "#jobTitle" ).autocomplete({
        source: $('#autocomplete_controler_url').attr('rel')+'/title',
        minLength: 2
    });
    $( "#jobState" ).autocomplete({
        source: $('#autocomplete_controler_url').attr('rel')+'/state',
        minLength: 2
    });
    $( "#jobCountry" ).autocomplete({
        source: $('#autocomplete_controler_url').attr('rel')+'/country',
        minLength: 2
    });
    $( "#jobCity" ).autocomplete({
        source: $('#autocomplete_controler_url').attr('rel')+'/city',
        minLength: 2
    });
   
})